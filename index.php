<?php
// 定義要開啟的目錄
$dir = "..".$_SERVER['REQUEST_URI'];
     
// 用 opendir() 開啟目錄，開啟失敗終止程式
$handle = @opendir($dir) or die("Cannot open " . $dir);
echo '<html><head><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</link>
</head>';

function formatSizeUnits($bytes){
	if ($bytes >= 1073741824)
	{
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	}
	elseif ($bytes >= 1048576)
	{
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	}
	elseif ($bytes >= 1024)
	{
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	}
	elseif ($bytes > 1)
	{
		$bytes = $bytes . ' bytes';
	}
	elseif ($bytes == 1)
	{
		$bytes = $bytes . ' byte';
	}
	else
	{
		$bytes = '0 bytes';
	}
	return $bytes;
}

     
// 用 readdir 讀取檔案內容
echo "<body style=\"background-color:#ebebeb;font-family: Microsoft JhengHei;\">";
echo "<div style='box-shadow:2px 2px 2px 2px #cccccc; background-color:white;width:65%; margin:10px auto;padding:10px;'><div style=\"width:96%;margin:10px auto;\"><table style=\"font-size:80%\" class=\"table table-sm\">";
echo "<thead><tr class=\"bg-primary\"><th scope='col'><b><font color=\"white\">Files in " . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "：</font></b></th><th scope='col'><b><font color=\"white\">Last Modified</font></th><th scope='col'><b><font color=\"white\">Size</font></th></tr></thead><tbody>";
while($file = readdir($handle)){
    // 將 "." 及 ".." 排除不顯示
	$URL=$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if($file != "." && $file != ".." && $file != "index.php"){
		echo "<tr class=\"table-light\"><td><a href='$URL$file'>$file</a><br/></td><td>".date("Y/m/d H:i:s",filemtime($file))."</td><td>".formatSizeUnits(filesize($file))."</td></tr>";
	}
}
echo "</tbody></table></div><div style='text-align:center;margin:10px auto;'><font>Powered by <a href='https://github.com/rsps1008'><u>rsps1008</font></a></u></div></div></body></html>";  

// 關閉目錄
closedir($handle);
?>