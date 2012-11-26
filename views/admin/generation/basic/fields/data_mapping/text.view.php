'<?= $model['column_prefix'].$field['name'] ?>' => array(
    'title' => __('<?= \Inflector::humanize($field['name']) ?>'),
    'value' => function($item) {
        return \Str::truncate($item-><?= $model['column_prefix'].$field['name'] ?>, 30);
    },
),