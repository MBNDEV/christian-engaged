 <section class="content-header">
    <h1>Shipping Detail</h1>
    <!-- You can dynamically generate breadcrumbs here -->
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{url('manage/setting')}}" id="shippingform" enctype= "multipart/form-data" method="post">
                    	{{ csrf_field() }}
		                   <div style="width:50%;"> 	
		                    	<table class="table">
			                        <tbody>
			                        	<tr>
					                        <td class="center" style="background: #24aae1; color: white; font-weight: 700; border: 2px solid #80808045;" colspan="2">Shipping Cart Weight Range</td>    
					                        <td class="center" style="background: #24aae1; color: white; font-weight: 700; border: 2px solid #80808045;" rowspan="3">Cost</td>    
				                        </tr>
		                        		<tr>
		                        			<td class="center" style="background: #24aae1; color: white; font-weight: 700; border: 2px solid #80808045;" colspan="2">Pound</td>
		                        		</tr>
		                        		<tr>
		                        			<td style="background: #24aae1; color: white; font-weight: 700; border: 2px solid #80808045;" class="center">Start Range</td>
		                        			<td  style="background: #24aae1; color: white; font-weight: 700; border: 2px solid #80808045;" class="center">End Range</td>
		                        		</tr>
		                        		<?php 
		                        			foreach ($setting as $key => $value) {
		                        				?>
			                        				<tr>
				                        				<td><input type="number" class="form-control start_{{$value->id}}" name="start_{{$value->id}}" value="{{$value->start_range}}"/></td>
				                        				<td><input type="number" class="form-control end_{{$value->id}}" name="end_{{$value->id}}" value="{{$value->end_range}}"/></td>
				                        				<td><input type="number" class="form-control cost_{{$value->id}}" name="cost_{{$value->id}}" value="{{$value->cost}}"/></td>
			                        				</tr>
		                        				<?php
		                        			}
		                        		?>
		                        	</tbody>
		                    	</table>
		                        <div class="row">
		                            <div class="col-md-12 text-right">
		                                <button type="button" id="submitbtn" class="btn btn-success">Save</button>
		                            </div>

		                        </div>

		                        <div class="row">
		                            <div class="col-md-12 text-center">
		                                <div id="errormsg" style="display:none;color:#dd3e3e">
		                                <p><strong> Weight should be greater than 0 and smaller than 100000. </strong></p>
		                                </div>
		                            </div>

		                        </div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
			$('#submitbtn').click(function(){
				$('#errormsg').hide();
				var check = false;
				$("input[type=number]").each(function(){
				 	var data = parseFloat($(this).val()).toFixed(5); 
				 	if(data <= 0 || data > 99999.99999){
				 		check = true;
					 	return false;				 		
				 	}
				});
				if(check){
					$('#errormsg').show();					
					return false;
				}
				$("#shippingform").submit();
			});		
	});
</script>
