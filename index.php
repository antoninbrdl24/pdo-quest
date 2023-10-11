<?php
require_once 'connec.php';

// A exécuter afin d'afficher vos lignes déjà insérées dans la table friends
$pdo = new \PDO(DSN, USER, PASS);
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

/*foreach($friendsArray as $friend) {
    echo $friend['firstname'] . ' ' . $friend['lastname'];
}
*/
$friendsObject = $statement->fetchAll(PDO::FETCH_OBJ);

foreach($friendsObject as $friend) {
    echo $friend->firstname . ' ' . $friend->lastname;
}


// A exécuter afin d'insérer une ligne dans votre table friends
/*$query = "INSERT INTO friend (firstname, lastname) VALUES ('Chandler', 'Bing')";
$statement = $pdo->exec($query); 
*/