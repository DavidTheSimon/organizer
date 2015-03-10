<?php
/**
 * Rename file
 *
 * @name renameFile.php
 * @author simonavad
 * @since 2011.12.09. 10:05:37
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body>
	<?php
	if (isset($_POST['renameSubmit'])) {
		if (isset($_POST['newName']) && $_POST['newName'] != "") {
			renameFile ($_POST['oldName'], $_POST['newName'], $_POST['dirName'], $_POST['extension']);
		}
		?>
	<script language="javascript">
			CloseDialog();
        </script>
	<?php
	}
	?>
	<form name="propertyForm" method="post" enctype="multipart/form-data">
		<div id="resizeForm">
			<table id="resizeTable">
				<tr>
					<td>New name of file:</td>
				</tr>
				<tr>
					<td><?php
					$fileInfo = pathinfo($_GET['fileUrl']);
					$fileName = $fileInfo['filename'];
					$dirName = $fileInfo['dirname'];
					$extension = $fileInfo['extension'];
					?> <input type="hidden" id="oldName"
						value="<?php echo $fileName ?>" name="oldName" /> <input
						type="hidden" id="dirName" value="<?php echo $dirName ?>"
						name="dirName" /> <input type="hidden" id="extension"
						value="<?php echo $extension ?>" name="extension" /> <input
						type="text" size="60" name="newName" id="newName"
						value="<?php echo $fileName; ?>" />
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Rename" id="renameSubmit"
						name="renameSubmit" /><input type="button" value="Cancel"
						onClick="JavaScript:window.close()" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
