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
		<div class="connexion">
		<form method="POST">
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
			if (password_verify($mdp, $user['mdp_joueur'])) {
				// Authentification réussie
				$_SESSION['id_joueur'] = $user['id_joueur'];
				$_SESSION['id_equipe'] = $user['id_equipe_joueur'];
				// Redirection vers une page inscription, par exemple
				header("Location: Inscription2.php");
				exit();
			} else {
				// Identifiants incorrects. Veuillez réessayer
				echo "Identifiants incorrects. Veuillez réessayer.";
			}
		}

		?>
			<p>
				<label for="log">Pseudo en jeu</label>
				<input type="text" id="log" name="u_name" placeholder = "Pseudo en jeu" required />
			</p>

			<p>
				<label for="mail">E-mail</label>
				<input type="email" id="mail" name="u_mail" placeholder = "E-mail"required />
			</p>

			<p>
				<label for="mdp">Mot de passe</label>
				<input type="password" id="mdp" name="u_mdp" placeholder = "Mot de passe"required />
				<img src="red_eye.png" id="eye" onclick="changer()" width="20" height="20">
			</p>

			<!-- bouton enregistrer -->
			<p>
				<input type="submit" name="Connection" value="Sign In" />
			</p>

			<!-- Redirection vers mot de passe oublié -->
			<a href="http://localhost/esport_2023/Mot_de_passe_oublié.php">Mot de passe oublié</a>
		</form>
		</div>
		<script>
            //L'oeil masqué
            e=true;
            function changer()
            {
                if(e)
                {
                    document.getElementById("mdp").setAttribute("type","text");
                    document.getElementById("eye").src="green_eye.png";
                    e=false;
                }
                else
                {
                    document.getElementById("mdp").setAttribute("type","password");
                    document.getElementById("eye").src="red_eye.png";
                    e=true;
                }
            }
        </script>
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
