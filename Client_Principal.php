<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion du site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Client_Principal.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<!-------------------------------------------------------------------------------------------------->
<body>
    <!--HEADER------------------------------------------------------------------------------------------------>
    <header>
        <?php
            session_start();
            if ((isset($_SESSION['conf']) && ($_SESSION['conf']==true))|| (!isset($_SESSION['prenom']))) {
                header('location:index.html');
                exit();
            } 
        ?>
        <div class="logo">
            <img src="image/Foreign Language Course.png" alt="Logo" class="logo-image">
        </div>

        <div class="sous-menu">
            <nav>
                <a href="Client_Principal.php" >
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
   
    <!-------------------------------------------------------------------------------------------------->
    <div class="transition-band"></div>
    <!------MAIN------------------------------------------------------------------------------------------------>
    <main>
        <section>
            <div class="titre">
                <h1>
                    Visitez nos conférences :
                </h1>
            </div>
            <div class="sous-titre">
                <p>
                    Conférences accessibles à tous les curieux, sans limite d'âge,<br> Rejoignez-nous, que vous soyez étudiant, professionnel ou retraité
                </p>                
            </div>
            <div class="cases-container">
                <?php
                    include("script_php\cnx_parti.inc.php");
                    try {
                        $result = $cnx -> query("SELECT num_conf,resume_court,resume_long,categorie_theme,langue,horaire,duree,date_conf,type_intervention,conference.num_salle,salle.capacite,salle.aile FROM vdeux.conference JOIN vdeux.salle ON conference.num_salle=salle.num_salle ORDER BY date_conf,horaire");
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
                            // Vérification de l'inscription et inscription à la conférence
                            $idconf = $ligne->num_conf;
                            if (!isset($_SESSION['id'])) {
                                echo "<p>Veuillez vous connecter pour vous inscrire.</p>";
                            } else {
                                $id=$_SESSION['id'];
                                $couple_conf_parti = (string)$idconf."_".(string)$id;
                                $inscriptions = $cnx -> query("SELECT * FROM vdeux.inscrit WHERE num_conf=$idconf AND num_parti=$id");
                                $verifInscrit =$inscriptions->fetch(PDO::FETCH_OBJ);
                                if ($verifInscrit) {
                                    echo "<p>Vous vous êtes inscrit.</p>";
                                    echo "<form action='script_php/desinscription_conf.php' method='post'>";
                                    echo "<input type='submit' value='$couple_conf_parti' name='desin' id='desinscrire$idconf' hidden>";
                                    echo "<label class='inscrire' for='desinscrire$idconf'>Desinscription</label></form>";

                                    echo "<p>Voulez-vous inviter quelqu’un ?</p>";
                                    echo "<input type='checkbox' id='inviter$idconf' class='bouton-invitation' hidden >";
                                    
                                    echo "<label for='inviter$idconf' class='inviter'>Inviter</label>";

                                    echo "<form class='details-invitation' action='script_php/invitation.php' method='post'>";
                                    echo "<input name='inv' type='email' id='mail$idconf' class='mail' placeholder='Insérer un mail'>";
                                    echo "<input name='valinv' value='$couple_conf_parti' type='submit' id='valider$idconf' class='validation' hidden>";
                                    echo "<label for='valider$idconf' class='inviter'>Valider</label>";
                                    
                                    echo "<label for='inviter$idconf' class='inviter'>Annuler</label></form>";
                                } else {
                                    echo "<form action='script_php/inscription_conf.php' method='post'>";
                                    echo "<input type='submit' value='$couple_conf_parti' name='insc' id='inscrire$idconf' hidden>";
                                    echo "<label class='inscrire' for='inscrire$idconf'>Inscription</label></form>";
                                }
                            }
                            
                            echo "</div>";
                        }
                    } catch (PDOException $e) {
                        echo "<h1>Une erreur est survenue, veuillez patienter.$e</h1>";
                    }
                ?>
                
                
            </div>
        </section>
    </main>
    
</body>
<!-------------------------------------------------------------------------------------------------->
</html>


<!-- 
<div class="actions">
        <div class="modifier-bouton">
            <label for="actif2">
                Modifier
            </label>                                
        </div>
        <button class="valider"><img src="image/valide.png" alt="Bouton_valider"></button>
        <label for="conf2">
            <img src="image/supprime.png" alt="Bouton_supprimer">
        </label>
    </div>
</div>       -->