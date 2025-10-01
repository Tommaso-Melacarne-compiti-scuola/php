<?php
function validateNumParam($n)
{
  if (!isset($n) || !is_numeric($n) || $n < 1 && $n > 6) {
    http_response_code(422);
    die("Unprocessable Entity");
  }

  return (int) $n;
}

$num = validateNumParam($_GET['num']);

function generateDots($num)
{
  $dotPatterns = [
    1 => [[1, 1]],
    2 => [[0, 0], [2, 2]],
    3 => [[0, 0], [1, 1], [2, 2]],
    4 => [[0, 0], [0, 2], [2, 0], [2, 2]],
    5 => [[0, 0], [0, 2], [1, 1], [2, 0], [2, 2]],
    6 => [[0, 0], [0, 1], [0, 2], [2, 0], [2, 1], [2, 2]]
  ];

  return $dotPatterns[$num] ?? [];
}

// Generate the SVG
function generateDiceSVG($num)
{
  $dots = generateDots($num);
  $svg = '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">';
  $svg .= '<rect width="100" height="100" rx="10" fill="white" stroke="black" stroke-width="4"/>';

  foreach ($dots as $dot) {
    $x = 25 + $dot[0] * 25;
    $y = 25 + $dot[1] * 25;
    $svg .= '<circle cx="' . $x . '" cy="' . $y . '" r="5" fill="black"/>';
  }

  $svg .= '</svg>';
  return $svg;
}

header('Content-Type: image/svg+xml');
echo generateDiceSVG($num);
?>