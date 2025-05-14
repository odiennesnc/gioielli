# Gestione Inventario Gioielli

Applicazione PHP per la gestione di un inventario di gioielli con interfaccia responsive basata su Windmill Dashboard.

## Requisiti

- PHP 7.4 o superiore
- MySQL 5.7 o superiore
- Server web (Apache, Nginx, ecc.)

## Installazione

1. Clonare o scaricare i file dell'applicazione nella cartella del server web
2. Creare un database MySQL vuoto per l'applicazione
3. Modificare il file `config.php` con i parametri di connessione al database:
   ```php
   $host = 'localhost';     // Server MySQL
   $db = 'gioielli_db';     // Nome del database
   $user = 'root';          // Username MySQL
   $password = '';          // Password MySQL
   ```
4. Eseguire lo script di installazione visitando `http://your-server/percorso/install.php`
5. Dopo l'installazione, accedere all'applicazione con le credenziali predefinite:
   - Email: admin@example.com
   - Password: admin

## Funzionalità

L'applicazione offre le seguenti funzionalità:

1. **Autenticazione utenti**
   - Login con email e password
   - Sessione sicura

2. **Dashboard**
   - Visualizzazione degli ultimi articoli inseriti
   - Statistiche riassuntive

3. **Gestione articoli in magazzino**
   - Lista articoli con filtri e ordinamento
   - Dettagli completi degli articoli
   - Calcolo automatico di costi e valori

4. **Inserimento e modifica articoli**
   - Form completo di inserimento
   - Modifica articoli esistenti
   - Gestione dei costi di lavorazione

5. **Gestione articoli venduti**
   - Tracciamento degli articoli venduti
   - Storico vendite

6. **Impostazioni**
   - Configurazione del prezzo dell'oro

## Struttura del database

L'applicazione utilizza le seguenti tabelle:

1. **utenti**: Gestione degli utenti con accesso all'applicativo
2. **articoli**: Archivio completo degli articoli con tutti i dettagli
3. **settings**: Impostazioni dell'applicativo (prezzo oro, ecc.)

## Sicurezza

- Password criptate con algoritmo sicuro (PHP password_hash)
- Protezione da SQL injection tramite PDO prepared statements
- Validazione input utente
- Protezione delle pagine con controllo di autenticazione

## Personalizzazione

L'interfaccia è basata sulla dashboard Windmill, che include supporto per:
- Tema chiaro e scuro
- Layout responsive
- Componenti UI moderni
- Completamente accessibile

## Crediti

- Windmill Dashboard: [https://windmillui.com/dashboard-html](https://windmillui.com/dashboard-html)