<?php 

session_start();

$_SESSION['pseudo'] = 'Jean';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
    </head>
    <style>
    form
    {
       
    }
    </style>
    <body>
    
    <!--
    <p>
        Salut <?php echo $_SESSION['pseudo']; ?> !<br />
    </p>
    -->

    <form action="minichat_post.php" method="post">
        <p><label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo" value="" required /></p>
        <p><label for="message">Message</label> :  <input type="text" name="message" id="message" required/></p>

        <input type="submit" value="Envoyer" />
    </p>
    </form>

       
    <?php
    // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
    ?>



	 <script>
    	var pseudoElt = document.getElementById("pseudo");
    	pseudoElt.value = "valeur"; 

    </script>


    <?php
    // Récupération des 10 derniers messages
    $reponse = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

    // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
    while ($donnees = $reponse->fetch())
    {
        echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';

    }

    


    $reponse->closeCursor();

    ?>
    </body>
</html>