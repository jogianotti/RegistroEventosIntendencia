<?php
	// Cabecera de imagen
	// En este caso usamos jpeg, aunque podemos utilizar cualquier formato
	header("Content-Type: image/jpeg");

	// Código para evitar la cache
	header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
	header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );

	// carga de la imágen
	$foto = './'.$_GET['id'].'.jpg';
	if (file_exists($foto)) {
    	@readfile($foto);
	} else {
		@readfile('./0.jpg');
	}
	
?>
