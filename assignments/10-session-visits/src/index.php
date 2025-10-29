<?php
session_start();

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: " . strtok($_SERVER["REQUEST_URI"], "?"));
}

if (!isset($_SESSION["visits"])) {
    $_SESSION["visits"] = 0;
}

$_SESSION["visits"]++;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Visits</title>
<body>
    <div class="text-center mt-5">
        You have visited this page <?php echo $_SESSION["visits"]; ?> times.

        <?php if (isset($_SESSION["last_visit"])): ?>
            The last time you visited was on: <?php echo $_SESSION[
                "last_visit"
            ]; ?>
        <?php endif; ?>

        <?php $_SESSION["last_visit"] = date("Y-m-d H:i:s"); ?>

        <div class="d-block mx-auto mt-3">
            <a href="?logout">
                <button type="button" class="btn btn-danger">
                    Delete session
                </button>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
