__(<?= var_export($category['name']) ?>) => array(
<?php
$fieldsName = array();
foreach ($fields as $field) {
    $fieldsName[] = render(
        $config['fields'][$field['type']]['views']['crud_name'],
        array(
            'field' => $field,
            'model' => $model,
            'data' => $data,
            'config' => $config,
        )
    );
}
if (count($fieldsName) > 0) {
    echo '    \''.implode("',\n    '", $fieldsName).'\'';
    echo "\n";
}
?>
),