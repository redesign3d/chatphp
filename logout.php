<?php
// Laden von start.php
require("start.php");

/* Methode enntfernt alle gespeicherten Variablen aus der aktuellen Session, 
aber die Session selbst bleibt aktiv -> von Vorteil für erneute Anmeldung */
session_unset();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Logout</title>
</head>

<body>
    <main>
        <!-- Bild -->
        <img src="images/logout.png" width="85" height="85"> <!-- in pixel -->
        <br>
        <!-- Überschrift -->
        <h1>Logged out...</h1>
        <p>See u!</p>
        <a href="login.html">Login again</a>
    </main>
</body>
</html>