<?php
require_once '../controllers/controllerPoste.php';
require_once '../models/modelPoste.php';
require_once  '../models/modelCompte.php';

function getNbCommentaires($id){
    $nb_comm_result = getNbCommentaireData($id);
    $nb_comm = (int)$nb_comm_result['COUNT(*)']; // Convert to integer
    return $nb_comm;
}

function showPosts($id){

    $result = getAllPostsData($id);
    $posts = ' ';

    // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
    while ($row = mysqli_fetch_assoc($result)) {
        $nb_comm = getNbCommentaires($row['id']);
        $posts = $posts . affiche_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    // Libère la variable
    mysqli_free_result($result);

    var_dump($posts);

    return $posts;
}

function showCompte($id){
    $result = getAllCompteData($id);
    $data = mysqli_fetch_assoc($result);
    ?>
    <img id="imgProfil" src="../public/assets/images/profil.png">
    <h1><?php echo $data['pseudo'] ?></h1>
    <h4>@<?php echo $data['id'] ?></h4>
    <h3>Points crous : <?php echo $data['ptsCrous']?></h3>
    <h5>Dernière connexion le <?php echo $data['derniere_connexion']?></h5>
    <h5>Création du compte le <?php echo $data['creation_compte']?></h5>
<?php
}