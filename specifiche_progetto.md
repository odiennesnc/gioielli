Questa applicazione ha lo scopo di gestire un inventario di gioielli.
Il layout dovrà essere accattivante e semplice e totalmente responvive.
Dovrà utilizzare gli stili e i layout contenuti nella cartella windmill-dashboard.

L'applicazione sarà accessibile tramite form di login con i seguenti campi:
    1. email
    2. password
Gli utenti saranno gestiti tramite database mysql.

Il menù dell'applicazione avrà le seguenti pagine:
    1. Articoli in magazzino
    2. Inserisci nuovo articolo
    3. Articoli venduti
    4. Settings

Una volta effettuato il login si accede alla dashboard dell'applicazione dove viene visualizzata la lista degli ultimi articoli inseriti.
Pagina Articoli in magazzino:
Questa pagina contiene la lista di tutti gli articoli presenti in magazzino. Le azioni disponibili in questa lista sono:
    1. Elimina articolo
    2. Modifica articolo

Le colonne visibili per la tabella degli articoli in magazzino sono:
    Numero
    Data creazione
    Descrizione
    Costo totale
    Valore totale
    Stato
    Modifica
    Elimina

Il tracciato della tabella mysql per gli articoli in magazzino è:

id
data_creazione
descrizione
costo_lavorazione
incassatura
incisione
rodiatura_1
rodiatura_2
brillanti_1
brillanti_2
brillanti_3
brillanti_4
brillanti_5
grammi_oro
costo_lavorazione_finale
incassatura_finale
incisione_finale
rodiatura_1_finale
rodiatura_2_finale
brillanti_1_finale
brillanti_2_finale
brillanti_3_finale
brillanti_4_finale
brillanti_5_finale
grammi_oro_finale
stato

Cliccando sul pulsante elimina articolo si dovrà aprire un alert dove si chiede di confermare o meno la cancellazione
Cliccando sul pulsante modifica si aprirà il form per modificare tutti i campi dell'articolo.
Il layout del form si deve sviluppare su 2 colonne
Nella colonna di sinistra ci saranno i campi
costo_lavorazione
incassatura
incisione
rodiatura_1
rodiatura_2
brillanti_1
brillanti_2
brillanti_3
brillanti_4
brillanti_5
grammi_oro
nella colonna di destra invece
costo_lavorazione_finale
incassatura_finale
incisione_finale
rodiatura_1_finale
rodiatura_2_finale
brillanti_1_finale
brillanti_2_finale
brillanti_3_finale
brillanti_4_finale
brillanti_5_finale
grammi_oro_finale

I campi descrizione, data creazione e stato posso essere inseriti in testa alla pagina

La pagina inserisci articolo sarà uguale alla pagina di modifica ma senza i dati salvati

La pagina articoli venduti sarà uguale alla pagina articoli in magazzino ma filtrata solamente per articoli cha hanno lo stato venduto

La pagina settings conterrà solamente un semplice form con un'unico campo per l'inserimento del prezzo al grammo dell'oro