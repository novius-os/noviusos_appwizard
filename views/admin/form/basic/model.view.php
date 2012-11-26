<div class="model input_item">
    <div class="model_information">
        <div class="labelled_input">
            <label>
                <?= __('Name:') ?>
            </label>
            <input type="text" name="name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Table name:') ?>
            </label>
            <input type="text" name="table_name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Column prefix:') ?>
            </label>
            <input type="text" name="column_prefix" />
        </div>
    </div>

    <?= render('noviusos_appwizard::admin/form/basic/categories', array('config' => $config), false) ?>
    <div class="model_fields input_list" data-key="fields">
        <div class="model_fields_title">
            <?= __('Fields') ?>
        </div>
        <div class="model_fields_list">
        </div>
        <button class="add_field"><?= __('Add field') ?></button>
    </div>
</div>
