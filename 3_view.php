<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<title></title>
</head>
<body>
	<div class="container">
	
		<div class="row">
			<div class="col-md-6">
				<h3>Simple App Climate</h3>
				<table class="table">
					<tr>
						<td>Pilih Kota</td>
						<td>:</td>
						<td>
							<select name="city">
								<option disabled="" selected>Pilih Kota</option>
								<option value="Jakarta">Jakarta</option>
								<option value="Tokyo">Tokyo</option>
								<option value="London">London</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-6">
				
			</div>
			<div class="col-md-6">
				<table class="table">
					<tr>
						<td id="city">Kota</td>
						<td>Temperature</td>
						<td>Variance</td>
					</tr>
					<tbody id="result">

					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("select[name='city']").on("change",function(){
			$("#result").html("<tr><td colspan='3'>Loading....</td></tr>");
			
			$("#city").text($(this).val());
			$.get('3.php?city='+$(this).val(), function(data) {
				var output ="";
				$.each(data.data, function(index, val) {
					 output += "<tr>"+
					 	"<td>"+val.date+"</td>"+
					 	"<td>"+val.temperature+"</td>"+
					 	"<td>"+val.variance+"</td></tr>";
				});

				$("#result").html(output);
			});
		});
	});	
</script>
</html>