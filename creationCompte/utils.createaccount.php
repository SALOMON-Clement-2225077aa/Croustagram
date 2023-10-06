<!-- Page de création du compte -->
<?php
function account_page($erreurTab = array(), $def_username = NULL, $def_mail = NULL, $def_name = NULL): void
{
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
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
            <?php if ($isMob) { ?>
                <form action="request.php" method="post">
            <?php }
            else { ?>
                <form action="createAccount.php" method="post">
            <?php } ?>
                <div class="FormDiv">
                    <label>E-Mail :</label>
                    <input type='text' name='mail' required value=<?php echo '\'' . $def_mail . '\''; ?>>
                </div>
                    <?php
                    if (in_array("mail", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>Format d\'adresse e-mail invalide</strong></label>';
                    }
                    elseif (in_array("mailPris", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>Adresse e-mail déjà utilisée par un autre compte</strong></label>';
                    }
                    elseif (in_array("mailLong", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>L\'adresse mail est trop longue (50 caractères maximum)</strong></label>';
                    }
                    ?>
                <div class="FormDiv">
                    <label>Nom d'utilisateur :</label>
                    <input type='text' name='username' required value=<?php echo '\'' . $def_username . '\''; ?>>

                </div>
                    <?php
                    if (in_array("username", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>Le nom d\'utilisateur ne peut contenir que des caractères alphanumériques !</strong></label>';
                    }
                    elseif (in_array("usernamePris", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>Ce nom d\'utilisateur est déjà utilisé !</strong></label>';
                    }
                    elseif (in_array("usernameLong", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>Le nom d\'utilisateur est trop long (20 caractères maximum) !</strong></label>';
                    }
                    ?>

                <div class="FormDiv">
                    <label>Mot de passe :</label>
                    <input type='password' name='password' required>

                </div>

                    <?php
                    if (in_array("password", $erreurTab)){
                        echo '<label class="erreurLabel"><strong>Le mot de passe doit faire minimum 8 caractères !</strong></label>';
                    }
                    ?>
                <div class="FormDiv">
                    <label>Vérification du mot de passe :</label>
                    <input type='password' name='passwordMatch' required>

                </div>
                    <?php
                    if (in_array("passwordMatch", $erreurTab)){
                        echo '<label class="erreurLabel"><strong>Les mots de passe ne correspondent pas !</strong></label>';
                    }
                    ?>

                <div class="FormDiv">
                    <label>Nom d'affichage :</label><label style="color: red">(optionnel)</label>
                    <input type='text' name='name' value=<?php echo '\'' . $def_name . '\''; ?>>

                </div>
                    <?php
                    if (in_array("nameLong", $erreurTab))
                    {
                        echo '<label class="erreurLabel"><strong>Le pseudo choisi est trop long (25 caractères maximum) !</strong></label>';
                    }
                    ?>

                <div id="DivBas">
                    <?php if ($isMob) { ?>
                        <button id="RetourBouton" onclick="window.location.href='../ConnexionPage/index.php'">
                    <?php }
                    else { ?>
                        <button id="RetourBouton" onclick="window.location.href='../connexionCompte/pageConnexionCompte.php'">
                    <?php } ?>
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