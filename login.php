<?php

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Laden von start.php/BackendService.php
require("start.php");
use Utils\BackendService;

// BackendService initialisieren
$baseUrl = "https://example.com/api"; // Ersetze mit der Basis-URL des Backends
$collectionId = "123456"; // Ersetze mit der tatsächlichen Collection-ID
// $service = new BackendService($baseUrl, $collectionId);

$error = "";

/* Überprüfen, ob der Nutzer bereits angemeldet ist durch
Prüfung, ob Session-Variable user bereits existiert */
if (isset($_SESSION['user'])) {
    header("Location: friends.php"); // wenn ja -> Weiterleitung zur Freundesliste
    exit();
}

// Verarbeitung der Formularfelder nur, wenn das Formular auch abgesendet wurde, also POST-Daten vorhanden sind
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formulareingaben auslesen
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Überprüfen, ob alle Felder ausgefüllt sind
    if (empty($username) || empty($password)) {
        $error = "Please fill in all required fields!";
    } else {
        // Login-Methode im BackendService aufrufen
        if ($service->login($username, $password)) {
            // wenn = true, dann... 
            $_SESSION['user'] = $username; // Nutzername in Session-Variable user speichern
            header("Location: friends.php"); // Nutzer weiterleiten an die Freundesliste
            exit();
        } else {
            $error = "Invalid username/password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- charset-Tag = stellt sicher, dass Sonderzeichen/Umlaute 
     im Deutschen richtig angezeigt werden -->
    <meta charset="UTF-8">
    <!-- viewport-Tag = stellt sicher, dass die Seite auch 
     auf verschiedenen Bildschirmen (wie z.B. Smartphone, Tablet, Laptop, etc.), 
     richtig angezeigt wird -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Titel = Titel, der im Browser-Tab angezeigt wird -->
    <title>Login</title>
</head>

<body>
    <main>
        <img src="images/chat.png" width="85" height="85"> <!-- relativ verlinkt, in pixel -->
        <br>
        <h1>Please sign in</h1>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Aktionsziel für das Formular = login.php (action = legt Seite fest, die bei Sumbit aufgerufen wird -->
        <form action="login.php" method="post" class="user-handling"> 
            <fieldset>
                <legend>Login</legend>
                <!-- Nutzername -->
                <div class="formField">
                    <!-- Label = Text vor dem Eingabefeld; for-Attribut = Label wird dem
                    entsprechenden Eingabefeld zugeordnet -->
                    <label for="usernameField">Username</label>
                    <!-- input type="text" = einzeiliges Texteingabefeld; id = Referenz zu Label; name = Schlüssel bei Datenübertragung;
                    required = Formular kann erst gesendet werden, wenn das Feld ausgefüllt ist -->
                    <input type="text" id="usernameField" name="username" placeholder="Username" required>
                </div>
                <!-- Passwort -->
                <div class="formField">
                    <label for="passwordField">Password</label>
                    <input type="password" id="passwordField" name="password" placeholder="Password" required>
                </div>
            </fieldset>
            <div class="btn-wrapper">
                <a href="register.html"><input type="button" value="Register"></a>
                <!-- Button der das Formular absendet -->
                <input type="submit" value="Login">
            </div>
        </form>
    </main>
</body>
</html>