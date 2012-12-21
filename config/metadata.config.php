<?php
return array(
    'name'    => 'Application wizard',
    'version' => '0.1',
    'provider' => array(
        'name' => 'Novius OS',
    ),
    'namespace' => 'Nos\AppWizard',
    'permission' => array(

    ),
    'launchers' => array(
        'noviusos_appwizard' => array(
            'name'    => 'Application wizard',
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/noviusos_appwizard/application',
                ),
            ),
        ),
    ),
    'icons' => array(
        16 => '/static/apps/noviusos_appwizard/img/icons/appwizard-16.png',
        32 => '/static/apps/noviusos_appwizard/img/icons/appwizard-32.png',
        64 => '/static/apps/noviusos_appwizard/img/icons/appwizard-64.png',
    ),
);
