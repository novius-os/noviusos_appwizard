<div class="model input_item">
    <div class="model_information">
        <div class="labelled_input">
            <label>
                <?= __('Name (e.g. Monkey):') ?>
            </label>
            <input type="text" name="name" class="model_name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Table name (e.g. monkeys):') ?>
            </label>
            <input type="text" name="table_name" class="table_name" />
        </div>
        <div class="labelled_input">
            <label>
                <?= __('Column prefix (e.g. monk_):') ?>
            </label>
            <input type="text" name="column_prefix" class="column_prefix" />
        </div>
        <div class="labelled_input has_url_enhancer">
            <label>
                <?= __('Add an url enhancer ?') ?>
            </label>
            <input type="checkbox" name="has_url_enhancer" />
        </div>
    </div>
</div>
