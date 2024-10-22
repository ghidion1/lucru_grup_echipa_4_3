<?php
require_once './bootstrap.php';
$userRepository = new UserRepository($databaseConnection);
$users = $userRepository->readUsers();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userRepository->deleteUser($id);
    header('Location: index.php');
    exit;
}
