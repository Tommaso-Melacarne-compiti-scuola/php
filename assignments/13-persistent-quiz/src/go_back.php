<?php
session_start();

if (isset($_SESSION["current_question"]) && $_SESSION["current_question"] > 0) {
    $_SESSION["current_question"]--;
}
header("Location: index.php");
exit();
