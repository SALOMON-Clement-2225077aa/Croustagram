<?php
require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerLeaderboard.php';

start_page('Leaderboard');

showLeaderboard();

end_page();
