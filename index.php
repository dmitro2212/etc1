<?php
session_start();
/*фиксим слет админки при выходе с аккаунта*/
if (isset($_SESSION['admin'])) {
    header("Location: /admin/panel.php");
    exit;
}

if (isset($_SESSION['user_id'])) {
    header("Location: orders/my_orders.php");
    exit;
}
?>
<?php require "header.php"; ?>

<div class="home-wrapper">

    <div class="home-hero">
        <h1>
            Грузоперевозки <br>
            <span>Быстро • Удобно • Надёжно</span>
        </h1>

        <p>
            Сервис для оформления и управления заказами на грузоперевозки.
            Всё в одном месте — от заявки до выполнения.
        </p>

        <div class="home-actions">
            <a href="auth/login.php" class="btn-main">
                Войти в систему
            </a>

            <a href="auth/register.php" class="btn-outline">
                Создать аккаунт
            </a>
        </div>
    </div>

</div>

<?php require "footer.php"; ?>
