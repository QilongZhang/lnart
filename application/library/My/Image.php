<?php
/**
 * Author : smallchicken
 * Time   : 2009年6月8日16:46:05
 * mode 1 : 强制裁剪，生成图片严格按照需要，不足放大，超过裁剪，图片始终铺满
 * mode 2 : 和1类似，但不足的时候 不放大 会产生补白，可以用png消除。
 * mode 3 : 只缩放，不裁剪，保留全部图片信息，会产生补白，
 * mode 4 : 只缩放，不裁剪，保留全部图片信息，生成图片大小为最终缩放后的图片有效信息的实际大小，不产生补白
 * 默认补白为白色，如果要使补白成透明像素，请使用SaveAlpha()方法代替SaveImage()方法
 *
 * 调用方法：
 *
 * $ic=new ImageCrop('old.jpg','afterCrop.jpg');
 * $ic->Crop(120,80,2);
 * $ic->SaveImage();
 *        //$ic->SaveAlpha();将补白变成透明像素保存
 * $ic->destory();
 *
 *
 */
class My_Image{

	var $sImage;
	var $dImage;
	var $src_file;
	var $dst_file;
	var $src_width;
	var $src_height;
	var $src_ext;
	var $src_type;

	function __construct($src_file,$dst_file=''){
		$this->src_file=$src_file;
		$this->dst_file=$dst_file;
		$this->LoadImage();
	}

	function SetSrcFile($src_file){
		$this->src_file=$src_file;
	}

	function SetDstFile($dst_file){
		$this->dst_file=$dst_file;
	}

	function LoadImage(){
		list($this->src_width, $this->src_height, $this->src_type) = getimagesize($this->src_file);
		switch($this->src_type) {
			case IMAGETYPE_JPEG :
				$this->sImage=imagecreatefromjpeg($this->src_file);
				$this->ext='jpg';
				break;
			case IMAGETYPE_PNG :
				$this->sImage=imagecreatefrompng($this->src_file);
				$this->ext='png';
				break;
			case IMAGETYPE_GIF :
				$this->sImage=imagecreatefromgif($this->src_file);
				$this->ext='gif';
				break;
			case IMAGETYPE_BMP :
				$this->sImage = $this->imagecreatefrombmp($this->src_file);
				$this->ext='bmp';
				break;
			default:
				exit();
		}
	}

	function SaveImage($fileName=''){
		$this->dst_file=$fileName ? $fileName : $this->dst_file;
		switch($this->src_type) {
			case IMAGETYPE_JPEG :
				imagejpeg($this->dImage,$this->dst_file,100);
				break;
			case IMAGETYPE_PNG :
				imagepng($this->dImage,$this->dst_file);
				break;
			case IMAGETYPE_GIF :
				imagegif($this->dImage,$this->dst_file);
				break;
			case IMAGETYPE_BMP:
				$this->imagebmp($this->dImage,$this->dst_file);
			default:
				break;
		}
	}

	function OutImage(){
		switch($this->src_type) {
			case IMAGETYPE_JPEG :
				header('Content-type: image/jpeg');
				imagejpeg($this->dImage);
				break;
			case IMAGETYPE_PNG :
				header('Content-type: image/png');
				imagepng($this->dImage);
				break;
			case IMAGETYPE_GIF :
				header('Content-type: image/gif');
				imagegif($this->dImage);
				break;
			case IMAGETYPE_GIF :
				header('Content-type: image/bmp');
				$this->imagebmp($this->dImage);
				break;
			default:
				break;
		}
	}

	function SaveAlpha($fileName=''){
		$this->dst_file=$fileName ? $fileName . '.png' : $this->dst_file .'.png';
		imagesavealpha($this->dImage, true);
		imagepng($this->dImage,$this->dst_file);
	}

	function OutAlpha(){
		imagesavealpha($this->dImage, true);
		header('Content-type: image/png');
		imagepng($this->dImage);
	}

	function destory(){
		imagedestroy($this->sImage);
		imagedestroy($this->dImage);
	}

