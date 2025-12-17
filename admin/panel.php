<?php
session_start();
require "../config/db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: ../auth/login.php");
    exit;
}

/* Удаление заявки */
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$_GET['delete']]);

    $_SESSION['success'] = "Заявка удалена администратором";
    header("Location: panel.php");
    exit;
}

/* Все заявки */
$stmt = $pdo->query("
    SELECT orders.*, users.fio, users.phone 
    FROM orders 
    JOIN users ON users.id = orders.user_id 
    ORDER BY orders.created_at DESC
");
$orders = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../assets/style.css">
<?php require "../header.php"; ?>

<div class="orders-wrapper">

    <h2 class="page-title">Панель администратора</h2>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert-success">
            <?= $_SESSION['success'] ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="empty-box">
            Заявок пока нет
        </div>
    <?php else: ?>

        <div class="orders-grid">
            <?php foreach ($orders as $o): ?>
                <div class="order-card">

                    <div class="order-row">
                        <span>Клиент:</span>
                        <b><?= htmlspecialchars($o['fio']) ?></b>
                    </div>

                    <div class="order-row">
                        <span>Телефон:</span>
                        <b><?= htmlspecialchars($o['phone']) ?></b>
                    </div>

                    <div class="order-row">
                        <span>Дата перевозки:</span>
                        <b><?= date("d.m.Y H:i", strtotime($o['dt'])) ?></b>
                    </div>

                    <div class="order-row">
                        <span>Тип груза:</span>
                        <b><?= htmlspecialchars($o['type']) ?></b>
                    </div>

                    <div class="order-row">
                        <span>Вес:</span>
                        <b><?= htmlspecialchars($o['weight']) ?> кг</b>
                    </div>

                    <div class="order-row">
                        <span>Габариты:</span>
                        <b><?= htmlspecialchars($o['size']) ?></b>
                    </div>

                    <div class="order-row">
                        <span>Откуда:</span>
                        <b><?= htmlspecialchars($o['from']) ?></b>
                    </div>

                    <div class="order-row">
                        <span>Куда:</span>
                        <b><?= htmlspecialchars($o['to']) ?></b>
                    </div>

                    <div class="order-date">
                        Создано: <?= date("d.m.Y", strtotime($o['created_at'])) ?>
                    </div>

                    <a href="?delete=<?= $o['id'] ?>"
                       class="btn-delete"
                       onclick="return confirm('Удалить заявку?')">
                        🗑 Удалить заявку
                    </a>

                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<?php require "../footer.php"; ?>