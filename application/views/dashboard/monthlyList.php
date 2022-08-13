<!--add modal-->
<modal v-if="monthListShow" @close="monthListShow=false">
    <h5 slot="head" >{{selectedMonth.Month}} </h5>
    <div slot="body">
            <div class="row"> 

                <table class="table table-sm table table-hover">
                    <thead>
                      <tr>
                        <th>Client</th>                          
                        <th style="text-align:right">Amount</th>        
                        <th style="text-align:right">Exp Date</th>                           
                      </tr>
                    </thead>
                                           
                    <tbody>
                        <tr v-for="r in monthList">
                            <td>{{r.name}}</span></td>                             
                            <td style="text-align:right">{{r.value}}</td>                                 
                            <td style="text-align:right">{{r.expDate}}</td>                                                          
                        </tr>                               
                    </tbody> 

                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th style="text-align:right">{{selectedMonth.tot}}</th>
                            <th></th>
                        </tr>                        
                    </tfoot>             
                    
                </table>                                    
            </div>       
    </div>    

    <div slot="foot">
        <button class="btn btn-dark" @click="monthListShow=false">Ok</button>                
    </div>
</modal>