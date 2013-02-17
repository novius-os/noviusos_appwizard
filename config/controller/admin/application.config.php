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
            'classes/controller/front',
            'classes/model',
            'config',
            'config/controller',
            'config/controller/admin',
            'config/model',
            'config/common',
            'views',
            'views/admin',
            'views/front',
            'static',
            'static/img',
            'static/img/16',
            'static/img/32',
            'static/img/64',
        ),
        'files' =>
            function($root_dir, $data, $config)
            {
                $theme_path = realpath(__DIR__.DS.'..'.DS.'..'.DS.'..'.DS.'views'.DS.'admin'.DS.'generation'.DS.'basic'); // @todo: find better way to do it
                copy($theme_path.DS.'static'.DS.'img'.DS.'16'.DS.'icon.png', $root_dir.DS.'static'.DS.'img'.DS.'16'.DS.'icon.png');
                copy($theme_path.DS.'static'.DS.'img'.DS.'32'.DS.'icon.png', $root_dir.DS.'static'.DS.'img'.DS.'32'.DS.'icon.png');
                copy($theme_path.DS.'static'.DS.'img'.DS.'64'.DS.'icon.png', $root_dir.DS.'static'.DS.'img'.DS.'64'.DS.'icon.png');

                // remove blank models, categories and fields
                if (isset($data['models']) && is_array($data['models'])) {
                    $models = array();
                    foreach ($data['models'] as $model) {
                        if (!empty($model['name']) && !empty($model['table_name']) && !empty($model['column_prefix'])) {
                            $categories = array();
                            foreach ($model['categories'] as $category) {
                                if (!empty($category['name'])) {
                                    $categories[] = $category;
                                }
                            }
                            $model['categories'] = $categories;

                            $fields = array();
                            $title_column_name = null;
                            foreach ($model['fields'] as $field) {
                                if (!empty($field['label']) && !empty($field['column_name'])) {
                                    $fields[] = $field;
                                }
                                if (isset($field['is_title']) && $field['is_title']) {
                                    $title_column_name = $field['column_name'];
                                }
                            }
                            $model['fields'] = $fields;
                            $model['title_column_name'] = $title_column_name;

                            $models[] = $model;
                        }
                    }
                    $data['models'] = $models;
                }

                $files = array();
                $files[] = array(
                    'template' => 'config/metadata.config',
                    'destination' => 'config/metadata.config.php',
                    'data' => array('data' => $data, 'config' => $config),
                );
                $files[] = array(
                    'template' => 'install.sql',
                    'destination' => 'install.sql',
                    'data' => array('data' => $data, 'config' => $config),
                );

                if (isset($data['models']) && is_array($data['models']) && count($data['models']) > 0) {
                    foreach ($data['models'] as $model) {
                        mkdir($root_dir.'/classes/controller/admin/'.strtolower($model['name']), 0777);
                        chmod($root_dir.'/classes/controller/admin/'.strtolower($model['name']), 0777);
                        mkdir($root_dir.'/config/controller/admin/'.strtolower($model['name']), 0777);
                        chmod($root_dir.'/config/controller/admin/'.strtolower($model['name']), 0777);
                        $model_data = array('model' => $model, 'data' => $data, 'config' => $config);
                        $files[] = array(
                            'template' => 'classes/controller/admin/appdesk.ctrl',
                            'destination' => 'classes/controller/admin/'.strtolower($model['name']).'/appdesk.ctrl.php',
                            'data' => $model_data,
                        );
                        $files[] = array(
                            'template' => 'classes/controller/admin/crud.ctrl',
                            'destination' => 'classes/controller/admin/'.strtolower($model['name']).'/crud.ctrl.php',
                            'data' => $model_data,
                        );
                        if (isset($model['has_url_enhancer'])) {
                            $files[] = array(
                                'template' => 'classes/controller/front.ctrl',
                                'destination' => 'classes/controller/front/'.strtolower($model['name']).'.ctrl.php',
                                'data' => $model_data,
                            );
                        }
                        $files[] = array(
                            'template' => 'classes/model/model.model',
                            'destination' => 'classes/model/'.strtolower($model['name']).'.model.php',
                            'data' => $model_data,
                        );
                        $files[] = array(
                            'template' => 'config/common/model.config',
                            'destination' => 'config/common/'.strtolower($model['name']).'.config.php',
                            'data' => $model_data,
                        );
                        $files[] = array(
                            'template' => 'config/controller/admin/appdesk.config',
                            'destination' => 'config/controller/admin/'.strtolower($model['name']).'/appdesk.config.php',
                            'data' => $model_data,
                        );
                        $files[] = array(
                            'template' => 'config/controller/admin/crud.config',
                            'destination' => 'config/controller/admin/'.strtolower($model['name']).'/crud.config.php',
                            'data' => $model_data,
                        );
                        if (isset($model['has_url_enhancer'])) {
                            $files[] = array(
                                'template' => 'views/front/model_item.view',
                                'destination' => 'views/front/'.strtolower($model['name']).'_item.view.php',
                                'data' => $model_data,
                            );
                            $files[] = array(
                                'template' => 'views/front/model_list.view',
                                'destination' => 'views/front/'.strtolower($model['name']).'_list.view.php',
                                'data' => $model_data,
                            );
                        }
                    }
                }

                return $files;
            },
        'category_types' => array(
            'main' => array(
                'label' => __('Main column')
            ),
            'menu' => array(
                'label' => __('Side column')
            ),
        ),
        'fields' => array(
            'single_line' => array(
                'label' => __('Single line text'),
            ),
            'wysiwyg' => array(
                'label' => __('WYSIWYG text editor')
            ),
            'text' => array(
                'label' => __('Paragraph text')
            ),
            'checkbox' => array(
                'label' => __('Checkbox')
            ),
            'image' => array(
                'label' => __('Image from Media Centre')
            ),

        )
    ),
);