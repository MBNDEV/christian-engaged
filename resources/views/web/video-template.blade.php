<!DOCTYPE html>
<html>
<head>
	<title>Christianity</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="{{ asset('js/video-template.js') }}"></script>
  	<style type="text/css">
		html{ height:100%;}
		body{ font-family: 'Roboto Condensed'; font-size:14px; font-weight:400; height:100%; margin: 0; padding: 0;}
		a{transition: all 0.2s ease 0s;}
		a:hover,a:focus,a:visited{ text-decoration:none; outline:none;}

		@media only screen and (max-width : 580px) {
			.main{
				width: 95%;
				font-family: 'Roboto Condensed';
			}
		}

.page-break {
    page-break-after: always;
}
</style>
  	

</head>
<body >
<table style="width: 600px; margin: 0px auto; font-family: 'Roboto Condensed';" cellspacing="0" cellspacing="0" border="0">
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			<!-- <img src="images/Video-template/header.jpg" alt="Christianity Header"> -->
			<img src="images/Video-template/header.jpg" alt="Christianity Header">
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td style="background: url('{{ asset('images/Video-template/middle.jpg') }}') no-repeat; height: 580px; font-family: 'Roboto Condensed'; font-size: 16px; line-height: 25px; vertical-align: top;">
			
			<p style="font-family: 'Roboto Condensed';"><?php echo $body; ?></p>

		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr class="page-break">
		<td>
			<img src="images/Video-template/footer.jpg" alt="Christianity Footer">
		</td>
	</tr>
</table>
</body>
</html>
