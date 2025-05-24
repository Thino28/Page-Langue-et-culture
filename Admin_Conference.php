<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Admin_Conference.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        session_start();
        include("script_php\cnx_admin.inc.php");
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
                    Gestion des conférences
                </h1>
            </div>

            <div class="cases-container">
                <?php
                    try {
                        $result = $cnx -> query("SELECT DISTINCT conference.num_conf,resume_court,resume_long,categorie_theme,langue,horaire,duree,date_conf,type_intervention,conference.num_salle,salle.capacite,salle.aile FROM vdeux.conference JOIN vdeux.salle ON conference.num_salle=salle.num_salle JOIN vdeux.organise ON conference.num_conf=organise.num_conf ORDER BY date_conf,horaire");
                        while($ligne =$result->fetch(PDO::FETCH_OBJ)) {
                            //Calcul du nombre de places restantes
                            $inscrit = $cnx -> query("SELECT COUNT(*) FROM vdeux.inscrit WHERE num_conf=$ligne->num_conf");
                            $insc = $inscrit->fetch(PDO::FETCH_OBJ);
                            $count = $insc->count;
                            $capacite = $ligne->capacite;
                            $capa = (int)$capacite - (int)$count;
                            // Formatage de la date, de l'heure et de la durée
                            setlocale(LC_TIME, 'french');   
                            $date = new DateTime($ligne->date_conf);
                            $dt = strftime('%A %d %B %Y', $date->getTimestamp());
                            $hr = date("H\hi", strtotime($ligne->horaire));
                            list($heures, $minutes, $secondes) = explode(":", $ligne->duree);
                            $dur = ($heures * 60) + $minutes;
                            // Affichage de la conférence
                            echo "<div class='case-conférence'>";
                            echo "<p class='date'>$dt</p><hr>";
                            echo "<p class='type'>$ligne->type_intervention</p>"; 
                            echo "<h2 class='conf_titre'>$ligne->resume_court</h2>";
                            echo "<p class='resume_long'>$ligne->resume_long</p>";
                            echo "<p class='langues'>Langue : $ligne->langue</p>";
                            echo "<p class='duree'>$hr - $dur"."min</p>";
                            echo "<p class='categorie'>$ligne->categorie_theme</p>";
                            echo "<p class='salle'> Salle $ligne->num_salle aile $ligne->aile</p>";
                            echo "<p class='place'> $capa places restantes</p>";
                            echo "<div class='actions'><button class='modifier'>Modifier</button>";
                            echo "<form method='post' action='script_php/supp_conf_admin.php'><button name='suppc' type='submit' value='$ligne->num_conf' class='refuser'>";
                            echo "<img src='image/supprime.png' alt='Bouton_supprimer'></button></form>";
                            echo "</div></div>";
                        }
                    } catch (PDOException $e) {
                        echo "<h1>Une erreur est survenue, veuillez patienter.</h1>";
                    }
                ?>
            </div>
        </section>
    </main>
</body>
</html>