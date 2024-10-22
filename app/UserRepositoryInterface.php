<?php
interface UserRepositoryInterface
{
    public function createUser($name, $email);
    public function readUsers();
    public function updateUser($id, $name, $email);
    public function deleteUser($id);
}