<?php
	require_once("inc/checkadminlogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
            document.getElementById('main').innerHTML = result;            
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
      makeRequest('editadminusersDB.php', getstr);
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit CP DB - Users</title>
</head>

<body>
<form action="javascript:get(document.getElementById('admdb'));" name="admdb" id="admdb">
      Login:
        <input type="text" name="login" id="login" accesskey="1" tabindex="1">
      
      Password:
        <input type="text" name="passwd" id="passwd" accesskey="2" tabindex="2"><br>
      
      Perms:
          <select name="perms" id="perms" accesskey="3" tabindex="3">
          <option value="-1" selected>Any</option>
          <option value="100">Admin</option>
          <option value="75">Full</option>
          <option value="50">Read</option>
          <option value="0">None</option>
        </select>
              
      Group:
        <select name="group" id="group" accesskey="4" tabindex="4">
          <option value="-1" selected>Any</option>
          <option value="Administrators">Administrators</option>
          <option value="Managers">Managers</option>
          <option value="Trainees">Trainees</option>
        </select>
	<p>  
    <input type="submit" name="button" value="Submit" accesskey="5" tabindex="5">
    </p>
</form>
<hr />

<p>
<span name="main" id="main"></span>
</p>

</body>
</html>
