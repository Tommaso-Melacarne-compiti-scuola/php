<?php
session_start();
$generalData = $_SESSION["general_data"] ?? null;
$contactData = $_SESSION["contact_data"] ?? null;

if (!$generalData || !$contactData) {
    header("Location: edit_general.php");
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
        Registrazione
    </title>
<body>
    <h1 class="text-center mt-4">
        Riassunto dati inseriti:
    </h1>
    <div class="container mt-4">
        <h2>Dati generali:</h2>
        <table class="table">
            <tr>
                <th>Nome</th>
                <td><?php echo htmlspecialchars($generalData["name"]); ?></td>
            </tr>
            <tr>
                <th>Cognome</th>
                <td><?php echo htmlspecialchars(
                    $generalData["surname"],
                ); ?></td>
            </tr>
            <tr>
                <th>Data di nascita</th>
                <td><?php echo htmlspecialchars(
                    $generalData["birthDate"],
                ); ?></td>
            </tr>
            <tr>
                <th>Codice fiscale</th>
                <td><?php echo htmlspecialchars(
                    $generalData["taxCode"],
                ); ?></td>
            </tr>
        </table>
        <h2>Dati di contatto:</h2>
        <table class="table">
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($contactData["email"]); ?></td>
            </tr>
            <tr>
                <th>Telefono</th>
                <td><?php echo htmlspecialchars($contactData["phone"]); ?></td>
            </tr>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="edit_general.php" class="btn btn-primary">Modifica dati</a>
    </div>
</body>
</html>
