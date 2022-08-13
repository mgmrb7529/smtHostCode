<!--add modal-->
<modal v-if="allInvoicesShow" @close="allInvoicesShow=false">
    <h5 slot="head" >{{selectedMonth.Month}} </h5>
    <div slot="body">
            <div class="row"> 

                <table class="table table-sm table table-hover">
                    <thead>
                      <tr>
                        <th>Inv No</th>                                                  
                        <th>Client</th>                                                  
                        <th style="text-align:right">Amount</th>        
                        <th style="text-align:right">Paid</th>                           
                      </tr>
                    </thead>
                                           
                    <tbody>
                        <tr v-for="r in allInvoices.det">
                            <td>{{r.id}}</td>
                            <td>{{r.name}}</span></td>                             
                            <td style="text-align:right">{{r.amount}}</td>                                 
                            <td style="text-align:right">{{r.paid}}</td>                                                    
                        </tr>                               
                    </tbody> 
                    
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Total</th>
                            <th style="text-align:right">{{allInvoices.sum[0].tot}}</th>
                            <th style="text-align:right">{{allInvoices.sum[0].paidtot}}</th>
                            <th></th>
                        </tr>                        
                    </tfoot> 
                    
                </table>                                    
            </div>       
    </div>    

    <div slot="foot">
        <button class="btn btn-dark" @click="allInvoicesShow=false">Ok</button>                
    </div>
</modal>

<!--delete modal-->
<modal v-if="deleteModal" @close="deleteModal = false">
    <h3 slot="head">Invoice No : {{selectedInvoice.id}}</h3>
    <div slot="body" class="text-center">
        <p>{{selectedInvoice.name}} </p>
        <p><h4>Do you want to delete this invoice?<h4></p>
    </div>

    <div slot="foot">
        <button class="btn btn-dark" @click="deleteModal = false;deleteInvoice()" >Delete</button>
        <button class="btn" @click="deleteModal = false">Cancel</button>
    </div>
</modal>