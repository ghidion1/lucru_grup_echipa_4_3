<?php

class UserRepository implements UserRepositoryInterface
{
    private $pdo;
    private $table_name;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->pdo = $databaseConnection->connect();
        $table_name = 'angajati_db';
    }

    // Creare utilizator
    public function createUser($nume, $prenume, $pozitie, $departament, $data_angajarii, $salariu)
    {
        $sql = 'INSERT INTO :table_name (nume, prenume, pozitie, departament, data_angajarii, salariu) VALUES (:nume, :prenume, :pozitie, :departament, :data_angajarii, :salariu)';
        $stmt = $this->pdo->prepare($sql);
        //$stmt->execute([':table_name' => $table_name, ':name' => $name, ':email' => $email]);
        $stmt->execute([ ':table_name' => $table_name,':nume' => $nume,  ':prenume' => $prenume,  ':pozitie' => $pozitie,  ':departament' => $departament,  ':data_angajarii' => $data_angajarii,  ':salariu' => $salariu]);
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
        $sql = 'SELECT * FROM :table_name WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([ ':table_name' => $table_name, ':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Actualizare utilizator
    public function updateUser($id, $name, $email)
    {
        $sql = 'UPDATE :table_name SET name = :name, email = :email WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':table_name' => $table_name, ':name' => $name, ':email' => $email, ':id' => $id]);
        $_SESSION['message'] = "Utilizatorul a fost actualizat cu succes!";
    }

    // Ștergere utilizator
    public function deleteUser($id)
    {
        $sql = 'DELETE FROM :table_name WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':table_name' => $table_name, ':id' => $id]);
        $_SESSION['message'] = "Utilizatorul a fost șters cu succes!";
    }
}
