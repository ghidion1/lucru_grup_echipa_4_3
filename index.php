<?php
    session_start();
    require_once './bootstrap.php';
    $userRepository = new UserRepository($databaseConnection);
    $users = $userRepository->readUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Users Management</title>
</head>

<body>
<div class="container mt-5">
        <h2>Adaugă Utilizator</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nume</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Adaugă</button>
        </form>
    </div>
    <div class="container mt-5">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        <h2 class="mb-4">Lista Utilizatorilor</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Email</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['id']; ?>"
                                class="btn btn-warning btn-sm">Actualizează</a>
                            <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Ești sigur că vrei să ștergi acest utilizator?');">Șterge</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// create_user.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userRepository->createUser($name, $email);
    header('Location: index.php');
    exit;
}
?>