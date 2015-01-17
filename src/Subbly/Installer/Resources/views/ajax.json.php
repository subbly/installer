<?php

$response = array(
    'status'  => 'error',
    'content' => 'Unkonown error',
);

if ($form->hasErrors()) {
    $response = array(
        'status'  => 'error',
        'content' => $form->getErrors(),
    );
} else {
    $response = array(
        'status'  => 'ok',
        'content' => '',
    );
}

header('Content-Type: application/json');
print json_encode($response);
