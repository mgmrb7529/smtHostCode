<!--add modal-->
<modal v-if="payForm" @close="clearAll()">
    <h3 slot="head" >Payment From </h3>
    <div slot="body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Invoice No:</label>
                    <input type="text" class="form-control" v-model="selectedInvoice.id" disabled="">      

                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label>Client Name:</label>
                    <input type="text" class="form-control" v-model="selectedInvoice.name" disabled="">            
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Payment:</label>
                    <input type="text" class="form-control" v-model="selectedInvoice.payment" name="txtPayment" >            
                </div>      
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Invoice Amt:</label>
                    <input type="text" class="form-control" v-model="selectedInvoice.amount" disabled >            
                </div>      
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Payable Amt:</label>
                    <input type="text" class="form-control"  v-model="balance" disabled >            
                </div>      
            </div>

        </div>
    </div>    

    <div slot="foot">
        <button class="btn btn-dark" @click="updateReceipt">Add</button>                
    </div>
</modal>

<!--delete modal-->
<modal v-if="msgShow" @close="msgShow=false">
    <h3 slot="head">{{selectedInvoice.name}}</h3>
    <div slot="body" class="text-center">
        <p>Invoice No {{selectedInvoice.id}} 's amount </p>
        <p><h4>has been setteled......<h4></p>
    </div>

    <div slot="foot">        
        <button class="btn btn-dark" @click="msgShow=false">Ok</button>
    </div>
</modal>