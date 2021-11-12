<?php
header("content-type:application/json");
include "conexion.php";
$result;
if(isset($_GET["id"])){
    $id = $_GET["id"];
    if(isset($_GET["limit"])){
        $limit = $_GET["limit"];
        $result = query("SELECT * FROM tiempo WHERE chipId = $id  ORDER BY `fecha` DESC LIMIT 0,$limit ");
        
        for ($i=0; $i < count($result) ; $i++) { 
            $result[$i] =  array_merge($result[$i],array("fingerprint"=> uniqid()));
        }
        
    }else{
        $result = query("SELECT * FROM estaciones WHERE chipId = $id");
    }
}else{
    $result = query("SELECT * FROM estaciones");
}
echo json_encode($result);
?>