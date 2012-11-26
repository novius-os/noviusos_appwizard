<?= "<?php\n" ?>
return array(
    'data_mapping' => array(
<?php
foreach ($model['fields'] as $field) {
    if (isset($field['is_on_appdesk']) && $field['is_on_appdesk']) {
        echo \Nos\AppWizard\Application_Generator::indent(
            '        ',
            render(
                $config['generation_path'].'/fields/data_mapping/'.$field['type'],
                array(
                    'field' => $field,
                    'model' => $model,
                    'data' => $data,
                    'config' => $config
                )
            )
        );
    }
}
echo "\n";
?>
    ),
    'controller' => '<?= strtolower($model['name']).'/crud' ?>',
);