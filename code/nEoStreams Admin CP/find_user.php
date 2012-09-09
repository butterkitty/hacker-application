<?php 
require_once("inc/checklogin.php");
require_once("settings.php");
//-------------------------------------------BEGINNING OF PERMS
require_once("Connections/panelDB.php");
$perms = getpageperms($_SERVER['PHP_SELF']);


if ($debug == 1)
{
	echo "<br />User: ". $_SESSION['user'];
	echo "<br />User Group: ". $_SESSION['group'];
	echo "<br />User Perms: ". $_SESSION['perms'];
	echo "<br />Current Allowed Perms: ".$perms;
}
if ($perms == 0) { echo "<br />INSUFFICIENT PERMISSIONS TO VIEW"; exit; }
//--------------------------------------------END OF PERMS
?>
<html>
<head>
<script type="text/javascript" language="javascript">
   var http_request = false;
   function makeRequest(url, parameters) {
      http_request = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request.onreadystatechange = alertContents;
      http_request.open('GET', url + parameters, true);
      http_request.send(null);
   }

   function alertContents() {
      if (http_request.readyState == 4) {
         if (http_request.status == 200) {
            //alert(http_request.responseText);
            result = http_request.responseText;
            document.getElementById('myspan').innerHTML = result;            
         } else {
            alert('There was a problem with the request.');
         }
      }
   }
   function get(obj) {
      var getstr = "?";
      for (i=0; i<obj.childNodes.length; i++) {
		 
         if (obj.childNodes[i].tagName == "INPUT") {
            if (obj.childNodes[i].type == "text") {
               getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }
            if (obj.childNodes[i].type == "checkbox") {
               if (obj.childNodes[i].checked) {
                  getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
               } else {
                  getstr += obj.childNodes[i].name + "=&";
               }
            }
            if (obj.childNodes[i].type == "radio") {
               if (obj.childNodes[i].checked) {
                  getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
               }
            }
         }   
         if (obj.childNodes[i].tagName == "SELECT") {
            var sel = obj.childNodes[i];
            getstr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
         }

      }
      getstr += "&unique=" + randomString();	  
      makeRequest('finduserDB.php', getstr);
   }
function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 12;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	return randomstring;
}
   
</script>
<title>nEoStreams Admin Control Panel - Find Stream</title>
</head>
<body>
<form action="javascript:get(document.getElementById('userSCfrm'));" name="userSCfrm" id="userSCfrm">
      Avatar Name:
        <input type="text" name="name" id="name" accesskey="1" tabindex="1">
      
      Avatar Key:
        <input type="text" name="key" id="key" accesskey="2" tabindex="2"><br>
      
      Type:
        <select name="type" id="type" accesskey="3" tabindex="3">
		  <option value="ANY" selected>ANY</option>
          <option value="SC">SC</option>
          <option value="ICE">ICE</option>
          <option value="AUTO">AUTO</option>
        </select>
      Region:
        <select name="region" id="region" accesskey="4" tabindex="4">
          <option value="ANY" selected>ANY</option>
          <option value="US">US</option>
          <option value="EU">EU</option>
        </select><br>
    
    
      Stream IP:
        <input type="text" name="ip" id="ip" accesskey="5" tabindex="5">
      
        
		Stream Port:
        <input type="text" name="port" id="port" accesskey="6" tabindex="6">
<br>
      Co-Owner:
        <input type="text" name="coowner" id="coowner" accesskey="7" tabindex="7">
      
    
    
      &nbsp;
      Email
        <input type="text" name="email" id="email" accesskey="8" tabindex="8">
      
      &nbsp;
    
  <p>
  
    <input type="submit" name="button" value="Submit" accesskey="9" tabindex="9">
    
  </p>
</form>


<hr />
<p>&nbsp; </p>
<span name="myspan" id="myspan"></span>

</body>
</html>