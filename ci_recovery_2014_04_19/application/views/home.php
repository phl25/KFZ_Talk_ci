<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	
	<body>
		<div id="container">
			<p>My view has been loaded</p>
		
			<?php foreach ($rows as $r) {
				
				echo '<h1>' . $r->title . '</h1>';
				echo $r->content;
					
			}
			
			?>
		
		</div>
		
		
		
	</body>
	
</html>