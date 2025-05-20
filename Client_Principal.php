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
            include("script_php/test_cookie.php");
            if (isset($_COOKIE['conf']) && ($_COOKIE['conf']='true')) {
                header('location:choix.html');
                exit();
            }
        ?>
        <div class="logo">
            <img src="image/Foreign Language Course.png" alt="Logo" class="logo-image">
        </div>

        <div class="sous-menu">
            <nav>
                <a href="#accueil" >
                    <img src="image/Vector.png" alt="home" class="logo-icon">
                    Accueil
                </a>
                <a href="#conférence" >
                    <img src="image/Icon_conférence.png" alt="icon_conference" class="logo-icon">
                    Gestion  conférence
                </a>
                <a href="#Contact" >
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
                        $result = $cnx -> query("SELECT num_conf,resume_court,resume_long,categorie_theme,langue,horaire,duree,date_conf,type_intervention,conference.num_salle,salle.capacite,salle.aile FROM vdeux.conference JOIN vdeux.salle ON conference.num_salle=salle.num_salle ");
                        while($ligne =$result->fetch(PDO::FETCH_OBJ)) {
                            $capacite = $ligne->capacite;
                            $inscrit = $cnx -> query("SELECT COUNT(*) FROM vdeux.inscrit WHERE num_conf=$ligne->num_conf");
                            $insc = $inscrit->fetch(PDO::FETCH_OBJ);
                            $count = $insc->count;
                            $capa = (int)$capacite - (int)$count;
                            setlocale(LC_TIME, 'french');
                            $date = new DateTime($ligne->date_conf);
                            $dt = strftime('%A %d %B %Y', $date->getTimestamp());
                            $hr = date("H\hi", strtotime($ligne->horaire));
                            list($heures, $minutes, $secondes) = explode(":", $ligne->duree);
                            $dur = ($heures * 60) + $minutes;
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

                            $idconf = $ligne->num_conf;
                            $id=$_COOKIE['id'];
                            $couple_conf_parti = (string)$idconf."_".(string)$id;
                            $inscriptions = $cnx -> query("SELECT * FROM vdeux.inscrit WHERE num_conf=$idconf AND num_parti=$id");
                            $verifInscrit =$inscriptions->fetch(PDO::FETCH_OBJ);
                            if ($verifInscrit) {
                                echo "<p>Vous vous êtes inscrit.</p>";
                                echo "<form action='script_php/desinscription_conf.php' method='post'>";
                                echo "<input type='submit' value='$couple_conf_parti' name='desin' id='desinscrire$idconf' hidden>";
                                echo "<label class='inscrire' for='desinscrire$idconf'>Desinscription</label></form>";

                                echo "<p>Voulez-vous inviter quelqu’un ?</p>";
                                echo "<input type='checkbox' id='inviter$idconf' class='bouton-invitation' hidden>";
                                echo "<label for='inviter$idconf' class='inviter'>Inviter</label>";

                                echo "<form class='details-invitation' action='script_php/invitation.php' method='post'>";
                                echo "<input type='email' id='mail$idconf' class='mail' placeholder='Insérer un mail'>";

                                echo "<input type='submit' id='valider$idconf' class='validation' name='inv' hidden>";
                                echo "<label for='valider$idconf' class='inviter'>Valider</label>";
                                
                                echo "<input type='checkbox' id='annuler$idconf' class='annuler' hidden>";
                                echo "<label for='annuler$idconf' class='inviter'>Annuler</label></form>";
                            } else {
                                echo "<form action='script_php/inscription_conf.php' method='post'>";
                                echo "<input type='submit' value='$couple_conf_parti' name='insc' id='inscrire$idconf' hidden>";
                                echo "<label class='inscrire' for='inscrire$idconf'>Inscription</label></form>";
                            }
                            echo "</div>";
                           
                            
                            
                            
                            //echo "<div class='details-inscription'><p class='confirmation'>Vous vous êtes inscrit.</p>";
                            //echo "<label for='inscrire1' class='inscrire' onclick='resetChekboxe('1')'>Se désinscrire</label>";
                           // echo "<p>Voulez-vous inviter quelqu’un ?</p>";
                            //echo "<input type='checkbox' id='inviter1' class='bouton-invitation' hidden>";
                            
                           // echo "<div class='details-invitation'>";
                           // echo "<input type='email' id='mail1' class='mail' placeholder='Insérer un mail'>";
                            //echo "<input type='checkbox' id='valider1' class='validation' hidden>";
                            //echo "<label for='valider1' class='inviter'>Valider</label>";
                            //echo "<input type='checkbox' id='inviter1' class='annuler' hidden>";
                            //echo "<label for='inviter1' class='inviter'>Annuler</label></div>";
                            
                            
                            
                        }
                    } catch (PDOException $e) {
                        echo "<h1>Une erreur est survenue, veuillez patienter.$e</h1>";
                    }
                ?>
                
                
            </div>
        </section>
    </main>
    <!-------------------------------------------------------------------------------------------------->

    <!--Javascript------------Très compliquer de faire sans javascript------------------------------------------------------------------------------------>
    <!-- Cette fonction JavaScript permet, quand on clique sur 'Se désinscrire', 
     de décocher automatiquement les autres cases de cette conférence (comme Inviter, Mail, etc) 
     pour que l’interface se réinitialise proprement
     elle est appelée avec un identifiant propre à chaque conférence, 
     ce qui permet de cibler uniquement les bonnes cases sans toucher aux autres -->

    <script>
        function resetChekboxe(id) {
            const sousCheckboxes = ['inviter', 'mail', 'valider'];
            // Pour chaque nom (inviter, mail, valider)
            sousCheckboxes.forEach(name => {
            //On recompose l'ID complet
            const checkbox = document.getElementById(name + id);
            //on la décoche
            if (checkbox) {
                checkbox.checked = false;
            }
            });
        }
    </script>

</body>
<!-------------------------------------------------------------------------------------------------->
</html>