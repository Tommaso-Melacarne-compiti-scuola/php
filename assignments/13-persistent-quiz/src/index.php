<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <?php if (isset($_SESSION["quiz_end"])): ?>
        <title>Quiz: completed</title>
    <?php elseif (isset($_SESSION["current_question"])): ?>
        <title>Quiz: question <?= $_SESSION["current_question"] + 1 ?></title>
    <?php else: ?>
        <title>Quiz: start</title>
    <?php endif; ?>
</head>
<body data-bs-theme="dark">
    <h1 class="text-center mt-3 mb-5">Quiz</h1>

    <div class="d-flex w-100 justify-content-center mx-auto" style="max-width: 500px;">
        <?php if (isset($_SESSION["quiz_end"])): ?>
            <div class="alert alert-success text-center w-100 mx-3" role="alert">
                <h2>Quiz Completed!</h2>
                <p>Your score: <?= $_SESSION["score"] ?></p>
                <form action="process_answer.php" method="post">
                    <button type="submit" class="btn btn-success w-100">Restart Quiz</button>
                </form>
            </div>
        <?php elseif (!isset($_SESSION["current_question"])): ?>
            <div class="alert alert-info text-center w-100 mx-3" role="alert">
                <h2>Welcome to the quiz!</h2>
                <form action="process_answer.php" method="post">
                    <button type="submit" class="btn btn-primary w-100">Start Quiz</button>
                </form>
            </div>
        <?php else: ?>
            <div class="w-100 mx-3">
                <?php
                require_once "quiz_data.php";

                $current_question_index = $_SESSION["current_question"];
                $current_question = quiz_data[$current_question_index];
                ?>

                <form method="post">
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
                                <?php $isChecked =
                                    isset(
                                        $_SESSION["answers"][
                                            (string) $current_question_index
                                        ],
                                    ) &&
                                    $_SESSION["answers"][
                                        (string) $current_question_index
                                    ] === $index; ?>
                                <input type="radio" class="form-check-input" id="option<?= $index ?>" name="answer" value="<?= $index ?>" required
                                    <?= $isChecked ? "checked" : "" ?>
                                >
                                <label class="form-check-radio" for="option<?= $index ?>">
                                    <?= htmlspecialchars($option) ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </fieldset>
                    <?php if ($_SESSION["current_question"] > 0): ?>
                        <a class="btn btn-secondary mt-3 me-2" href="go_back.php">
                            Go Back
                        </a>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary mt-3" formaction="process_answer.php">Submit Answer</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
