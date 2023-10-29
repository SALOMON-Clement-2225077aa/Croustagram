<?php

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerCompte.php';
require_once '../controllers/newProfilePicture.php';

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];
$id = $_GET['id'];

$title = 'Profil de ' . $id;
start_page($title);
if($id ==  $_SESSION['username']) {
    header("Location: ../views/viewProfil_Mobile.php");
}
?>
    <section id="contenuPage">
        <article>
            <?php
                showCompte($id);

                echo showPosts($id);

            ?>
        </article>
    </section>
</body>
<?php
    end_page();
?>