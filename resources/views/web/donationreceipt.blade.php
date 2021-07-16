<section class="thankyou-wrap">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><i class="fa fa-check-circle"></i> Thank you for your donation.</h2>
				<center><h4>A confirmation email has been sent to your email address below.</h4></center>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{$donation->first_name.' '.$donation->last_name}}</td>
							<td>{{$donation->email}}</td>
							<td>${{$donation->donation_amount}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php    if($_SERVER['SERVER_NAME'] == "christianityengaged.org" || $_SERVER['SERVER_NAME'] == "www.christianityengaged.org") {    ?>
		<!-- Event snippet for Donate Button conversion page -->
		<script>
			 gtag('event', 'conversion', { 'send_to': 'AW-769682949/hHR2CL7jyJMBEIXcge8C', 'transaction_id': '{{$donation->order_number}}' });
		</script>
<?php } ?>
