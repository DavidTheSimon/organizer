<?php
/**
 * Upload file
 *
 * @name uploadFile.php
 * @author simonavad
 * @since 2011.12.09. 10:09:07
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body>
	<div id="main">
		<?php
		if (isset($_POST['uploadSubmit'])) {
			$dirName = $_POST['dirName'];
			foreach (getNormalizedFILES() as $keys){
				foreach ($keys as $key=>$value){
					fileUploadToServer ($dirName, $value);
				}
			}
		}
		?>
		<form id="uploadForm" enctype="multipart/form-data" method="POST">
			<fieldset>
				<legend>Upload files</legend>
				<ul id="upload">
					<li>
                    	<label for="fileName">Browse: </label> 
                        <input name="MAX_FILE_SIZE" value="1048576" type="hidden" />
                        <input name="fileName[]" id="fileName" type="file" multiple="" />
                        <input type="hidden" id="dirName" value="<?php echo $_GET['dirName'] ?>" 
                        name="dirName" />
					</li>
				</ul>
			</fieldset>
			<input type="submit" name="uploadSubmit" value="Upload" />
		</form>
	</div>
</body>
</html>
