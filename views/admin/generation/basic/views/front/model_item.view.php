<?php
$medias = $wysiwygs = array();
foreach ($model['fields'] as $field) {
    if ($field['type'] == 'image') {
        $medias[] = $field['column_name'];
    }
    if ($field['type'] == 'wysiwyg') {
        $wysiwygs[] = $field['column_name'];
    }
}
?>
<?= "<?php\n" ?>
    // Load dictionnary if we want to use __()
    // Nos\I18n::current_dictionary('<?= $data['application_settings']['folder'] ?>::common');
<?= "?>\n" ?>
<h2><?= "<?=" ?> $<?= $model['table_name'] ?>-><?= $model['column_prefix'] ?><?= $model['title_column_name'] ?> <?= "?>" ?></h2>

<?php
if (count($medias)) {
    echo "<?php\n";

    foreach ($medias as $media_name) {
        echo 'if (!empty($' . $model['table_name'] . "->medias->$media_name)) {\n";
        echo '    echo \'<img src="\' . $' . $model['table_name'] . '->medias->' . $media_name . '->get_public_path_resized(400, 300) . \'" alt="" />\';'."\n";
        echo "}\n";
    }
    echo "?>\n";
}
?>

<?php
if (count($wysiwygs)) {
    foreach ($wysiwygs as $wysiwyg_name) {
        echo '<?= $' . $model['table_name'] . '->wysiwygs->' . $wysiwyg_name . " ?>\n";
    }
}
?>

<a href="<?= "<?=" ?> \Nos\Nos::main_controller()->getPage()->url() <?= "?>" ?>"><?= __('Back') ?></a>