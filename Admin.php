<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        include("script_php/test_cookie.php");
        if ($_COOKIE["id"]>2) {
            header('location:choix.html');
            exit();
        }
    ?>
    <header>
        <div class="logo">
            <img src="image/Foreign Language Course.png" alt="Logo" class="logo-image">
        </div>

        <div class="sous-menu">
            <nav>
                <a href="Admin.php">
                    <img src="image/Vector.png" alt="home" class="logo-icon">
                    Accueil
                </a>
                <a href="Admin_Conference.php" >
                    <img src="image/Icon_conférence.png" alt="icon_conference" class="logo-icon">
                    Gestion  conférence
                </a>
                <a href="Admin_Utilisateur.php" >
                    <img src="image/Icon_utilisateur.png" alt="icon_utilisateur" class="logo-icon">
                    Gestion utilisateur
                </a>
                <a href="#profil" >
                    <img src="image/icon Compte blanc.png" alt="" class="logo-icon">
                    <?php
                        if (isset($_COOKIE['prenom'])){
                            echo $_COOKIE['prenom'];
                        } else {
                            echo "Profil";
                        }
                    ?>
                </a>
            </nav>
        </div>

    </header>

    <div class="transition-band"></div>

    <main>
        <section>
            <div class="titre">
                <h1>
                    Gestion du site
                </h1>
            </div>

            <div class="Bouton_admin">
                <a href="Admin_Conference.php" class="case-bouton-1">
                    <h2>Gestion des <br> conférences</h2>
                    <img src="image/Icon_conférence.png" alt="icon_conference" class="icon">
                </a>
                <a href="Admin_Utilisateur.php" class="case-bouton 2">
                    <h2>Gestion des <br> utilisateurs</h2>
                    <img src="image/Icon_utilisateur.png" alt="icon_utilisateur" class="icon">
                </a>
            </div>
        </section>
    </main>
</body>
</html>