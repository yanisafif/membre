<?php

require 'inclureClasses.php';
require 'model.php';


$manager = new UtilisateursManager(connexionBDD());
if(isset($_POST['nom'])){
    $utilisateur = new Utilisateurs(['nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'tel' => $_POST['tel'],
        'mel' => $_POST['mel']]);
    if($utilisateur->isUserValide()){
        $manager->inserer($utilisateur);
        echo 'Utilisateur enregistré';
    }else{
        $erreurs = $utilisateur->getErreurs();
    }
}

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Inscription utilisateur</title>
    </head>
    <body>
        <h1>Inscription d'un membre</h1>
        <p><a href="index.php">Accéder à l'accueil du site</a></p>
        <p style="text-align: center">
        <form action="inscription.php" method="post">
            <table>
                <?php
                if (isset($erreurs) && in_array(Utilisateurs::NOM_INVALID, $erreurs)) {
                    echo 'Le nom est invalide<br>';
                }
                ?>
                <tr>
                    <td>Nom: </td>
                    <td><input type="text" name="nom"></td>
                </tr>
                <?php
                if (isset($erreurs) && in_array(Utilisateurs::PRENOM_INVALID, $erreurs)) {
                    echo 'Le prenom est invalide<br>';
                }
                ?>
                <tr>
                    <td>Prénom: </td>
                    <td><input type="text" name="prenom"></td>
                </tr>
                <tr>
                    <td>Télephone: </td>
                    <td><input type="text" name="tel"></td>
                </tr>
                <?php
                if (isset($erreurs) && in_array(Utilisateurs::MEL_INVALID, $erreurs)) {
                    echo 'Adresse email non valide <br>';
                }
                ?>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="mel"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Enregistrer" name="enregistrer"></td>
                </tr>
            </table>
        </form>
        </p>
    </body>
</html>