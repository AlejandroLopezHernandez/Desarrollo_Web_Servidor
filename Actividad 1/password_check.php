<?php
// Array asociativo con usuarios y contraseñas cifradas
$users = [
    'user1' => password_hash('pd123', PASSWORD_DEFAULT),
    'user2' => password_hash('my5678', PASSWORD_DEFAULT),
    'admin' => password_hash('adminpass', PASSWORD_DEFAULT),
];
print_r($users);

$usuario = $_POST['username'];
$contraseña = $_POST['password'];

array_key_exists('user1', $users);
array_key_exists('user2', $users);
array_key_exists('admin', $users);

password_verify('pd123', '$2y$10$CUlNgHtFA6WcV9ByipYnKeZKLhSncvG59l6IkLCqzZHrTZJ/TkzM6');
password_verify('my5678', '$2y$10$KO21SKQvGy2Je1jkxTQchOain2vxqjoYzbT/vyWtJEwAdhu8LFKfO');
password_verify('adminpass', '$2y$10$v2vmQmhXdllVWfohJzLWLOP.Wj9n4.ljzCQRxG7CKOcsJ6x8sG8S2');


