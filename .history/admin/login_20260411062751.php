<?php
session_start();
include '../config/connection.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='admin'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['admin'] = $data['name'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Admin - PathFinderIT</title>
    <link rel="icon" type="image/png" href="../img/logo-pathfinderit.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background: linear-gradient(135deg, #1a0d0d 0%, #2d1414 50%, #1a0d0d 100%);
        position: relative;
        overflow: hidden;
    }

    /* Background Decoration */
    body::before {
        content: "";
        position: fixed;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255, 107, 107, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    body::after {
        content: "";
        position: fixed;
        bottom: -20%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(107, 31, 31, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
    }

    .login-container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        z-index: 1;
        padding: 2rem;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        padding: 3rem;
        width: 100%;
        max-width: 400px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .login-card h4 {
        color: #1a0d0d;
        font-weight: 700;
        text-align: center;
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
        letter-spacing: 0.3px;
    }

    .login-subtitle {
        text-align: center;
        color: #999;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .login-form .form-group {
        margin-bottom: 1.5rem;
    }

    .login-form label {
        color: #2d1414;
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.2px;
        margin-bottom: 0.7rem;
        display: block;
    }

    .login-form .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.9rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        color: #333;
        font-weight: 500;
    }

    .login-form .form-control:focus {
        outline: none;
        border-color: #ff6b6b;
        background: #fafafa;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
    }

    .login-form .form-control::placeholder {
        color: #aaa;
        font-weight: 400;
    }

    .btn-login {
        background: linear-gradient(135deg, #ff6b6b, #ff5252);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 1.5rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        cursor: pointer;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 107, 107, 0.4);
        background: linear-gradient(135deg, #ff5252, #ff3838);
    }

    .btn-login:active {
        transform: translateY(-1px);
    }

    .alert {
        border-radius: 8px;
        border: none;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #fee;
        color: #c33;
        font-weight: 500;
    }

    .alert strong {
        display: block;
        margin-bottom: 0.3rem;
    }

    .login-footer {
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        margin-top: 2rem;
        position: relative;
        z-index: 1;
        padding: 2rem 0;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 2rem;
        }

        .login-card h4 {
            font-size: 1.5rem;
        }
    }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">
            <h4>Admin Panel</h4>
            <p class="login-subtitle">PathFinderIT Management System</p>

            <?php if (isset($error)) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
            <?php } ?>

            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control"
                        placeholder="Masukkan username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit" name="login" class="btn-login">
                    Masuk ke Admin Panel
                </button>
            </form>
        </div>
    </div>

    <div class="login-footer">
        PathFinderIT © 2024 — Intelligent System for IT Specialty Guidance
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>