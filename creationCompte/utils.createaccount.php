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
    <link rel="icon" href="/ressources/logo.png" />
    <title>Devenir croustagrameur</title>
</head>

<body>
    <div id="ContenuPage">
        <div id="BoxMilieu">
            <h1 id="FormTitre">Prêt à vivre l'expérience Croustagram ?</h1>
            <form action="/creationCompte/createAccount.php" method="post">
                <div class="FormDiv">
                    <label>E-Mail :</label>
                    <input type='text' name='mail' required value=<?php echo '\'' . $def_mail . '\''; ?>>
                    <?php
                    if (in_array("mail", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>Format d\'adresse e-mail invalide</strong>';
                    }
                    elseif (in_array("mailPris", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>Adresse e-mail déjà utilisée par un autre compte</strong>';
                    }
                    elseif (in_array("mailLong", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>L\'adresse mail est trop longue (50 caractères maximum)</strong>';
                    }
                    ?>
                </div>

                <div class="FormDiv">
                    <label>Nom d'utilisateur :</label>
                    <input type='text' name='username' required value=<?php echo '\'' . $def_username . '\''; ?>>
                    <?php
                    if (in_array("username", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>Le nom d\'utilisateur ne peut contenir que des caractères alphanumériques</strong>';
                    }
                    elseif (in_array("usernamePris", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>Ce nom d\'utilisateur est déjà utilisé</strong>';
                    }
                    elseif (in_array("usernameLong", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>Le nom d\'utilisateur est trop long (20 caractères maximum)</strong>';
                    }
                    ?>
                </div>

                <div class="FormDiv">
                    <label>Mot de passe :</label>
                    <input type='password' name='password' required>
                    <?php
                    if (in_array("password", $erreurTab)){
                        echo '<strong style=\'color:red;\'>Le mot de passe doit faire minimum 8 caractères</strong>';
                    }
                    ?>
                </div>

                <div class="FormDiv">
                    <label>Vérification du mot de passe :</label>
                    <input type='password' name='passwordMatch' required>
                    <?php
                    if (in_array("passwordMatch", $erreurTab)){
                        echo '<strong style=\'color:red;\'>Les mots de passe ne correspondent pas !</strong>';
                    }
                    ?>
                </div>

                <div class="FormDiv">
                    <label>Nom d'affichage :</label><label style="color: red">(optionnel)</label>
                    <input type='text' name='name' value=<?php echo '\'' . $def_name . '\''; ?>>
                    <?php
                    if (in_array("nameLong", $erreurTab))
                    {
                        echo '<strong style=\'color:red;\'>Le pseudo choisi est trop long (25 caractères maximum)</strong>';
                    }
                    ?>
                </div>

                <div id="DivBas">
                    <img src="../../ressources/logo.png">
                    <button id="FormBouton" type="submit" value="mailer" name="action">S'inscrire</button>
                </div>

            </form>
        </div>
    </div>
</body>
<?php
}
?>
<!--------------------------------->