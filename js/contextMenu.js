// File list right click menu
var menuFile = [
		{
			'Download' : {
				onclick : function(menuItem, menu) {
					var fileUrl = this.rel
					var fileName = this.title;
					fileUrl = fileUrl.replace('../', '');
					window.location.href = urlInfo + "/includes/download.php?fileUrl=" + fileUrl + "&name=" + fileName;
				},
				icon : '../images/download.png',
				disabled : false
			}
		},
		{
			'Open' : {
				onclick : function(menuItem, menu) {
					var fileName = this.title;
					var fileUrl = this.rev + "/" + this.title;
					fileUrl = fileUrl.replace('../', '');
					var parts = fileName.split('.');
					var ext = parts[parts.length - 1].toLowerCase();
					if (ext == 'jpg' || ext == 'jpeg' || ext == 'png'
							|| ext == 'gif') {
						window.open(urlInfo + "/" + fileUrl, "_blank");
					} else {
						return false;
					}
				},
				icon : '../images/search.png',
				disabled : false
			}
		},
		{
			'Resize' : {
				onclick : function(menuItem, menu) {
					var fileName = this.title;
					var fileUrl = this.rev + "/" + this.title;
					fileUrl = fileUrl.replace('../', '');
					var parts = fileName.split('.');
					var ext = parts[parts.length - 1].toLowerCase();
					if (ext == 'jpg' || ext == 'jpeg' || ext == 'png'
							|| ext == 'gif') {
						window
								.showModalDialog(
										urlInfo + "/includes/resizeFile.php?fileUrl="
												+ fileUrl, "dialog",
										"dialogWidth:600px; dialogHeight:400px; center:yes");
					} else {
						return false;
					}
				},
				icon : '../images/resize.png',
				disabled : false
			}
		},
		$.contextMenu.separator,
		{
			'Rename' : {
				onclick : function(menuItem, menu) {
					var fileUrl = this.rev + "/" + this.title;
					fileUrl = fileUrl.replace('../', '');
					window
							.showModalDialog(
									urlInfo + "/includes/renameFile.php?fileUrl="
											+ fileUrl, "dialog",
									"dialogWidth:400px; dialogHeight:150px; center:yes");
				},
				icon : '../images/rename.png',
				disabled : false
			}
		},
		$.contextMenu.separator,
		{
			'Delete' : {
				onclick : function(menuItem, menu) {
					var fileUrl = this.rev + "/" + this.title;
					var r = confirm("Are you sure you would like to delete the file?");
					if (r == true) {
						Del(fileUrl);
					}
					function Del(fileUrl) {
						if (window.XMLHttpRequest) {// code for IE7+, Firefox,
													// Chrome, Opera, Safari
							xmlhttp = new XMLHttpRequest();
						} else {// code for IE6, IE5
							xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
							if (xmlhttp.readyState == 4
									&& xmlhttp.status == 200) {
								window.location.reload();
							}
						}
						xmlhttp
								.open("GET",
										urlInfo + "/includes/deleteFile.php?fileUrl="
												+ fileUrl, true);
						xmlhttp.send();
					}
				},
				icon : '../images/delete.png',
				disabled : false
			}
		} ];
// Folder list right click menu
var menuDirectory = [
		// $.contextMenu.separator,
		{
			'New Folder' : {
				onclick : function(menuItem, menu) {
					var dirName = this.title;
					window
							.showModalDialog(urlInfo+"/includes/newFolder.php?dirName="
									+ dirName, "dialog",
									"dialogWidth:400px; dialogHeight:150px; center:yes");
				},
				icon : "images/new.png",
				disabled : false
			}
		},
		$.contextMenu.separator,
		{
			'Rename' : {
				onclick : function(menuItem, menu) {
					var dir = this.title;
					var dirName = this.rel;
					var pathName = this.rev;
					if (dir == pathInfo)
						return false;
					else {
						window
								.showModalDialog(
										urlInfo +"/includes/renameFolder.php?dirName="
												+ dirName + "&pathName="
												+ pathName, "dialog",
										"dialogWidth:400px; dialogHeight:150px; center:yes");
					}
				},
				icon : 'images/rename.png',
				disabled : false
			}
		},
		$.contextMenu.separator,
		{
			'Delete' : {
				onclick : function(menuItem, menu) {
					var dir = this.title;
					var dirName = this.title;
					if (dir == pathInfo)
						return false;
					else {
						function Del(dirName) {
							if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp = new XMLHttpRequest();
							} else {// code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function() {
								if (xmlhttp.readyState == 4
										&& xmlhttp.status == 200) {
									window.location.reload();
									//document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
								}
							}
							xmlhttp.open("GET",
									urlInfo + "/includes/deleteFolder.php?dirName="
											+ dirName, true);
							xmlhttp.send();
						}
						var r = confirm("Are you sure you would like to delete the folder?");
						if (r == true) {
							Del(dirName);
						}
					}
				},
				icon : 'images/delete.png',
				disabled : false
			}
		} ];