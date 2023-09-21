<?php
    require '../utils.createaccount.php';
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (strlen($password)<8)
    {
        account_page('password', $username);
    }
    elseif (isset($username) and !ctype_alnum($username))
    {
        account_page('username', $username);
    }
    else
    {
        echo '<br><strong>Username : ' . $username . '</strong><br><strong>Password : ' . $password . '</strong>';
    }