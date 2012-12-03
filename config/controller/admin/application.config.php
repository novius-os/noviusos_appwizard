<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

return array(
    'basic' => array(
        'form_path' => 'noviusos_appwizard::admin/form/basic',
        'generation_path' => 'noviusos_appwizard::admin/generation/basic',
        'folders' => array(
            'classes',
            'classes/controller',
            'classes/controller/admin',
            'classes/model',
            'config',
            'config/controller',
            'config/controller/admin',
            'config/model',
            'config/common',
            'static',
            'views',
            'views/admin',
            'views/front'
        ),
        'files' => function($root_dir, $data, $config) {
            $files = array();
            $files[] = 'config/metadata.config.php';
            $files[] = array(
                'template' => 'install.sql.php',
                'destination' => 'install.sql',
                'data' => array('data' => $data, 'config' => $config),
            );

            if (isset($data['models'])) {
                foreach ($data['models'] as $model) {
                    mkdir($root_dir.'/classes/controller/admin/'.strtolower($model['name']), 0777);
                    chmod($root_dir.'/classes/controller/admin/'.strtolower($model['name']), 0777);
                    mkdir($root_dir.'/config/controller/admin/'.strtolower($model['name']), 0777);
                    chmod($root_dir.'/config/controller/admin/'.strtolower($model['name']), 0777);
                    $model_data = array('model' => $model, 'data' => $data, 'config' => $config);
                    $files[] = array(
                        'template' => 'classes/controller/admin/appdesk.ctrl.php',
                        'destination' => 'classes/controller/admin/'.strtolower($model['name']).'/appdesk.ctrl.php',
                        'data' => $model_data,
                    );
                    $files[] = array(
                        'template' => 'classes/controller/admin/crud.ctrl.php',
                        'destination' => 'classes/controller/admin/'.strtolower($model['name']).'/crud.ctrl.php',
                        'data' => $model_data,
                    );
                    $files[] = array(
                        'template' => 'classes/model/model.model.php',
                        'destination' => 'classes/model/'.strtolower($model['name']).'.model.php',
                        'data' => $model_data,
                    );
                    $files[] = array(
                        'template' => 'config/common/model.config.php',
                        'destination' => 'config/common/'.strtolower($model['name']).'.config.php',
                        'data' => $model_data,
                    );
                    $files[] = array(
                        'template' => 'config/controller/admin/appdesk.config.php',
                        'destination' => 'config/controller/admin/'.strtolower($model['name']).'/appdesk.config.php',
                        'data' => $model_data,
                    );
                    $files[] = array(
                        'template' => 'config/controller/admin/crud.config.php',
                        'destination' => 'config/controller/admin/'.strtolower($model['name']).'/crud.config.php',
                        'data' => $model_data,
                    );
                }
            }

            return $files;
        },
        'category_types' => array(
            'main' => array(
                'label' => __('Main view')
            ),
            'menu' => array(
                'label' => __('Menu view')
            ),
        ),
        'fields' => array(
            'single_line' => array(
                'label' => __('Single line'),
            ),
            'wysiwyg' => array(
                'label' => __('Wysiwyg')
            ),
            'text' => array(
                'label' => __('Text')
            ),
            'checkbox' => array(
                'label' => __('Checkbox')
            ),
        )
    ),
);