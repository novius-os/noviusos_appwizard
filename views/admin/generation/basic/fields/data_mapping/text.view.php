'<?= $model['column_prefix'].$field['column_name'] ?>' => array(
    'title' => __(<?= var_export($field['label']) ?>),
    'value' => function($item) {
        return \Str::truncate($item-><?= $model['column_prefix'].$field['column_name'] ?>, 30);
    },
),