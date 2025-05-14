<?php
// Configurazione database
$host = 'localhost';
$db = 'gioielli_db';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $options);
} catch (PDOException $e) {
    die('Errore di connessione: ' . $e->getMessage());
}

// Sessione
session_start();

// Funzione per controllare se l'utente è loggato
function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Funzione per reindirizzare se non è loggato
function redirectIfNotLoggedIn() {
    if (!isUserLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Funzione per ottenere il prezzo dell'oro
function getOroPrezzo() {
    global $pdo;
    $stmt = $pdo->query("SELECT valore FROM settings WHERE nome = 'prezzo_oro'");
    $result = $stmt->fetch();
    return $result ? floatval($result['valore']) : 0;
}

// Calcola il costo totale di un articolo
function calcolaCostoTotale($articolo) {
    $costoTotale = 0;
    $costoTotale += floatval($articolo['costo_lavorazione']);
    $costoTotale += floatval($articolo['incassatura']);
    $costoTotale += floatval($articolo['incisione']);
    $costoTotale += floatval($articolo['rodiatura_1']);
    $costoTotale += floatval($articolo['rodiatura_2']);
    $costoTotale += floatval($articolo['brillanti_1']);
    $costoTotale += floatval($articolo['brillanti_2']);
    $costoTotale += floatval($articolo['brillanti_3']);
    $costoTotale += floatval($articolo['brillanti_4']);
    $costoTotale += floatval($articolo['brillanti_5']);
    $costoTotale += floatval($articolo['grammi_oro']) * getOroPrezzo();
    
    return $costoTotale;
}

// Calcola il valore totale di un articolo
function calcolaValoreTotale($articolo) {
    $valoreTotale = 0;
    $valoreTotale += floatval($articolo['costo_lavorazione_finale']);
    $valoreTotale += floatval($articolo['incassatura_finale']);
    $valoreTotale += floatval($articolo['incisione_finale']);
    $valoreTotale += floatval($articolo['rodiatura_1_finale']);
    $valoreTotale += floatval($articolo['rodiatura_2_finale']);
    $valoreTotale += floatval($articolo['brillanti_1_finale']);
    $valoreTotale += floatval($articolo['brillanti_2_finale']);
    $valoreTotale += floatval($articolo['brillanti_3_finale']);
    $valoreTotale += floatval($articolo['brillanti_4_finale']);
    $valoreTotale += floatval($articolo['brillanti_5_finale']);
    $valoreTotale += floatval($articolo['grammi_oro_finale']) * getOroPrezzo();
    
    return $valoreTotale;
}
?>
