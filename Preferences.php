<!-- Preferences
     Not sure if this will be one page or several
     I.e., Which stores you like... but that may be better as a list with rating like MyRecipes
     Cook slideshow options - auto-scroll, etc.
     Place to edit their cuisines?
-->

<!-- Common tools, php classes -->
<?php
	require_once "Includes/Global.inc.php";
?>

<!-- To do: Figure out preferences and actually do something with this page -->
<!DOCTYPE html>
<html lang="en">
  	<head>
  		<!-- Bootstrap copy -->
  		<!-- To do: Probably useful for search engines, should fill out -->
  		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<meta name="description" content="">
  		<meta name="author" content="">
  		<link rel="shortcut icon" href="../../assets/ico/favicon.ico">

  		<title>The Pantry Butler - Preferences</title>
  		
  		<!-- Common styles and javascript -->
  		<?php require_once "Includes/HTML.inc.php"; ?>
  		
  		<!-- Simple script to show mess of form buttons on page -->
  		<script>
			var show = true;
			
			function toggleShow() {
				if (show == false) {
					show = true;
					$('.mess').show();
				} else {
					show = false;
					$('.mess').hide();
				}
			}
			
			$(document).ready(function() {
				toggleShow(); //Initialize, if set div with style then it will ignore javascript toggle	
			});
  		</script>
  	</head>
  	
  	<body>
  		<?php require_once "Includes/Navbar.inc.php"; ?>
  	
  		<!-- Checkbox, all alone in the middle of the page -->
  		<div class="hidden-xs" style="margin: 33% 50% 27%";>
  			<span class="checkbox-inline"><input type="checkbox" onClick="toggleShow()"></span>
  		</div>
  		<div class="visible-xs" style="margin: 50% 50% 50%";>
  			<span class="checkbox-inline"><input type="checkbox"></span>
  		</div>
  		
  		<!-- Mess of form buttons -->
  		<div class="mess" style="position: absolute; top: 20%; left: 20%;">
			<div class="btn-group">
			  <button type="button" class="btn btn-info">Left</button>
			  <button type="button" class="btn btn-info">Middle</button>
			  <button type="button" class="btn btn-info">Right</button>
			</div>
	
			<div class="btn-toolbar" role="toolbar">
			  <div class="btn-group">...</div>
			  <div class="btn-group">...</div>
			  <div class="btn-group">...</div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-info">1</button>
			  <button type="button" class="btn btn-info">2</button>
			
			  <div class="btn-group">
			    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			      Dropdown
			      <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu">
			      <li><a href="#">Dropdown link</a></li>
			      <li><a href="#">Dropdown link</a></li>
			    </ul>
			  </div>
			</div>
			
			<h1 style="color: orangered;">FORMSPLOSION!!!</h1>
		</div>
  		
  	</body>
</html>
