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
        'content' => null,
    );
}

header('Content-Type: application/json');
echo json_encode($response);

// Don't remove the line after!
?>
