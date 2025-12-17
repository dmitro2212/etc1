<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<link rel="stylesheet" href="/assets/style.css">
<script defer src="/assets/theme.js"></script>

<header class="topbar"> 
    <a href="/index.php" class="logo">
        🚚 Грузовозофф
    </a>

    <nav class="nav-actions">

        <?php if (isset($_SESSION['admin'])): ?>

            <a href="/admin/panel.php">Админка</a>
            <a href="/auth/logout.php" class="nav-link">Выйти</a>

        <?php elseif (isset($_SESSION['user'])): ?>

            <a href="/orders/create.php">Новая заявка</a>
            <a href="/orders/my_orders.php">Мои заявки</a>
            <a href="/auth/logout.php" class="nav-link">Выйти</a>

        <?php else: ?>

            <span id="themeToggle" class="theme-btn">🌙</span>

            <a href="/auth/login.php" class="nav-link">
                🔐 Вход
            </a>

            <a href="/auth/register.php" class="nav-btn">
                🚀 Регистрация
            </a>

        <?php endif; ?>

    </nav>
</header>
