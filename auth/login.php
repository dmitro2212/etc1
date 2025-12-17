<?php
session_start();
require "../config/db.php";

if (isset($_SESSION['user'])) {
    header("Location: /orders/my_orders.php");
    exit;
}

$error = "";

if ($_POST) {

    if ($_POST['login'] === "admin" && $_POST['password'] === "gruzovik2024") {
        $_SESSION['admin'] = 1;
        header("Location: ../admin/panel.php");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->execute([$_POST['login']]);
    $u = $stmt->fetch();

    if ($u && password_verify($_POST['password'], $u['password'])) {
        $_SESSION['user'] = $u;
        header("Location: ../index.php");
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>

<link rel="stylesheet" href="../assets/style.css">
<?php require "../header.php"; ?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Добро пожаловать</h2>
        <p class="auth-subtitle">Войдите в систему «Грузовозофф»</p>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                ⚠ <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <label>Логин</label>
            <input type="text" name="login" placeholder="Введите логин" required>

            <label>Пароль</label>
            <input type="password" name="password" placeholder="Введите пароль" required>

            <button class="btn-main">Войти</button>

            <div class="auth-divider">
                <span>или</span>
            </div>

            <div class="auth-links">
                <a href="register.php">Создать аккаунт</a>
                <a href="javascript:history.back()">← Назад</a>
            </div>
        </form>
    </div>
</div>

<?php require "../footer.php"; ?>
