<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lorem Ipsum</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    const RANDOM_MIN = 16;
    const RANDOM_MAX = 40;

    const str = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed tempus lectus. In urna purus, convallis sit amet viverra et, convallis a libero. Donec condimentum neque mollis, mattis lacus sit amet, scelerisque tortor. Aliquam feugiat ante ac felis auctor posuere. Pellentesque massa velit, mollis quis facilisis eu, dapibus at velit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis turpis enim, ornare eget arcu ullamcorper, vestibulum hendrerit velit.";

    $fontSizeGreen = rand(RANDOM_MIN, RANDOM_MAX);
    $fontSizeBlue = rand(RANDOM_MIN, RANDOM_MAX);

    $numCharacters = strlen(str);
    $numWords = str_word_count(str);
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1 class="text-center mb-4">Lorem Ipsum</h1>

                <div class="mb-4">
                    <h3>Paragrafo Verde</h3>
                    <p class="text-success" style="font-size: <?php echo $fontSizeGreen; ?>px;">
                        <?php echo str; ?>
                    </p>
                </div>

                <div class="mb-4">
                    <h3>Paragrafo Blu Maiuscolo</h3>
                    <p class="text-primary" style="font-size: <?php echo $fontSizeBlue; ?>px;">
                        <?php echo strtoupper(str); ?>
                    </p>
                </div>

                <h1 class="text-danger">Numero di caratteri: <?php echo $numCharacters; ?></h1>

                <h2 class="text-warning">Numero di parole: <?php echo $numWords; ?></h2>
            </div>
        </div>
    </div>

</body>
</html>
