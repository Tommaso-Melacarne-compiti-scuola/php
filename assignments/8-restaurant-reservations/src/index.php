<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <title>Prenotazione Ristorante</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <h2>Prenota il tuo tavolo</h2>
    <form action="manageReservation.php" method="POST" class="mt-4">
      <div class="mb-3">
        <label for="firstName" class="form-label">Nome</label>
        <input type="text" class="form-control" name="firstName" id="firstName" required>
      </div>
      <div class="mb-3">
        <label for="lastName" class="form-label">Cognome</label>
        <input type="text" class="form-control" name="lastName" id="lastName" required>
      </div>
      <div class="mb-3">
        <label for="tableNumber" class="form-label">Numero del tavolo</label>
        <select class="form-select" name="tableNumber" id="tableNumber" required>
          <option value="">Seleziona...</option>
          <option value="1">Tavolo 1</option>
          <option value="2">Tavolo 2</option>
          <option value="3">Tavolo 3</option>
          <option value="4">Tavolo 4</option>
          <option value="5">Tavolo 5</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="time" class="form-label">Orario</label>
        <input type="time" class="form-control" name="time" id="time" required>
      </div>
      <div class="mb-3">
        <label for="notes" class="form-label">Note</label>
        <textarea class="form-control" name="notes" id="notes" rows="2"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Pasti</label><br>
        <input type="checkbox" name="starter" id="starter" value="1"> <label for="starter">Antipasto</label>
        <input type="checkbox" name="first" id="first" value="1"> <label for="first">Primo</label>
        <input type="checkbox" name="second" id="second" value="1"> <label for="second">Secondo</label>
      </div>
      <div class="mb-3">
        <label class="form-label">Parcheggio</label><br>
        <input type="radio" name="parking" id="parkingGuarded" value="guarded"> <label
          for="parkingGuarded">Custodito</label>
        <input type="radio" name="parking" id="parkingUnguarded" value="unguarded"> <label for="parkingUnguarded">Non
          custodito</label>
        <input type="radio" name="parking" id="parkingNone" value="none" checked> <label
          for="parkingNone">Nessuno</label>
      </div>
      <button type="submit" class="btn btn-primary">Invia prenotazione</button>
    </form>
  </div>
</body>

</html>