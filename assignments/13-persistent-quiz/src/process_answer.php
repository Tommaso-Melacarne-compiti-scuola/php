<?php
session_start();
require_once "quiz_data.php";

if (!isset($_SESSION["current_question"]) || isset($_SESSION["quiz_end"])) {
    // Start the quiz
    $_SESSION["quiz_end"] = null;
    $_SESSION["current_question"] = 0;
    $_SESSION["score"] = 0;
    header("Location: index.php");
    exit();
}
$current_question_index = $_SESSION["current_question"];
$current_question = quiz_data[$current_question_index];
if (isset($_POST["answer"])) {
    $selected_answer = (int) $_POST["answer"];
    if ($selected_answer === $current_question["answer"]) {
        $_SESSION["score"]++;
    }
    $_SESSION["current_question"]++;
    if ($_SESSION["current_question"] >= count(quiz_data)) {
        $_SESSION["current_question"] = null;
        $_SESSION["quiz_end"] = true;
        header("Location: index.php");
        exit();
    } else {
        // Move to the next question
        header("Location: index.php");
        exit();
    }
} else {
    // No answer selected, redirect back to the question
    header("Location: index.php");
    exit();
}
