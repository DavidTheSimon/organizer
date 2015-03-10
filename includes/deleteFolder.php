<?php
/**
 * Delete folder
 *
 * @name deleteFolder.php
 * @author simonavad
 * @since 2011.12.09. 10:08:31
 *
 */

include('functions.php');
if (isset($_GET['dirName'])) {
	deleteFolder($_GET['dirName']);
}
?>