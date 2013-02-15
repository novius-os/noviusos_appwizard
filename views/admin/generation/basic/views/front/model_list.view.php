<?= "<?php\n" ?>
<?php
echo 'if (count($' . $model['table_name'] . "_list) > 0) {\n";
echo '    echo "<ul>\n";'."\n";
echo '    foreach ($' . $model['table_name'] . '_list as $' . $model['table_name'] . ") {\n";
echo '        echo \'<li><a href="\' . $' . $model['table_name'] . '->url() . \'">\' . $' . $model['table_name'] . '->' . $model['column_prefix'] . $model['title_column_name'] . ' . "</a></li>\n";' . "\n";
echo "    }\n";
echo '    echo "</ul>\n";'."\n";
echo "}\n";