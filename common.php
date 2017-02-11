<?php
	function image_exists($path)
	{
		if (file_exists($path))
		{
			echo $path;
		}
		else {
			echo "img/Countries/defaultImage.jpg";
		}
	}
?>