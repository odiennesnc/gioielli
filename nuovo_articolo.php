<?php
require_once 'config.php';
require_once 'layout.php';

// Verifica se l'utente è loggato
redirectIfNotLoggedIn();

$message = '';

// Gestione del form di inserimento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Preparazione della query di inserimento
        $sql = "INSERT INTO articoli (
            descrizione, 
            costo_lavorazione, 
            incassatura, 
            incisione, 
            rodiatura_1, 
            rodiatura_2, 
            brillanti_1, 
            brillanti_2, 
            brillanti_3, 
            brillanti_4, 
            brillanti_5, 
            grammi_oro, 
            costo_lavorazione_finale, 
            incassatura_finale, 
            incisione_finale, 
            rodiatura_1_finale, 
            rodiatura_2_finale, 
            brillanti_1_finale, 
            brillanti_2_finale, 
            brillanti_3_finale, 
            brillanti_4_finale, 
            brillanti_5_finale, 
            grammi_oro_finale, 
            stato
        ) VALUES (
            :descrizione, 
            :costo_lavorazione, 
            :incassatura, 
            :incisione, 
            :rodiatura_1, 
            :rodiatura_2, 
            :brillanti_1, 
            :brillanti_2, 
            :brillanti_3, 
            :brillanti_4, 
            :brillanti_5, 
            :grammi_oro, 
            :costo_lavorazione_finale, 
            :incassatura_finale, 
            :incisione_finale, 
            :rodiatura_1_finale, 
            :rodiatura_2_finale, 
            :brillanti_1_finale, 
            :brillanti_2_finale, 
            :brillanti_3_finale, 
            :brillanti_4_finale, 
            :brillanti_5_finale, 
            :grammi_oro_finale, 
            :stato
        )";
        
        $stmt = $pdo->prepare($sql);
        
        // Binding dei valori
        $stmt->bindParam(':descrizione', $_POST['descrizione']);
        $stmt->bindParam(':costo_lavorazione', $_POST['costo_lavorazione']);
        $stmt->bindParam(':incassatura', $_POST['incassatura']);
        $stmt->bindParam(':incisione', $_POST['incisione']);
        $stmt->bindParam(':rodiatura_1', $_POST['rodiatura_1']);
        $stmt->bindParam(':rodiatura_2', $_POST['rodiatura_2']);
        $stmt->bindParam(':brillanti_1', $_POST['brillanti_1']);
        $stmt->bindParam(':brillanti_2', $_POST['brillanti_2']);
        $stmt->bindParam(':brillanti_3', $_POST['brillanti_3']);
        $stmt->bindParam(':brillanti_4', $_POST['brillanti_4']);
        $stmt->bindParam(':brillanti_5', $_POST['brillanti_5']);
        $stmt->bindParam(':grammi_oro', $_POST['grammi_oro']);
        $stmt->bindParam(':costo_lavorazione_finale', $_POST['costo_lavorazione_finale']);
        $stmt->bindParam(':incassatura_finale', $_POST['incassatura_finale']);
        $stmt->bindParam(':incisione_finale', $_POST['incisione_finale']);
        $stmt->bindParam(':rodiatura_1_finale', $_POST['rodiatura_1_finale']);
        $stmt->bindParam(':rodiatura_2_finale', $_POST['rodiatura_2_finale']);
        $stmt->bindParam(':brillanti_1_finale', $_POST['brillanti_1_finale']);
        $stmt->bindParam(':brillanti_2_finale', $_POST['brillanti_2_finale']);
        $stmt->bindParam(':brillanti_3_finale', $_POST['brillanti_3_finale']);
        $stmt->bindParam(':brillanti_4_finale', $_POST['brillanti_4_finale']);
        $stmt->bindParam(':brillanti_5_finale', $_POST['brillanti_5_finale']);
        $stmt->bindParam(':grammi_oro_finale', $_POST['grammi_oro_finale']);
        $stmt->bindParam(':stato', $_POST['stato']);
        
        // Esecuzione query
        $stmt->execute();
        
        $message = 'Articolo inserito con successo!';
        
        // Redirect alla lista articoli
        header('Location: articoli.php?message=' . urlencode($message));
        exit;
    } catch (PDOException $e) {
        $message = 'Errore durante l\'inserimento: ' . $e->getMessage();
    }
}

