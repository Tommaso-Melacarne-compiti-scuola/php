<?php
function average($numbers)
{
    if (empty($numbers)) {
        return 0;
    }

    $sum = array_sum($numbers);
    $count = count($numbers);

    return $sum / $count;
}

function printResult($average)
{
    if ($average >= 6) {
        echo "Passed";
    } else {
        echo "Failed";
    }
}
