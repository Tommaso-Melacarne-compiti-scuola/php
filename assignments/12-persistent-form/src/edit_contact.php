<?php
session_start();

include "lib/validation.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["contact_data"] = [
        "email" => $_POST["email"] ?? "",
        "phone" => $_POST["phone"] ?? "",
    ];

    header("Location: /");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>
        Informazioni di contatto
    </title>
<body>
    <h1 class="text-center mt-4">
        Informazioni di contatto:
    </h1>

    <div class="container mt-4 w-75">
        <form method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars(
                    $_SESSION["contact_data"]["email"] ?? "",
                ); ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telefono:</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars(
                    $_SESSION["contact_data"]["phone"] ?? "",
                ); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Vai al riepilogo</button>
        </form>
    </div>

</html>
