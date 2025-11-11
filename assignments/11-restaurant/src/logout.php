<?php
session_start();

session_unset();

// Redirect to index.php after logout
header("Location: /");
http_response_code(302);
exit();
