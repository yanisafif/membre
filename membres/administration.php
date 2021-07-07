<?php

require 'inclureClasses.php';
require 'model.php';
$manager = new UtilisateursManager(connexionBDD());

if(isset($_GET['modifier'])){
    $utilisateur = $manager->getUtilisateur((int) $_GET['modifier']);
}
if(isset($_POST['nom'])){

    $utilisateur = new Utilisateurs(
            [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'tel' => $_POST['tel'],
                'mel' => $_POST['mel']
            ]
    );

    if(isset($_POST['id'])){
        $utilisateur->setId($_POST['id']);

    }
    if($utilisateur->isUserValide()){

        $manager->mettreAjour($utilisateur);
        echo "Utilisateur bien modifié";
    }else{
        $erreurs = $utilisateur->getErreurs();
    }
}
if(isset($_GET['supprimer'])){
    $manager->supprimer((int) $_GET['supprimer']);
    echo 'Utilisateur bien supprimé';
}
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Administration</title>
        <style type="text/css">
            table, td, th{
                border: 1px solid #000000;
            }
            table{
                margin: auto;
                text-align: center;
                border-collapse: collapse;
            }
            th{
                font-size: 1.5em;
            }
            td, th{
                padding:15px;
            }
        </style>
    </head>
    <body>
        <p><a href="index.php">Accéder à l'accueil du site</a></p>


        <h1>Modification d'un membre</h1>
        <p style="text-align: center">
        <form action="administration.php" method="post">
            <table>
                <?php
                if (isset($erreurs) && in_array(Utilisateurs::NOM_INVALID, $erreurs)) {
                    echo 'Le nom est invalide<br>';
                }
                ?>
                <tr>
                    <td>Nom: </td>
                    <td><input type="text" name="nom" value="<?php if(isset ($utilisateur)) echo $utilisateur->getNom(); ?>"></td>
                </tr>
                <?php
                if (isset($erreurs) && in_array(Utilisateurs::PRENOM_INVALID, $erreurs)) {
                    echo 'Le prenom est invalide<br>';
                }
                ?>
                <tr>
                    <td>Prénom: </td>
                    <td><input type="text" name="prenom" value="<?php if(isset ($utilisateur)) echo $utilisateur->getPrenom(); ?>"></td>
                </tr>
                <tr>
                    <td>Télephone: </td>
                    <td><input type="text" name="tel" value="<?php if(isset ($utilisateur)) echo $utilisateur->getTel(); ?>"></td>
                </tr>
                <?php
                if (isset($erreurs) && in_array(Utilisateurs::MEL_INVALID, $erreurs)) {
                    echo 'Adresse email non valide <br>';
                }
                ?>
                <tr>
                    <td>Email: </td>
                    <td><input type="text" name="mel" value="<?php if(isset ($utilisateur)) echo $utilisateur->getMel(); ?>"></td>
                </tr>
                <?PHP
                if(isset($utilisateur)){
                    ?>
                    <input type="hidden" name="id" value="<?=$utilisateur->getId(); ?>"/>
                <?php } ?>

                <tr>
                    <td><input type="submit" value="Modifier" name="modifier"></td>
                </tr>
            </table>
        </form>
        </p>
        <br>
        <hr>
        <hr>
        <br>
        <table>
            <tr><th>Nom</th> <th>Prénom</th> <th>Téléphone</th> <th>Adresse Email</th><th>Action de modification</th><th>Action de suppression</th></tr>
            <?php
                foreach ($manager->getListeUtilisateurs() as $utilisateur){
                    echo
                    '<tr><td>',
                    $utilisateur->getNom(),
                    '</td><td>',
                    $utilisateur->getPrenom(),
                    '</td><td>',
                    $utilisateur->getTel(),
                    '</td><td>',
                    $utilisateur->getMel(),
                    '</td><td>','
                    <a href="?modifier=',$utilisateur->getId(),'">Modifier</a>',
                    '</td><td>','
                    <a href="?supprimer=',$utilisateur->getId(),'">Supprimer</a>',
                    '</td></tr>';

                }
            ?>
        </table>
    </body>
</html>
