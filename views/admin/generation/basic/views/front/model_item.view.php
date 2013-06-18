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
<div class="<?= $data['application_settings']['folder'].'_'.strtolower($model['name']) ?> noviusos_enhancer">
<h2><?= "<?=" ?> $<?= strtolower($model['name']) ?>-><?= $model['column_prefix'] ?><?= $model['title_column_name'] ?> <?= "?>" ?></h2>

<?php
if (count($medias)) {
    echo "<?php\n";

    foreach ($medias as $media_name) {
        echo 'if (!empty($' . strtolower($model['name']) . "->medias->$media_name)) {\n";
        echo '    echo ' . strtolower($model['name']) . '->medias->' . $media_name . '->get_img_tag_resized(400, 300);'."\n";
        echo "}\n";
    }
    echo "?>\n";
}
?>

<?php
if (count($wysiwygs)) {
    foreach ($wysiwygs as $wysiwyg_name) {
        echo '<?= $' . strtolower($model['name']) . '->wysiwygs->' . $wysiwyg_name . " ?>\n";
    }
}
?>

<a href="<?= "<?=" ?> \Nos\Nos::main_controller()->getPage()->url() <?= "?>" ?>"><?= __('Back') ?></a>
</div>