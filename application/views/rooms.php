<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">
		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}

		#roomsList {
			margin: 20px;
			border: 1px solid #D0D0D0;
			padding: 20px;
			width: 300px;
			border-spacing: 20px;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		crossorigin="anonymous"></script>
</head>
<body>

<div id="container">
	<h1>Welcome to VC!</h1>

	<div id="body">
		<form action="">
			<input type="text" id="name" name="name" placeholder="room name">
			<input type="submit" value="Create">
		</form>
		<table id="roomsList" >
		</table>
	</div>
</div>

</body>
<script type="text/javascript">
	let token = 'OGE0MmJlYzctNjQwZC00MjBmLTg4NmQtMWM0ZTQyOGVlMTU3MjEzNGJlYTQtMzcy_PF84_consumer';
	
	$(document).ready(function(){
		getAllRooms();

		function getAllRooms() {
			$.ajax({
					url: "https://webexapis.com/v1/rooms",
					method: "GET",
					beforeSend: (function (xhr) {
						xhr.setRequestHeader("Authorization", "Bearer " + token );
					}),
					success: function(data, status) {
						let finalText = ''
						$.each( data.items, function( key, value ) {
							// console.log( key + ": " );
							// console.log( value );

							// created: "2020-07-06T11:10:08.991Z"
							// creatorId: "Y2lzY29zcGFyazovL3VzL1BFT1BMRS8xZmNiZWU5MC02N2E3LTQyZGEtOWFiOS0yNjA3NjY0MTZkNDQ"
							// id: "Y2lzY29zcGFyazovL3VzL1JPT00vNDBmNDFlZjAtYmY3OS0xMWVhLTk2ZTQtMWJjMDIyZmYwZjBj"
							// isLocked: true
							// lastActivity: "2020-07-06T11:10:08.991Z"
							// ownerId: "Y2lzY29zcGFyazovL3VzL09SR0FOSVpBVElPTi9jb25zdW1lcg"
							// teamId: "Y2lzY29zcGFyazovL3VzL1RFQU0vNDBmNDFlZjAtYmY3OS0xMWVhLTk2ZTQtMWJjMDIyZmYwZjBj"
							// title: "PS"
							// type: "group"
							finalText += "<tr><td>"+value.title+"</td><td><input type='button' onclick='joinRoom(\""+value.id+"\")' value='Join'></td></tr>";
						});
						$("#roomsList").html(finalText);
					}
				});
		}
		

		$("form").submit(function(e) {
			e.preventDefault();
			let name = $('#name').val();

			$.ajax({
					url: "https://webexapis.com/v1/rooms",
					method: "POST",
					data: {
						title: name
					},
					beforeSend: (function (xhr) {
						xhr.setRequestHeader("Authorization", "Bearer " + token );
					}),
					success: function(data, status) {
						$('#name').val('');
						getAllRooms();
					}
				});

		});
	});

	function joinRoom(id) {
		$.ajax({
				url: "https://webexapis.com/v1/rooms/"+id+"/meetingInfo",
				method: "GET",
				beforeSend: (function (xhr) {
					xhr.setRequestHeader("Authorization", "Bearer " + token );
				}),
				success: function(data, status) {
					console.log(data);
				}
			});

	}
</script>

</html>