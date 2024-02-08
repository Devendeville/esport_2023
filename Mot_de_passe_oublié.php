<?php session_start(); ?>
<!DOCTYPE html>
<html>
<?php
try {
// On se connecte à MySQL
	$db = new PDO('mysql:host=localhost;dbname=esport_2023;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) 
{
	die('Erreur de connexion : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer

// Déclaration des variables
$email = "";
$error = "";

// Si le formulaire est soumis
if (isset($_POST['email'])) 
{
    $email = $_POST['email'];

     // Vérification de la validité de l'email
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) 
        {
            $mdp_length = 10;//Longueur du mot de passe généré
            $mdp_joueur = substr(bin2hex(random_bytes($mdp_length)), 0, $mdp_length);
            $hashMdp_joueur = password_hash($mdp_joueur, PASSWORD_DEFAULT);

            $expirationTime = time() + ( 10 * 60); // 10 minute d'expiration
            $expirationTimestamp = date('Y-m-d H:i:s',$expirationTime);
            
            $stmt = $db->prepare("UPDATE utilisateurs SET password = ?, reset_timestamp = ? WHERE email = ?");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashMdp_joueur);
            $stmt->bindParam(':reset_timestamp', $expirationTimestamp);
            $stmt->execute();

            $subject = "Récupération de mot de passe";
            $message = "Voici votre nouveau mot de passe: " . $mdp_joueur;
            $headers = "From: noreply@example.com";

            if (mail($email, $subject, $message, $headers))
            {
                echo "E-mail envoyé avec un nouveau mot de passe. Vérifiez votre boîte mail";
            } else {
                echo "Une erreur est survenue lors de l'envoie du mail";
            }
        }else{
            echo "Aucun utilisateur trouvé avec cette adresse e-mail.";
        }
    } else {
        echo "Veuillez entrer une adresse e-mail valide.";
    }
}

?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-widht, initial-scale=1">
        <title>Mot de passe oublié</title>
    </head>

    <body>
    <h2>Mot de passe oublié</h2>
    <form method="post">
        <div class="container">
            <label for = "email"> <b>email</b> </label>
            <input type = "email" placeholder = "entrée l'email" name = "email"placeholder ="E-mail" required>
            <button type="submit">Envoyez-moi un mot de passe aléatoire</button>
        </div>
    </form>
    </body>

</html>