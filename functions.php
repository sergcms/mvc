<?php

function getInstance($modelName) {
    $model = file_get_contents(__DIR__ . '/models/' . $modelName . '.model');
    $data = file_get_contents(__DIR__ . '/data/' . $modelName . '.data');

    $model = explode("\n", $model);
    $data = explode("\n", $data);

    $instance = [];
    
    foreach ($model as $propertyName) {
        $propertyValue = null;

        foreach ($data as $d) {
            $d = explode(":", $d);

            if ($d[0] === $propertyName) {
                $propertyValue = $d[1];
                break;
            }
        }

        $instance[$propertyName] = $propertyValue;
    }

    return $instance;
}

function saveInstance($modelName, $instance) {
    $model = file_get_contents(__DIR__ . '/models/' . $modelName . '.model');
    $model = explode("\n", $model);

    $data = [];

    foreach ($model as $propertyName) {
        $data[] = $propertyName . ':' . $instance[$propertyName];
    }

    return file_put_contents(
        __DIR__ . '/data/' . $modelName . '.data',
        implode("\n", $data)
    );
}
