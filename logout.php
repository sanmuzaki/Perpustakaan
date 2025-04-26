<?php
session_start();
session_destroy();  // Menghancurkan session untuk logout
header("Location: login.php");  // Arahkan kembali ke login
?>
