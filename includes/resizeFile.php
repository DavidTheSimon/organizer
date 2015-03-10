<?php
/**
 * Resize file
 *
 * @name resizeFile.php
 * @author simonavad
 * @since 2011.12.09. 10:05:06
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body>
	<?php
	if (isset($_POST['resizeSubmit'])) {
		if (isset($_POST['imgNewCheck']) && $_POST['imgNewCheck'] == 1) {
			echo createThumb ($_POST['fileName'], $_POST['imgNew'], $_POST['imgWidth'], $_POST['imgHeight'], $_POST['dirName'], $_POST['extension']);
			?>
	<script language="javascript">
				CloseDialog();
			</script>
	<?php
		} else {
			echo createThumb ($_POST['fileName'], $_POST['fileName'], $_POST['imgWidth'], $_POST['imgHeight'], $_POST['dirName'], $_POST['extension']);
			?>
	<script language="javascript">
				CloseDialog();
			</script>
	<?php
		}
	}
	?>
	<form name="propertyForm" method="post" action=""
		enctype="multipart/form-data">
		<div id="resizeImage">
			<img src="<?php echo "../" . $_GET['fileUrl'] ?>"
				style="visibility: visible" onload="resizeLogicalImage()" id="image" />
		</div>
		<div id="resizeForm">
			<?php
			$fileInfo = pathinfo($_GET['fileUrl']);
			$fileName = $fileInfo['filename'];
			$dirName = $fileInfo['dirname'];
			$extension = $fileInfo['extension'];
			?>
			<input type="hidden" id="fileName" value="<?php echo $fileName ?>"
				name="fileName" /> <input type="hidden" id="dirName"
				value="<?php echo $dirName ?>" name="dirName" /> <input
				type="hidden" id="extension" value="<?php echo $extension ?>"
				name="extension" /> <strong>New dimensions:</strong><br>
			<table id="resizeTable">
				<tr>
					<td>Width:</td>
				</tr>
				<tr>
					<td><input type="text" size="10" id="imgWidth" name="imgWidth"
						onBlur="newProperty('width',this.value)" /> px</td>
				</tr>
				<tr>
					<td>Height:</td>
				</tr>
				<tr>
					<td><input type="text" size="10" id="imgHeight" name="imgHeight"
						onBlur="newProperty('height',this.value)" /> px</td>
				</tr>
				<tr>
					<td><input type="hidden" size="6" id="imgWidthHidden" /> <input
						type="hidden" size="6" id="imgHeightHidden" /> <input
						type="checkbox" id="imgNewCheck" name="imgNewCheck"
						onChange="createNewImageName()" value="1" /> Create new image</td>
				</tr>
				<tr>
					<td><input type="text" id="imgNew" name="imgNew" size="60" value=""
						style="visibility: hidden" />
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Resize" id="resizeSubmit"
						name="resizeSubmit" /> <input type="button" value="Cancel"
						onClick="JavaScript:window.close()" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
