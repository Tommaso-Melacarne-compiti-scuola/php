<?php
const DICE_MAX = 6;
const ROLLS = 2;

$nums = [];

for ($i = 0; $i < ROLLS; $i++) {
  array_push($nums, rand(1, DICE_MAX));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Dadi</title>
</head>

<body>
  <div>
    <div class="fw-bold text-center fs-2">
      Sono usciti i numeri <?php echo implode(', ', $nums) ?>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-3">
      <?php foreach ($nums as $num): ?>
        <img src="dice.php?num=<?php echo $num; ?>" alt="Dice showing number <?php echo $num; ?>">
      <?php endforeach ?>
    </div>

    <div class="d-flex justify-content-center">
      <button type="button" class="btn btn-primary mt-4" id="reload-btn">Ricarica</button>
    </div>
  </div>

  <script src="./scripts/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>