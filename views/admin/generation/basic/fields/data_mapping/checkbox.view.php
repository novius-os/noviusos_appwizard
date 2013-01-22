'<?= $model['column_prefix'].$field['column_name'] ?>' => array(
    'title' => __(<?= var_export($field['label']) ?>),
    'value' => function($item) {
        return $item-><?= $model['column_prefix'].$field['column_name'] ?> ? __('Yes') : __('No');
    },
),