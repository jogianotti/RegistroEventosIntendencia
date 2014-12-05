<?php

namespace RegistroEventos\CoreBundle\Helper;

class SubirImagen
{   
	public function ValidarImagen($file)
    {   
		$uploadedfile = $file->getRealPath();
		$extension = strtolower($file->getClientOriginalExtension());
		switch ($extension){
			case 'jpg':
				break;
			case 'jpeg':
				break;
			case 'png':
				break;
			case 'gif':
				break;
			default:
				return "Solo se permiten fotos con formato JPG, JPEG, PNG, GIF";																		
			}
	}	

    public function SubirImagen($file, $id)
    {   
		$uploadedfile = $file->getRealPath();
		$extension = strtolower($file->getClientOriginalExtension());
		switch ($extension){
			case 'jpg':
				$src = imagecreatefromjpeg($uploadedfile);
				break;
			case 'jpeg':
				$src = imagecreatefromjpeg($uploadedfile);
				break;
			case 'png':
				$src = imagecreatefrompng($uploadedfile);
				break;
			case 'gif':
				$src = imagecreatefromgif($uploadedfile);
				break;
			default:
				return "Solo se permiten fotos con formato JPG, JPEG, PNG, GIF";																		
		}
    	//$file->move('fotos', $id.'.jpg');
    	
    	
	    $nombreNuevo = $id.'.jpg';
		list($width,$height)=getimagesize($uploadedfile);
			if ($width > $height){
				$newwidth = 40;
				$newheight = ($height / $width) * $newwidth;
			}else{
				$newheight = 40;
				$newwidth = ($width / $height) * $newheight;
			}
		$tmp = imagecreatetruecolor ($newwidth, $newheight);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		if (!file_exists('fotos')) {
			mkdir('fotos', 0777, true);
		}
		$filename = 'fotos/'.$nombreNuevo;

		imagejpeg($tmp, $filename);						
		imagedestroy($tmp);	

		return null;
    } 
}