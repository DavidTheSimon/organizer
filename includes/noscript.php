<?php
/**
 * If javascript is disabled
 *
 * @name noscript.php
 * @author simonavad
 * @since 2011.12.09. 10:06:35
 *
 */

session_start();
include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');
?>
<body onLoad='JavaScript:reDirect();'>
	<div style="float: left; margin-left: 10px;">
		JavaScript is disabled. Please enable it to continue!
	</div>
</body>
</html>
