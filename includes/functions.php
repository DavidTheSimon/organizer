<?php
define('_FOLDER','simi');
define('_URL', $_SESSION['pathInfo'] . '/');

/**
 * $dt = strtotime($date);
 * $day = date("D", $dt);
*/
$napokArray['Mon'] = "Monday";
$napokArray['Tue'] = "Tuesday";
$napokArray['Wed'] = "Wednesday";
$napokArray['Thu'] = "Thursday";
$napokArray['Fri'] = "Friday";
$napokArray['Sat'] = "Saturday";
$napokArray['Sun'] = "Sunday";

/**
 * Listing directories
 * @return string
*/
function directories ($dir, $n = 0)
{
	static $n;
	if ($n==0) {
		$html = "<ul class='mainDir'>";
		$html .=  "<a class='cmenuDirectory' rel='" . $dir . "' rev='" . _URL . $dir . "' title='" . _URL . $dir . '/' . "' href='#'><li class='mainDir' onclick='JavaScript:iframeLoader(\"" . $dir . "/" . "\")'>" . $dir;
		$html .= directories($dir . '/', $n++);
	}
	else
		$html = "<ul class='dirs'>";
	$dirs = scandir($dir);
	foreach ($dirs as $key=>$value) {
		if ($value == "." || $value == ".." || !is_dir($dir . '/' . $value)) {
			unset($dirs[$key]);
		}
	}
	foreach($dirs as $file) {
		$html .=  "<a class='cmenuDirectory' rel='" . $file . "' rev='" . _URL . $dir . "' title='" . _URL . $dir . '/' . $file . "' href='#'><li class='dirs' onclick='JavaScript:iframeLoader(\"" . $dir . "/" . $file . "\")'>";
		if (is_dir($dir . '/' . $file)) {
			$html .= $file . "<br>";
			$html .= directories($dir . '/' . $file, $n++);
		}
		$html .=  "</li></a>";
	}
	$html .=  "</li></a>";
	$html .=  "</ul>";
	return $html;
}

/**
 * Display the list and calling the showListFiles() function with added params.
 * @return function()
*/
function listFiles($dir)
{
	$dirs = scandir($dir);

	// . and .. logically delete from file list
	foreach ($dirs as $key=>$value) {
		if ($value == "." || $value == "..") {
			unset($dirs[$key]);
		}
	}

	// Sort of ordering
	include('sort.php');
	$i = 0;

	// List files
	foreach($dirs as $file) {
		if (($file == '.') || ($file == '..')) {}
		elseif (is_dir($dir . '/' . $file)) {}
		else {
			$array[$i]['fileUrl'] = $dir . '/' . $file;

			$fileSize = filesize($array[$i]['fileUrl']);

			// File extension
			$array[$i]['fileExtension'] = fileExtension($array[$i]['fileUrl']);

			// Create link
			$array[$i]['aTag'] = "<a class='cmenuFile' rel='" . _URL . $array[$i]['fileUrl'] . "' title='" . $file . "' rev='" . $dir . "' href='#'>" . $file . "</a>";

			// File size
			$array[$i]['fileSize'] = floor($fileSize / 1024) . "KB";

			// File uploading date
			$array[$i]['fileDate'] = date ("Y.m.d H:i:s", filemtime($array[$i]['fileUrl']));

			$i++;
		}
	}
	if ($i == 0) {
		return noFiles();
	} else {
		return showListFiles($array, $dir);
	}
}

/**
 * Show the list view
 * @return string
*/
function showListFiles($array, $dir)
{
	$html = "<div id='folderName'>";
	$html .= $dir;
	$html .= "</div>";
	$html .= "<div id='list'><table id='showTable' cellpadding='2'>";
	$html .= "<tr>
	<th>&nbsp;</th>
	<th>Name</th>
	<th align='right'>Size</th>
	<th align='right'>Date</th>
	</tr>";
	foreach ($array as $key) {
			$html .= "<tr>";
			$html .= "<td width='16'>";
			$html .= $key['fileExtension'];
			$html .= "</td>";
			$html .= "<td>";
			$html .= $key['aTag'];
			$html .= "</td>";
			$html .= "<td align='right' width='80'>";
			$html .= $key['fileSize'];
			$html .= "</td>";
			$html .= "<td align='right' width='150'>";
			$html .= $key['fileDate'];
			$html .= "</td>";
			$html .= "</tr>";
	}

	$html .= "</table></div>";
	return $html;
}

