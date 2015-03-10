// dropdown
$(document).ready(function() {
  $("li.dirs").click(function() {
	$("ul.dirs", this).toggle();
	return false;
  });        
});

// iframe only in parent
function parentOrNot() {
	if (window.parent.location == window.location) {
		document.location.href = "404.php";
	}
}

// Redirect if Javascript is enabled
function reDirect()
{
	document.location.href="../organizer.php";
}

// iframe source
function iframeLoader(source)
{
	var showFrame=document.getElementById("showFrame"); 
	showFrame.src = "pages/listDirectory.php?dir=" + source;
	document.getElementById("uploadLink").href = "pages/uploadFile.php?dirName="+source;
	
}

// Close dialog and reload parent
function CloseDialog()
{
	window.close();
	window.opener.location.reload();
}

// Change the session for type of view and sorting
function sessionChanger(listType, sortBy)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var content = document.getElementById('showFrame');
		content.src = content.src;
		var order = document.getElementById('orderFrame');
		order.src = order.src;
	}
  }
xmlhttp.open("GET","includes/sessionChanger.php?listType="+listType+"&sortBy="+sortBy,true);
xmlhttp.send();
}

// Resize logically the image and write the size into a text input
function resizeLogicalImage()
{
	var width = document.getElementById("image").width;
	var height = document.getElementById("image").height;
	
	if (width>200)
	{
		document.getElementById("image").width=200;
	}
	document.getElementById("image").style.display = "block";
	
	document.getElementById("imgWidth").value = width;
	document.getElementById("imgHeight").value = height;
	document.getElementById("imgWidthHidden").value = width;
	document.getElementById("imgHeightHidden").value = height;
}

// New dimensions of the image, keeping the ratio
function newProperty(obj, values)
{
	var width = document.getElementById("imgWidthHidden").value;
	var height = document.getElementById("imgHeightHidden").value;
	switch (obj) {
		case 'width':
		{
			var newHeight = Math.round(height / (width / values));
			document.getElementById("imgHeight").value = newHeight;
			document.getElementById("imgWidthHidden").value = values;
			document.getElementById("imgHeightHidden").value = newHeight;
		}
		break;
		case 'height':
		{
			var newWidth = Math.round(width / (height / values));
			document.getElementById("imgWidth").value = newWidth;
			document.getElementById("imgWidthHidden").value = newWidth;
			document.getElementById("imgHeightHidden").value = values;
		}
		break;
	}
}

// Rename image if checkbox is thicked
function createNewImageName()
{
	var check = document.getElementById("imgNewCheck").checked;
	if (check == true){
		document.getElementById("imgNew").value = document.getElementById("fileName").value;
		document.getElementById("imgNew").style.visibility = 'visible';
	} else {
		document.getElementById("imgNew").value = "";
		document.getElementById("imgNew").style.visibility = 'hidden';
	}
}