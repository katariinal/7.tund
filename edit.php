<?php
    require_once("edit_functions.php");
    //kas muutuja on aadressireal
    if(isset($_GET["edit_id"])){
        echo $_GET["edit_id"];
        
        //küsin andmed 
        $car = getSingleCarData($_GET["edit_id"]);
        var_dump ($car);
        
    }else{
        //kui muutujat ei ole, ei ole mõtet siia lehele tulla 
        header("Location: table.php");
    }

?>