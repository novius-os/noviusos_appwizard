<?php
Nos\I18n::current_dictionary('noviusos_appwizard::common');

echo render('nos::form/expander', array(
    'title' => __('Field'),
    'content' => render('noviusos_appwizard::admin/form/basic/field_inside', array('config' => $config), false)), false);
