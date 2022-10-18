<!DOCTYPE html>
<?php //echo "<pre>"; print_r($data['orderItems']);
$orderItems =$data['orderItems'];
$orderdetails =$data['orderdetails'];
//print_r($data['orderdetails']);
 ?>
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
			<h1 style="color: #288dcc; margin: 0; padding: 20px 0;">Thank You for placing order @ christianity</h1>
		</td>
	</tr>

	<tr>
		<td style="padding: 10px 0; text-align: center; border-bottom: 1px solid #e9e9e9;">
			<h5 style="color: #222; font-family: arial; font-size: 18px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Dear <?php echo $orderdetails->first_name.' '.$orderdetails->last_name; ?>,</h5>
			<p style="color: #999999; font-family: arial; font-size: 16px; text-decoration: none; font-weight: normal; line-height: 25px;"> Thanks for ordering from Christianity Engaged, your order will be delivered soon.<br> We look forward to seeing you again.<br> Have a great day! :-)</p>
		</td>
	</tr>
	<tr>
		<td style="padding: 15px 0; border-bottom: 1px solid #e9e9e9;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td style="text-align: left;">
						Order ID: <span style="color: #f68623;"><?php echo $orderdetails->order_id;   ?></span>
					</td>
					<td style="text-align: right;">
						Placed on: <?php echo date('Y-m-d',strtotime($orderdetails->order_date)); ?>
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
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Delivery Address</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"><?php echo $orderdetails->shipping_fname.' '.$orderdetails->shipping_lname ;?><br>
							<?php echo $orderdetails->ship_address_line_1; ?><br>  
							<?php echo $orderdetails->ship_address_line_2; ?><br>
							<?php echo $orderdetails->ship_city.' ,'.$orderdetails->ship_state; ?><br>
						     <?php echo $orderdetails->ship_zipcode.' ,'.'tel:-'.$orderdetails->ship_telephone; ?></p> 
					</td>
					<td style="text-align: right;">
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Phone Number</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"><?php echo $orderdetails->telephone; ?></p>
						<h6 style="color: #222; font-family: arial; font-size: 16px; text-decoration: none; font-weight: bold; line-height: 25px; margin: 0;">Total Price	</h6>
						<p style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;">Rs.<?php echo $orderdetails->order_amount; ?></p>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td style="padding: 0px 0 15px; border-top:1px solid #e9e9e9;">
			<table width="100%" cellpadding="0" cellspacing="0" border="0">

				<?php foreach ($orderItems as $key => $value) { ?>
				
				
				<tr>
					<td style="border-bottom:1px solid #e9e9e9; padding: 10px 0;">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="10%" style="border:1px solid #ccc;">
									<img src="{{ URL::to('/') }}/images/Mail_Temolate/product_icon.jpg">
								</td>
								<td width="90%" style="padding: 0 0 0 5%;">
									<table width="95%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<th style="text-align: left;">
												<strong>Product Name</strong>
											</th>
											<th style="text-align: left;">
												<strong>Price</strong>
											</th>
											<th style="text-align: left;">
												<strong>Qty.</strong>
											</th>
										</tr>
										<tr>
											<td style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;">
												<?php echo $value->product_name; ?>
											</td>
											<td style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;">
												Rs <?php echo $value->price; ?>
											</td>
											<td style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"> 
												<?php echo $value->quantity; ?>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php } ?>
				<!-- <tr>
					<td style="border-bottom:1px solid #e9e9e9; padding: 10px 0;">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td width="10%" style="border:1px solid #ccc;">
									<img src="images/product_icon.jpg">
								</td>
								<td width="90%" style="padding: 0 0 0 5%;">
									<table width="95%" cellpadding="0" cellspacing="0" border="0">
										<tr>
											<th style="text-align: left;">
												<strong>Product Name</strong>
											</th>
											<th style="text-align: left;">
												<strong>Price</strong>
											</th>
											<th style="text-align: left;">
												<strong>Qty.</strong>
											</th>
										</tr>
										<tr>
											<td style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;">
												Dummy Product Name with text heading
											</td>
											<td style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;">
												Rs 4239
											</td>
											<td style="color: #999999; font-family: arial; font-size: 14px; text-decoration: none; font-weight: normal; line-height: 25px;"> 
												1
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr> -->
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
						<p><a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/facebook_icon.png" alt="Facebook Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/twitter_icon.png" alt="Twitter Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/googleplus_icon.png" alt="Google Plus Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/linkedin_icon.png" alt="Linked In Icon"></a> <a href="#"><img src="{{ URL::to('/') }}/images/Mail_Temolate/pinterest_icon.png" alt="Pinterest Icon"></a></p>
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