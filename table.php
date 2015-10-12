<?php 
    require_once("functions.php");
    
    //kuulan, kas kasutaja tahab kustutada
    if(isset($_GET["delete"])){
        //saadan kustutatava auto id
        deleteCarData($_GET["delete"]);
    }
    
    //kasutaja muudab andmeid
    if(isset($_GET["update"])){
        updateCarData($_GET["car_id"], $_GET["number_plate"], $_GET["color"]);
    }
    
    //kõik autod objektide kujul massiivis
    $car_array = getAllData();
    
    $keyword = "";
    if(isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
        //otsime
        $car_array = getAllData($keyword);
    }else{
        //näitame kõik tulemused
        $car_array = getAllData();
    }
?>

<h1>Tabel</h1>
<form action="table.php" method="get">
    <input name="keyword" type="search" value="<?=$keyword?>">
    <input type="submit" value="Otsi"><br><br>
</form>
<table border=1>
<tr>
    <th>id</th>
    <th>Kasutaja id</th>
    <th>Auto numbri märk</th>
    <th>Värv</th>
    <th>Kustuta</th>
    <th>Muuda</th>
    <th></th>
</tr>
<?php
    //autod ükshaaval läbi käia
    for($i = 0; $i < count($car_array); $i++){
        
        //kasutaja tahab rida muuta
        if(isset($_GET["edit"]) && $_GET["edit"] == $car_array[$i]->id){
            echo "<tr>";
            echo "<form action='table.php' method='get'>";
            // input mida välja ei näidata
            echo "<input type='hidden' name='car_id' value='".$car_array[$i]->id."'>";
            echo "<td>".$car_array[$i]->id."</td>";
            echo "<td>".$car_array[$i]->user_id."</td>";
            echo "<td><input name='number_plate' value='".$car_array[$i]->number_plate."'></td>";
            echo "<td><input name='color' value='".$car_array[$i]->color."'></td>";            
            echo "<td><a href='?table.php=".$car_array[$i]->id."'>Katkesta</a></td>";
            echo "<td><input name='update' type='submit'></td>";
            echo "</form>";
            echo "</tr>";
        }else{
            //lihtne vaade
            echo "<tr>";
            echo "<td>".$car_array[$i]->id."</td>";
            echo "<td>".$car_array[$i]->user_id."</td>";
            echo "<td>".$car_array[$i]->number_plate."</td>";
            echo "<td>".$car_array[$i]->color."</td>";
            echo "<td><a href='?delete=".$car_array[$i]->id."'>X</a></td>";
            echo "<td><a href='?edit=".$car_array[$i]->id."'>Muuda</a></td>";
            echo "<td><a href='edit.php?edit_id=".$car_array[$i]->id."'>Muuda eraldi lehel</a></td>";
            echo "</tr>";
            
        }
        
        
    }
    
?>
</table>