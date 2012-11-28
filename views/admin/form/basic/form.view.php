<form method="post" id="<?= $form_id = uniqid('appwizard_') ?>" action="admin/noviusos_appwizard/application/generate">
    <div class="tabs fill-parent" style="width: 92.4%; clear:both; margin:30px auto 1em;display:none;padding:0;">
        <ul style="width: 15%;">
            <li><a href="#general_application_settings"><?= __('1. Main settings') ?></a></li>
            <li><a href="#compile"><?= __('2. Compile') ?></a></li>
        </ul>
        <div id="general_application_settings">
            <?= render('nos::form/expander', array(
                    'title' => __('General application settings'),
                    'content' => render('noviusos_appwizard::admin/form/basic/application_settings', false),
                ), false); ?>
            <?= render('noviusos_appwizard::admin/form/basic/models', array('config' => $config)) ?>
        </div>
        <div id="compile">
            <button><?= __('Compile') ?></button>
        </div>
    </div>
</form>


<style type="text/css">
    .models_list .field_item {
        border: 1px solid grey;
        padding: 10px;
        margin-bottom: 15px;
    }

    .crud_options {
        margin-left: 20px;
    }

    .crud_options.inactive, .crud_other_options.inactive {
        display: none;
    }
</style>

<script type="text/javascript">

    var templates = {};
    templates['model'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/model', array('config' => $config), false)) ?>;
    templates['field'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/field', array('config' => $config), false)) ?>;
    templates['categories'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/categories', array('config' => $config), false)) ?>;
    templates['category'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/category', array('config' => $config), false)) ?>;
    templates['fields'] = <?= json_encode(render('noviusos_appwizard::admin/form/basic/fields', array('config' => $config), false)) ?>;

    require(
            [
                'jquery-nos',
                'wijmo.wijtabs'
            ],
            function($) {
                var $form = $('#<?= $form_id ?>');
                $form.nosFormAjax();
                $form.nosFormUI();
                var $tabs = $form.find('.tabs');
                $tabs.css('display', 'block').nosOnShow();
                $tabs.wijtabs({
                    alignment: 'left'
                });
                $tabs.find('> div').addClass('fill-parent').css({
                    left: '15%',
                    width : '85%'
                });

                var $tabsMenu = $form.find('.tabs > ul');


                $form.submit(function(e) {
                    processInputList($(this), 'input, select');
                });


                $form.find('.add_model').click(function(e) {
                    e.preventDefault();
                    addModel($(this));
                });

                var i = 0;

                function addModel($el) {
                    var $models = $el.closest('.models');
                    var $modelsList = $models.find('.models_list');

                    var $modelContent = $(templates['model']);
                    $modelsList.append($modelContent);
                    $modelContent.nosFormUI();

                    var fieldLayoutId = 'field_layout_' + i;

                    $modelContent.find('.model_name').keyup(function() {
                        refreshWizard($(this));
                    });



                    var $fieldLayout = $('<div class="field_layout"></div>', i);
                    $fieldLayout.attr('id', fieldLayoutId);
                    $fieldLayout.data('modelId', i);
                    $fieldLayout.html(templates['categories']);
                    $fieldLayout.appendTo($tabs);
                    $fieldLayout.nosFormUI();

                    $tabs.wijtabs('add', '#' + fieldLayoutId, 'field_layout', i + 1);

                    $fieldLayout.find('.add_category').click(function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        addCategory($this);
                        refreshWizard($this);
                        refreshCategories($this);
                    });

                    $fieldLayout.find('.categories_list').data('key', 'models[' + i + '][fields]');



                    var fieldsId = 'fields_' + i;

                    var $fields = $('<div class="fields"></div>');
                    $fields.attr('id', fieldsId);
                    $fields.data('modelId', i);
                    $fields.html(templates['fields']);
                    $fields.appendTo($tabs);
                    $fields.nosFormUI();

                    $tabs.wijtabs('add', '#' + fieldsId, 'fields', i + 2);

                    $fields.find('.add_field').click(function(e) {
                        e.preventDefault();
                        var $this = $(this);
                        addField($this);
                        refreshWizard($this);
                        refreshCategories($this);
                    });

                    $fields.find('.model_fields').data('key', 'models[' + i + '][categories]');


                    refreshWizard($el);

                    i++;
                }

                function refreshWizard($el) {
                    //return;
                    var $menuItems = $tabsMenu.find('li a');
                    var $modelNames = $form.find('.model_name');
                    $modelNames.each(function(i) {
                        var $this = $(this);
                        var $menuFieldsLayoutItem = $($menuItems[i * 2 + 1]);
                        var $menuFieldsItem = $($menuItems[i * 2 + 2]);
                        if ($modelNames.length > 1) {
                            $menuFieldsLayoutItem.text(<?= json_encode(__('{num}. ({modelName}) Fields layout')) ?>.replace('{modelName}', $this.val()).replace('{num}', i * 2 + 2));
                            $menuFieldsItem.text(<?= json_encode(__('{num}. ({modelName}) Fields')) ?>.replace('{modelName}', $this.val()).replace('{num}', i * 2 + 3));
                        } else {
                            $menuFieldsLayoutItem.text(<?= json_encode(__('{num}. Fields layout')) ?>.replace('{num}', i * 2 + 2));
                            $menuFieldsItem.text(<?= json_encode(__('{num}. Fields')) ?>.replace('{modelName}', $this.val()).replace('{num}', i * 2 + 3));
                        }
                    });
                    var $menuFieldsCompile = $($menuItems[$modelNames.length  * 2 + 1]);
                    console.log($menuFieldsCompile[0]);
                    $menuFieldsCompile.text(<?= json_encode(__('{num}. Compile')) ?>.replace('{num}', $modelNames.length * 2 + 2));
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

                function addField($el) {
                    var $fieldList = $el.closest('.model_fields').find('.model_fields_list');
                    var $fieldContent = $(templates['field']);
                    $fieldList.append($fieldContent);
                    $fieldContent.nosFormUI();

                    $fieldList.find('.crud_options').addClass('inactive');

                    $fieldContent.find('.is_on_crud_checkbox').change(function() {
                        var $this = $(this);
                        var $crudOptions = $this.closest('.field_item').find('.crud_options');
                        $this.is(':checked') ? $crudOptions.removeClass('inactive') : $crudOptions.addClass('inactive');
                    });

                    $fieldContent.find('.is_title_checkbox').change(function() {
                        var $this = $(this);
                        var $crudOptions = $this.closest('.field_item').find('.crud_other_options');
                        $this.is(':checked') ? $crudOptions.addClass('inactive') : $crudOptions.removeClass('inactive');
                    });
                    refreshWizard($el);
                    refreshCategories($el);
                }


                function refreshCategories($el) {
                    var $form = $el.closest('.field_layout, .fields');
                    var formId = $form.data('modelId');
                    var $categoriesName = $('#field_layout_' + formId).find('.categories_list .category_name');
                    var options = '';
                    $categoriesName.each(function(i) {
                        options += '<option value="' + i + '">' + $(this).val() + '</option>';
                    });

                    var $categorySelects = $('#fields_' + formId).find('.model_fields_list .category_type');

                    $categorySelects.each(function() {
                        var $this = $(this);
                        var previousVal = $this.val();
                        $this.html(options);
                        $this.val(previousVal);
                    });
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