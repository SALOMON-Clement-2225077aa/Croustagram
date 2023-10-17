<?php
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if($isMob){header('Location: MVC/views/viewMainPage_Mobile.php');}
    else {
        header('Location: MVC/views/viewMainPage.php');
    }
?>