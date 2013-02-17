<?= "<?php\n" ?>
<?php
echo 'if (count($' . strtolower($model['name']) . "_list) > 0) {\n";
echo '    echo "<ul>\n";'."\n";
echo '    foreach ($' . strtolower($model['name']) . '_list as $' . strtolower($model['name']) . ") {\n";
echo '        echo \'<li><a href="\' . $' . strtolower($model['name']) . '->url() . \'">\' . $' . strtolower($model['name']) . '->' . $model['column_prefix'] . $model['title_column_name'] . ' . "</a></li>\n";' . "\n";
echo "    }\n";
echo '    echo "</ul>\n";'."\n";
echo "}\n";