<?php
require_once './bootstrap.php';
$userRepository = new UserRepository($databaseConnection);

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $user = $userRepository->getById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $userRepository->updateUser($id, $name, $email);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizează Utilizator</title>
</head>

<body>
    <div class="container mt-5">
        <h2>Actualizează Utilizator</h2>
        <form action="?id=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nume</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizează</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>