/**
 * Display the miniatures and calling the showMiniatureFiles() function with added params.
 * @return function()
*/
function miniatureFiles($dir)
{
	$dirs = scandir($dir);

	// . and .. logically delete from file list
	foreach ($dirs as $key=>$value) {
		if ($value == "." || $value == "..") {
			unset($dirs[$key]);
		}
	}

	// Sort of ordering
	include('sort.php');
	$i = 0;

	// List files
	foreach($dirs as $file) {
		if (($file == '.') || ($file == '..')) {}
		elseif (is_dir($dir . '/' . $file)) {}
		else {
			$array[$i]['fileUrl'] = $dir . '/' . $file;
			$fileSize = filesize($array[$i]['fileUrl']);
			$fileInfo = pathinfo($file);
			$ext = $fileInfo['extension'];

			// Attach icons to files
			if (!preg_match('/jpg|jpeg|png|gif|bmp|tif|tiff/',$ext)) {
				$icon = fileExtensionMiniature($array[$i]['fileUrl']);
				if (!file_exists($icon)) {
					$array[$i]['icon'] = "<a class='cmenuFile' rel='" . _URL . $array[$i]['fileUrl'] . "' title='" . $file . "' rev='" . $dir . "' href='#'><img src='../images/icons/noimage.gif' width='16' height='16'></a><br>";
				} else {
					$array[$i]['icon'] = "<a class='cmenuFile' rel='" . _URL . $array[$i]['fileUrl'] . "' title='" . $file . "' rev='" . $dir . "' href='#'><img src='" . $icon . "' width='16' height='16'></a><br>";
				}
			} else {

				// Logically resize of thumbnails
				$imageSize = resizeImg($array[$i]['fileUrl'],100,100);
				$array[$i]['icon'] = "<a class='cmenuFile' rel='" . _URL . $array[$i]['fileUrl'] . "' title='" . $file . "' rev='" . $dir . "' href='#'><img src='" . $array[$i]['fileUrl'] . "' width='" . $imageSize['x'] . "' height='" . $imageSize['y'] . "'></a><br>";
			}

			// Create shorter filenames
			if (strlen($file) > 14	) {
				$array[$i]['aTag'] = "<a class='cmenuFile' rel='" . _URL . $array[$i]['fileUrl'] . "' title='" . $file . "' rev='" . $dir . "' href='#'>" . substr($file, 0, 13) . "..." . str_replace(".", "", strrchr($file, '.')) . "</a><br>";
			} else {
				$array[$i]['aTag'] = "<a class='cmenuFile' rel='" . _URL . $array[$i]['fileUrl'] . "' title='" . $file . "' rev='" . $dir . "' href='#'>" . substr($file, 0, 13) . "</a><br>";
			}

			// File size
			$array[$i]['fileSize'] = floor($fileSize / 1024) . " KB";

			// File uploading date
			$array[$i]['fileDate'] = date ("Y.m.d H:i:s", filemtime($array[$i]['fileUrl'])) . "";
			$i++;

		}
	}
	if ($i == 0) {
		return noFiles();
	} else {
		return showMiniatureFiles($array, $dir);
	}
}

