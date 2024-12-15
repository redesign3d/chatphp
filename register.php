<?php
/* Die in Aufgabe 3 realisierte Überprüfung des Benutzernamens (der Name darf noch nicht
existieren) muss nun angepasst werden, da der Browser keine direkten Backend-Aufrufe mehr
durchführen soll. Stattdessen wird der eingegebene Benutzername an das vorgegebene PHP-
Skript ajax
check
user.php als Query-Parameter eines AJAX-GET-Calls gesendet. Das Skript ruft den BackendService 
entsprechend auf und gibt das Ergebnis als HTTP Status Code zurück (siehe PHP-Skript).
Passen Sie Ihren JavaScript-Code so an, dass das oben beschriebene PHP-Sript aufgerufen wird. */

// Laden von start.php
require("start.php");

// -> Prüfung in JS reicht nicht, da diese auf der Seite des Clients umgangen werden könnte
// Prüfen, dass:
if (!empty($username) && !empty($password) && !empty($passwordRepeat)) { // die Felder nicht leer ist
    if (strlen($username) < 3) { // der Nutzername min. 3 Zeichen hat
        $error = "Username has to be at least 3 characters long!";
    } else if (strlen($password) < 8) { //  das Passwort min. 8 Zeichen hat
        $error = "Password has to be at least 8 characters long!"; 
    } else if ($password !== $passwordRepeat) { // das Passwort mit der Wiederholung übereinstimmt
        $error = "Passwords do not match!";
    } else if ($service->userExists($username)) { // Prüfen, dass der Nutzername nicht vergeben ist (siehe BackendService)
        $error = "Username is already taken!"; 
    } else {
        // Alle Bedingungen erfüllt, Registrierung versuchen
        if ($service->register($username, $password)) {
            $_SESSION['user'] = $username; // Nutzername in Session-Variable user speichern
            header("Location: friends.php"); // Nutzer weiterleiten an die Freundesliste
            exit();
        } else {
            $error = "Registration failed!";
        }
    }
} else {
    $error = "Please fill in all the fields!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registrieren</title>
</head>
<body>
   <main>
       
        <!-- Bild -->
        <img src="images/user.png" width="85" height="85">
        <br>
        <!-- Überschrift -->
        <h1>Register yourself</h1>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Aktionsziel für das Formular = register.php (action = legt Seite fest, die bei Sumbit aufgerufen wird -->
        <form action="register.php" method="post" class="user-handling">
            <fieldset>
                <legend>Register</legend>
                <!-- Nutzername -->
                <div class="formField">
                    <label for="usernameField">Username</label>
                    <input type="text" id="usernameField" name="username" placeholder="Username" required>
                </div>
                <!-- Passwort -->
                <div class="formField">
                    <label for="passwordField">Password</label>
                    <input type="password" id="passwordField" name="password" placeholder="Password" required>
                </div>
                <!-- Passwort wiederholen -->
                <div class="formField">
                    <label for="passwordField">Confirm Password</label>
                    <input type="password" id="passwordField" name="password" placeholder="Confirm Password" required>
                </div>
            </fieldset>
            <!-- Button der zum Login weiterleitet -->
            <a href="login.html"><input type="button" value="Cancel"></a>
       
            <!-- Button der das Formular absendet -->
            <input type="submit" value="Create Account">
        </form>
   </main>


</body>
</html>
