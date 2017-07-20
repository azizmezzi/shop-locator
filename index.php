<!DOCTYPE html>
<html>
<head>
    <title>Les formulaires</title>
    <meta charset="utf-8">
    <style>label{display: inline-block;min-width: 200px;}</style>
</head>

<body>
<h1>Les formulaires HTML</h1>
<form method="post" action="traitement.php">
    <label for='prenom'>Entrez votre prénom svp : </label>
    <input type='text' name='prenom' id='prenom' maxlength='20' required>
    <span id='missPrenom'></span><br>

    <label for='mail'>Entrez votre mail : </label>
    <input type='email' name='mail' id='mail' required><br>
    <label for='tel'>Numéro de téléphone :</label>
    <input type='tel' name='tel' id='tel' required><br>
    <input type='submit' value='Valider' id='bouton_envoi'>
</form>

<script>
    var formValid = document.getElementById('bouton_envoi');
    var prenom = document.getElementById('prenom');
    var missPrenom = document.getElementById('missPrenom');
    var prenomValid = /^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([-'\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/;

    formValid.addEventListener('click', validation);

    function validation(event){
        //Si le champ est vide
        if (prenom.validity.valueMissing){
            event.preventDefault();
            missPrenom.textContent = 'Prénom manquant';
            missPrenom.style.color = 'red';
            //Si le format de données est incorrect
        }else if (prenomValid.test(prenom.value) == false){
            event.preventDefault();
            missPrenom.textContent = 'Format incorrect';
            missPrenom.style.color = 'orange';
        }else{
        }
    }
</script>

<?php

$num = 5;
$word = 'banana';
$format = 'can you say %d times the word %s';
$n= sprintf($format, $num, $word);
echo $n;
?>

</body>
</html>