	function Crop($x,$y,$dst_width,$dst_height){
		$this->dImage =  imagecreatetruecolor($dst_width,$dst_height);
		imagecopyresampled($this->dImage, $this->sImage, 0 , 0, $x ,$y ,$dst_width ,$dst_width ,$dst_width,$dst_width);
		$this->SaveImage();
	}// end Crop
	
	
	/**
	 * 缩放函数，type参数控制缩放类型
	 * 1为头像，
	 * 0为twindow图片
	 * */
	public function Thumb($width = 480,$height=480)
	{
		$zoom = 0;
		$zoom_width = 0;
		$zoom_height = 0;
		if(($this->src_width/$this->src_height)>($width/$height))
		{
			$zoom = $this->src_width/$width;
		}else{
			$zoom = $this->src_height/$width;
		}
		$zoom_width = $this->src_width / $zoom;
		$zoom_height = $this->src_height / $zoom;
		$this->dImage = imagecreatetruecolor($zoom_width,$zoom_height);
		$white=imagecolorallocate($this->dImage,255,255,255);
		imagefilledrectangle($this->dImage,0,0,$zoom_width,$zoom_height,$white);
		imagecopyresampled($this->dImage,$this->sImage,0,0,0,0,$zoom_width,$zoom_height,$this->src_width,$this->src_height);
		$this->SaveImage();
	}
	function imagecreatefrombmp($fname) {

		$buf=@file_get_contents($fname);

		if(strlen($buf)<54) return false;

		$file_header=unpack("sbfType/LbfSize/sbfReserved1/sbfReserved2/LbfOffBits",substr($buf,0,14));

		if($file_header["bfType"]!=19778) return false;
		$info_header=unpack("LbiSize/lbiWidth/lbiHeight/sbiPlanes/sbiBitCountLbiCompression/LbiSizeImage/lbiXPelsPerMeter/lbiYPelsPerMeter/LbiClrUsed/LbiClrImportant",substr($buf,14,40));
		if($info_header["biBitCountLbiCompression"]==2) return false;
		$line_len=round($info_header["biWidth"]*$info_header["biBitCountLbiCompression"]/8);
		$x=$line_len%4;
		if($x>0) $line_len+=4-$x;

		$img=imagecreatetruecolor($info_header["biWidth"],$info_header["biHeight"]);
		switch($info_header["biBitCountLbiCompression"]){
			case 4:
				$colorset=unpack("L*",substr($buf,54,64));
				for($y=0;$y<$info_header["biHeight"];$y++){
					$colors=array();
					$y_pos=$y*$line_len+$file_header["bfOffBits"];
					for($x=0;$x<$info_header["biWidth"];$x++){
						if($x%2)
						$colors[]=$colorset[(ord($buf[$y_pos+($x+1)/2])&0xf)+1];
						else
						$colors[]=$colorset[((ord($buf[$y_pos+$x/2+1])>>4)&0xf)+1];
					}
					imagesetstyle($img,$colors);
					imageline($img,0,$info_header["biHeight"]-$y-1,$info_header["biWidth"],$info_header["biHeight"]-$y-1,IMG_COLOR_STYLED);
				}
				break;
			case 8:
				$colorset=unpack("L*",substr($buf,54,1024));
				for($y=0;$y<$info_header["biHeight"];$y++){
					$colors=array();
					$y_pos=$y*$line_len+$file_header["bfOffBits"];
					for($x=0;$x<$info_header["biWidth"];$x++){
						$colors[]=$colorset[ord($buf[$y_pos+$x])+1];
					}
					imagesetstyle($img,$colors);
					imageline($img,0,$info_header["biHeight"]-$y-1,$info_header["biWidth"],$info_header["biHeight"]-$y-1,IMG_COLOR_STYLED);
				}
				break;
			case 16:
				for($y=0;$y<$info_header["biHeight"];$y++){
					$colors=array();
					$y_pos=$y*$line_len+$file_header["bfOffBits"];
					for($x=0;$x<$info_header["biWidth"];$x++){
						$i=$x*2;
						$color=ord($buf[$y_pos+$i])|(ord($buf[$y_pos+$i+1])<<8);
						$colors[]=imagecolorallocate($img,(($color>>10)&0x1f)*0xff/0x1f,(($color>>5)&0x1f)*0xff/0x1f,($color&0x1f)*0xff/0x1f);
					}
					imagesetstyle($img,$colors);
					imageline($img,0,$info_header["biHeight"]-$y-1,$info_header["biWidth"],$info_header["biHeight"]-$y-1,IMG_COLOR_STYLED);
				}
				break;
			case 24:
				for($y=0;$y<$info_header["biHeight"];$y++){
					$colors=array();
					$y_pos=$y*$line_len+$file_header["bfOffBits"];
					for($x=0;$x<$info_header["biWidth"];$x++){
						$i=$x*3;
						$colors[]=imagecolorallocate($img,ord($buf[$y_pos+$i+2]),ord($buf[$y_pos+$i+1]),ord($buf[$y_pos+$i]));
					}
					imagesetstyle($img,$colors);
					imageline($img,0,$info_header["biHeight"]-$y-1,$info_header["biWidth"],$info_header["biHeight"]-$y-1,IMG_COLOR_STYLED);
				}
				break;
			default:
				return false;
				break;
		}
		return $img;
	}
	/*function imagecreatefrombmp($src)
	 {
		global  $CurrentBit, $echoMode;
		$f=fopen($file,"r");
		$Header=fread($f,2);
		if($Header=="BM")
		{
		$Size=$this->freaddword($f);
		$Reserved1=$this->freadword($f);
		$Reserved2=$this->freadword($f);
		$FirstByteOfImage=$this->freaddword($f);

		$SizeBITMAPINFOHEADER=$this->freaddword($f);
		$Width=$this->freaddword($f);
		$Height=$this->freaddword($f);
		$biPlanes=$this->freadword($f);
		$biBitCount=$this->freadword($f);
		$RLECompression=$this->freaddword($f);
		$WidthxHeight=$this->freaddword($f);
		$biXPelsPerMeter=$this->freaddword($f);
		$biYPelsPerMeter=$this->freaddword($f);
		$NumberOfPalettesUsed=$this->freaddword($f);
		$NumberOfImportantColors=$this->freaddword($f);

		if($biBitCount==24)
		{
		$img=imagecreatetruecolor($Width,$Height);
		$Zbytek=$Width%4;
			
		for($y=$Height-1;$y>=0;$y--)
		{
		for($x=0;$x<$Width;$x++)
		{
		$B=$this->freadbyte($f);
		$G=$this->freadbyte($f);
		$R=$this->freadbyte($f);
		$color=imagecolorexact($img,$R,$G,$B);
		if($color==-1) $color=imagecolorallocate($img,$R,$G,$B);
		imagesetpixel($img,$x,$y,$color);
		}
		for($z=0;$z<$Zbytek;$z++)
		$this->freadbyte($f);
		}
		}
		fclose($f);
		return $img;
		}
		fclose($f);
		}*/


