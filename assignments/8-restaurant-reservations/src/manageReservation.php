<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <title>Resoconto Prenotazione</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <?php
  date_default_timezone_set("Europe/Rome");

  $defaultWaiters = ['Luca', 'Marco', 'Anna', 'Simone', 'Giulia'];

  function getRandomWaiter(array $waiters): string
  {
    return $waiters[array_rand($waiters)];
  }

  function calculateMealPrice(bool $starter, bool $first, bool $second): float
  {
    $price = 0;
    if ($starter)
      $price += 5;
    if ($first)
      $price += 6;
    if ($second)
      $price += 7;

    // Discounts
    if ($first && $second && !$starter) {
      $price *= 0.9; // 10% discount
    }
    if ($starter && $first && $second) {
      $price *= 0.85; // 15% discount
    }

    return $price;
  }

  function calculateParkingPrice(string $parkingType): float
  {
    switch ($parkingType) {
      case 'unguarded':
        return 3;
      case 'guarded':
        return 5;
      default:
        return 0;
    }
  }

  function sanitizeInput(string $input): string
  {
    return htmlspecialchars(trim($input));
  }

  // Recupera dati POST
  $firstName = sanitizeInput($_POST['firstName'] ?? '');
  $lastName = sanitizeInput($_POST['lastName'] ?? '');
  $tableNumber = $_POST['tableNumber'] ?? '';
  $time = $_POST['time'] ?? '';
  $notes = sanitizeInput($_POST['notes'] ?? '');

  $starter = isset($_POST['starter']);
  $first = isset($_POST['first']);
  $second = isset($_POST['second']);
  $parking = $_POST['parking'] ?? 'none';

  $reservationTime = date("d-m-Y H:i");

  $errorMsg = "";
  $mealsSelected = array_filter([$starter, $first, $second]);

  if (count($mealsSelected) === 0) {
    $errorMsg = "Devi selezionare almeno un pasto!";
  } elseif ($starter && !$first && !$second) {
    $errorMsg = "Non è possibile ordinare solo l'antipasto!";
  }

  if ($errorMsg) {
    echo '<div class="container mt-5 text-center w-50">';
    echo '<div class="alert alert-danger">' . $errorMsg . '</div>';
    echo '<a href="/" class="btn btn-secondary mt-3">Ritorna alla prenotazione</a>';
    echo '</div>';
    http_response_code(400);
    exit;
  }

  $mealPrice = calculateMealPrice($starter, $first, $second);
  $parkingPrice = calculateParkingPrice($parking);
  $totalPrice = $mealPrice + $parkingPrice;

  $waiter = getRandomWaiter($defaultWaiters);

  ?>
  <div class="container mt-5">
    <h3>Resoconto Prenotazione</h3>
    <table class="table table-bordered mt-3">
      <tr>
        <th>Nome</th>
        <td><?= $firstName ?></td>
      </tr>
      <tr>
        <th>Cognome</th>
        <td><?= $lastName ?></td>
      </tr>
      <tr>
        <th>Numero Tavolo</th>
        <td><?= $tableNumber ?></td>
      </tr>
      <tr>
        <th>Orario</th>
        <td><?= $time ?></td>
      </tr>
      <tr>
        <th>Note</th>
        <td><?= $notes ?></td>
      </tr>
      <tr>
        <th>Pasti</th>
        <td>
          <?php
          $meals = [];
          if ($starter)
            $meals[] = "Antipasto";
          if ($first)
            $meals[] = "Primo";
          if ($second)
            $meals[] = "Secondo";
          echo implode(', ', $meals);
          ?>
        </td>
      </tr>
      <tr>
        <th>Parcheggio</th>
        <td>
          <?php
          if ($parking == 'guarded')
            echo "Custodito";
          elseif ($parking == 'unguarded')
            echo "Non custodito";
          else
            echo "Nessuno";
          ?>
        </td>
      </tr>
      <tr>
        <th>Cameriere Assegnato</th>
        <td><?= $waiter ?></td>
      </tr>
      <tr>
        <th>Prezzo Totale</th>
        <td><?= number_format($totalPrice, 2) ?> €</td>
      </tr>
      <tr>
        <th>Data prenotazione</th>
        <td><?= $reservationTime ?></td>
      </tr>
    </table>
  </div>
</body>

</html>