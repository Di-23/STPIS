<?
/*
Class for resize and caching photos
*/

class Image{
        private static function imagecreate($thumb)
        {
            $handle = fopen($thumb, "rb");
            $data = fread($handle, 3);
            fclose($handle);
            switch(bin2hex($data))
            {
                case '89504e':
                    return imagecreatefrompng($thumb);
                case 'ffd8ff':
                    return imagecreatefromjpeg($thumb);
            }
        }
    
	public static function resize_image($thumb_target = '', $width = 60,$height = 60,$SetFileName = false, $quality = 80)
            {
            try{
                $thumb_img  =   self::imagecreate($thumb_target);
                list($w, $h) = getimagesize($thumb_target);
                if($w > $h) {
                        $new_height =   $height;
                        $new_width  =   floor($w * ($new_height / $h));
                        $crop_x     =   ceil(($w - $h) / 2);
                        $crop_y     =   0;
                }
                else {
                        $new_width  =   $width;
                        $new_height =   floor( $h * ( $new_width / $w ));
                        $crop_x     =   0;
                        $crop_y     =   ceil(($h - $w) / 2);
                }
                $tmp_img = imagecreatetruecolor($width,$height);
                imagecopyresampled($tmp_img, $thumb_img, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $w, $h);
				imagejpeg($tmp_img,$SetFileName,$quality);
                imagedestroy($tmp_img);
            }catch(Exception $ex){
                 echo $ex->getMessage();
            }
	}
	
	private static function minname($path,$width,$height,$name)
	{
		return abs(crc32($path.$width.$height)).'.'.pathinfo($name, PATHINFO_EXTENSION);
	}
	
	public static function getimage($path,$width,$height,$crop,$ifnull)
	{
		$name = pathinfo($path, PATHINFO_BASENAME);
		$impath = getAbPath($path);
		$inpath = getAbPath('/core/storage/thumbs/').self::minname($path,$width,$height,$name);
		if(!file_exists($impath) && isset($ifnull))
			return self::getimage($ifnull,$width,$height,$crop,$ifnull);
		if(!file_exists($inpath) || filemtime($inpath)<filemtime($impath))
		{
			self::resize_image($impath,$width,$height,$inpath,80);
		}
		return '/core/storage/thumbs/'.self::minname($path,$width,$height,$name).'?hash=0'.filemtime(getAbPath($path));
	}	
	
	
}
?>