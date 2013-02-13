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
    <?= $thumbnails ? "'thumbnails' => true," : '' ?>
    /*
    'search_text' => 'post_title',
    */
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
