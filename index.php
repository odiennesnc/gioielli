<?php
require_once 'config.php';
require_once 'layout.php';

// Verifica se l'utente è loggato
redirectIfNotLoggedIn();

// Ottieni ultimi articoli inseriti
$stmt = $pdo->query("SELECT * FROM articoli ORDER BY data_creazione DESC LIMIT 10");
$articoliRecenti = $stmt->fetchAll();

// Output della pagina
echo getHeader('Dashboard');
getSidebar('dashboard');
?>

<div class="flex flex-col flex-1 w-full">
    <?php getHeaderContent(); ?>
    
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Dashboard
            </h2>
            
            <!-- Statistiche -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                        </svg>
                    </div>
                    <div>
                        <?php 
                        $stmt = $pdo->query("SELECT COUNT(*) as total FROM articoli");
                        $totalArticoli = $stmt->fetch()['total'];
                        ?>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Totale Articoli
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            <?= $totalArticoli ?>
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <?php 
                        $stmt = $pdo->query("SELECT COUNT(*) as total FROM articoli WHERE stato = 'magazzino'");
                        $totalMagazzino = $stmt->fetch()['total'];
                        ?>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Articoli in Magazzino
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            <?= $totalMagazzino ?>
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <?php 
                        $stmt = $pdo->query("SELECT COUNT(*) as total FROM articoli WHERE stato = 'venduto'");
                        $totalVenduti = $stmt->fetch()['total'];
                        ?>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Articoli Venduti
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            <?= $totalVenduti ?>
                        </p>
                    </div>
                </div>
                <!-- Card -->
                <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <?php 
                        $stmt = $pdo->query("SELECT valore FROM settings WHERE nome = 'prezzo_oro'");
                        $prezzoOro = $stmt->fetch()['valore'];
                        ?>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Prezzo Oro (g)
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            € <?= number_format($prezzoOro, 2, ',', '.') ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Ultimi articoli inseriti -->
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Ultimi articoli inseriti
            </h2>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <th class="px-4 py-3">Numero</th>
                                <th class="px-4 py-3">Data creazione</th>
                                <th class="px-4 py-3">Descrizione</th>
                                <th class="px-4 py-3">Costo totale</th>
                                <th class="px-4 py-3">Valore totale</th>
                                <th class="px-4 py-3">Stato</th>
                                <th class="px-4 py-3">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <?php foreach ($articoliRecenti as $articolo): ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <div>
                                                <p class="font-semibold"><?= $articolo['id'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= date('d/m/Y', strtotime($articolo['data_creazione'])) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?= htmlspecialchars($articolo['descrizione']) ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        € <?= number_format(calcolaCostoTotale($articolo), 2, ',', '.') ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        € <?= number_format(calcolaValoreTotale($articolo), 2, ',', '.') ?>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight rounded-full <?= $articolo['stato'] == 'magazzino' ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100' ?>">
                                            <?= $articolo['stato'] == 'magazzino' ? 'In Magazzino' : 'Venduto' ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a href="modifica_articolo.php?id=<?= $articolo['id'] ?>" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>
                                            <button onclick="deleteArticolo(<?= $articolo['id'] ?>)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($articoliRecenti)): ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td colspan="7" class="px-4 py-3 text-sm text-center">
                                        Nessun articolo presente. <a href="nuovo_articolo.php" class="text-purple-600">Inserisci il tuo primo articolo</a>.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function deleteArticolo(id) {
    if (confirm('Sei sicuro di voler eliminare questo articolo?')) {
        window.location.href = 'delete_articolo.php?id=' + id;
    }
}
</script>

<?php
echo getFooter();
?>
