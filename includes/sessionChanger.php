<?php
/**
 * Changing the sessions: type of order, list or miniature view
 *
 * @name sessionChanger.php
 * @author simonavad
 * @since 2011.12.09. 10:04:11
 *
 */

session_start();
if (isset($_GET['listType'])){
	$_SESSION['listType'] = $_GET['listType'];
}
if (isset($_GET['sortBy'])){
	if ($_GET['sortBy'] == $_SESSION['sortBy']) {
		if ($_SESSION['sortType'] == 'ASC') {
			$_SESSION['sortType'] = 'DESC';
		} elseif ($_SESSION['sortType'] == 'DESC') {
			$_SESSION['sortType'] = 'ASC';
		}
	} else {
		$_SESSION['sortBy'] = $_GET['sortBy'];
		$_SESSION['sortType'] == 'ASC';
	}
}
?>