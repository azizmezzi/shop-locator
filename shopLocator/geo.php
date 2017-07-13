<?php


    $query = "SELECT attitude, longititude FROM shop";
    $statement1 = $bdd->prepare($query);
    $statement1->execute();

    $donne = $statement1->fetchAll();



?>