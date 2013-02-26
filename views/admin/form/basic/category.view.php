<?php
Nos\I18n::current_dictionary('noviusos_appwizard::common');

echo render('nos::form/expander', array(
    'title' => __('Fields group'),
    'content' => render('noviusos_appwizard::admin/form/basic/category_inside', array('config' => $config), false)), false);
