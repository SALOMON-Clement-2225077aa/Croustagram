<?php
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if($isMob){header('Location: MobileView/HomePage/index.php');}
    else {header('Location: ComputerView/index.php');}