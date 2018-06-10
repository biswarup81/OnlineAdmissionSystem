<?
//thumbnail
function getimgdim_restrict_wh($filename,$max_width,$max_height)//paramaters----name of file, order*(100,50)
{
   	         //echo $img;
			 if(!is_file("$filename"))
			 {
			   return;
			 }
			 
			 $size=@getimagesize($filename);
			 $origwidth=$width=$size[0];
			 $origheight=$height=$size[1];
			 
			     if($width>$max_width)
			     {
			       $per=$width/$max_width;
				   //echo "per: ".$per;  
				   $width=round($width/$per);
				   $height=round($height/$per);
			     }
				 
			     if($height>$max_height)
			     {
			       $per=$height/$max_height;
				   //echo "per: ".$per;  
				   $width=round($width/$per);
				   $height=round($height/$per);
			     }
			 
		return array($width,$height,$origwidth,$origheight);
}
//end thumbnail
?>