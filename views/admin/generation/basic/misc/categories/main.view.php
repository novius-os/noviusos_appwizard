'<?= Inflector::friendly_title($category['name'], '_', true, false) ?>' => array(
    'view' => 'nos::form/expander',
    'params' => array(
        'title'   => __(<?= var_export($category['name']) ?>),
        'nomargin' => true,
        'options' => array(
            'allowExpand' => false,
        ),
        'content' => array(
            'view' => 'nos::form/fields',
            'params' => array(
                'fields' => array(
<?php
$fieldsName = array();
foreach ($fields as $field) {
    $fieldsName[] = render(
        $config['generation_path'].'/fields/crud/name/'.$field['type'],
        array(
            'field' => $field,
            'model' => $model,
            'data' => $data,
            'config' => $config,
        )
    );
}
if (count($fieldsName) > 0) {
    echo '                    \''.implode("',\n                    '", $fieldsName).'\'';
    echo "\n";
}
?>
                ),
            ),
        ),
    ),
),