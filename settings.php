<?php
require_once 'config.php';
require_once 'layout.php';

// Verifica se l'utente è loggato
redirectIfNotLoggedIn();

$message = '';
$prezzoOro = 0;

// Recupera il prezzo attuale dell'oro
try {
    $stmt = $pdo->query("SELECT valore FROM settings WHERE nome = 'prezzo_oro'");
    $row = $stmt->fetch();
    if ($row) {
        $prezzoOro = $row['valore'];
    }
} catch (PDOException $e) {
    $message = 'Errore durante il recupero delle impostazioni: ' . $e->getMessage();
}

// Gestione del form di aggiornamento prezzo oro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuovoPrezzoOro = isset($_POST['prezzo_oro']) ? floatval($_POST['prezzo_oro']) : 0;
    
    try {
        // Aggiorna il prezzo dell'oro
        $stmt = $pdo->prepare("UPDATE settings SET valore = :valore WHERE nome = 'prezzo_oro'");
        $stmt->execute(['valore' => $nuovoPrezzoOro]);
        
        $prezzoOro = $nuovoPrezzoOro;
        $message = 'Prezzo dell\'oro aggiornato con successo!';
    } catch (PDOException $e) {
        $message = 'Errore durante l\'aggiornamento: ' . $e->getMessage();
    }
}

// Output della pagina
echo getHeader('Impostazioni');
getSidebar('settings');
?>

<div class="flex flex-col flex-1 w-full">
    <?php getHeaderContent(); ?>
    
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Impostazioni
            </h2>
            
            <?php if ($message): ?>
                <div class="px-4 py-3 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <form method="POST" action="">
                    <div class="mb-6">
                        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                            Prezzo dell'oro
                        </h4>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Prezzo al grammo (€)</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="0.00"
                                type="number"
                                step="0.01"
                                name="prezzo_oro"
                                value="<?= htmlspecialchars($prezzoOro) ?>"
                                required
                            />
                        </label>
                    </div>
                    
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                            Salva impostazioni
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<?php
echo getFooter();
?>
