// File: assets/js/articoli.js

/**
 * Funzioni per la gestione degli articoli nell'applicazione di gestione gioielli
 */

// Variabile globale per il prezzo dell'oro
let prezzoOro = 0;

/**
 * Inizializza la pagina e i listener degli eventi
 */
function initArticoliPage() {
    // Ottieni il prezzo dell'oro dalla pagina
    const prezzoOroElement = document.getElementById('prezzo-oro');
    if (prezzoOroElement) {
        prezzoOro = parseFloat(prezzoOroElement.value) || 0;
    }

    // Aggiungi gli event listener ai campi di input
    aggiungiListenerCampi('costo_lavorazione', 'costo-totale');
    aggiungiListenerCampi('incassatura', 'costo-totale');
    aggiungiListenerCampi('incisione', 'costo-totale');
    aggiungiListenerCampi('rodiatura_1', 'costo-totale');
    aggiungiListenerCampi('rodiatura_2', 'costo-totale');
    aggiungiListenerCampi('brillanti_1', 'costo-totale');
    aggiungiListenerCampi('brillanti_2', 'costo-totale');
    aggiungiListenerCampi('brillanti_3', 'costo-totale');
    aggiungiListenerCampi('brillanti_4', 'costo-totale');
    aggiungiListenerCampi('brillanti_5', 'costo-totale');
    aggiungiListenerCampi('grammi_oro', 'costo-totale');

    aggiungiListenerCampi('costo_lavorazione_finale', 'valore-totale');
    aggiungiListenerCampi('incassatura_finale', 'valore-totale');
    aggiungiListenerCampi('incisione_finale', 'valore-totale');
    aggiungiListenerCampi('rodiatura_1_finale', 'valore-totale');
    aggiungiListenerCampi('rodiatura_2_finale', 'valore-totale');
    aggiungiListenerCampi('brillanti_1_finale', 'valore-totale');
    aggiungiListenerCampi('brillanti_2_finale', 'valore-totale');
    aggiungiListenerCampi('brillanti_3_finale', 'valore-totale');
    aggiungiListenerCampi('brillanti_4_finale', 'valore-totale');
    aggiungiListenerCampi('brillanti_5_finale', 'valore-totale');
    aggiungiListenerCampi('grammi_oro_finale', 'valore-totale');

    // Calcola i totali iniziali
    calcolaCostoTotale();
    calcolaValoreTotale();

    // Aggiungi il listener per il bottone di copia valori
    const btnCopiaCosti = document.getElementById('copia-costi');
    if (btnCopiaCosti) {
        btnCopiaCosti.addEventListener('click', copiaCostiInizialiFinal);
    }
}

/**
 * Aggiunge un event listener ad un campo per calcolare i totali
 */
function aggiungiListenerCampi(idCampo, idTotale) {
    const campo = document.getElementsByName(idCampo)[0];
    if (campo) {
        campo.addEventListener('input', function() {
            if (idTotale === 'costo-totale') {
                calcolaCostoTotale();
            } else {
                calcolaValoreTotale();
            }
        });
    }
}

/**
 * Calcola il costo totale dell'articolo
 */
function calcolaCostoTotale() {
    let costoTotale = 0;
    costoTotale += getInputValue('costo_lavorazione');
    costoTotale += getInputValue('incassatura');
    costoTotale += getInputValue('incisione');
    costoTotale += getInputValue('rodiatura_1');
    costoTotale += getInputValue('rodiatura_2');
    costoTotale += getInputValue('brillanti_1');
    costoTotale += getInputValue('brillanti_2');
    costoTotale += getInputValue('brillanti_3');
    costoTotale += getInputValue('brillanti_4');
    costoTotale += getInputValue('brillanti_5');
    
    // Aggiungi il valore dell'oro (grammi_oro * prezzo_oro)
    const grammiOro = getInputValue('grammi_oro');
    costoTotale += grammiOro * prezzoOro;
    
    // Aggiorna il valore visualizzato
    const costoTotaleElement = document.getElementById('costo-totale');
    if (costoTotaleElement) {
        costoTotaleElement.textContent = formattaPrezzo(costoTotale);
    }
}

/**
 * Calcola il valore totale dell'articolo
 */
function calcolaValoreTotale() {
    let valoreTotale = 0;
    valoreTotale += getInputValue('costo_lavorazione_finale');
    valoreTotale += getInputValue('incassatura_finale');
    valoreTotale += getInputValue('incisione_finale');
    valoreTotale += getInputValue('rodiatura_1_finale');
    valoreTotale += getInputValue('rodiatura_2_finale');
    valoreTotale += getInputValue('brillanti_1_finale');
    valoreTotale += getInputValue('brillanti_2_finale');
    valoreTotale += getInputValue('brillanti_3_finale');
    valoreTotale += getInputValue('brillanti_4_finale');
    valoreTotale += getInputValue('brillanti_5_finale');
    
    // Aggiungi il valore dell'oro (grammi_oro_finale * prezzo_oro)
    const grammiOroFinale = getInputValue('grammi_oro_finale');
    valoreTotale += grammiOroFinale * prezzoOro;
    
    // Aggiorna il valore visualizzato
    const valoreTotaleElement = document.getElementById('valore-totale');
    if (valoreTotaleElement) {
        valoreTotaleElement.textContent = formattaPrezzo(valoreTotale);
    }
}

/**
 * Ottiene il valore numerico da un input
 */
function getInputValue(name) {
    const input = document.getElementsByName(name)[0];
    if (input) {
        return parseFloat(input.value) || 0;
    }
    return 0;
}

/**
 * Formatta un numero come prezzo in Euro
 */
function formattaPrezzo(valore) {
    return '€ ' + valore.toFixed(2).replace('.', ',');
}

/**
 * Copia i valori dei costi iniziali nei campi dei costi finali
 */
function copiaCostiInizialiFinal() {
    document.getElementsByName('costo_lavorazione_finale')[0].value = document.getElementsByName('costo_lavorazione')[0].value;
    document.getElementsByName('incassatura_finale')[0].value = document.getElementsByName('incassatura')[0].value;
    document.getElementsByName('incisione_finale')[0].value = document.getElementsByName('incisione')[0].value;
    document.getElementsByName('rodiatura_1_finale')[0].value = document.getElementsByName('rodiatura_1')[0].value;
    document.getElementsByName('rodiatura_2_finale')[0].value = document.getElementsByName('rodiatura_2')[0].value;
    document.getElementsByName('brillanti_1_finale')[0].value = document.getElementsByName('brillanti_1')[0].value;
    document.getElementsByName('brillanti_2_finale')[0].value = document.getElementsByName('brillanti_2')[0].value;
    document.getElementsByName('brillanti_3_finale')[0].value = document.getElementsByName('brillanti_3')[0].value;
    document.getElementsByName('brillanti_4_finale')[0].value = document.getElementsByName('brillanti_4')[0].value;
    document.getElementsByName('brillanti_5_finale')[0].value = document.getElementsByName('brillanti_5')[0].value;
    document.getElementsByName('grammi_oro_finale')[0].value = document.getElementsByName('grammi_oro')[0].value;
    
    // Ricalcola il valore totale
    calcolaValoreTotale();
}

// Esegui l'inizializzazione quando il documento è pronto
document.addEventListener('DOMContentLoaded', initArticoliPage);
