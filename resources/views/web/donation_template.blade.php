<!DOCTYPE html>
<html>
<head>
	<title>eSangam :: Mailer</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		html{ height:100%;}
		body{ font-family: Arial; font-size:14px; font-weight:normal; height:100%; margin: 0; padding: 0;}
		a{transition: all 0.2s ease 0s;}
		a:hover,a:focus,a:visited{ text-decoration:none; outline:none;}
		.main{
			width: 600px;
			margin: 0px auto;
		}
		@media only screen and (max-width : 580px) {
			.main{
				width: 95%;
			}
		}
  	</style>
  
</head>
<body>
<table class="main" style="margin: 0px auto;" cellspacing="0" cellspacing="0" border="0">
	<tr>
		<td style="background: #f4f4f4; padding: 10px 0; text-align: center;">
			<img src="{{ URL::to('/') }}/images/Mail_Temolate/logo.png" alt="eSangam Logo" />
		</td>
	</tr>
	<tr>
		<td style="padding: 10px 0; text-align: center; border-bottom: 1px solid #e9e9e9;">
			<h1 style="color: #288dcc; margin: 0; padding: 20px 0;">Thank You for donating @ christianity</h1>
		</td>
	</tr>

	<tr>
		<td style="padding: 10px 0; text-align: center; border-bottom: 1px solid #e9e9e9;">
			<h5 style="color: #222; font-family: arial; font-size: 18px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Dear <?php echo $donation->first_name.' '.$donation->last_name; ?>,</h5>
			<p style="color: #999999; font-family: arial; font-size: 16px; text-decoration: none; font-weight: normal; line-height: 25px;"> Thank you for your generous grant of <?php echo '$'.$donation->donation_amount; ?> for Christianity Engaged, your assistance means so much to us.</p>
		</td>
	</tr>
	<tr>
		<td style="padding: 15px 0; border-bottom: 1px solid #e9e9e9;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="text-align: left;">
						Reference ID: <span style="color: #f68623;"><?php echo $donation->id ?></span>
					</td>
					<td style="text-align: right;">
						Donated On: <?php echo date('Y-m-d',strtotime($donation->donation_date)); ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="padding: 15px 0 0;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="text-align: left;">
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Donar's Address</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"><?php echo $donation->address_line_1;?><br>
							<?php echo $donation->address_line_2;?><br>
							<?php echo $donation->city.','.$donation->state;?><br>
							<?php echo 'Pin Code'.$donation->zipcode.','.$donation->state;?></p>
					</td>
					<td style="text-align: right;">
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Phone Number</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"><?php  echo $donation->phone; ?></p>
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Donation Amount	</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"><?php echo '$'.$donation->donation_amount; ?></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="padding: 15px 0; border-bottom: 1px solid #e9e9e9;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="text-align: left;">
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Customer Service</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;">Have questions? Feel free to write us at <br>
							christianity.com/donation, we love to hear from you.</p>
					</td>
					<td style="text-align: right;">
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Stay Connected</h6>
						<p><a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/facebook_icon.png" alt="Facebook Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/twitter_icon.png" alt="Twitter Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/googleplus_icon.png" alt="Google Plus Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/linkedin_icon.png" alt="Linked In Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/pinterest_icon.png" alt="Pinterest Icon"></a></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="background: #015ca3; padding: 10px 0;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style=" padding-left: 10px;">
						
						<small style="color: #FFF; font-family: arial; font-size: 11px; font-weight: normal;">© Copyright 2022 christianity. All rights reserved.</small>

					</td>
					<td style="text-align: right; padding-right: 10px;">
						<a href="mailto:info@esangam.com" style="color: #FFF; font-family: arial; font-size: 13px; text-decoration: none; font-weight: normal;">info@christianity.com</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>
</body>
</html>