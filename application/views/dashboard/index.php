

<div id="dashboardapp">

	<div class="container-fluid">
		<div class="row my-2">
			<div class="col-md-8">
				<div class="row my-2">		
					
					<?php if ($this->session->userdata('admin')==0) {echo '<div class="col-md-4">';}else{echo '<div class="col-md-3">';}?>				
						<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
			  				<div class="card-header">Income in <?php echo date("F", mktime(0, 0, 0, date('m'), 10)); ?> </div>
			  				<div class="card-body">	    					    				
			    				<h6 class="card-title">{{monthTotal}} ({{monthPesentage}}%)</h6>
			  				</div>
						</div>
					</div>

					
					<?php if ($this->session->userdata('admin')==0) {echo '<div class="col-md-4">';}else{echo '<div class="col-md-3">';}?>				
						<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
			  				<div class="card-header">Generated Invoices</div>
			  				<div class="card-body">	    					    				
			    				<h6 class="card-title">{{totalValue}} ({{invoicePesentage}}%)</h6>
			  				</div>
						</div>
					</div>


					<?php if ($this->session->userdata('admin')==0) {echo '<div class="col-md-4">';}else{echo '<div class="col-md-3">';}?>							
						<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
			  				<div class="card-header">Paid in <?php echo date("F", mktime(0, 0, 0, date('m'), 10)); ?></div>
			  				<div class="card-body">	    				
			    				<h6 class="card-title">{{totalPaid}} ({{paidPesentage}}%)</h6>
			  				</div>
						</div>
					</div>

					<?php				
					if ($this->session->userdata('admin')==0) {
						echo '<div class="col-md-3" style="display:none">';			 			              
					}else{
						echo '<div class="col-md-3">';			 			              
					}
					?>
						<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
			  				<div class="card-header">Anual Income</div>
			  				<div class="card-body">	  						    				
			    			   <h6 class="card-title">{{anualTotal}}</h5>			
							  
			  				</div>
						</div>
					</div>
				</div>

				
				<div class="row">
					<div class="col-md-12">		  
						<div class="container p-3 my-3 border" style="height: :100x">
						  <h5>Invoices in This Month(<?php echo date("F", mktime(0, 0, 0, date('m'), 10)); ?>)				              
						  						  
						  <button class="btn btn-sm btn-info" @click="updateDollarRate()">Update Dollar Rate</button>
						</h5>	 
						  <table class="table table-sm table-hover">
						    <thead>
						      <tr>
						        <th style="text-align:right">No</th>
						        <th>Client</th>
						        <th style="text-align:right">Exp Date</th>
						        <th style="text-align:right">Dollar</th>
								<th style="text-align:right">Old Value</th>
						        <th style="text-align:right">Paid</th>						        
						        <th><button class="btn btn-sm btn-warning" @click="calculateInvoice()">CAL</button></th>
								<th><button class="btn btn-sm btn-warning" @click="calculateInvoice()">CUL</button></th>
								<th><button class="btn btn-sm btn-warning" @click="calculateInvoice()">ATE</button></th>
						      </tr>
						    </thead>
						    
						   
						    <tbody>
							   <tr v-for="inv in invoices">
						        	<td style="text-align:right">{{inv.id}}</td>
						        	<td>{{inv.name}}</td>
						        	<td style="text-align:right">{{inv.periodFrom}}</td>
									<td style="text-align:right">{{inv.amountInDollar}}</td>
						        	<td style="text-align:right">{{inv.amount}}</td>
						        	<td style="text-align:right">{{inv.paid}}</td>
						        	<td style="width: 30px"><button class="btn btn-sm btn-info fa fa-envelope-o" @click="printInvoice(inv)"></button></td>
		                        <td style="width: 30px"><button class="btn btn-sm btn-success fa fa-credit-card" @click="selectInvoice(inv)"></button></td>
		                        <td style="width: 30px"><button class="btn btn-sm btn-danger fa fa-trash-o fa-lg" @click="delInvoice(inv)"></button></td>
						      </tr>	
						    </tbody>
						
						    <tfoot>
		    					<tr>
		      						<th></th>
		      						<th>Total</th>
		      						<th></th>
									<th></th>
		      						<th style="text-align:right">{{totalValue}}</th>
		      						<th style="text-align:right">{{totalPaid}}</th>
		      						<th></th>
		      						<th></th>

		    					</tr>
		    					<tr>
		    						<td></td>
		      						<td>
		    						<pagination     
					        			:current_page="currentPage"
					        			:row_count_page="rowCountPage"
					         			@page-update="pageUpdate"
					         			:total_records="totalInvoices"
					         			:page_range="pageRange"
					         			>
			      					</pagination>	
			      					</td>
			      					<td></td>
			      					<td></td>
			      					<td></td>
			      					<td></td>
			      					<td></td>
			      				</tr>
		  					</tfoot>
						  </table>
						</div>
					</div>			
				</div>
			</div>

			<div class="col-md-3 ">			
				
				<div class="row my-2">
						<table class="table table-sm table-striped table-dark">
						    <thead>
						      <tr>
						        <th>Month</th>					        
						        <th style="text-align:right">Amount</th>       	
								
						        <th></th>					        
						        <th></th>					        
						      </tr>
						    </thead>
						    					   
						    <tbody>
							   	<tr v-for="r in allMonthTotal">
						        	<td>{{r.Month}} <span class="badge badge-danger">{{r.noof}}</span></td>					        	
						        	<td style="text-align:right">{{r.tot}}</td>
								
						        	<td><button class="btn btn-sm btn-success fa fa-search" @click="getMonthList(r)"></button></td>
						        	<td><button class="btn btn-sm btn-info fa fa-bars" @click="get_given_month_invoices(r)"></button></td>
		                        </tr>		                        
						    </tbody>
						
						    <!-- <tfoot>
		    					<tr>
		      						<th>Total</th>	      						
		      						<th style="text-align:right">{{anualTotal}}</th>	      						
		      						<th></th>
		      						<th></th>
		    					</tr>
		    				</tfoot> -->
		    			</table>		    		
		    	</div>
				
			</div>

		</div>
	</div>
	
	<?php 
		include 'receipt.php';
		include 'monthlyList.php';
		include 'invoiceList.php';
	?>
</div>