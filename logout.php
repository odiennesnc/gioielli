<?php
require_once 'config.php';

// Distruggi la sessione
session_unset();
session_destroy();

// Redirect alla pagina di login
header('Location: login.php');
exit;
?>
