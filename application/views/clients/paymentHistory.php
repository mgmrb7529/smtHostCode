<!--add modal-->
<modal v-if="showPaymentHistory" @close="showPaymentHistory=false">
    <h5 slot="head" >{{clientRec.name}} </h5>
    <div slot="body">
            <div class="row"> 

                <table class="table table-sm table table-hover">
                    <thead>
                      <tr>
                        <th>Inv No</th>                                                  
                        <th>Date</th>                                                  
                        <th style="text-align:right">Amount</th>        
                        <th style="text-align:right">Paid</th>                           
                      </tr>
                    </thead>
                                           
                    <tbody>
                        <tr v-for="r in clientHistory">
                            <td>{{r.invNo}}</td>
                            <td>{{r.date}}</span></td>                             
                            <td style="text-align:right">{{r.amount}}</td>                                 
                            <td style="text-align:right">{{r.paid}}</td>                                                    
                        </tr>                               
                    </tbody> 
                    
                    <!-- <tfoot>
                        <tr>
                            <th></th>
                            <th>Total</th>
                            <th style="text-align:right">{{allInvoices.sum[0].tot}}</th>
                            <th style="text-align:right">{{allInvoices.sum[0].paidtot}}</th>
                            <th></th>
                        </tr>                        
                    </tfoot>  -->
                    
                </table>                                    
            </div>       
    </div>    

    <div slot="foot">
        <button class="btn btn-dark" @click="showPaymentHistory=false">Ok</button>                
    </div>
</modal>
