<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <?php if (isset($_SESSION["current_question"])): ?>
        <title>Quiz: question <?= $_SESSION["current_question"] ?></title>
    <?php else: ?>
        <title>Quiz: start</title>
    <?php endif; ?>
</head>
<body data-bs-theme="dark">
    <h1 class="text-center mt-3 mb-5">Persistent Quiz</h1>

    <?php if (isset($_SESSION["quiz_end"])): ?>
        <div class="alert alert-success w-25 mx-auto text-center" role="alert">
            <h2>Quiz Completed!</h2>
            <p>Your score: <?= $_SESSION["score"] ?></p>
            <form action="process_answer.php" method="post">
                <button type="submit" class="btn btn-success w-100">Restart Quiz</button>
            </form>
        </div>
    <?php elseif (!isset($_SESSION["current_question"])): ?>
        Welcome to the quiz!<br>
        <form action="process_answer.php" method="post">
            <button type="submit">Start Quiz</button>
        </form>
    <?php else: ?>
        <div class="w-50 mx-auto">
            <?php
            require_once "quiz_data.php";

            $current_question_index = $_SESSION["current_question"];
            $current_question = quiz_data[$current_question_index];
            ?>

            <form action="process_answer.php" method="post">
                <fieldset>
                    <legend>Question <?= $current_question_index +
                        1 ?>:</legend>
                    <p><?= htmlspecialchars(
                        $current_question["question"],
                    ) ?></p>
                    <?php foreach (
                        $current_question["options"]
                        as $index => $option
                    ): ?>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="option<?= $index ?>" name="answer" value="<?= $index ?>" required>
                            <label class="form-check-radio" for="option<?= $index ?>">
                                <?= htmlspecialchars($option) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
                <button type="submit" class="btn btn-primary mt-3">Submit Answer</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
