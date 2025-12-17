<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

if ($_POST) {
    $pdo->prepare("INSERT INTO orders VALUES(NULL,?,?,?,?,?,?,?,NOW())")
        ->execute([
            $_SESSION['user']['id'],
            $_POST['dt'],
            $_POST['weight'],
            $_POST['size'],
            $_POST['type'],
            $_POST['from'],
            $_POST['to']
        ]);

    $_SESSION['success'] = "Заявка успешно отправлена";
    header("Location: my_orders.php");
    exit;
}
?>

<link rel="stylesheet" href="../assets/style.css">
<?php require "../header.php"; ?>

<div class="form-wrapper">
    <form method="post" class="card-form">
        <h2>Новая заявка</h2>

        <label>Дата и время перевозки</label>
        <input type="datetime-local" name="dt" required min="<?= date('Y-m-d\TH:i') ?>">

        <label>Тип груза</label>
        <select name="type" required>
            <option value="">Выберите тип</option>
            <option>Мебель</option>
            <option>Бытовая техника</option>
            <option>Стройматериалы</option>
            <option>Продукты</option>
            <option>Другое</option>
        </select>

        <label>Вес груза (кг)</label>
        <input name="weight" placeholder="Примерно" required>

        <label>Габариты груза</label>
        <input name="size" placeholder="Д × Ш × В">

        <label>Адрес отправления</label>
        <textarea name="from" placeholder="Откуда" required></textarea>

        <label>Адрес доставки</label>
        <textarea name="to" placeholder="Куда" required></textarea>

        <button class="btn-main">
            Отправить заявку
        </button>
    </form>
</div>

<?php require "../footer.php"; ?>
