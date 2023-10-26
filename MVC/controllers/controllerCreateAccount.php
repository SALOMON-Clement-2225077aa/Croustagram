<?php
function showAccountPage($erreurTab = array(), $def_username = NULL, $def_mail = NULL, $def_name = NULL): void
{
    session_start();
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
if(isset($_SESSION['createTabErreur'])) $erreurTab = $_SESSION['createTabErreur'];
if(isset($_SESSION['createUsername'])) $def_username = $_SESSION['createUsername'];
if(isset($_SESSION['createMail'])) $def_mail = $_SESSION['createMail'];
if(isset($_SESSION['createName'])) $def_name = $_SESSION['createName'];
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset="UTF-8">
    <meta name="titre" content="Créer un compte">
    <meta name="description" content="Page pour créer un compte">
    <link rel="icon" href="../public/assets/images/logo.png" />
    <?php if(!$isMob) { ?>
        <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
    <?php } ?>
    <title>Croustagram - Inscription</title>
</head>

<body>
<div id="ContenuPage">
    <div id="BoxMilieu">
        <h1 id="FormTitre">Prêt à vivre l'expérience Croustagram ?</h1>
        <form action="../models/createAccount.php" method="post">
                <div class="FormDiv">
                    <label>E-Mail :</label>
                    <input placeholder="Adresse e-mail"  type='text' name='mail' required value=<?php echo '\'' . $def_mail . '\''; ?>>
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
                    <input placeholder="Nom d'utilisateur unique"  type='text' name='username' required value=<?php echo '\'' . $def_username . '\''; ?>>

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
                    <input placeholder="Mot de passe" type='password' name='password' required>

                </div>

                <?php
                if (in_array("password", $erreurTab)){
                    echo '<label class="erreurLabel"><strong>Le mot de passe doit faire minimum 8 caractères !</strong></label>';
                }
                ?>
                <div class="FormDiv">
                    <label>Vérification du mot de passe :</label>
                    <input placeholder="2ème entrée mot de passe" type='password' name='passwordMatch' required>

                </div>
                <?php
                if (in_array("passwordMatch", $erreurTab)){
                    echo '<label class="erreurLabel"><strong>Les mots de passe ne correspondent pas !</strong></label>';
                }
                ?>

                <div class="FormDiv">
                    <label>Nom d'affichage :</label><label style="color: red"> (optionnel)</label>
                    <input placeholder="Pseudo affiché" type='text' name='name' value=<?php echo '\'' . $def_name . '\''; ?>>

                </div>
                <?php
                if (in_array("nameLong", $erreurTab))
                {
                    echo '<label class="erreurLabel"><strong>Le pseudo choisi est trop long (25 caractères maximum) !</strong></label>';
                }
                ?>

                <div id="DivBas">
                    <?php if ($isMob) { ?>
                        <button id="RetourBouton" onclick="window.location.href='../views/viewConnexionPage_Mobile.php'">Se connecter</button>
                    <?php }
                    else { ?>
                        <button id="RetourBouton" onclick="window.location.href='../views/viewConnexionPage.php'">Se connecter</button>
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
