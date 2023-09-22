<?php

require '../utils.inc.php';
require '../../creationCompte/utils.createaccount.php';

start_page('Profil');

?>
    <div id="ContenuPage">
        <?php
            account_page();
        ?>
</div>

<?php

end_page('Profil');

?>
