<?php

$data = [ 'name' => 'Bench press' ];
header('Content-Type: application/json');
echo json_encode($data);

die;