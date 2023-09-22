<!-- Page de création du compte -->
<?php
function account_page($erreurTab = array(), $def_username = NULL, $def_mail = NULL, $def_name = NULL): void
{

?><!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset="UTF-8">
    <meta name="titre" content="Créer un compte">
    <meta name="description" content="Page pour créer un compte">
    <title>Devenir croustagrameur</title>
</head>

<body>
    <h1>Prêt à vivre l'expérience Croustagram ?</h1>
    <form action="/creationCompte/createAccount.php" method="post">

        <label>E-Mail :</label>
        <input type='text' name='mail' required value=<?php echo '\'' . $def_mail . '\''; ?><br><br>
        <?php
            if (in_array("mail", $erreurTab))
        {
            echo '<strong style=\'color:red;\'>Format d\'adresse e-mail invalide</strong>';
        }
            elseif (in_array("mailPris", $erreurTab))
        {
            echo '<strong style=\'color:red;\'>Adresse e-mail déjà utilisée par un autre compte</strong>';
        }
        ?>

        <br><label>Nom d'utilisateur :</label>
        <input type='text' name='username' required value=<?php echo '\'' . $def_username . '\''; ?><br><br>
        <?php
            if (in_array("username", $erreurTab))
            {
                echo '<strong style=\'color:red;\'>Le nom d\'utilisateur ne peut contenir que des caractères alphanumériques</strong>';
            }
            elseif (in_array("usernamePris", $erreurTab))
            {
                echo '<strong style=\'color:red;\'>Ce nom d\'utilisateur est déjà utilisé</strong>';
            }
        ?>

        <br><label>Mot de passe :</label>
        <input type='password' name='password' required><br>
        <?php
            if (in_array("password", $erreurTab)){
                echo '<strong style=\'color:red;\'>Le mot de passe doit faire minimum 8 caractères</strong>';
            }
        ?>
        <br><label>Vérification du mot de passe :</label>
        <input type='password' name='passwordMatch' required><br>
        <?php
        if (in_array("passwordMatch", $erreurTab)){
            echo '<strong style=\'color:red;\'>Les mots de passe ne correspondent pas !</strong>';
        }
        ?>


        <br><label>Nom d'affichage </label><label style="color: red">(optionnel)</label><label> :</label>
        <input type='text' name='name' value=<?php echo '\'' . $def_name . '\''; ?>><br>
        <br><button type="submit" value="mailer" name="action">Rejoindre Croustagram !</button>

    </form>
</body>
<?php
}
?>
<!--------------------------------->