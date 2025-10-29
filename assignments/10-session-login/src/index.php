<?php
session_start();

if (!isset($_SESSION["username"])) {
    // Redirect to login if not logged in
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Home</title>
<body>
    <div class="text-center mt-5">
        Welcome, <?= $_SESSION["username"] ?>!
        Login date: <?= date("d/m/Y H:i:s", $_SESSION["login_date"]) ?>

        <a href="/logout.php" class="btn btn-danger d-block w-25 mx-auto mt-3">Logout</a>
    </div>

</body>
</html>
