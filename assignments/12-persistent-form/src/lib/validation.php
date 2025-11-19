<?php
function is_italian_tax_code_valid($taxCode)
{
    // Italian tax code must be 16 characters long
    if (strlen($taxCode) !== 16) {
        return false;
    }

    // Check the format
    if (
        !preg_match(
            '/^[A-Z]{6}[0-9]{2}[A-Z][0-9]{2}[A-Z][0-9]{3}[A-Z]$/i',
            $taxCode,
        )
    ) {
        return false;
    }

    return true;
}

$monthMap = [
    "A" => "01",
    "B" => "02",
    "C" => "03",
    "D" => "04",
    "E" => "05",
    "H" => "06",
    "L" => "07",
    "M" => "08",
    "P" => "09",
    "R" => "10",
    "S" => "11",
    "T" => "12",
];

function get_birthdate_from_tax_code($taxCode)
{
    $year = substr($taxCode, 6, 2);
    $month = substr($taxCode, 8, 1);
    $day = substr($taxCode, 9, 2);

    // Determine the century
    $currentYear = date("Y") % 100;
    $century = $year <= $currentYear ? "20" : "19";

    // Adjust day
    if ($day > 40) {
        $day -= 40;
    }
    // Map month letter to month number
    global $monthMap;
    $monthNumber = $monthMap[$month] ?? "01";
    return sprintf("%s-%s-%02d", "$century$year", $monthNumber, $day);
}
