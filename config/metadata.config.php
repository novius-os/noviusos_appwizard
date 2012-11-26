<?php
return array(
    'name'    => 'Application wizard',
    'version' => '0.1',
    'icon16'  => 'static/apps/noviusos_appwizard/img/appwizard-16.png',
    'icon64'  => 'static/apps/noviusos_appwizard/img/appwizard-64.png',
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
        64 => '/static/apps/noviusos_appwizard/img/appwizard-64.png',
        32 => '/static/apps/noviusos_appwizard/img/appwizard-32.png',
        16 => '/static/apps/noviusos_appwizard/img/appwizard-16.png',
    ),
);
