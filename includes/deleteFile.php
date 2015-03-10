<?php
/**
 * Delete files
 *
 * @name deleteFile.php
 * @author simonavad
 * @since 2011.12.09. 10:08:40
 *
 */

if (isset($_GET['fileUrl'])) {
	unlink($_GET['fileUrl']);
}
?>