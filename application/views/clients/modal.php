<!--add modal-->
<modal v-if="showModal" @close="clearAll()">
    <h3 slot="head" >
        <div v-if="addModal">
            Add {{menuName}}
        </div>
        <div v-else>
            Edit {{menuName}}
        </div>        
    </h3>
    <div slot="body">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="txtname" :class="{'is-invalid': formValidate.name}" v-model="clientRec.name">
            <div class="has-text-danger" v-html="formValidate.name"> </div>          
        </div>
              

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="txtemail" :class="{'is-invalid': formValidate.email}"v-model="clientRec.email">          
                    <div class="has-text-danger" v-html="formValidate.email"> </div>          
                </div>  

                <div class="form-group">
                    <label>Contact Person:</label>
                    <input type="text" class="form-control" name="txtconPerson" :class="{'is-invalid': formValidate.conPerson}" v-model="clientRec.conPerson">    
                    <div class="has-text-danger" v-html="formValidate.conPerson"> </div>          
                </div>  

                <div class="form-group">
                    <label>Mobile No:</label>
                    <input type="text" class="form-control" name="txtmobileNo" :class="{'is-invalid': formValidate.mobileNo}" v-model="clientRec.mobileNo">
                    <div class="has-text-danger" v-html="formValidate.mobileNo"> </div>          
                </div>          
                
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Telephone No:</label>
                    <input type="text" class="form-control" name="txttelNo" v-model="clientRec.telNo">
                </div>
                
                <div class="form-group">
                    <label>Expire Date:</label>
                    <input type="date" class="form-control" name="txtexpDate" :class="{'is-invalid': formValidate.expDate}" v-model="clientRec.expDate">
                    <div class="has-text-danger" v-html="formValidate.expDate"> </div>
                </div> 
                
                <div class="row">
                    <div class="col-md-6">         
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="text" class="form-control" name="txtDvalue" :class="{'is-invalid': formValidate.value}" v-model="clientRec.dollarValue">
                            <div class="has-text-danger" v-html="formValidate.dollarValue"> </div>
                        </div>                    
                    </div>

                    <div class="col-md-6">         
                        <div class="form-group">
                            <label>Price:</label>
                            <input type="text" class="form-control" name="txtvalue" :class="{'is-invalid': formValidate.value}" v-model="clientRec.value">
                            <div class="has-text-danger" v-html="formValidate.value"> </div>
                        </div>                    
                    </div>
                </div>

            </div>
        </div>   

        <div class="form-group">
            <label>Hosting Provider:</label>            
            <select class="form-control" name="host" v-model="clientRec.host">                
                    <option v-for="h in hosts" :value="h.id">{{h.company+'-'+h.name}}</option>         
            </select>            
        </div>

        <div class="form-group">
            <label>Inactive Client:</label>                        
            <input type="checkbox" name="inactive" v-model="clientRec.inactive">
        </div>

    </div>

    <div slot="foot">
        <div v-if="addModal">
            <button class="btn btn-dark" @click="addclient">Add</button>        
        </div>
        <div v-else>
            <button class="btn btn-dark" @click="updateClient">Update</button>
        </div>
    </div>

</modal>

<!--delete modal-->
<modal v-if="deleteModal" @close="clearAll()">
    <h3 slot="head">Delete {{menuName}}</h3>
    <div slot="body" class="text-center">
        <p>{{chooseClient.name}} </p>
        <p><h4>Do you want to delete this record?<h4></p>
    </div>

    <div slot="foot">
        <button class="btn btn-dark" @click="deleteModal = false; deleteClient()" >Delete</button>
        <button class="btn" @click="deleteModal = false">Cancel</button>
    </div>
</modal>

