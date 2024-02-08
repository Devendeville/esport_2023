<?php session_start(); ?>

<head>
	<meta charset="utf-8">
	<title>Inscription</title>
	<link rel="stylesheet" href="Page_css.css"/>
</head>

<?php
try {
	// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost:3306;dbname=esport_2023;charset=utf8', 'root', '');
	$mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active les erreurs PDO
} catch (Exception $e) {
	die('Erreur  : ' . $e->getMessage());
}

// Si tout va bien, on peut continuer
?>

<body>
	
		<h1>Inscription</h1>
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

				<p>
					<label for="rang">Rang</label>
					<input type="text" id="rang" name="u_rang" required />
				</p>

				<!-- bouton enregistrer -->
				<p>
					<input type="submit" name="Login" value="Sign Up" />
				</p>
			</form>
		</div>
		<?php
		if (isset($_POST["Login"])) {
			$name = $_POST["u_name"];
			$mail = $_POST["u_mail"];
			$mdp = password_hash($_POST["u_mdp"], PASSWORD_DEFAULT); // Hachage du mot de passe
			$rang = $_POST["u_rang"];

			// Requête préparée pour éviter les injections SQL
			$QuerySignUp = "INSERT INTO joueur(log_joueur, mdp_joueur, email_joueur, Rang_id_rang) VALUES (?, ?, ?, ?)";
			$RecupLog = $mysqlClient->prepare($QuerySignUp);
			$RecupLog->execute([$name, $mdp, $mail, $rang]);
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
