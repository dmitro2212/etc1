<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /orders/my_orders.php");
    exit;
}
?>
<?php
require "../config/db.php";
if($_POST){
$stmt=$pdo->prepare("INSERT INTO users VALUES(NULL,?,?,?,?,?)");
$stmt->execute([$_POST['fio'],$_POST['phone'],$_POST['email'],$_POST['login'],
password_hash($_POST['password'],PASSWORD_DEFAULT)]);
header("Location: login.php");
}
?>
<link rel="stylesheet" href="../assets/style.css">
<?php require "../header.php"; ?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>Создание аккаунта</h2>
        <p class="auth-subtitle">
            Регистрация в системе «Грузовозофф»
        </p>

        <form method="post">

            <label>ФИО</label>
            <input
                type="text"
                name="fio"
                placeholder="Иванов Иван Иванович"
                required
            >

            <label>Номер телефона</label>
            <input
                type="tel"
                name="phone"
                placeholder="+7 (999) 123-45-67"
                required
            >

            <label>Email</label>
            <input
                type="email"
                name="email"
                placeholder="example@mail.ru"
                required
            >

            <label>Логин</label>
            <input
                type="text"
                name="login"
                placeholder="Придумайте логин"
                required
            >

            <label>Пароль</label>
            <input
                type="password"
                name="password"
                placeholder="Минимум 6 символов"
                required
            >

            <button class="btn-main btn-success">
                Зарегистрироваться
            </button>

            <div class="auth-divider">
                <span>или</span>
            </div>

            <div class="auth-links">
                <a href="login.php">Уже есть аккаунт? Войти</a>
                <a href="javascript:history.back()">← Назад</a>
            </div>

        </form>
    </div>
</div>

<?php require "../footer.php"; ?>