/**
 * Show the miniature view
 * @return string
*/
function showMiniatureFiles($array, $dir)
{
	$html = "<div id='folderName'>";
	$html .= $dir;
	$html .= "</div>";
	$html .= "<div id='showDiv'>";
	foreach ($array as $key) {
		$html .= "<div class='elements'>";
		$html .= "<table id='showTableMiniature' align='center'>";
		$html .= "<tr height='106'>";
		$html .= "<td align='center'>";
		$html .= $key['icon'];
		$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='center'>";
		$html .= $key['aTag'];
		$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='center'>";
		$html .= $key['fileSize'];
		$html .= "</td>";
		$html .= "</tr>";
		$html .= "<tr>";
		$html .= "<td align='center'>";
		$html .= $key['fileDate'];
		$html .= "</td>";
		$html .= "</tr>";
		$html .= "</table>";
		$html .= "</div>";
	}
	$html .= "</div>";
	return $html;
}

/**
 * Empty folder
 * @return string
 */
function noFiles()
{
	$html = "<div id='emptyFolder'>";
	$html .= "Üres mappa";
	$html .= "</div>";

	return $html;
}

/**
 * Attach icons to extensions in list view
 * @return string
 */
function fileExtension($file)
{
	$ext = str_replace(".", "", strrchr($file, '.'));
	$icon = "../images/icons/" . $ext . ".png";
	if (file_exists($icon)) {
		return "<img src='" . $icon . "'>";
	} else {
		return "<img src='../images/icons/noimage.gif'>";
	}
}

/**
 * Attach icons to extensions in miniature view
 * @return string
 */
function fileExtensionMiniature($file)
{
	$ext = str_replace(".", "", strrchr($file, '.'));
	$icon = "../images/icons/" . $ext . ".png";
	return $icon;
}

/**
 * Resize images
 * If necessary, copy the resized image with new name
 */
function createThumb($fileName, $newFileName, $newW, $newH, $dirName, $extension)
{
	// Attach pathname and extension to the name of the picture
	$newFileName = replaceChars($newFileName);
	$fullPathName = _URL . $dirName . "/" . $fileName . "." . $extension;
	$fullPathNewFileName = _URL . $dirName . "/" . $newFileName . "." . $extension;

	// Lower casing extensions
	$ext = strtolower($extension);
	if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {

		// List image sizes
		list($width, $height) = getimagesize($fullPathName);

		// If the new size is smaller than the old one
		if (($width >= $newW) || ($height >= $newH)) {
			if (preg_match('/jpg|jpeg/', $ext)) {
				$img=imagecreatefromjpeg($fullPathName);
			} elseif (preg_match('/png/', $ext)) {
				$img=imagecreatefrompng($fullPathName);
			} elseif (preg_match('/gif/', $ext)) {
				$img=imagecreatefromgif($fullPathName);
			}

			$newImg=imagecreatetruecolor($newW,$newH);

			if (preg_match('/jpg|jpeg/', $ext)) {
				imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newW, $newH, $width, $height);
				imagejpeg($newImg,$fullPathNewFileName,100);
			} elseif (preg_match('/png/', $ext)) {
				imagealphablending($newImg, false);
				imagesavealpha($newImg,true);
				$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
				imagefilledrectangle($newImg, 0, 0, $newW, $newH, $transparent);
				imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newW, $newH, $width, $height);

				imagepng($newImg,$fullPathNewFileName,9);
			} elseif (preg_match('/gif/', $ext)) {
				imagealphablending($newImg, false);
				imagesavealpha($newImg,true);
				$transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
				imagefilledrectangle($newImg, 0, 0, $newW, $newH, $transparent);
				imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newW, $newH, $width, $height);
				imagegif($newImg,$fullPathNewFileName);
			}
			imagedestroy($newImg);
			imagedestroy($img);
		} elseif (($width < $newW) || ($height < $newH)) {
			return false;
		}
	}
}

/**
 * Resize thumbnails for miniature view
 * @return array
 */
