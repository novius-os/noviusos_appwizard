<?php
$properties = array();
$properties[] = var_export($model['column_prefix'].'id', true);

foreach ($model['fields'] as $field) {
    if ($config['fields'][$field['type']]['on_model_properties']) {
        $properties[] = var_export($model['column_prefix'].$field['column_name'], true);
    }
}

$properties[] = var_export($model['column_prefix'].'created_at', true);
$properties[] = var_export($model['column_prefix'].'updated_at', true);
echo "<?php\n";
?>

namespace <?= $data['application_settings']['namespace'] ?>;

class Model_<?= $model['name'] ?> extends \Nos\Orm\Model
{

    protected static $_primary_key = array('<?= $model['column_prefix'] ?>id');
    protected static $_table_name = '<?= $model['table_name'] ?>';

    protected static $_properties = array(
        <?= implode(",\n        ", $properties)."\n" ?>
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
            'property'=>'<?= $model['column_prefix'] ?>created_at'
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
            'property'=>'<?= $model['column_prefix'] ?>updated_at'
        )
    );

    protected static $_behaviours = array(
        /*
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_state_property' => '<?= $model['column_prefix'] ?>_publication_status',
            'publication_start_property' => '<?= $model['column_prefix'] ?>_publication_start',
            'publication_endproperty' => '<?= $model['column_prefix'] ?>_publication_end',
        ),
        */
<?= isset($model['has_url_enhancer']) ? '' : "        /*\n" ?>
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('<?= $data['application_settings']['folder'] ?>_<?= strtolower($model['name']) ?>'),
        ),
<?= isset($model['has_url_enhancer']) ? '' : "        */\n" ?>
<?= isset($model['has_url_enhancer']) ? '' : "        /*\n" ?>
        'Nos\Orm_Behaviour_Virtualname' => array(
            'events' => array('before_save', 'after_save'),
            'virtual_name_property' => '<?= $model['column_prefix'] ?>virtual_name',
        ),
<?= isset($model['has_url_enhancer']) ? '' : "        */\n" ?>
        /*
        'Nos\Orm_Behaviour_Twinnable' => array(
            'events' => array('before_insert', 'after_insert', 'before_save', 'after_delete', 'change_parent'),
            'context_property'      => '<?= $model['column_prefix'] ?>_context',
            'common_id_property' => '<?= $model['column_prefix'] ?>_context_common_id',
            'is_main_property' => '<?= $model['column_prefix'] ?>_context_is_main',
            'invariant_fields'   => array(),
        ),
        */
    );

    protected static $_belongs_to  = array(
        /*
        'key' => array( // key must be defined, relation will be loaded via $<?= strtolower($model['name']) ?>->key
            'key_from' => '<?= $model['column_prefix'] ?>...', // Column on this model
            'model_to' => '<?= $data['application_settings']['namespace'] ?>\Model_...', // Model to be defined
            'key_to' => '...', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
        */
    );
    protected static $_has_many  = array(
        /*
        'key' => array( // key must be defined, relation will be loaded via $<?= strtolower($model['name']) ?>->key
            'key_from' => '<?= $model['column_prefix'] ?>...', // Column on this model
            'model_to' => '<?= $data['application_settings']['namespace'] ?>\Model_...', // Model to be defined
            'key_to' => '...', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
        */
    );
    protected static $_many_many = array(
        /*
            'key' => array( // key must be defined, relation will be loaded via $<?= strtolower($model['name']) ?>->key
                'table_through' => '...', // intermediary table must be defined
                'key_from' => '<?= $model['column_prefix'] ?>...', // Column on this model
                'key_through_from' => '...', // Column "from" on the intermediary table
                'key_through_to' => '...', // Column "to" on the intermediary table
                'key_to' => '...', // Column on the other model
                'cascade_save' => false,
                'cascade_delete' => false,
                'model_to'       => '<?= $data['application_settings']['namespace'] ?>\Model_...', // Model to be defined
            ),
        */
    );
}
