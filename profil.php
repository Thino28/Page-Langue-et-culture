<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestion du site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/profil.css">
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
</head>
<!-------------------------------------------------------------------------------------------------->
<body>
    <!--HEADER------------------------------------------------------------------------------------------------>
    <header>
        <div class="logo">
            <img src="image/Foreign Language Course.png" alt="Logo" class="logo-image">
        </div>

        <div class="sous-menu">
            <nav>
                <?php
                    session_start();
                    if ((isset($_SESSION['conf']) && ($_SESSION['conf']==true))){
                        echo "<a href='Conferencier_Principal.php' >";
                    }
                    if (isset($_SESSION['id']) && $_SESSION['id'] < 3) {
                        echo "<a href='Admin.php' >";
                    } else {
                        echo "<a href='Client_Principal.php' >";
                    }
                ?>
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
                    Profil :
                </h1>
            </div>
            <div class="profil-container">
                <div class="profil">
                    <div class="profil-image">
                        <img src="image/icon Compte blanc.png" alt="Profil Image" class="profil-icon">
                        <div class="profil-nom">
                            <?php
                            if (isset($_SESSION['prenom']) && $_SESSION['prenom'] =='Visiteur') {
                                echo "Visiteur";
                            } else {
                                if (isset($_SESSION['prenom'])){
                                    echo $_SESSION['nom']." ".$_SESSION['prenom'];
                                } else {
                                    echo "Profil";
                                }
                            }
                                
                            ?>
                        </div>
                    </div>
                    <div class="profil-informations">
                        <?php
                            if (isset($_SESSION['prenom']) && $_SESSION['prenom'] =='Visiteur') {
                                echo "Veuillez vous connectez pour modifier votre profil.";
                            } else {
                                echo "<form action='script_php/modif_profil.php' method='post'>";
                                echo "<div class='ligne'><span>Nom : </span> ";
                                echo "<input type='text' name='nom' id='nom'></div><br>";
                                echo "<div class='ligne'><span>Prénom : </span>";
                                echo "<input type='text' name='prenom' id='prenom'></div><br>";
                                echo "<div class='ligne'><span>Adresse postale : </span>";
                                echo "<input type='text' name='adresse' id='adresse'></div><br>";
                                echo "<div class='ligne'><span>Adresse mail : </span>";
                                echo "<input type='mail' name='mail' id='mail'></div><br>";
                                echo "<div class='ligne'><span>Téléphone : </span>";
                                echo "<input type='tel' name='tel' id='tel'></div><br>";
                                echo "<div class='ligne'><span>Date de naissance : </span>";
                                echo "<input type='date' name='naiss' id='naiss'></div><br>";
                                echo "<div class='ligne'><span>Profession : </span>";
                                echo "<input type='text' name='profession' id='profession'></div><br>";
                                echo "<div class='ligne'><span>Mot de passe : </span>";
                                echo "<input type='password' name='mdp' id='mdp'></div><br>";
                                
                                if ($_SESSION['pro']) {
                                    echo "<div class='ligne'><span>Email professionnel : </span>";
                                    echo "<input type='email' name='email_pro' id='email_pro'></div><br>";
                                    echo "<div class='ligne'><span>Téléphone professionnel : </span>";
                                    echo "<input type='tel' name='tel_pro' id='tel_pro'></div><br>";
                                    echo "<div class='ligne'><span>Fonction : </span>";
                                    echo "<input type='text' name='fonction' id='fonction'></div><br>";
                                }

                                if ($_SESSION['conf']) {
                                    echo "<div class='ligne'><span>Fonction : </span>";
                                    echo "<input type='text' name='fonction' id='fonction'></div><br>";
                                    echo "<div class='ligne'><span>Organisme : </span>";
                                    echo "<input type='text' name='orga' id='orga'></div><br>";
                                }

                                echo "<div class='bouton-modifier'>";
                                echo "<button class='modifier' type='submit'>Modifier</button>";
                                echo "</div></form>";
                            }
                        ?>
                    </div>
                </div> 
            </div>
        </section>
    </main>
    <!-------------------------------------------------------------------------------------------------->
</body>
<!-------------------------------------------------------------------------------------------------->
</html>



 