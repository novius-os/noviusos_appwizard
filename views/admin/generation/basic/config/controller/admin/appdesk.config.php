<?= "<?php\n" ?>
<?php
$thumbnails = false;
foreach ($model['fields'] as $field) {
    if (isset($field['is_on_appdesk']) && $field['is_on_appdesk']) {
        if ($field['type'] == 'image') {
            $thumbnails = true;
            break;
        }
    }
}
?>
return array(
    'model' => '<?= $data['application_settings']['namespace'] ?>\Model_<?= $model['name'] ?>',
<?php
if ($thumbnails) {
    echo <<<MYDELIMITER
    'thumbnails' => true,
    /*
    'appdesk' => array(
        'appdesk' => array(
            'defaultView' => 'thumbnails',
        ),
    ),
    */
MYDELIMITER;
    echo "\n";
}
?>
    'search_text' => <?= var_export($model['column_prefix'].$model['title_column_name'], true) ?>,
    /*
    'inspectors' => array(
        'author',
        'tag',
        'category',
        'date'
    ),
    */
    /*
    'query' => array(
        'model' => '{{namespace}}\Model_Post',
        'order_by' => array('post_created_at' => 'DESC'),
        'limit' => 20,
    ),
    */
);
