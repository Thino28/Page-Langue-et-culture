<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Formulaire inscription</title>
  <link rel="stylesheet" href="CSS/form_inscription.css">
</head>
<body>
  <h1>Bienvenue au Colloque "Langues et Cultures"</h1>
  <div class="intro">
      Rejoignez-nous pour célébrer la richesse des langues et des cultures lors de notre colloque annuelle, un lieu d'échange, de partage et de découverte. 
  </div>
  <div class="conteneur">
    <img src="image\image_page_inscription.png" alt="image_langage">
  </div>

  <form action="script_php\form_inscription_bdd.php" method="post">
    <?php 
      session_start();
      if (isset($_SESSION["essai_inscription"])) {
        echo "<p>".$_SESSION['essai_inscription']."</p>";
        session_unset();
      }
    ?>
    <div class="ligne">
      <span>Nom : </span> 
      <input type="text" name="nom" id="nom">
    </div>
    <br>
    <div class="ligne">
      <span>Prénom : </span>
      <input type="text" name="prenom" id="prenom">
    </div>
    <br>
    <div class="ligne">
      <span>Adresse postale : </span>
      <input type="text" name="adresse" id="adresse">
    </div>
    <br>
    <div class="ligne">
      <span>Adresse mail : </span>
      <input type="mail" name="mail" id="mail">
    </div>
    <br>
    <div class="ligne">
      <span>Téléphone : </span>
      <input type="tel" name="tel" id="tel">
    </div>
    <br>
    <div class="ligne">
      <span>Date de naissance : </span>
      <input type="date" name="naiss" id="naiss">
    </div>
    <br>
    <div class="ligne">
      <span>Profession : </span>
      <input type="text" name="profession" id="profession">
    </div>
    <br>
    <div class="ligne">
      <span>Mot de passe : </span>
      <input type="password" name="mdp" id="mdp">
    </div>
    <br>
    <div class="ligne">
      <span>Confirmation du mot de passe : </span>
      <input type="password" name="mdp2" id="mdp2">
    </div>
    <br>
    
    <div class="type_inscription">
      Inscription :
      <input type="radio" checked name="type_inscr" id="perso" value="Perso"> Perso
      <input type="radio" name="type_inscr" id="pro" value="Pro"> Pro
      <input type="radio" name="type_inscr" id="conf" value="Conf"> Conférencier
      <br><br>
    
      <div class="info_pro">
        <div class="ligne_bis">
          <span>Fonction : </span>
          <input type="text" name="fonction" id="fonction">
        </div>
        <br>
        <div class="ligne_bis">
          <span>Adresse email pro : </span>
          <input type="mail" name="mailpro" id="mailpro">
        </div>
        <br>
        <div class="ligne_bis">
          <span>Téléphone pro : </span>
          <input type="tel" name="telpro" id="telpro">
        </div>
        <br>  
      </div>
      
      <div class="info_conf">
        <div class="ligne_bis">
          <span>Fonction : </span>
          <input type="text" name="fonction_conf" id="fonction_conf">
        </div>
        <br>
        <div class="ligne_bis">
          <span>Organisme : </span>
          <input type="text" name="orga" id="orga">
        </div>
        <br>  
      </div>
      
      <div class="autre">
        <a href="index.html">
          <img id="retour" src="image\fleche_retour.png" alt="retour">
        </a>
        <input id="submit" type="submit" value="S'inscrire">
      </div>
    
    </div>
    <br>
  </form>

</body>
</html>