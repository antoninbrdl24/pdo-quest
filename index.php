<?php
require_once 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $data= array_map('trim',$_POST);
    $data= array_map('htmlentities',$data);
    if(empty($data['firstname'])){
        $errors[] = "Le champ prénom est obligatoire";
    }
    if(empty($data['lastname'])){
        $errors[] = "Le champ nom est obligatoire";
    }
    if (empty($errors)) {
        $query = 'INSERT INTO friend (firstname,lastname) VALUES (:firstname, :lastname)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':lastname', $data['lastname'],  PDO::PARAM_STR);
        $statement->execute();
        header('Location: /');
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <h2>Ajoutez vos amis à cette liste</h2>
        <form action="" method="post">
            <article>
                <input  type="text"  id="firstname"  name="firstname" spaceholder="Prénom" required>
                <input  type="text"  id="lastname"  name="lastname" spaceholder="Nom" required>
                <button>Submit</button>
            </article>  
        </form>
    </main>
</body>
</html>
<?php
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();
?>
<h2>Liste d'amis</h2>
<ul>
    <?php foreach($friends as $friend):?>
     <li><?=$friend['firstname']." ". $friend['lastname'] . '<br/>'; ?> </li>
    <?php endforeach ?>
</ul>
