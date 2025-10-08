<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Intro Form</title>
</head>

<body>
  <div class="container mt-5 w-sm-50 w-25">
    <form action="riepilogo.php" method="get">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
      </div>
      <div class="mb-3">
        <label for="cognome" class="form-label">Cognome</label>
        <input type="text" class="form-control" id="cognome" name="cognome" required>
      </div>
      <div class="mb-3">
        <label for="mail" class="form-label">Indirizzo mail</label>
        <input type="email" class="form-control" id="mail" name="mail" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Invia</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>