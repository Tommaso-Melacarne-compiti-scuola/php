<?php
if (!function_exists('current_user')) {
    require_once __DIR__ . '/../auth/bootstrap.php';
}

$authUser = current_user();
$currentPath = basename($_SERVER['PHP_SELF'] ?? '');
$navItems = [
    'index.php' => 'Ordini',
    'customers.php' => 'Clienti'
];
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="index.php">Classic Models</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($navItems as $href => $label) {
                    $active = ($currentPath === $href) ? ' active' : '';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link' . $active . '" href="' . htmlspecialchars($href) . '">' . htmlspecialchars($label) . '</a>';
                    echo '</li>';
                } ?>
            </ul>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">Logged in as
                    <b><?php echo htmlspecialchars($authUser['email'] ?? ''); ?></b></span>
                <a class="btn btn-outline-danger btn-sm" href="auth/logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>