	function freadbyte($f)
	{
		return ord(fread($f,1));
	}
	function freadword($f)
	{
		$b1=$this->freadbyte($f);
		$b2=$this->freadbyte($f);
		return $b2*256+$b1;
	}

	function freaddword($f)
	{
		$b1=$this->freadword($f);
		$b2=$this->freadword($f);
		return $b2*65536+$b1;
	}
	function imagebmp(&$im, $filename = '', $bit = 24, $compression = 0)
	{
		if (!in_array($bit, array(1, 4, 8, 16, 24, 32)))
		{
			$bit = 8;
		}
		else if ($bit == 32) // todo:32 bit
		{
			$bit = 24;
		}

		$bits = pow(2, $bit);

		// 调整调色板
		imagetruecolortopalette($im, true, $bits);
		$width  = imagesx($im);
		$height = imagesy($im);
		$colors_num = imagecolorstotal($im);

		if ($bit <= 8)
		{
			// 颜色索引
			$rgb_quad = '';
			for ($i = 0; $i < $colors_num; $i ++)
			{
				$colors = imagecolorsforindex($im, $i);
				$rgb_quad .= chr($colors['blue']) . chr($colors['green']) . chr($colors['red']) . "\0";
			}

			// 位图数据
			$bmp_data = '';

			// 非压缩
			if ($compression == 0 || $bit < 8)
			{
				if (!in_array($bit, array(1, 4, 8)))
				{
					$bit = 8;
				}
				$compression = 0;

				// 每行字节数必须为4的倍数，补齐。
				$extra = '';
				$padding = 4 - ceil($width / (8 / $bit)) % 4;
				if ($padding % 4 != 0)
				{
					$extra = str_repeat("\0", $padding);
				}

				for ($j = $height - 1; $j >= 0; $j --)
				{
					$i = 0;
					while ($i < $width)
					{
						$bin = 0;
						$limit = $width - $i < 8 / $bit ? (8 / $bit - $width + $i) * $bit : 0;

						for ($k = 8 - $bit; $k >= $limit; $k -= $bit)
						{
							$index = imagecolorat($im, $i, $j);
							$bin |= $index << $k;
							$i ++;
						}

						$bmp_data .= chr($bin);
					}

					$bmp_data .= $extra;
				}
			}
			// RLE8 压缩
			else if ($compression == 1 && $bit == 8)
			{
				for ($j = $height - 1; $j >= 0; $j --)
				{
					$last_index = "\0";
					$same_num   = 0;
					for ($i = 0; $i <= $width; $i ++)
					{
						$index = imagecolorat($im, $i, $j);
						if ($index !== $last_index || $same_num > 255)
						{
							if ($same_num != 0)
							{
								$bmp_data .= chr($same_num) . chr($last_index);
							}

							$last_index = $index;
							$same_num = 1;
						}
						else
						{
							$same_num ++;
						}
					}

					$bmp_data .= "\0\0";
				}

				$bmp_data .= "\0\1";
			}

			$size_quad = strlen($rgb_quad);
			$size_data = strlen($bmp_data);
		}
		else
		{
			// 每行字节数必须为4的倍数，补齐。
			$extra = '';
			$padding = 4 - ($width * ($bit / 8)) % 4;
			if ($padding % 4 != 0)
			{
				$extra = str_repeat("\0", $padding);
			}

			// 位图数据
			$bmp_data = '';

			for ($j = $height - 1; $j >= 0; $j --)
			{
				for ($i = 0; $i < $width; $i ++)
				{
					$index  = imagecolorat($im, $i, $j);
					$colors = imagecolorsforindex($im, $index);
					if ($bit == 16)
					{
						$bin = 0 << $bit;
						$bin |= ($colors['red'] >> 3) << 10;
						$bin |= ($colors['green'] >> 3) << 5;
						$bin |= $colors['blue'] >> 3;
						$bmp_data .= pack("v", $bin);
					}
					else
					{
						$bmp_data .= pack("c*", $colors['blue'], $colors['green'], $colors['red']);
					}// todo: 32bit;
				}
				$bmp_data .= $extra;
			}
			$size_quad = 0;
			$size_data = strlen($bmp_data);
			$colors_num = 0;
		}
		// 位图文件头
		$file_header = "BM" . pack("V3", 54 + $size_quad + $size_data, 0, 54 + $size_quad);
		// 位图信息头
		$info_header = pack("V3v2V*", 0x28, $width, $height, 1, $bit, $compression, $size_data, 0, 0, $colors_num, 0);
		if($filename != '')
		{
			$fp = fopen($filename, "wb");
			fwrite($fp, $file_header);
			fwrite($fp, $info_header);
			fwrite($fp, $rgb_quad);
			fwrite($fp, $bmp_data);
			fclose($fp);
			return 1;
		}
		return 1;
	}
}
?>