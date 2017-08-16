<?php
echo <<<_END
<html>
<head>
<title>
BROWSER
</title>
</head>
_END;
echo '<style type="text/css">
a{text-decoration: none;color:rgb(128,8,8);font-style:bold;font-family: "Century Gothic";background-color:rgb(57,196,96)}
p{text-decoration: none;color:rgb(128,8,8);font-style:bold;font-family: "Century Gothic";background-color:rgb(161,234,33);display:inline;padding:4px;}
a:hover{color:white;background-color:rgb(38,39,83)}
button{cursor:pointer;}
button:hover{background-color:red;}
.menu{background-color:rgb(107,166,31);width:100%;height:40px;position:fixed;top:5px;left:0px;}
.menuico{height:4em;width:4em;position:fixed;top:0px;left:20px;}
.menuico1{height:4em;width:4em;position:fixed;top:0px;right:20px;}
</style>
<body style="background-color:rgb(155,164,143);"><h1 align = "center">BROWSER</h1>';


$fs = fopen("ext.txt", 'r');
$dir = fread($fs,filesize("ext.txt"));
fclose($fs);
if(isset($_POST['fldr']))
echo $_POST['fldr'];


if(isset($_POST['reset']))
{
	$dir = "./";
	$fs = fopen("ext.txt",'w');
	fwrite($fs , $dir);
	fclose($fs);
}
if(isset($_POST['back']))
{	$n = filesize("ext.txt")-2;
	for($k = $n;$k>0;$k--)
	{
		if($dir[$k] == "/")
			{$pos = $k+1;
			 break;
			}
	}
	
	$dir = substr($dir, 0 ,$pos);
	$fs = fopen("ext.txt",'w');
	fwrite($fs , $dir);
	fclose($fs);

}
echo <<<_END
<table class="menu">
<tr>
<td>
<form method = "post" action = "browser.php">
<input type = "hidden" name = "reset">
<button class="menuico" type="submit"> <img  src = "./ico1/reset.png"> </button>
</form>
<td>
<form method = "post" action = "browser.php">
<input type = "hidden" name = "back">
<button class="menuico1" type="submit"><img  src = "./ico1/prev.png"></button>
</form>
</table>


_END;

echo <<<_END
<table>


_END;


if(isset($_POST['fldr']))
	{$dir = $dir . $_POST['fldr'] . "/";
	 $fs = fopen("ext.txt", 'w');
	 fwrite($fs, $dir);
	 fclose($fs);
	}
;

$ab = scandir($dir);
echo '<tr><td style="border:6px solid black;background:rgb(134,179,144);"><h3> BROWSER WINDOW </h3>';
for ($i=2;$i < count($ab);$i++)
{	$ext = strrpos($ab[$i], '.')==""?"":substr($ab[$i], strrpos($ab[$i], '.') + 1);
    if($ext == "")
	echo '<br><form method = "post" action = "browser.php"><input type = "hidden" name = "fldr" value = "'.$ab[$i].'"><button type = "submit" value = "visit"><img src="./ico1/fldr2.png";></button></form><p>'.$ab[$i].'</p><br>';
}
echo'<hr size="9" color="black"><br><br>';
for ($i=2;$i < count($ab);$i++)
{	$ext = strrpos($ab[$i], '.')==""?"":substr($ab[$i], strrpos($ab[$i], '.') + 1);
    if($ext == "png" or $ext == "jpg" or $ext == "jpeg" or $ext == "gif")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/img1.png">'.$ab[$i].'</a><br><br>';
    elseif($ext == "mp3")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/mp31.png">'.$ab[$i].'</a><br><br>';
    elseif($ext == "pdf")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/pdf1.png">'.$ab[$i].'</a><br><br>';
    elseif($ext == "mp4" || $ext == "wmv" || $ext == "mkv" || $ext == "avi")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/vid1.png">'.$ab[$i].'</a><br><br>';
    elseif($ext == "txt")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/file.png">'.$ab[$i].'</a><br><br>';
	elseif($ext == "");
    elseif($ext == "html")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/html1.png">'.$ab[$i].'</a><br><br>';
    elseif($ext == "php")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/php1.png">'.$ab[$i].'</a><br><br>';
    elseif($ext == "zip" or $ext == "tar")
	echo ' : - <a href="'.$dir.$ab[$i].'"><img src="./ico1/zip1.png">'.$ab[$i].'</a><br><br>';
	else
	echo ' : - <a href="'.$dir.$ab[$i].'">'.$ab[$i].'</a><br><br>';
	
}
// upload.php
echo <<<_END
</table>
<table class="uploader">
<h3>UPLOAD FILES TO SERVER</h3>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" id="files" multiple="" />
    <input type="submit" value="Upload" />
</form>
_END;
if(isset($_FILES['files'])){
    $errors= array();
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
		$desired_dir="user_data";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"user_data/".$file_name);
            }}
}}
echo "</table></body></html>"




?>

