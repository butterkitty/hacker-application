<head>
<style>
	div.kitty { position:absolute; }
</style>
</head>
<div id="thekitty" class="kitty">=^.^=</div>
<script type="text/javascript" src="Libraries/jquery.js"></script>
<script type="application/javascript">
var moveFrequency = 1000; //When to move in milliseconds
Kitty.prototype.SetName = function (){
	var randomnumber=Math.floor(Math.random()*6); //Generate a random number so as we can pick a random name
	if(randomnumber==0) {
		return "Darth Kitty";
	}
	else if(randomnumber==1) {
		return "Abbie Kitty";
	}
	else if(randomnumber==2) {
		return "Bella Kitty";
	}	
	else if(randomnumber==3) {
		return "Cherie Kitty";
	}	
	else if(randomnumber==4) {
		return "Donna Kitty";
	}
	else { return "Elise Kitty"; }	
}
Kitty.prototype.SetSpeed = function ()
{
	if (this.name=="Darth Kitty") { //Darth Kitty is fat so he has a large size automatically and doesn't move quickly :P
		return 5;
	}
	else {
		return Math.floor(Math.random()*5 + 20); //Generate a random speed from 1 up to 5 and return it
	}
}
Kitty.prototype.MoveKittyRandomly = function () {
	var randomnumber = Math.floor(Math.random()*4); //Is the kitty moving left, right, up, or down....or to an alternate dimension!!...naw that never happens
	var movement = kitty.speed;
	if (randomnumber==0 && kitty.positionleft >= movement + 1) { //Left and make sure the kitty doesn't move off the screen
		kitty.positionleft = kitty.positionleft - movement;
	}
	else if (randomnumber==1 && movement + kitty.positionleft <= screen.width ) { //Right
		kitty.positionleft = kitty.positionleft + movement;
	}
	else if (randomnumber==2 && kitty.positiontop >= movement + 1) { //Up
		kitty.positiontop = kitty.positiontop - movement;
	}
	else if (randomnumber==3 && movement + kitty.positiontop <= screen.height ) { //Down
		kitty.positiontop = kitty.positiontop + movement;
	}	
	document.getElementById("thekitty").style.top  = kitty.positiontop + "px";
	document.getElementById("thekitty").style.left = kitty.positionleft + "px";
	randomnumber = Math.floor(Math.random()*16); //Generate random number to see if kitty wants to mew .. decrease max number to max the kitty mew more frequently
	if (randomnumber == 0) {
		$(document).ready(function() {
			$("#thekitty").html("MEW");
		});
	}
	else if (randomnumber == 1) {
		$(document).ready(function() {
			$("#thekitty").html("MEW!!!");
		});
	}	
	else {
		$(document).ready(function() {
			$("#thekitty").html("=^.^=");
		});
	}	
}
function EatCursor() {
	document.body.style.cursor = "none";  
	$(document).ready(function() {
		$("#thekitty").html("OM NOM NOM NOM NOM");
	});
	window.setTimeout('ResetCursor()',1000);		
}
function ResetCursor() { //After eating it
	document.body.style.cursor = "default";
	$(document).ready(function() {
		$("#thekitty").html("=^.^=");
	});
}
function Kitty() {
	this.name = Kitty.prototype.SetName(); //The kitty needs a name
	this.speed = Kitty.prototype.SetSpeed(); //It also needs a speed
	this.positiontop = screen.height / 2;
	this.positionleft = screen.width / 2;
	document.getElementById("thekitty").style.top  = this.positiontop+'px';
	document.getElementById("thekitty").style.left = this.positionleft+'px';
}

var kitty = new Kitty(); //Create the kitty
window.setInterval('kitty.MoveKittyRandomly()',moveFrequency);

$(document).ready(function() { //If you click the kitty it'll do something
	$("#thekitty").click(function() {
		var randomnumber = Math.floor(Math.random()*11);
		if (randomnumber == 0) {//Do something funny (Eat the cursor)
 			EatCursor();
		}
		else { //Display kitty state
			alert("Name: " + kitty.name + "\nSpeed: " + kitty.speed + "\nLocation: " + kitty.positionleft + "x" + kitty.positiontop);
		}
	});
});



</script>
