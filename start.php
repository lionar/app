<?php

$statuses = new statuses\statuses;
$input = new input\collection;

$app = new app\container ( $statuses, $input );

$app->instance ( 'app', $app );
$app->instance ( 'statuses', $statuses );
$app->instance ( 'input', $input );