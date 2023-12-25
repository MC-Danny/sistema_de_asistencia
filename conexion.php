<?php
	$usuario="root";                    //postgres      sa   root
	$password="123";			//todas son iguales
	$basedatos="BDASISTENCIA";
	try{
		$cn=new PDO("mysql:host=localhost;dbname=".$basedatos, $usuario,$password);
		//$cn=new PDO("pgsql:host=localhost;port=5433;dbname=".$basedatos, $usuario,$password);
		//$cn=new PDO("sqlsrv:server=localhost\15.0.2101.7;database=".$basedatos, $usuario,$password);
		//echo"exito de  coneccion con la base de datos"."<br>";


	}catch(PDOException $e){
		echo"error al conectar conla base de datos :" . $e->getMessage()."<br>";

	}

?>