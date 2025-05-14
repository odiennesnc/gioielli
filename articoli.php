<?php
require_once 'config.php';
require_once 'layout.php';

// Verifica se l'utente è loggato
redirectIfNotLoggedIn();

// Query per ottenere gli articoli in magazzino
$stmt = $pdo->query("SELECT * FROM articoli WHERE stato = 'magazzino' ORDER BY data_creazione DESC");
$articoli = $stmt->fetchAll();

// Output della pagina
echo getHeader('Articoli in magazzino');
getSidebar('articoli');
?>

<div class="flex flex-col flex-1 w-full">
    <?php getHeaderContent(); ?>
    
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Articoli in magazzino
            </h2>
            
            <!-- Nuovo articolo button -->
            <div class="flex justify-end mb-4">
                <a href="nuovo_articolo.php" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Nuovo articolo</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </a>
            </div>

            <!-- Tabella articoli -->
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
                                <th class="px-4 py-3">Modifica</th>
                                <th class="px-4 py-3">Elimina</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <?php foreach ($articoli as $articolo): ?>
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
                                        <span class="px-2 py-1 font-semibold leading-tight rounded-full text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100">
                                            In Magazzino
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a href="modifica_articolo.php?id=<?= $articolo['id'] ?>" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <button onclick="deleteArticolo(<?= $articolo['id'] ?>)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($articoli)): ?>
                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td colspan="8" class="px-4 py-3 text-sm text-center">
                                        Nessun articolo presente in magazzino. <a href="nuovo_articolo.php" class="text-purple-600">Inserisci un nuovo articolo</a>.
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

<!-- Modale per conferma eliminazione -->
<div
    x-data="{ isModalOpen: false, articoloId: null }"
    x-on:keydown.escape="isModalOpen = false"
    :class="{ 'block': isModalOpen, 'hidden': !isModalOpen }"
    class="fixed inset-0 z-30 hidden flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
>
    <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-1/2"
        @click.away="isModalOpen = false"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
    >
        <header class="flex justify-end">
            <button
                class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                aria-label="close"
                @click="isModalOpen = false"
            >
                <svg
                    class="w-4 h-4"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    role="img"
                    aria-hidden="true"
                >
                    <path
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                    ></path>
                </svg>
            </button>
        </header>
        <div class="mt-4 mb-6">
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                Conferma eliminazione
            </p>
            <p class="text-sm text-gray-700 dark:text-gray-400">
                Sei sicuro di voler eliminare questo articolo? Questa azione non può essere annullata.
            </p>
        </div>
        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button
                @click="isModalOpen = false"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
            >
                Annulla
            </button>
            <button
                @click="window.location.href = 'delete_articolo.php?id=' + articoloId"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
                Conferma
            </button>
        </footer>
    </div>
</div>

<script>
function deleteArticolo(id) {
    const modal = document.querySelector('[x-data]');
    modal.__x.$data.isModalOpen = true;
    modal.__x.$data.articoloId = id;
}
</script>

<?php
echo getFooter();
?>
