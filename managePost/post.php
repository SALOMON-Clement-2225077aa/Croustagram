<?php
    function afficher_unique_post($titre, $contenu, $auteur, $date, $ptsCrous, $categories)
    {
        echo $titre . '<br>' . $contenu . '<br>' . $auteur . '<br>' . $date . '<br>' . $ptsCrous . '<br>' . $categories . '<br>';
    }
    function afficher_unique_comm($contenu, $auteur, $date, $ptsCrous)
    {
        echo $contenu . '<br>' . $auteur . '<br>' . $date . '<br>' . $ptsCrous . '<br><br>';
    }