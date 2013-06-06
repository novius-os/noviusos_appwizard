<?= "<?php\n" ?>
<?php
echo 'echo "<div class=\"', $data['application_settings']['folder'].'_'.strtolower($model['name']), ' noviusos_enhancer\">\n";'."\n";
echo 'if (count($' . strtolower($model['name']) . "_list) > 0) {\n";
echo '    echo "<ul>\n";'."\n";
echo '    foreach ($' . strtolower($model['name']) . '_list as $' . strtolower($model['name']) . ") {\n";
echo '        echo \'<li><a href="\' . $' . strtolower($model['name']) . '->url() . \'">\' . $' . strtolower($model['name']) . '->' . $model['column_prefix'] . $model['title_column_name'] . ' . "</a></li>\n";' . "\n";
echo "    }\n";
echo '    echo "</ul>\n";'."\n";
echo "}\n";
echo 'echo "</div>\n";'."\n";
