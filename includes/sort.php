<?php
/**
 * Sort files
 *
 * @name sort.php
 * @author simonavad
 * @since 2011.12.09. 10:03:41
 *
 */

if (isset($_SESSION['isCorrect']) && $_SESSION['isCorrect'] == 1):

// Sort by name ASC
if ($_SESSION['sortBy'] == 'name' && $_SESSION['sortType'] == 'ASC')
	sort($dirs, SORT_LOCALE_STRING);
// Sort by name DESC
else if ($_SESSION['sortBy'] == 'name' && $_SESSION['sortType'] == 'DESC')
	rsort($dirs, SORT_LOCALE_STRING);
// Sort by date ASC
else if ($_SESSION['sortBy'] == 'update' && $_SESSION['sortType'] == 'ASC') {
	if (!empty($dirs)){
		foreach ($dirs as $file) {
			$arrayTmp [$file]= filemtime($dir . '/' . $file);
		}
		asort($arrayTmp, SORT_NUMERIC);
		unset($dirs);
		foreach ($arrayTmp as $key => $value) {
			$dirs []= $key;
		}
	}
}
// Sort by date DESC
else if ($_SESSION['sortBy'] == 'update' && $_SESSION['sortType'] == 'DESC') {
	if (!empty($dirs)){
		foreach ($dirs as $file) {
			$arrayTmp [$file]= filemtime($dir . '/' . $file);
		}
		arsort($arrayTmp, SORT_NUMERIC);
		unset($dirs);
		foreach ($arrayTmp as $key => $value) {
			$dirs []= $key;
		}
	}
}
// Sort by size ASC
else if ($_SESSION['sortBy'] == 'size' && $_SESSION['sortType'] == 'ASC') {
	if (!empty($dirs)){
		foreach ($dirs as $file) {
			$arrayTmp [$file]= filesize($dir . '/' . $file);
		}
		asort($arrayTmp, SORT_NUMERIC);
		unset($dirs);
		foreach ($arrayTmp as $key => $value) {
			$dirs []= $key;
		}
	}
}
// Sort by size DESC
else if ($_SESSION['sortBy'] == 'size' && $_SESSION['sortType'] == 'DESC') {
	if (!empty($dirs)){
		foreach ($dirs as $file) {
			$arrayTmp [$file]= filesize($dir . '/' . $file);
		}
		arsort($arrayTmp, SORT_NUMERIC);
		unset($dirs);
		foreach ($arrayTmp as $key => $value) {
			$dirs []= $key;
		}
	}
}
endif;
?>