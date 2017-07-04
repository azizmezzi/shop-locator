<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mini-chat</title>
</head>
<style>
    form
    {
        text-align:center;
    }
</style>
<body>

<form action="chat_recu.php" method="post">
    <p>
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />
        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />

        <input type="submit" value="Envoyer" />
    </p>
</form>

<?php
// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'root', 'root');
    $reponse = $bdd->query('SELECT pseudo, message FROM chat ORDER BY id DESC LIMIT 0, 10');

}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

// Récupération des 10 derniers messages

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
    echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();

?>
</body>
</html>