<?php session_start(); ?>

<head>
	<meta charset="utf-8">
	<title>Connexion</title>
	<link rel="stylesheet" href="Page_css.css"/>
</head>

<?php
try {
    // On se connecte à MySQL
    $mysqlClient = new PDO('mysql:host=localhost:3306;dbname=esport_2023;charset=utf8', 'root', '');
    $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à MySQL : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer
?>

<body>
	
		<h1>Connexion</h1>
		<div class="formulaire">
		<form method="POST">
			<p>
				<label for="log">Pseudo en jeu</label>
				<input type="text" id="log" name="u_name" required />
			</p>

			<p>
				<label for="mail">Mail</label>
				<input type="email" id="mail" name="u_mail" required />
			</p>

			<p>
				<label for="mdp">Mot de passe</label>
				<input type="password" id="mdp" name="u_mdp" required />
			</p>

			<!-- bouton enregistrer -->
			<p>
				<input type="submit" name="Connection" value="Sign In" />
			</p>

			<!-- Redirection vers mot de passe oublié -->
			<a href="http://localhost/projet_esport/Mdp_oublie.php">Mot de passe oublié</a>
		</form>
		</div>
		<?php
		if (isset($_POST["Connection"])) {
			$name = $_POST["u_name"];
			$mail = $_POST["u_mail"];
			$mdp = $_POST["u_mdp"];

			// Requête préparée avec des paramètres liés
			$QueryConnexion = "SELECT * FROM joueur WHERE log_joueur = :name";
            $rq_connexion = $mysqlClient->prepare($QueryConnexion);
            $rq_connexion->bindParam(':name', $name, PDO::PARAM_STR);
            $rq_connexion->execute();
			$user = $rq_connexion->fetch(PDO::FETCH_ASSOC);
            var_dump($user['mdp_joueur']);
            var_dump(password_hash($user['mdp_joueur'], PASSWORD_DEFAULT));
            var_dump(password_verify($mdp, $user['mdp_joueur']));
			if (password_verify($mdp, $user['mdp_joueur'])) {
				// Authentification réussie
				$_SESSION['id_joueur'] = $user['id_joueur'];
				$_SESSION['id_equipe'] = $user['id_equipe_joueur'];
				// Redirection vers une page sécurisée, par exemple
				header("Location: page_securisee.html");
				exit();
			} else {
				// Identifiants incorrects. Veuillez réessayer
				echo "Identifiants incorrects. Veuillez réessayer.";
			}
		}

		?>
	
	<footer>
<div class="footer-rl">
		© Rocket Laon 2023 - L'eSport Rocket League du lycee Paul Claudel a Laon
		</div>
		<div class="mentions-contacts">
		<a href="mailto:ryanrousseaux02320@gmail.com">Contactez nous</a>
		<a href="mentions-legales">Mentions legales</a>
		</div>
	</footer>
</body>
