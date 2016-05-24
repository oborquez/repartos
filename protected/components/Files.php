<?php
/*
*	Componente Yii
*	Manejo de datos entre Yii y kendoUI
*	omarborquez
*/

/* allowed files types */
class Files extends CApplicationComponent{

	public function files_types(){

		return array(
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'png' => 'image/png',
			'txt' => 'text/plain',
			'zip' => 'application/zip',
			'pdf' => 'application/pdf',
			'doc' => 'application/msword'
		);
	}

	/*  input file and return extension file */
	public function get_extension($file){

		return preg_replace('@.*?\.([a-z0-9]+)$@i','$1',$file);

	}

	/* boolean returns */
	public function allowed_file($file){

		return (in_array($this->get_extension($file), $this->tiles_types));

	}

	/* Input file string, and return the file type*/
	public function get_file_type($file){

		$ext = $this->get_extension($file);
		$types = $this->files_types();
		$type = (in_array($ext,$types))? $types[$ext] : $ext;
		return $type;
	}

	public function resource(){
		
	}
}


