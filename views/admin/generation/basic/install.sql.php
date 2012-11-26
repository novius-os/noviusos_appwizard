<?php
foreach ($data['models'] as $model) {
    echo render(
            $config['generation_path'].'/misc/model.sql.php',
            array(
                'model' => $model,
                'data' => $data,
                'config' => $config,
            )
        );
    echo "\n";
}