<!--add modal-->
<modal v-if="monthListShow" @close="monthListShow=false">
    <h5 slot="head" >{{selectedHost.company+'-'+selectedHost.name}} </h5>
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
                            <th style="text-align:right">{{doFormat(selectedHost.inc)}}</th>
                            <th></th>
                        </tr>                        

                        <tr>
                            <th>Cost</th>
                            <th style="text-align:right">{{doFormat((selectedHost.value*12)*USDrate)}}</th>
                            <th></th>
                        </tr>                        

                        <tr>
                            <th>Profit</th>
                            <th style="text-align:right">{{doFormat(selectedHost.inc-((selectedHost.value*12)*USDrate))}}</th>
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