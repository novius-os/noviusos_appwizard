'<?= $model['column_prefix'].$field['name'] ?>' => array(
    'title' => __('<?= \Inflector::humanize($field['name']) ?>'),
    'value' => function($item) {
        return $item-><?= $model['column_prefix'].$field['name'] ?> ? __('Yes') : __('No');
    },
),