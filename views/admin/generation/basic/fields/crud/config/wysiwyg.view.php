'wysiwygs-><?= $field['name'] ?>->wysiwyg_text' => array(
    'label' => __('<?= \Inflector::humanize($field['name']) ?>'),
    'widget' => 'Nos\Widget_Wysiwyg',
    'template' => '{field}',
    'form' => array(
        'style' => 'width: 100%; height: 500px;',
    ),
),