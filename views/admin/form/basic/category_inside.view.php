<div class="category input_item">
    <div class="category_information">
        <div class="labelled_input">
            <label>
                <?= __('Name (ex: Content):') ?>
            </label>
            <input type="text" class="category_name" name="name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Type:') ?>
            </label>
            <select name="type" class="notransform">
<?php
foreach ($config['category_types'] as $key => $val) {
    echo '<option value="'.$key.'">'.$val['label'].'</option>';
}
?>
            </select>
        </div>
    </div>
</div>