function resizeImg($img, $newWidth, $newHeight)
{
	list($width, $height) = getimagesize($img);

	$imgX = $width;
	$imgY = $height;

	if (($imgX > $newWidth) || ($imgY > $newHeight)) {
		if ($imgX > $imgY){
			$x = $newWidth;
			$y = $imgY * ($newHeight / $imgX);
		}
		if ($imgX < $imgY) {
			$x = $imgX * ($newWidth / $imgY);
			$y = $newHeight;
		}
		if ($imgX == $imgY) {
			$x = $newWidth;
			$y = $newHeight;
		}
	} else {
		$x = $imgX;
		$y = $imgY;
	}
	$imageSize['x'] = $x;
	$imageSize['y'] = $y;

	return $imageSize;
}

/**
 * Normalizing FILES method to upload
 * @return array
 */
function getNormalizedFILES()
{
    $newfiles = array();
    foreach ($_FILES as $fieldname=>$fieldvalue)
        foreach ($fieldvalue as $paramname=>$paramvalue)
            foreach ((array)$paramvalue as $index=>$value)
                $newfiles[$fieldname][$index][$paramname] = $value;
    return $newfiles;
} 

/**
 * Upload files to server
 * @return string or redirect to main page
 */
function fileUploadToServer ($dirName, $file)
{
	// Select url
	$myUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
	$myUrl .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	$uploadDir = _URL . $dirName . '/';
	$fileInfo = pathinfo($file['name']);
	$file['name'] = replaceChars($fileInfo['filename']) . '.' . $fileInfo['extension'];
	$uploadFile = $uploadDir . basename($file['name']);
	$html = '';
	if (move_uploaded_file ($file['tmp_name'], $uploadFile)) {
		header("Location: ../organizer.php");
	} else {
		$html .= '<h1>Uploading error!</h1>';
		switch ($file['error']) {
			case 1:
				$html .= 'The size of file is too big!';
				break;
			case 2:
				$html .= 'The size of file is too big!';
				break;
			case 3:
				$html .= 'File is just partly uploaded!';
				break;
			case 4:
				$html .= 'No selected file!';
				break;
			default:
				$html .= 'Unknown error!';
		}
		return $html;
	}
}

/**
 * Rename file
 */
function renameFile($oldName, $newName, $dirName, $extension)
{
	if (($oldName == $newName) || ($newName == "")) {
		return false;
	} else {
		$newName = replaceChars($newName);
		$fullPathName = _URL . $dirName . "/" . $oldName . "." . $extension;
		$fullPathNewFileName = _URL . $dirName . "/" . $newName . "." . $extension;
		copy($fullPathName, $fullPathNewFileName);
		unlink($fullPathName);
	}
}

/**
 * Replace incorrect characters
 * @return string;
 */
function replaceChars($text)
{
	if (!extension_loaded('iconv')) {
		trigger_error('The extension "iconv" is missing!');
	}

	// Replace non alphabet characters to "-", except the . before the extension
	$text = preg_replace('/[^\\pL\d]+/u', '-', $text);

	// Trim "-" chars from start and from end of the string
	$text = trim($text, '-');

	// Convert special chars to ASCII
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// Convert any chars to lowercase
	$text = strtolower($text);

	// Delete everything, which couldn't convert 
	$text = preg_replace('/[^-\w]+/', '', $text);

	return $text;
}

/**
 * Delete folder, include sub folders
 */
function deleteFolder($dir)
{
	$dirs = scandir($dir);
	foreach ($dirs as $key=>$value) {
		if ($value == "." || $value == ".." ) {
			unset($dirs[$key]);
		}
	}
	foreach ($dirs as $file) {
		if (!is_dir($dir . '/' . $file)) {
			unlink($dir . '/' . $file);
		} else {
			deleteFolder($dir . '/' . $file);
		}
	}
	rmdir($dir);
}

/**
 * Create new folder
 */
function newFolder($newName, $dirName)
{
	$newName = replaceChars($newName);
	mkdir($dirName . '/' . $newName, 0777);
}

/**
 * Rename folder
 */
function renameFolder($oldName, $newName, $dirName)
{
	$newName = replaceChars($newName);
	rename($dirName . '/' . $oldName, $dirName . '/' . $newName);
}
?>