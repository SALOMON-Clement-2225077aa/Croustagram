<?php
require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerLeaderboard.php';
?>
<body>
<?php
session_start();
start_page('Leaderboard');

showLeaderboard();

end_page();
?>
</body>
