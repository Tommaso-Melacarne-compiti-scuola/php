<?php
const numPrimes = 100; ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I Primi 100 Numeri Primi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"></head>
<body class="bg-white">
    <div class="container my-5">
        <h1 class="text-center mb-4">
            I Primi
            <?php echo numPrimes; ?>
            Numeri Primi
        </h1>

        <?php
        function isPrime($n)
        {
            if ($n < 2) {
                return false;
            }
            if ($n == 2) {
                return true;
            }
            if ($n % 2 == 0) {
                return false;
            }

            for ($i = 3; $i <= sqrt($n); $i += 2) {
                if ($n % $i == 0) {
                    return false;
                }
            }
            return true;
        }

        function getFirstNPrimes($count)
        {
            $primes = [];
            $num = 2;

            while (count($primes) < $count) {
                if (isPrime($num)) {
                    $primes[] = $num;
                }
                $num++;
            }

            return $primes;
        }

        $primes = getFirstNPrimes(numPrimes);
        ?>

        <ul class="list-unstyled">
            <div class="row">
                <?php foreach ($primes as $prime): ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2">
                        <li>
                            <span class="badge bg-secondary w-100 p-2">
                                <?php echo $prime; ?>
                            </span>
                        </li>
                    </div>
                <?php endforeach; ?>
            </div>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script></body>
</html>
