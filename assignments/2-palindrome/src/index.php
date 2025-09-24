2-palindrome/src/index.php
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controllo Palindroma e Rimozione Vocali</title>
</head>
<body>
    <?php
    $str = "A man a plan a canal Panama";

    function cleanUpString($string)
    {
        $cleaned = preg_replace("/[^a-zA-Z]/", "", $string);
        $cleaned = strtolower($cleaned);
        return strtolower($cleaned);
    }

    function isPalindrome($str)
    {
        return $str === strrev($str);
    }

    $cleaned = cleanUpString($str);

    if (isPalindrome($cleaned)) {
        echo "<p>La stringa '$str' è palindroma.</p>";
    } else {
        echo "<p>La stringa '$str' non è palindroma.</p>";
    }

    function removeVowels($string)
    {
        return preg_replace("/[aeiouAEIOU]/", "", $string);
    }

    $withoutVowels = removeVowels($str);
    echo "<p>Stringa senza vocali: '$withoutVowels'</p>";
    ?>
</body>
</html>
