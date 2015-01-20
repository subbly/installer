<?php

$response = array(
    'status'  => 'error',
    'content' => 'Unkonown error',
);

if ($form instanceof Subbly_Installer_FormValidator && $form->hasErrors()) {
    $response = array(
        'status'  => 'error',
        'content' => $form->getErrors(),
    );
} elseif (!empty($errorMessage)) {
    $response = array(
        'status'  => 'error',
        'content' => $errorMessage,
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
