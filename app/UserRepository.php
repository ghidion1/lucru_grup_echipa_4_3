<?php

class UserRepository implements UserRepositoryInterface
{
    private $pdo;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->pdo = $databaseConnection->connect();
    }

    // Creare utilizator
    public function createUser($name, $email)
    {
        $sql = 'INSERT INTO users (name, email) VALUES (:name, :email)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':name' => $name, ':email' => $email]);
        $_SESSION['message'] = "Utilizatorul a fost adăugat cu succes!";
    }

    // Citire utilizatori
    public function readUsers()
    {
        $sql = 'SELECT * FROM users';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Citire utilizator dupa ID
    public function getById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Actualizare utilizator
    public function updateUser($id, $name, $email)
    {
        $sql = 'UPDATE users SET name = :name, email = :email WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':name' => $name, ':email' => $email, ':id' => $id]);
        $_SESSION['message'] = "Utilizatorul a fost actualizat cu succes!";
    }

    // Ștergere utilizator
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $_SESSION['message'] = "Utilizatorul a fost șters cu succes!";
    }
}
