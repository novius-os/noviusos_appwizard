'wysiwygs-><?= $field['column_name'] ?>->wysiwyg_text' => array(
    'label' => __(<?= var_export($field['label']) ?>),
    'renderer' => 'Nos\Renderer_Wysiwyg',
    'template' => '{field}',
    'form' => array(
        'style' => 'width: 100%; height: 500px;',
    ),
),