<?php 
/*********** Fonction de Débuggage *********/
function dd($a){
    echo "<pre>";
    print_r($a);
    echo "</pre>";
    die();
}

?>