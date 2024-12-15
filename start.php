<?php
// Initialisierungsdatei

// Autoloading von Klassen mittels spl_autoload_register()
spl_autoload_register(callback: function($class) {
    include str_replace(search: "\\", replace: "/", subject: $class) . '.php';
});
session_start(); // PHP-Session starten

// Konstanten für den Zugang zum Backend-Server
define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'aca55b81-250a-4f01-b1be-8d7b96b2ed2e');

$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>