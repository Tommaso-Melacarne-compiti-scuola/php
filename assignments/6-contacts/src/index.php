<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrica Telefonica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Rubrica Telefonica</h1>

        <?php // Array associativo rubrica
// Array associativo rubrica
// Array associativo rubrica
        // Array associativo rubrica
        // Array associativo rubrica
        // Array associativo rubrica
        // Array associativo rubrica
        $rubrica = [
            "Mario Rossi" => "3456789012",
            "Giulia Verdi" => "3387654321",
            "Alessandro Bianchi" => "3201234567",
        ]; ?>

        <!-- 1. Contatti iniziali -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Contatti iniziali</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rubrica as $nome => $telefono): ?>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $telefono ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php // 2. Aggiungi un nuovo contatto (Laura Bianchi)

$rubrica["Laura Bianchi"] = "3331122334"; ?>

        <!-- 2. Dopo aver aggiunto Laura Bianchi -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Dopo aver aggiunto Laura Bianchi</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rubrica as $nome => $telefono): ?>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $telefono ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php // 3. Modifica numero di telefono esistente (Mario Rossi)

$rubrica["Mario Rossi"] = "3399887766"; ?>

        <!-- 3. Dopo aver modificato il numero di Mario Rossi -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Dopo aver modificato il numero di Mario Rossi</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rubrica as $nome => $telefono): ?>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $telefono ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php // 4. Cancella un contatto (Giulia Verdi)

unset($rubrica["Giulia Verdi"]); ?>

        <!-- 4. Dopo aver cancellato Giulia Verdi -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>Dopo aver cancellato Giulia Verdi</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rubrica as $nome => $telefono): ?>
                            <tr>
                                <td><?= $nome ?></td>
                                <td><?= $telefono ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. Rubrica finale aggiornata -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3>Rubrica finale aggiornata</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rubrica as $nome => $telefono): ?>
                            <tr>
                                <td><strong><?= $nome ?></strong></td>
                                <td><?= $telefono ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
