<?php
// Laden von start.php
require("start.php");

/* Überprüfen, ob der Nutzer bereits angemeldet ist durch
Prüfung, ob Session-Variable user bereits existiert */
if (empty($_SESSION['user'])) {
    header("Location: login.php"); // wenn ja -> Weiterleitung zur Login-Seite
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    
    <script src="js/main.js" defer></script>
    <script src="js/friends.js" defer></script>
    
    <script src="js/jwt_decoder.js" defer></script>
    <title>Friends</title>
</head>

<body>
    <main>
        <!-- Überschrift -->
        <h1>Friends</h1>
        <!-- Link zur Logout Ansicht -->
        <a href="logout.html">&lt; Logout</a>
        <hr>
        <!-- Ungeordenete Liste mit aktuellen Freunden -->
        <ul>
            <li><a href="chat.html" data-count="3">Tom</a></li>
            <li><a href="chat.html" data-count="1">Marvin</a></li>
            <li><a href="chat.html">Tick</a></li>
            <li><a href="chat.html">Trick</a></li>
        </ul>
        <hr>
        <!-- Geordnete Liste mit Freundschaftsanfragen -->
        <h2>New Requests</h2>

        <div class="friend-request-list"></div> <!-- nicht gebraucht? -->

        <ol class="ol-friend-requests">
            <li class="li-friend-request">
                Friend request from <b>Track</b>
                <div class="btn-wrapper">
                    <input type="button" value="Accept" onclick="acceptRequest()">
                    <input type="button" value="Reject" onclick="rejectRequest()">
                </div>
            </li>
        </ol>
        <hr>
        <!-- Formular, mit dem neue Freunde hinzugefügt werden können -->
        <form action="" method="GET" class="textbox">
            <div class="textbox-content">
                <!--<input type="text" id="addFriendsField" name="addFriend" placeholder="Add Friend to List" required>
                <input type="button" class="submit-btn" value="Add"> -->
                <input type="text" placeholder="Add Friend to List" name="addfriend" id="friend-request-name" list="friend-selector">
                <datalist id="friend-selector">
                    <!-- Dynamische Vorschläge für Freundesnamen können hier hinzugefügt werden -->
                </datalist>
                <input type="button" id="add-friend-button" class="submit-btn" value="Add"> <!-- id new-->
            </div>
        </form>
    </main>
</body>
</html>
