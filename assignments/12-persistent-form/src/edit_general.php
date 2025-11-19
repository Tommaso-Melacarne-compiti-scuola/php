<?php
session_start();

include "lib/validation.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["general_data"] = [
        "name" => $_POST["name"] ?? "",
        "surname" => $_POST["surname"] ?? "",
        "birthDate" => $_POST["birthDate"] ?? "",
        "taxCode" => $_POST["taxCode"] ?? "",
    ];

    // Validate tax code
    if (!is_italian_tax_code_valid($_SESSION["general_data"]["taxCode"])) {
        $errorMessage =
            "Codice fiscale non valido. Deve essere di 16 caratteri e seguire il formato corretto.";
        echo "<div class='alert alert-danger' role='alert'>$errorMessage</div>";
        exit();
    }

    header("Location: edit_contact.php");
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
        Modifica dati generali
    </title>
<body>
    <h1 class="text-center mt-4">
        Dati generali:
    </h1>

    <div class="container mt-4 w-75">
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars(
                    $_SESSION["general_data"]["name"] ?? "",
                ); ?>">
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Cognome:</label>
                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo htmlspecialchars(
                    $_SESSION["general_data"]["surname"] ?? "",
                ); ?>">
            </div>
            <div class="mb-3">
                <label for="birthDate" class="form-label">Data di nascita:</label>
                <input type="date" class="form-control" id="birthDate" name="birthDate" value="<?php echo htmlspecialchars(
                    $_SESSION["general_data"]["birthDate"] ?? "",
                ); ?>">
            </div>
            <div class="mb-3">
                <label for="taxCode" class="form-label">Codice fiscale:</label>
                <input type="text" class="form-control" id="taxCode" name="taxCode" value="<?php echo htmlspecialchars(
                    $_SESSION["general_data"]["taxCode"] ?? "",
                ); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Vai ai dati di contatto</button>
        </form>
    </div>
</body>
</html>
