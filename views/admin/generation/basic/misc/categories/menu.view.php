__('<?= $category['name'] ?>') => array(
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
    echo '    \''.implode("',\n    '", $fieldsName).'\'';
    echo "\n";
}
?>
),