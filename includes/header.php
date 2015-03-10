<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	if ($_SERVER['SCRIPT_FILENAME'] != $_SESSION['pathInfo'] . '/includes/noscript.php') {
		echo "<noscript> <meta http-equiv=refresh content='0; URL=" . $_SESSION['urlInfo'] . "/includes/noscript.php' /> </noscript>";
	}
?>

<link type="text/css" href="<?php echo $_SESSION['urlInfo']; ?>/css/style.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $_SESSION['urlInfo']; ?>/css/jquery.contextmenu.css" rel="stylesheet" />
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['urlInfo']; ?>/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['urlInfo']; ?>/js/jquery.contextmenu.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_SESSION['urlInfo']; ?>/js/myScript.js"></script>
</head>