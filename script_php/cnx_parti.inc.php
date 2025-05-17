<?php

$host = 'localhost'; 
$dbname = 'sae_bdd'; 
$user = 'participant'; 
$password = 'hello'; 

try {
    $cnx = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
}
catch (PDOException $e) {
    echo "ERREUR : La connexion a échouée\n";
    echo "Error: " . $e;

}

?>