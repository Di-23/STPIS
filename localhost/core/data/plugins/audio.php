<?
class audio{
	private $dat=array('','','','','','');
	private function load($path)
	{
		require_once 'getid3/getid3.php';
		$getID3 = new getID3;
		return $getID3->analyze($path);
	}
	private function getTag($tag)
	{
		return (isset($tag))?$tag:'';
	}
	public function __construct($path)
	{
		$file_name = getAbPath('/core/storage/media/'.$path);
		$file_temp = getAbPath('/core/storage/temp'.minname($path));
		
		if(file_exists($file_temp.'.dat') && filemtime($file_temp.'.dat') > filemtime($file_name))
			$this->dat = explode('\n',file_get_contents($file_temp.'.dat'));
		else
		{
			$tag=self::load($file_name);
			if(isset($tag['tags']['id3v2']))
			{
				$this->dat[0] = self::getTag($tag['tags']['id3v2']['title'][0]);
				$this->dat[1] = self::getTag($tag['tags']['id3v2']['artist'][0]);
			}
			else
			{
				$this->dat[0] = 'ID3v1- '.self::getTag($tag['tags']['id3v1']['title'][0]);
				$this->dat[1] = 'ID3v1- '.self::getTag($tag['tags']['id3v1']['artist'][0]);
			}
			$this->dat[2] = self::getTag($tag['playtime_string']);
			$this->dat[3] = '/core/storage/temp'.minname($path).'.jpg';
			if(isset($tag['comments']['picture'][0]))
			{
				file_put_contents($file_temp.'.jpg',$tag['comments']['picture'][0]['data']);
			}
			file_put_contents($file_temp.'.dat',implode('\n',$this->dat));
		}
	}
	
	public function getData()
	{
		return $this->dat;
	}
	
	public static function listFiles()
	{
		return scandir(getAbPath('/core/storage/media/'));
	}
	/*
	foreach( $codes as $index => $code ) {
	   echo '<option value="' . $code . '">' . $names[$index] . '</option>';
	}

	public static function getImage($tag,$width,$height)
	{
	  if(isset($tag['comments']['picture'][0])){
		 imagejpeg($tag['comments']['picture'][0]['data'],,$quality);
	  }
	}
*/

}
?>