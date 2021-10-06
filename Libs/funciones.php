<?php
	
	function prepare_query($conexion,$sql,$campo,$tipo="")
		{
			$tipo=$tipo ?: str_repeat('s',count($campo));//repeat repite el valor las vezes q indique
			$cmd=$conexion->prepare($sql);//Prepara la consulta SQL y devuelve un manejador de sentencia para ser utilizado por operaciones adicionales sobre la sentencia.
			if($campo!=[])//si la variable tiene valores
			$cmd->bind_param($tipo, ...$campo); // Agrega variables a una sentencia preparada como parámetros
			$cmd->execute();
			return $cmd;
		}
	function prepare_select($conexion,$sql,$campo=[],$tipo="")
		{
			return prepare_query($conexion,$sql,$campo,$tipo)->get_result();
			
		}
?>