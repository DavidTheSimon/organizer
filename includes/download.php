<?php
/**
 * Download file
 *
 * @name download.php
 * @author simonavad
 * @since 2011.12.09. 10:08:18
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');

if (isset($_GET['fileUrl']) && isset($_GET['name']))
{
	$download_file = str_replace(array("../"), array(""),$_GET['fileUrl']);
	$download_file_name = $_GET['name'];
	$handle = fopen($download_file, "r");
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$download_file_name);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($download_file));
	ob_clean();
	flush();
	readfile($download_file);
	fclose($handle);
	exit;
}
?>