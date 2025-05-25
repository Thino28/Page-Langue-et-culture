<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion du site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Conferencier_Principal.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <?php
            session_start();
            include("script_php\cnx_parti.inc.php");
            if (isset($_SESSION['conf']) && ($_SESSION['conf']!=true) || (!isset($_SESSION['prenom'])) || ($_SESSION['prenom']=="Invité")) {
                header('location:index.html');
                exit();
            }
        ?>
        <div class="logo">
            <img src="image/Foreign Language Course.png" alt="Logo" class="logo-image">
        </div>

        <div class="sous-menu">
            <nav>
                <a href="Conferencier_Principal.php">
                    <img src="image/Vector.png" alt="home" class="logo-icon">
                    Accueil
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
                    Vos conférences :
                </h1>
            </div>
            <?php
                $id=$_SESSION['id'];
                //Bouton pour ajouter une conférence
                echo "<div class='ajouter'>";
                echo "<input type='checkbox' id='actif' hidden>";
                echo "<div class='ajouter-container'>";
                echo "<label for='actif'> Ajouter</label></div>";
                // Formulaire d'ajout de conférence
                echo "<div class='ajouter-contenu'>";
                echo "<form method='post' action='script_php/ajout_conf.php'>";
                echo "<div class='form-group'>";
                echo "<label for='conferencier2'>Mail d'un deuxième conferencier :</label>";
                echo "<input type='mail' id='mail' name='mail'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='date'>Date :</label>";
                echo "<input type='date' id='date' name='date' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='horaire'>Horaire :</label>";
                echo "<input type='time' id='horaire' name='horaire' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='duree'>Durée :</label>";
                echo "<input type='time' id='duree' name='duree' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='langue'>Langue :</label>";
                echo "<input type='text' id='langue' name='langue' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='Type'>Type d'intervention :</label>";
                echo "<input type='text' id='type' name='type' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='categorie'>Catégorie :</label>";
                echo "<input type='text' id='categorie' name='categorie' required>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='salle'>Salle :</label>";
                echo "<select id='salle' name='salle' required>";
                $result2 = $cnx -> query("SELECT * FROM vdeux.salle ORDER BY num_salle");
                while($ligne =$result2->fetch(PDO::FETCH_OBJ)) {
                    echo "<option value='$ligne->num_salle'>Salle $ligne->num_salle aile $ligne->aile capacite $ligne->capacite personnes</option>";
                }
                echo "</select>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='description'>Titre/Résumé court: </label>";
                echo "<textarea id='Resumer-court' name='Resume-court' required></textarea>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='description'>Résumé long: </label>";
                echo "<textarea id='Resumer-long' name='Resume-long' required></textarea>";
                echo "</div>";
                echo "<div class='form-group-button'>";
                echo "<button type='submit' class='bouton-ajouter' value='$id' >Ajouter</button>";
                echo "<label for='actif' id='bouton'>Annuler</label>";
                echo "</div>";
                echo "</form>";
                echo "</div>";
                echo "</div>";


            ?>
            
            <input type="checkbox" id="actif2" class="form" hidden > 
            <div class="cases-container">
                <?php
                    try {
                        $id=$_SESSION['id'];
                        $result = $cnx -> query("SELECT DISTINCT conference.num_conf,resume_court,resume_long,categorie_theme,langue,horaire,duree,date_conf,type_intervention,conference.num_salle,salle.aile FROM vdeux.conference JOIN vdeux.salle ON conference.num_salle=salle.num_salle JOIN vdeux.organise ON conference.num_conf=organise.num_conf WHERE organise.num_parti=$id ORDER BY date_conf,horaire");
                        while($ligne =$result->fetch(PDO::FETCH_OBJ)) {
                            $idconf = $ligne->num_conf;
                            //Calcul du nombre de participants inscrits
                            $inscrit = $cnx -> query("SELECT COUNT(*) FROM vdeux.inscrit WHERE num_conf=$ligne->num_conf");
                            $insc = $inscrit->fetch(PDO::FETCH_OBJ);
                            $count = $insc->count;
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
                            echo "<p class='place'> $count personne(s) inscrite(s)</p>";
                            echo "<div class='actions'>";
                            echo "<label for='modifier$ligne->num_conf' class='modifier-bouton'>Modifier</label>";
                            echo "<form method='post' action='script_php/supp_conf.php'>";
                            echo "<button name='suppc' type='submit' value='$ligne->num_conf' class='refuser'>";
                            echo "<img src='image/supprime.png' alt='Bouton_supprimer'></button></form>";
                            echo "</div></div>";
                            echo "<input class='modifier-check' type='checkbox' name='voir_modif' value='$ligne->num_conf' id='modifier$ligne->num_conf' hidden>";

                            // Formulaire de modification de conférence
                            echo "<div class='modifier'><div class='modifier-contenu'>"; 
                            echo "<form method='post' action='script_php/modif_conf.php'>";
                            echo "<div class='form-group'>";
                            echo "<label for='date'>Date :</label>";
                            echo "<input type='date' id='date' name='date' >";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='duree'>Durée :</label>";
                            echo "<input type='text' id='duree' name='duree' >";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='horaire'>Horaire :</label>";
                            echo "<input type='text' id='horaire' name='horaire' >";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='langue'>Langue :</label>";
                            echo "<input type='text' id='langue' name='langue' >";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='Type'>Type :</label>";
                            echo "<input type='text' id='type' name='type' >";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='categorie'>Catégorie :</label>";
                            echo "<input type='text' id='categorie' name='categorie' >";
                            echo "</div>";  
                            echo "<div class='form-group'>";
                            echo "<label for='salle'>Salle :</label>";
                            echo "<select id='salle' name='salle' >";
                            $result2 = $cnx -> query("SELECT * FROM vdeux.salle ORDER BY num_salle");
                            while($ligne =$result2->fetch(PDO::FETCH_OBJ)) {
                                echo "<option value='$ligne->num_salle'>Salle $ligne->num_salle aile $ligne->aile capacite $ligne->capacite personnes</option>";
                            }
                            echo "</select>";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='description'>Titre/Résumé court:</label>";
                            echo "<textarea id='Resumer-court' name='Resume-court' ></textarea>";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<label for='description'>Résumé long:</label>";
                            echo "<textarea id='Resumer-long' name='Resume-long' ></textarea>";
                            echo "</div>";
                            echo "<div class='form-group-button'>";
                            echo "<button type='submit' value='$idconf' name='idconf' class='bouton-modifier'>Modifier</button>";
                            echo "<label for='modifier$idconf' id='boutonannuler$idconf'>Annuler</label>";
                            echo "</div>";
                            echo "</form>";
                            echo "</div><div>";
                            
                        }
                    } catch (PDOException $e) {
                        echo "<h1>Une erreur est survenue, veuillez patienter.$e</h1>";
                    }
                ?>
            </div>
        </section>
    </main>
</body>
</html>