<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Admin_Utilisateur.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        session_start();
        include ("script_php/cnx_admin.inc.php");
        if ($_SESSION["id"]>2) {
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
                <a href="profil.php" >
                    <img src="image/icon Compte blanc.png" alt="" class="logo-icon">
                    <?php
                        if (isset($_SESSION['prenom'])){
                            echo $_SESSION['prenom'];
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
                    Gestion des utilisateurs
                </h1>
            </div>

            <div class="cases-principales">
                
                <div class="case-conférencier">
                    <h2 class="titre_conf">Conférencier</h2>
                    <?php
                        $result = $cnx -> query("SELECT * FROM vdeux.participant WHERE titre_conf='true'");
                        while ($ligne = $result->fetch(PDO::FETCH_OBJ)) {
                            echo "<form action='script_php/supp_compte.php' method='POST' class='personne'><p>$ligne->nom $ligne->prenom</p>";
                            echo "<div class='actions'><div class='supprime'>";
                            echo "<input type='submit' value='$ligne->num_parti' name='supp' id='supp$ligne->num_parti' hidden>";
                            echo "<label for='supp$ligne->num_parti'>Supprimer</label></div></div></form>";
                        }
                    ?>
                </div>

                <div class="case-participant">
                    <h2 class="titre_conf">Participant</h2>
                    <?php
                        $result = $cnx -> query("SELECT * FROM vdeux.participant WHERE titre_conf!='true' AND num_parti>2");
                        while ($ligne = $result->fetch(PDO::FETCH_OBJ)) {
                            echo "<form action='script_php/supp_compte.php' method='POST' class='personne'><p>$ligne->nom $ligne->prenom</p>";
                            echo "<div class='actions'><div class='supprime'>";
                            echo "<input type='submit' value='$ligne->num_parti' name='supp' id='supp$ligne->num_parti' hidden>";
                            echo "<label for='supp$ligne->num_parti'>Supprimer</label></div></div></form>";
                        }
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>
</html>