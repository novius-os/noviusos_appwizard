<?php
echo render('nos::form/expander', array(
    'title' => __('Fields group'),
    'content' => render('noviusos_appwizard::admin/form/basic/category_inside', array('config' => $config), false)), false);