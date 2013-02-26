<?php
Nos\I18n::current_dictionary('noviusos_appwizard::common');

echo render('nos::form/expander', array(
    'title' => __('Model'),
    'content' => render('noviusos_appwizard::admin/form/basic/model_inside')), false);
