'<?= $model['column_prefix'].$field['name'] ?>' => array (
    'label' => __('<?= \Inflector::humanize($field['name']) ?>'),
    'form' => array(
        'type' => 'textarea',
        'rows' => '6',
    ),
),