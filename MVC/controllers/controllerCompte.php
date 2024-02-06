<?php
require_once '../controllers/controllerPost.php';
require_once '../models/modelPost.php';
require_once '../models/modelCompte.php';

/**
 * Récupère le nb de commentaire du post en paramètre et le renvoie
 * @param $id = l'identifiant du compte
 */
function getNbCommentaires($id){

    $data = getNbCommentaireData($id);

    $row = $data->fetch(PDO::FETCH_ASSOC);
    $nb_comm = (int)$row['COUNT(*)']; // Convert to integer
    return $nb_comm;
}

/**
 * Récupère tout les posts de l'utilisateur en param et les renvoies
 * @param $id_User = l'identifiant du compte
 * @return string
 */
function showPosts($id_User): string
{

    $data = getAllPostsOfUserData($id_User);
    $posts = ' ';

    $accountData = getAllCompteData($id_User);
    $account = $accountData->fetch(PDO::FETCH_ASSOC);
    $accountName = $account['pseudo'];
    $accountImg = $account['img'];

    // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $nb_comm = getNbCommentaires($row['id']);
        $posts = $posts . showPost($row['croustagrameur_id'], $accountImg, $accountName, $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    // Libère la variable
    $data->closeCursor();

    return $posts;
}

/**
 * Affiche le profil de l'utilisateur en paramètre :
 * (pseudo, id(pseudo unique), points, dernière connexion, date création compte)
 * @param $id_User = l'identifiant du compte qu'on voit
 * @return void
 */
function showCompte($id_User){
    $result = getAllCompteData($id_User);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    if (!empty($data)){
        if($data['img'] == 'no_img') {
            echo '<img draggable="false" alt="Photo de profil" src="../public/assets/images/profil.png" class="imgProfilCompte" >';
        }
        else {
            echo '<img draggable="false" alt="Photo de profil" src="'. $data['img'] .'" class="imgProfilCompte" >';
        }
    ?>
    <h1><?php echo $data['pseudo'] . ' (@' . $data['id'] . ')'?></h1>
    <h3>Points crous : <?php echo $data['ptsCrous']?></h3>
    <h5>Dernière connexion le <?php echo $data['derniere_connexion']?></h5>
    <h5>Création du compte le <?php echo $data['creation_compte']?></h5>
<?php
    }
    else{
        echo '<strong>Cet utilisateur n\'existe pas</strong>';
    }
}