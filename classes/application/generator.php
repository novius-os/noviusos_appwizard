<?php
/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

namespace Nos\AppWizard;

class Application_Generator
{
    public static function generate($config, $input)
    {
        $root_dir = APPPATH.'applications/'.$input['application_settings']['folder'];

        foreach ($config['fields'] as $key => &$field_config) {
            if (!isset($field_config['views'])) {
                $field_config['views'] = array();
            }
            if (!isset($field_config['views']['data_mapping'])) {
                $field_config['views']['data_mapping'] = $config['generation_path'].'/fields/data_mapping/'.$key;
            }
            if (!isset($field_config['views']['crud_name'])) {
                $field_config['views']['crud_name'] = $config['generation_path'].'/fields/crud/name/'.$key;
            }
            if (!isset($field_config['views']['crud_config'])) {
                $field_config['views']['crud_config'] = $config['generation_path'].'/fields/crud/config/'.$key;
            }
            if (!isset($field_config['views']['sql'])) {
                $field_config['views']['sql'] = $config['generation_path'].'/fields/sql/'.$key;
            }
        }

        if (file_exists($root_dir)) {
            throw new \Exception('Folder already exists!');
        }
        mkdir($root_dir, 0775);
        chmod($root_dir, 0775);
        static::generateFolders($root_dir, $config['folders']);
        static::generateFiles($root_dir, $config, $input);
        if (!empty($input['generation_options']['install'])) {
            $application = \Nos\Application::forge($input['application_settings']['folder']);
            $application->install();
        }
        return array();
    }

    public static function indent($pre, $str)
    {
        $exploded_str = explode("\n", $str);
        foreach ($exploded_str as &$line) {
            $line = $pre.$line;
        }
        return implode("\n", $exploded_str);
    }

    protected static function generateFolders($root_dir, $folders)
    {
        foreach ($folders as $folder) {
            mkdir($root_dir.DS.$folder, 0775);
            chmod($root_dir.DS.$folder, 0775);
        }
    }

    protected static function generateFiles($root_dir, $config, $input)
    {
        $files = $config['files']($root_dir, $input, $config);
        foreach ($files as $file) {
            if (!is_array($file)) {
                $file = array(
                    'template' => $file,
                    'destination' => $file,
                    'data' => array('data' => $input, 'config' => $config),
                );
            }
            file_put_contents($root_dir.DS.$file['destination'], render($config['generation_path'].'/'.$file['template'], $file['data'], false));
            chmod($root_dir.DS.$file['destination'], 0664);
        }
    }
}
