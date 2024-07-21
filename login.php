<?php
session_start();
if (!empty($_SESSION['username_apotek'])) {
    header('Location: home.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'lianda@gmail.com' && $password == 'kamunanya') {
        $_SESSION['username_apotek'] = $username;
        header('Location: home.php');
        exit();
    } else {
        $error = "Email atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Manajemen Apotek - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background-color: #e8f5e9;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .form-signin {
        max-width: 500px;
        width: 100%;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-signin .form-floating {
        margin-bottom: 1rem;
    }

    .form-signin .btn-primary {
        background-color: #4caf50;
        border-color: #4caf50;
    }

    .form-signin .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .form-signin .alert-danger {
        margin-bottom: 1rem;
    }

    .login-info {
        margin-top: 1rem;
        font-size: 0.875rem;
        color: #616161;
    }

    .login-info strong {
        color: #333;
    }
    </style>
</head>

<body>
    <main class="form-signin text-center">
        <div class="text-center mb-4">
            <i class="bi bi-hospital fs-1 text-success"></i>
        </div>
        <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>
        <form class="needs-validation" novalidate action="login.php" method="POST">
            <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            <div class="form-floating mb-3">
                <input name="username" type="email" class="form-control" id="floatingInput"
                    placeholder="name@example.com" required />
                <label for="floatingInput">Email address</label>
                <div class="invalid-feedback">Masukkan email yang valid.</div>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    required />
                <label for="floatingPassword">Password</label>
                <div class="invalid-feedback">Masukkan password.</div>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me" /> Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
        </form>
        <div class="login-info text-center mt-3">
            <p>Username: <strong>lianda@gmail.com</strong></p>
            <p>Password: <strong>kamunanya</strong></p>
        </div>
    </main>
    <script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>
</body>

</html>