<?php

function getModel($modelName)
{
    $model = file_get_contents(__DIR__ . '//models//' . $modelName . '.model');
    return preg_split("/\R/", $model);
}

function getInstance($modelName) {
    $data = file_get_contents(__DIR__ . '//data//' . $modelName . '.data');

    $model = getModel($modelName);
    $data = explode(PHP_EOL, $data);

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
    $model = getModel($modelName);

    $data = [];

    foreach ($model as $propertyName) {
        $data[] = $propertyName . ':' . $instance[$propertyName];
    }

    return file_put_contents(
        __DIR__ . '//data//' . $modelName . '.data',
        implode(PHP_EOL, $data)
    );
}
