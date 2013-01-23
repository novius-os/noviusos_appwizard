<div class="category input_item">
    <div class="category_information">
        <div class="labelled_input">
            <label>
                <?= __('Title (e.g. Properties):') ?>
            </label>
            <input type="text" class="category_name" name="name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Type:') ?>
                <?= \View::forge('nos::admin/tooltip', array(
                'title' => '',
                'content' => '<img src="static/apps/noviusos_appwizard/img/help.png"/>',
                'options' => array(
                ),
            ), false) ?>
            </label>
            <select name="type" style="width: 200px;">
<?php
foreach ($config['category_types'] as $key => $val) {
    echo '<option value="'.$key.'">'.$val['label'].'</option>';
}
?>
            </select>
        </div>
    </div>
</div>
