<?php
/**
 * Iframe: files ordering by...
 *
 * @name order.php
 * @author simonavad
 * @since 2011.12.09. 10:05:49
 *
 */

session_start();
if (isset($_SESSION['isCorrect']) && $_SESSION['isCorrect'] == 1):

include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body onLoad="JavaScript:parentOrNot()">
	Order by:
	<a href="JavaScript:parent.sessionChanger('<?php echo $_SESSION['listType']; ?>', 'name')">Name</a>
	<a href="JavaScript:parent.sessionChanger('<?php echo $_SESSION['listType']; ?>', 'size')">Size</a>
	<a href="JavaScript:parent.sessionChanger('<?php echo $_SESSION['listType']; ?>', 'update')">Date</a>
</body>
</html>
<?php
endif;
?>
