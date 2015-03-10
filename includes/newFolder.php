<?php
/**
 * Create new folder form
 *
 * @name newFolder.php
 * @author simonavad
 * @since 2011.12.09. 10:07:10
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body>
	<?php
	if (isset($_POST['newFolderSubmit'])) {
		if (isset($_POST['newName']) && $_POST['newName'] != "") {
			newFolder ($_POST['newName'], $_POST['dirName']);
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
					<td>Name of new folder:</td>
				</tr>
				<tr>
					<td><input type="hidden" id="dirName"
						value="<?php echo $_GET['dirName']; ?>" name="dirName" /> <input
						type="text" size="60" name="newName" id="newName" value="" />
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Create" id="newFolderSubmit"
						name="newFolderSubmit" /><input type="button" value="Cancel"
						onClick="JavaScript:window.close()" />
					</td>
				</tr>
			</table>
		</div>
	</form>
</body>
</html>
