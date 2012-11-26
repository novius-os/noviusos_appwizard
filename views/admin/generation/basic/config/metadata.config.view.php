<?= "<?php\n" ?>
return array(
    'name'    => "<?= $data['application_settings']['name'] ?>",
    'version' => 'WIP', //@todo: to be defined
    'provider' => array(
        'name' => 'Unknown', //@todo: to be defined
    ),
    'namespace' => "<?= $data['application_settings']['namespace'] ?>",
    'permission' => array(
    ),
    'icons' => array( //@todo: to be defined
        64 => '/static/apps/<?= $data['application_settings']['folder'] ?>/img/icon-64.png',
        32 => '/static/apps/<?= $data['application_settings']['folder'] ?>/img/icon-32.png',
        16 => '/static/apps/<?= $data['application_settings']['folder'] ?>/img/icon-16.png',
    ),
<?php
if (isset($data['models'])) {
    echo "    'launchers' => array(\n";
    foreach ($data['models'] as $model) {
        echo \Nos\AppWizard\Application_Generator::indent(
            '        ',
            render(
                $config['generation_path'].'/misc/launcher',
                array(
                    'model' => $model,
                    'data' => $data
                )
            )
        );
        echo "\n";
    }
    echo "    ),\n";

}
?>
    /* launcher configuration example
    'launchers' => array(
        'key' => array( // key must be defined
            'name'    => 'name of the launcher', // displayed name of the launcher
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'url to load', // url to load
                ),
            ),
        ),
    ),
    */
    /* Enhancer configuration example
    'enhancers' => array(
        'key' => array( // key must be defined
            'title' => 'title',
            'desc'  => '',
            'urlEnhancer' => '<?= $data['application_settings']['folder'] ?>/front/main', // url of the enhancer
            'previewUrl' => 'admin/<?= $data['application_settings']['folder'] ?>/application/preview', // url of preview
            'dialog' => array(
                'contentUrl' => 'admin/<?= $data['application_settings']['folder'] ?>/application/popup',
                'width' => 450,
                'height' => 400,
                'ajax' => true,
            ),
        ),
    ),
    */
    /* Data catcher configuration
    'data_catchers' => array(
        'key' => array( // key must be defined
            'title' => 'title',
            'description'  => '',
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/<?= $data['application_settings']['folder'] ?>/post/insert_update/?context={{context}}&title={{urlencode:'.\Nos\DataCatcher::TYPE_TITLE.'}}&summary={{urlencode:'.\Nos\DataCatcher::TYPE_TEXT.'}}&thumbnail={{urlencode:'.\Nos\DataCatcher::TYPE_IMAGE.'}}',
                    'label' => 'label of the data catcher',
                ),
            ),
            'onDemand' => true,
            'specified_models' => false,
            // data examples
            'required_data' => array(
                \Nos\DataCatcher::TYPE_TITLE,
            ),
            'optional_data' => array(
                \Nos\DataCatcher::TYPE_TEXT,
                \Nos\DataCatcher::TYPE_IMAGE,
            ),
        ),
    ),
    */
);
