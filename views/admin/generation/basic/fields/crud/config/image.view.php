'medias-><?= $field['column_name'] ?>->medil_media_id' => array(
    'label' => '',
    'renderer' => 'Nos\Media\Renderer_Media',
    'form' => array(
        'title' => __(<?= var_export($field['label']) ?>),
    ),
),