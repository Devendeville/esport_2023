<?php session_start(); ?>
<?php
try {
// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost:3306;dbname=esport_2023;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) 
{
	die('Erreur de connexion : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-widht,initial-scale=1">
        <title>Mot de passe oublié</title>
    </head>



    <body>
    <h2>Mot de passe oublié</h2>
    <form method="post">
        <div class="container">
            <label for="email"><b>email</b></label>
            <input type="email"placeholder="entrée l'email"name="email"required>
            <button type="submit">Envoyez-moi un mot de passe aléatoire</button>
        </div>
    </form>
    </body>

</html>

<?php

if(isset($_POST["email"]))
{
    $expirationTime = time() + ( 10 * 60); // 10 minute d'expiration
    $expirationTimestamp = date('Y-m-d H:i:s',$expirationTime);
    
    $mdp_length = 10;//Longueur du mot de passe généré
    $mdp_joueur = substr(bin2hex(random_bytes($mdp_length)), 0, $mdp_length);
    echo $mdp_joueur .'';
    $hashMdp_joueur = password_hash($mdp_joueur, PASSWORD_DEFAULT);

    $subject = "Mot de passe oublié";
    $message = "Bonjour, voici vorte nouveau mot de passe: $mdp_joueur";
    $headers = 'Content-Type: text/plain; charset ="UTF-8"';
   
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        if (mail($_POST['email'], $subject, $message, $headers)) 
        {
        $stmt = $db->prepare("UPDATE esport2023 SET password=?,reset_timestamp=? WHERE email =?");
        $stmt->execute([$hashMdp_joueur,$expirationTimestamp,$_POST['email']]);
        echo "E-mail envoyé avce un nouveau mot de passe. Vérifiez votre boîte mail";
        } else {
        echo "Une erreur est survenue lors de l'envoie du mail";
        }
    } else {
        echo "Veuillez entrer une adresse e-mail valide.";
    }
}