<?php
session_start();
require "../config/db.php";
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
    $stmt->execute([$_GET['delete'], $_SESSION['user']['id']]);

    $_SESSION['success'] = "Заявка удалена";
    header("Location: my_orders.php");
    exit;
}

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user']['id']]);
$orders = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../assets/style.css">
<?php require "../header.php"; ?>

<div class="orders-wrapper">

    <h2 class="page-title">Мои заявки</h2>
    
<?php if (!empty($_SESSION['success'])): ?>
    <div class="alert-success">
        <?= $_SESSION['success'] ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>


    <?php if (empty($orders)): ?>
        <div class="empty-box">
            У вас пока нет заявок  
            <br>
            <a href="create.php" class="btn-main small">Создать первую</a>
        </div>
    <?php else: ?>

        <div class="orders-grid">
            <?php foreach ($orders as $o): ?>
                <div class="order-card">
                    <div class="order-row">
                        <span>Дата:</span>
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
                        Удалить
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<?php require "../footer.php"; ?>
