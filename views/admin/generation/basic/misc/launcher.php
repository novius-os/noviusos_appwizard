'<?= $data['application_settings']['namespace'].'::'.$model['name'] ?>' => array(
    'name'    => '<?= \Inflector::humanize($model['name']) ?>', // displayed name of the launcher
    'action' => array(
        'action' => 'nosTabs',
        'tab' => array(
            'url' => 'admin/<?= $data['application_settings']['folder'].'/'.strtolower($model['name']).'/appdesk' ?>', // url to load
        ),
    ),
),