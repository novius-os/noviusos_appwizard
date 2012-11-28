<?php
echo render('nos::form/expander', array(
    'title' => __('Field'),
    'content' => render('noviusos_appwizard::admin/form/basic/field_inside', array('config' => $config), false)), false);