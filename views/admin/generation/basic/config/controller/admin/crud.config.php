<?= "<?php\n" ?>
<?php
$menus = array();
$content = array();

$fieldsByCategory = array();
$title_field = null;
$medias = array();
foreach ($model['fields'] as $field) {
    if (isset($field['is_on_crud']) && $field['is_on_crud']) {
        if (isset($field['is_title']) && $field['is_title']) {
            $title_field = render($config['fields'][$field['type']]['views']['crud_name'],
                array(
                    'field' => $field,
                    'model' => $model,
                    'data' => $data,
                    'config' => $config,
                ));
        } elseif ($field['type'] == 'image') {
            $medias[] = render($config['fields'][$field['type']]['views']['crud_name'],
                array(
                    'field' => $field,
                    'model' => $model,
                    'data' => $data,
                    'config' => $config,
                ));;
        } else {
            if (!isset($fieldsByCategory[$field['category']])) {
                $fieldsByCategory[$field['category']] = array();
            }
            $fieldsByCategory[$field['category']][] = $field;
        }
    }
}

$viewsByCategoryType = array();
if (isset($model['categories'])) {
    for ($i = 0; $i < count($model['categories']); $i++) {
        $categoryType = $model['categories'][$i]['type'];
        if (!isset($viewsByCategoryType[$categoryType])) {
            $viewsByCategoryType[$categoryType] = array();
        }
        $viewsByCategoryType[$categoryType][] = render(
            $config['generation_path'].'/misc/categories/'.$categoryType,
            array(
                'fields' => isset($fieldsByCategory[$i]) ? $fieldsByCategory[$i] : array(),
                'model' => $model,
                'category' => $model['categories'][$i],
                'config' => $config,
                'data' => $data
            )
        );
    }
}
?>
return array(
    'controller_url'  => 'admin/<?= $data['application_settings']['folder'] ?>/<?= strtolower($model['name']) ?>/crud',
    'model' => '<?= $data['application_settings']['namespace'] ?>\Model_<?= $model['name'] ?>',
    'layout' => array(
        'large' => true,
        'save' => 'save',
<?php
if ($title_field !== null) {
    echo "        'title' => '".$title_field."',\n";
}
if (count($medias) > 0) {
    echo "        'medias' => array('".implode("', '", $medias)."'),\n";
}

if (isset($viewsByCategoryType['main'])) {
    echo "        'content' => array(\n";
    echo \Nos\AppWizard\Application_Generator::indent(
        '            ',
        implode("\n", $viewsByCategoryType['main'])
    );
    echo "\n";
    echo "        ),\n";
}
?>
<?php
if (isset($viewsByCategoryType['menu'])) {
    echo "        'menu' => array(\n";
    echo \Nos\AppWizard\Application_Generator::indent(
        '            ',
        implode("\n", $viewsByCategoryType['menu'])
    );
    echo "\n";
    echo "        ),\n";
}
?>
    ),
    'fields' => array(
        '<?= $model['column_prefix'] ?>_id' => array (
            'label' => 'ID: ',
            'form' => array(
                'type' => 'hidden',
            ),
            'dont_save' => true,
        ),
<?php
foreach ($model['fields'] as $field) {
    echo \Nos\AppWizard\Application_Generator::indent(
        '        ',
        render($config['fields'][$field['type']]['views']['crud_config'],
            array(
                'field' => $field,
                'model' => $model,
                'config' => $config,
                'data' => $data
            )
        )
    );
    echo "\n";
}
?>
        'save' => array(
            'label' => '',
            'form' => array(
                'type' => 'submit',
                'tag' => 'button',
                // Note to translator: This is a submit button
                'value' => __('Save'),
                'class' => 'primary',
                'data-icon' => 'check',
            ),
        ),
    )
    /* UI texts sample
    'messages' => array(
        'successfully added' => __('Item successfully added.'),
        'successfully saved' => __('Item successfully saved.'),
        'successfully deleted' => __('Item has successfully been deleted!'),
        'you are about to delete, confim' => __('You are about to delete item <span style="font-weight: bold;">":title"</span>. Are you sure you want to continue?'),
        'you are about to delete' => __('You are about to delete item <span style="font-weight: bold;">":title"</span>.'),
        'exists in multiple context' => __('This item exists in <strong>{count} contexts</strong>.'),
        'delete in the following contexts' => __('Delete this item in the following contexts:'),
        'item deleted' => __('This item has been deleted.'),
        'not found' => __('Item not found'),
        'error added in context' => __('This item cannot be added {context}.'),
        'item inexistent in context yet' => __('This item has not been added in {context} yet.'),
        'add an item in context' => __('Add a new item in {context}'),
        'delete an item' => __('Delete a item'),
    ),
    */
    /*
    Tab configuration sample
    'tab' => array(
        'iconUrl' => 'static/apps/{{application_name}}/img/16/icon.png',
        'labels' => array(
            'insert' => __('Add a item'),
            'blankSlate' => __('Translate a item'),
        ),
    ),
    */
);