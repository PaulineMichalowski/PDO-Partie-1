<?php
// Je crée une variable query dans laquelle je mets ma requête SQL
$query = 'SELECT `title`, `performer`, DATE_FORMAT(`date`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`startTime`, "%Hh%i") AS `startTime` FROM `shows` ORDER BY `title` ';
// On fait un try catch pour être sûr que la connexion à mysql se fasse
try {
    // On instancie un objet PDO. Le host est l'adresse locale sur laquelle on se connecte. dbname correspond au nom de la base de données.
    $db = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'usr_pdopartie1', 'pdopartie1');
} catch (Exception $ex) { // On attrape l'exception, qui est une erreur de PHP
    // Die arrête le script PHP en cas d'erreur et affiche ce qu'on lui met en paramètre
    die('Erreur : ' . $ex->getMessage());
}
// Gràce à ->query($query) on éxécute la requête SQL et on récupère un objet PDO Statement
$customersResult = $db->query($query);
/* fetchAll() va retourner le résultat sous la forme du paramètre demandé
 * PDO::FETCH_OBJ est le paramètre qui permet d'avoir un tableau d'objets. Les clés sont les noms des colonnes de la table
 */
$customersList = $customersResult->fetchAll(PDO::FETCH_OBJ);
// On affecte NULL à l'objet PDO pour pouvoir fermer la connexion à la base de données
$db = NULL;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Exercice 6</title>
    </head>
    <body>
        <h1>Exercice 6</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Spectacle</th>
                    <th>Artiste</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customersList AS $customers) { ?>
                    <tr>
                        <td><?= $customers->title; ?></td>
                        <td><?= $customers->performer; ?></td>
                        <td><?= $customers->date; ?></td>
                        <td><?= $customers->startTime; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
