<?php

$statuses = new statuses\statuses;
$input = new input\collection;

$app = new app\container ( $statuses, $input );

$app->instance ( 'app\container', $app );
$app->instance ( 'app', $app );
$app->instance ( 'statuses', $statuses );
$app->instance ( 'input', $input );

facade::setFacadeApplication ( $app );