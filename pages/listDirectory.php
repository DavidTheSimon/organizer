<?php
/**
 * List files in current directory
 *
 * @name listDirectory.php
 * @author simonavad
 * @since 2011.12.09. 10:07:30
 *
 */

session_start();
if (isset($_SESSION['isCorrect']) && $_SESSION['isCorrect'] == 1):

include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body onLoad="JavaScript:parentOrNot()">
	<?php
	if (isset($_GET['dir'])){
		$dir = $_GET['dir'];
	} elseif (isset($_SESSION['dir'])) {
		$dir = $_SESSION['dir'];
	}
	if (isset($dir)){
		$dir = '../' . $_GET['dir'];
		$_SESSION['dir'] = $dir;
		if (isset($_SESSION['listType'])) {
			if ($_SESSION['listType'] == 'list')
				echo listFiles($dir);
			elseif ($_SESSION['listType'] == 'miniature')
			echo miniatureFiles($dir);
		} else {
			echo "Wrong view!";
		}
	}
	?>
	<script language="javascript" type="text/javascript">
		var urlInfo = '<?php echo $_SESSION['urlInfo']; ?>';
		var pathInfo = '<?php echo $_SESSION['pathInfo'] . '/' . _FOLDER . '/'; ?>';
		$(function() {
	  		$('.cmenuFile').contextMenu(menuFile,{theme:'vista'});
		});
	</script>
	<script language="javascript" type="text/javascript"
		src="<?php echo $_SESSION['urlInfo']; ?>/js/contextMenu.js"></script>
</body>
</html>
<?php
endif;
?>