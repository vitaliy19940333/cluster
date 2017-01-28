<?php
class Model_Image extends Model
{
	public static function upload($file){
		$uploaddir = 'images/';
		// это папка, в которую будет загружаться картинка
		$apend=date('YmdHis').rand(100,1000).'.jpg'; 
		// это имя, которое будет присвоенно изображению 
		$uploadfile = "$uploaddir$apend"; 
		//в переменную $uploadfile будет входить папка и имя изображения

		// В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
		// И проходит ли изображение по весу. В нашем случае до 512 Кб
		if(($file['type'] == 'image/gif' || $file['type'] == 'image/jpeg' || $file['type'] == 'image/png') && ($file['size'] != 0 and $file['size']<=2048000)) 
		{ 
		// Указываем максимальный вес загружаемого файла. Сейчас до 512 Кб 
		  if (move_uploaded_file($file['tmp_name'], $uploadfile)) 
		   { 
		   //Здесь идет процесс загрузки изображения 
		   $size = getimagesize($uploadfile); 
		   // с помощью этой функции мы можем получить размер пикселей изображения 
			 if ($size[0] < 11501 && $size[1]<11501) 
			 { 
			 // если размер изображения не более 500 пикселей по ширине и не более 1500 по  высоте 
			 return array(true,$uploadfile); 
			 } else {
			 return "Загружаемое изображение превышает допустимые нормы (ширина не более - 500; высота не более 1500)"; 
			 unlink($uploadfile); 
			 // удаление файла 
			 } 
		   } else {
		   return "Файл не загружен, вернитеcь и попробуйте еще раз";
		   } 
		} else { 
		return "Размер файла не должен превышать 2Мб  и файл должен быть одним из форматов: jpg;jpeg;png;gif";
		} return "fsdfsd";
	}
	
	public static function uploadMaterials($file){
		$uploaddir = 'materials/';
		// это папка, в которую будет загружаться картинка
		$apend=date('Ymd').rand(100,1000); 
		// это имя, которое будет присвоенно изображению 
		$uploadfile = "$uploaddir$apend"; 
		//в переменную $uploadfile будет входить папка и имя изображения

		// В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
		// И проходит ли изображение по весу. В нашем случае до 512 Кб
		if(($file['size']<=8048000)) 
		{ 
		// Указываем максимальный вес загружаемого файла. Сейчас до 512 Кб 
		  if (move_uploaded_file($file['tmp_name'], $uploadfile.'.'.$file['name'])) 
		  { 
			return array(true,$uploadfile.".".$file['name']); 
		  }else
			 return "Файл не загружен попробуйте еще раз";
			 // удаление файла 
		}else{
		  return "Размер файла не должен превышать 8Мб  и файл должен быть одним из форматов: jpg;jpeg;png;gif";
		} 
	
	}
}
?>