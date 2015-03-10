<?php
session_start();
$pathInfo = pathinfo(__FILE__);
$_SESSION['pathInfo'] = str_replace("\\", "/", $pathInfo['dirname']);
$_SESSION['urlInfo'] = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$_SESSION['isCorrect'] = 1;

if (!isset($_SESSION['listType'])) {
	$_SESSION['listType'] = 'list';
}
if (!isset($_SESSION['sortBy'])) {
	$_SESSION['sortBy'] = 'name';
}
if (!isset($_SESSION['sortType'])) {
	$_SESSION['sortType'] = 'ASC';
}

include($_SESSION['pathInfo'] . '/includes/functions.php');
include($_SESSION['pathInfo'] . '/includes/header.php');

?>
<body onLoad="JavaScript:iframeLoader('<?php echo _FOLDER; ?>')">
	<div id="main">
    	<div id="notice">
        Test version! Max upload size 1024KB
        </div>
		<div id="dirs">
			<h1>Your folders</h1>
			<?php echo directories(_FOLDER); ?>
			<script language="javascript" type="text/javascript">
			var urlInfo = '<?php echo $_SESSION['urlInfo']; ?>';
			var pathInfo = '<?php echo $_SESSION['pathInfo'] . '/' . _FOLDER . '/'; ?>';
			$(function() {
			  $('.cmenuDirectory').contextMenu(menuDirectory,{theme:'vista'});
			});
			</script>
			<script language="javascript"
					type="text/javascript"
				    src="<?php echo $_SESSION['urlInfo']; ?>/js/contextMenu.js">
			</script>
		</div>
		<div id="files">
			<div id="bottombar">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td><a id="uploadLink" href="<?php echo $_SESSION['urlInfo']; ?>/pages/uploadFile.php">Upload files</a>
						</td>
						<td><iframe id="orderFrame" frameborder="0" width="250"
								height="20" src="<?php echo $_SESSION['urlInfo']; ?>/pages/order.php"></iframe>
						</td>
						<td align="right">View: <a
							href="JavaScript:sessionChanger('list', '<?php echo $_SESSION['sortBy']; ?>')">List</a>
							<a
							href="JavaScript:sessionChanger('miniature', '<?php echo $_SESSION['sortBy']; ?>')">Miniature</a>
						</td>
					</tr>
				</table>
			</div>
			<div id="content">
				<iframe id="showFrame" frameborder="0" src=""></iframe>
			</div>
		</div>
	</div>
	<div id="txtHint"></div>
</body>
</html>
