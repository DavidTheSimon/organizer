<?php
/**
 * 404 error page
 *
 * @name 404.php
 * @author simonavad
 * @since 2011.12.09. 10:08:51
 *
 */

header("Content-Type: text/html; charset=UTF-8");
header('HTTP/1.1 404 Not Found');
echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\n<html><head>\n<title>404 Not Found</title>\n</head>";
echo "<body>\n<h1>404 - The page is not found</h1>\n<p>The requested url was not found on this server.</p>\n";
echo "<hr>\n".$_SERVER['SERVER_SIGNATURE']."\n</body></html>\n";
exit;
?>