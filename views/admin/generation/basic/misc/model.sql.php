CREATE TABLE IF NOT EXISTS `<?= $model['table_name'] ?>` (
    `<?= $model['column_prefix'] ?>id` int(11) unsigned NOT NULL AUTO_INCREMENT,
<?php
foreach ($model['fields'] as $field) {
    $view = render(
        $config['fields'][$field['type']]['views']['sql'],
        array(
            'model' => $model,
            'field' => $field,
            'data' => $data
        )
    );
    if (!empty($view)) {
        echo \Nos\AppWizard\Application_Generator::indent(
            '    ', $view
        );
        echo "\n";
    }
}
?>
<?php
if (isset($model['has_url_enhancer'])) {
    echo '    `' . $model['column_prefix'] . "virtual_name` varchar(30) NOT NULL,\n";
}
?>
    `<?= $model['column_prefix'] ?>created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `<?= $model['column_prefix'] ?>updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`<?= $model['column_prefix'] ?>id`),
    KEY `<?= $model['column_prefix'] ?>created_at` (`<?= $model['column_prefix'] ?>created_at`),
    KEY `<?= $model['column_prefix'] ?>updated_at` (`<?= $model['column_prefix'] ?>updated_at`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;