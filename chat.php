<?php
// Laden von start.php
require("start.php");

/* Überprüfen, ob der Nutzer bereits angemeldet ist durch
Prüfung, ob Session-Variable user bereits existiert */
if (empty($_SESSION['user'])) {
    header("Location: login.php"); // wenn ja -> Weiterleitung zur Login-Seite
    exit();
}

// Überprüfen ob Query-Parameter für das Chat-Ziel existiert und nicht leer ist
if (!empty($_GET['friend'])) {
    $chatPartner = $_GET['friend'];
} else {
    // Kein Chat-Ziel übergeben -> Zurück zur Freundesliste
    header("Location: friends.php");
    exit();
}

// Weiterverarbeitung mit dem Chatpartner
echo "Chat mit: " . htmlspecialchars($chatPartner);

/* Analog zum 3. Aufgabenblatt sollte die Chat-Ansicht periodisch mit JavaScript aktualisiert
werden. Statt direkter Backend-Aufrufe sollen die beiden vorgegebenen PHP-Skripte
ajax
send
message.php und ajax
load
messages.php?to=&lt;chatpartner&gt; genutzt werden. Passen Sie Ihren JavaScript-Code aus Aufgabenblatt 3 entsprechend an.
Verlinken Sie die Funktion zum Löschen des Freundes korrekt mit der Freundesliste, stimmen
Sie sich hierfür über die Benennung der Query-Parameter entsprechend ab. */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">

    <!-- defer, damit das script erst ausgeführt wird, wenn die Seite geladen und geparst wurde -->

    <script src="js/main.js" defer></script>
    <script src="js/chat.js" defer></script>
    <script src="js/jwt_decoder.js" defer></script> 
    
    <title>Chat</title>
</head>
<body>
    <main>
        <h1 id="chatHeader">Chat with Tom</h1>
        <div>
            <!-- Link zur Freundesliste -->
            <a href="friends.html">&lt; Back</a> |
            <!-- placeholder, da Nutzerprofilansicht Aufgabe der nicht vorhandenen Person 3 ist.-->
            <!-- <a href="#profile">Profile</a> |  -->
            <!-- Link zur Freundesliste -->
            <a class="important" href="friends.html">Remove Friend</a>
        </div>
        <!-- "Chatverlauf" -->
        <div class="chat" id="chat"></div>
            <!-- Eingabefeld/Formular für neue Nachrichten -->
            <form action="#" method="post" class="textbox">
                <div class="textbox-content">
                    <input type="text" name="newMessage" placeholder="New Message" id="messageInput" required>
                    <input type="button" class="submit-btn" value="Send">
                </div>
            </form>
        </div>

    </main>
    
</body>
</html>