
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angajați</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Angajați</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Acasă</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" method="get">
                    <input class="form-control me-2" type="search" name="search" placeholder="Căutare" aria-label="Search">
                    <button class="btn btn-outline-secondary" type="submit">Caută</button>
                </form>
            </div>
        </div>
    </nav>
    
    <div class="container my-4">
        <div class="row">
            <button class="btn btn-dark btn-sm col-1" data-bs-toggle="modal" data-bs-target="#employeeModal">Adaugă</button>
        </div>
        <div class="row mt-4">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success" role="alert"><?= $_SESSION['message'] ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger" role="alert">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nume</th>
                            <th>Prenume</th>
                            <th>Poziție</th>
                            <th>Departament</th>
                            <th>Data angajării</th>
                            <th>Salariu</th>
                            <th>Opțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($users as $user): 
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($user['nume']) ?></td>
                            <td><?= htmlspecialchars($user['prenume']) ?></td>
                            <td><?= htmlspecialchars($user['pozitie']) ?></td>
                            <td><?= htmlspecialchars($user['departament']) ?></td>
                            <td><?= htmlspecialchars($user['data_angajarii']) ?></td>
                            <td><?= htmlspecialchars($user['salariu']) ?></td>
                            <td class="d-flex">
                                <a href="sterge.php?employee=<?= $user['id'] ?>" class="btn btn-danger btn-sm me-2" onclick="return confirm('Ești sigur că vrei să ștergi acest angajat?');">Șterge</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Înregistrează un angajat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save_employee.php" method="post">
                        <div class="mb-3">
                            <label for="nume">Nume</label>
                            <input type="text" name="nume" id="nume" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenume">Prenume</label>
                            <input type="text" name="prenume" id="prenume" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="pozitie">Poziție</label>
                            <input type="text" name="pozitie" id="pozitie" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="departament">Departament</label>
                            <input type="text" name="departament" id="departament" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_angajarii">Data angajării</label>
                            <input type="date" name="data_angajarii" id="data_angajarii" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="salariu">Salariu</label>
                            <input type="number" name="salariu" id="salariu" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm">Salvează</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
