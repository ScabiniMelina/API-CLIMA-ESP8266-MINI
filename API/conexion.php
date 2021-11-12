<?php
	// ver los errores menos los warnings
	error_reporting(E_ALL^E_WARNING);
	include "credenciales.php";
	
	function conectarDB(){
		try{
			$db = new mysqli(HOST,USER,PASS,BD,PORT);
			if($db->connect_errno !=0 ){
				echo $db-> connect_error;
				exit();
			}
			return $db;
		}catch (Exception $e){
            echo $e->getMessage();
        }
	}

	function query($ssql){
		try{
		$db = conectarDB();
		$result = $db ->query($ssql);

		if($db->errno !=0 ){
			echo $db->error;
			echo "<br>". $db.$ssql;
			exit();
		}

		if($result->num_rows > 0 ){
			while($fila[]=$result->fetch_array(MYSQLI_ASSOC)){}
			unset($fila[count($fila)-1]);
			return $fila;
		}else{
			return array("error"=>"no hay datos");
		}
		echo "<pre>".print_r($result,true)."</pre>";
		}catch (Exception $e){
			  echo $e->getMessage();
		}
	}