// Output della pagina
echo getHeader('Inserisci nuovo articolo');
getSidebar('nuovo_articolo');
?>

<div class="flex flex-col flex-1 w-full">
    <?php getHeaderContent(); ?>
    
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Inserisci nuovo articolo
            </h2>
            
            <?php if ($message): ?>
                <div class="px-4 py-3 mb-6 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Descrizione
                        </label>
                        <input 
                            type="text" 
                            name="descrizione" 
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                            placeholder="Descrizione dell'articolo"
                            required
                        />
                    </div>
                    
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Stato
                        </label>
                        <select name="stato" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="magazzino">In magazzino</option>
                            <option value="venduto">Venduto</option>
                        </select>
                    </div>
                    
                    <!-- Sommario costi e valori -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="flex justify-between">
                            <div>
                                <h4 class="mb-2 text-base font-semibold text-gray-700 dark:text-gray-300">Costo Totale:</h4>
                                <p id="costo-totale" class="text-xl font-bold text-purple-600 dark:text-purple-400">€ 0,00</p>
                            </div>
                            <div>
                                <h4 class="mb-2 text-base font-semibold text-gray-700 dark:text-gray-300">Valore Totale:</h4>
                                <p id="valore-totale" class="text-xl font-bold text-green-600 dark:text-green-400">€ 0,00</p>
                            </div>
                            <div>
                                <button 
                                    type="button" 
                                    id="copia-costi" 
                                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                >
                                    Copia costi → finali
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="prezzo-oro" value="<?= getOroPrezzo() ?>">
                    </div>
                    <div class="grid gap-6 mb-8 md:grid-cols-2">
                        <!-- Colonna sinistra -->
                        <div>
                            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                Costi iniziali
                            </h3>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Costo lavorazione</span>
                                <input 
                                    type="number" 
                                    name="costo_lavorazione" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Incassatura</span>
                                <input 
                                    type="number" 
                                    name="incassatura" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Incisione</span>
                                <input 
                                    type="number" 
                                    name="incisione" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Rodiatura 1</span>
                                <input 
                                    type="number" 
                                    name="rodiatura_1" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Rodiatura 2</span>
                                <input 
                                    type="number" 
                                    name="rodiatura_2" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 1</span>
                                <input 
                                    type="number" 
                                    name="brillanti_1" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 2</span>
                                <input 
                                    type="number" 
                                    name="brillanti_2" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 3</span>
                                <input 
                                    type="number" 
                                    name="brillanti_3" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 4</span>
                                <input 
                                    type="number" 
                                    name="brillanti_4" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 5</span>
                                <input 
                                    type="number" 
                                    name="brillanti_5" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Grammi oro</span>
                                <input 
                                    type="number" 
                                    name="grammi_oro" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                        </div>
                        
                        <!-- Colonna destra -->
                        <div>
                            <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                Costi finali
                            </h3>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Costo lavorazione finale</span>
                                <input 
                                    type="number" 
                                    name="costo_lavorazione_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Incassatura finale</span>
                                <input 
                                    type="number" 
                                    name="incassatura_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Incisione finale</span>
                                <input 
                                    type="number" 
                                    name="incisione_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Rodiatura 1 finale</span>
                                <input 
                                    type="number" 
                                    name="rodiatura_1_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Rodiatura 2 finale</span>
                                <input 
                                    type="number" 
                                    name="rodiatura_2_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 1 finale</span>
                                <input 
                                    type="number" 
                                    name="brillanti_1_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 2 finale</span>
                                <input 
                                    type="number" 
                                    name="brillanti_2_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 3 finale</span>
                                <input 
                                    type="number" 
                                    name="brillanti_3_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 4 finale</span>
                                <input 
                                    type="number" 
                                    name="brillanti_4_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Brillanti 5 finale</span>
                                <input 
                                    type="number" 
                                    name="brillanti_5_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                            
                            <label class="block text-sm mb-4">
                                <span class="text-gray-700 dark:text-gray-400">Grammi oro finale</span>
                                <input 
                                    type="number" 
                                    name="grammi_oro_finale" 
                                    step="0.01" 
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                    placeholder="0.00"
                                    value="0"
                                />
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <a href="articoli.php" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                            Annulla
                        </a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Salva articolo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

<script src="assets/js/articoli.js"></script>

<?php
echo getFooter();
?>
