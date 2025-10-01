<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">School Grade Calculator</h1>

        <?php
        // Include the functions
        include "functions.php";

        // Example grades array
        $grades = [7, 5, 6, 8, 9];

        // Calculate the average
        $gradeAverage = average($grades);
        ?>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grades</h5>
                <p>Grades: <?php echo implode(", ", $grades); ?></p>

                <h5 class="card-title">Average</h5>
                <p>Average: <?php echo number_format($gradeAverage, 2); ?></p>

                <h5 class="card-title">Result</h5>
                <p><?php printResult($gradeAverage); ?></p>
            </div>
        </div>
    </div>
</body>
</html>
