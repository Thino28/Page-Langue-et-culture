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
        session_start();
        if ($_SESSION["id"]>2 || (!isset($_SESSION['prenom'])) || ($_SESSION['prenom']=="Invité")) {
            header('location:index.html');
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
                <div class="profil-déroulant">
                    <a href="profil.php" class="profil-button">
                        <img src="image/icon Compte blanc.png" alt="" class="logo-icon">
                        <?php
                            if (isset($_SESSION['prenom'])){
                                echo $_SESSION['prenom'];
                            } else {
                                echo "Profil";
                            }
                        ?>
                    </a>
                    <div class="profil-menu">
                        <a href="profil.php">Profil</a>
                        <a href="script_php/deconnexion.php">Se déconnecter</a>
                    </div>
                </div>
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