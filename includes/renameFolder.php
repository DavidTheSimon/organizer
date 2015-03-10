<?php
/**
 * Rename folder
 *
 * @name renameFolder.php
 * @author simonavad
 * @since 2011.12.09. 10:05:27
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body>
	<?php
	if (isset($_POST['renameFolderSubmit'])) {
		if (isset($_POST['newName']) && $_POST['newName'] != "" && $_POST['dirName'] != $_POST['newName']) {
			renameFolder ($_POST['dirName'], $_POST['newName'], $_POST['pathName']);
		}
		?>
	<script language="javascript">
				CloseDialog();
        </script>
	<?php
	}
	?>
	<form name="propertyForm" method="post" action=""
		enctype="multipart/form-data">
		<div id="resizeForm">
			<table id="resizeTable">
				<tr>
					<td>New name of folder:</td>
				</tr>
				<tr>
					<td><input type="hidden" id="dirName"
						value="<?php echo $_GET['dirName']; ?>" name="dirName" /> <input
						type="hidden" id="pathName"
						value="<?php echo $_GET['pathName']; ?>" name="pathName" /> <input
						type="text" size="60" name="newName" id="newName"
						value="<?php echo $_GET['dirName']; ?>" />
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Rename" id="renameFolderSubmit"
						name="renameFolderSubmit" /><input type="button" value="Cancel"
						onClick="JavaScript:window.close()" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
