<?php

/**
 * Affiche la page de visualisation du leaderboard sur mobile
 */

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerLeaderboard.php';

start_page('Leaderboard');

echo '<div id="contenuClassement">';
    showLeaderboard();
echo '</div>';

end_page();
?>

</body>
