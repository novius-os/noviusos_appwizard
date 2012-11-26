<form method="post" id="<?= $form_id = uniqid('appwizard_') ?>" action="admin/noviusos_appwizard/application/generate">
    <?= render('nos::form/expander', array(
            'title' => __('General application settings'),
            'content' => render('noviusos_appwizard::admin/form/basic/application_settings')), false)
    ?>

    <?= render('nos::form/expander', array(
            'title' => __('Models'),
            'content' => render('noviusos_appwizard::admin/form/basic/models', array('config' => $config), false)), false);
    ?>
    <input type="submit" value="<?= __('Generate') ?>" />
</form>




<style type="text/css">
    .models_list .model, .categories_list .category, .categories {
        border: 1px solid grey;
        padding: 20px;
        margin-bottom: 30px;
    }

    .models_list .field_item {
        border: 1px solid grey;
        padding: 10px;
        margin-bottom: 15px;
    }
</style>

<script type="text/javascript">

    var templates = {};
    templates['model'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/model', array('config' => $config), false)) ?>;
    templates['field'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/field', array('config' => $config), false)) ?>;
    templates['category'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/category', array('config' => $config), false)) ?>;
    templates['fields'] = {};

<?php
foreach ($config['fields'] as $key => $field) {
    echo 'templates[\'fields\'][\''.$key.'\'] = '.json_encode(render($config['form_path'].'/fields/'.$key)).";\n";
}
?>

    require(
            [
                'jquery-nos'
            ],
            function($) {
                var $form = $('#<?= $form_id ?>');
                $form.nosFormAjax();
                $form.submit(function(e) {
                    processInputList($(this), 'input, select');
                });

                $form.nosFormUI();


                $form.find('.add_model').click(function(e) {
                    e.preventDefault();
                    addModel($(this));
                });

                function refreshCategories($el) {
                    var $form = $el.closest('.model');
                    var $categoriesName = $form.find('.categories_list .category_name');
                    var options = '';
                    $categoriesName.each(function(i) {
                        options += '<option value="' + i + '">' + $(this).val() + '</option>';
                    });


                    var $categorySelects = $el.closest('.model').find('.model_fields_list .category_type');
                    $categorySelects.each(function() {
                        var $this = $(this);
                        var previousVal = $this.val();
                        $this.html(options);
                        $this.val(previousVal);
                    });
                }

                function addCategory($el) {
                    var $categories = $el.closest('.categories');
                    var $categoriesList = $categories.find('.categories_list');

                    var $categoryContent = $(templates['category']);
                    $categoriesList.append($categoryContent);
                    $categoryContent.nosFormUI();
                    $categoryContent.find('.category_name').keyup(function(e) {
                        e.preventDefault();
                        refreshCategories($(this));
                    });
                }

                function addModel($el) {
                    var $models = $el.closest('.models');
                    var $modelsList = $models.find('.models_list');

                    var $modelContent = $(templates['model']);
                    $modelsList.append($modelContent);
                    $modelContent.nosFormUI();
                    $modelContent.find('.add_field').click(function(e) {
                        e.preventDefault();
                        addField($(this));
                    });

                    $modelContent.find('.add_category').click(function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        addCategory($this);
                        refreshCategories($this);
                    });
                }

                function addField($el) {
                    var $fieldList = $el.closest('.model_fields').find('.model_fields_list');
                    var $fieldContent = $(templates['field']);
                    $fieldList.append($fieldContent);
                    $fieldContent.nosFormUI();
                    refreshCategories($el);
                }

                /* @todo: can be heavily optimized */
                function processInputList($el, inputSelector) {
                    var prefix = '';
                    if ($el.hasClass('input_list')) {
                        prefix = $el.data('key');

                        $el.find('.input_item').each(function(i) {
                            var $input_item = $(this);
                            $input_item.find(inputSelector + ', .input_list').each(function() {
                                var $input = $(this);
                                var originalName = $input.data('originalName');
                                if (!originalName) {
                                    originalName = $input.attr('name') || $input.data('key');
                                    $input.data('originalName', originalName);
                                }
                                if ($input.hasClass('input_list')) {
                                    $input.data('key', prefix + '[' + i + ']' + '[' + originalName + ']');
                                } else {
                                    $input.attr('name', prefix + '[' + i + ']' + '[' + originalName + ']');
                                }
                            });
                        });
                    } else {
                        $el.find('.input_list').each(function() {
                            processInputList($(this), inputSelector);
                        });
                    }

/*
                    $el.find('.input_list').each(function(i) {
                        var $this = $(this);
                        if (prefix === '' || $this.closest('.input_list')[0] === $el[0]) {
                            var originalName = $this.data('originalName');
                            if (!originalName) {
                                $this.data('originalName', $this.data('key'))
                            }
                        }
                    });

                    */
                }

                function processModelForms() {

                    var input_selector = ['input', 'select'];

                    $form.find('.models_list .model').each(function(i) {
                        var $model = $(this);
                        var $model_inputs = $model.find('.model_information ' + input_selector.join(', .model_information '));
                        $model_inputs.each(function() {
                            var $this = $(this);
                            var name = $this.attr('name');
                            var prefix = 'model[' + i + ']';
                            if (name.substring(0, 5) === 'model') {
                                name = prefix + name.substring(name.indexOf(']') + 1);
                            } else {
                                name = prefix + '[' + name + ']';
                            }

                            $this.attr('name', name);
                        });

                        var $model_fields = $model.find('.model_fields_list .field_item');
                        $model_fields.each(function(j) {
                            var $this = $(this);

                            var $field_inputs = $this.find(input_selector.join(', '))
                            $field_inputs.each(function() {
                                var $this = $(this);

                                var name = $this.attr('name');
                                var prefix = 'model[' + i + '][fields][' + j + ']';
                                if (name.substring(0, 5) === 'model') {
                                    var startFrom = 0;
                                    for (var h = 0; h < 3; h++) {
                                        startFrom = name.indexOf(']', startFrom + 1)
                                    }
                                    name = prefix + name.substring(startFrom + 1);
                                } else {
                                    name = prefix + '[' + name + ']';
                                }

                                $this.attr('name', name);
                            });
                        });
                    });
                }
            }
    );
</script>