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
            <label>Company:</label>
            <input type="text" class="form-control" name="txtcompany" :class="{'is-invalid': formValidate.company}" v-model="hostRec.company">
            <div class="has-text-danger" v-html="formValidate.company"> </div>          
        </div>

        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="txtname" :class="{'is-invalid': formValidate.name}" v-model="hostRec.name">
            <div class="has-text-danger" v-html="formValidate.name"> </div>          
        </div>
              
        <div class="form-group">
            <label>Url:</label>
            <input type="text" class="form-control" name="txturl" :class="{'is-invalid': formValidate.url}"v-model="hostRec.url">          
            <div class="has-text-danger" v-html="formValidate.url"> </div>          
        </div>                

        <div class="row">            
            <div class="col-md-6">                
                <div class="form-group">
                    <label>Expire Date:</label>
                    <input type="date" class="form-control" name="txtexpDate" :class="{'is-invalid': formValidate.expDate}" v-model="hostRec.expDate">
                    <div class="has-text-danger" v-html="formValidate.expDate"> </div>
                </div>          
            </div>
            <div class="col-md-6">                    
                <div class="form-group">
                    <label>Price:</label>
                    <input type="text" class="form-control" name="txtvalue" :class="{'is-invalid': formValidate.value}" v-model="hostRec.value">
                    <div class="has-text-danger" v-html="formValidate.value"> </div>
                </div>
            </div>
        </div>        
    </div>

    <div slot="foot">
        <div v-if="addModal">
            <button class="btn btn-dark" @click="addhost">Add</button>        
        </div>
        <div v-else>
            <button class="btn btn-dark" @click="updatehost">Update</button>
        </div>
    </div>

</modal>

<!--delete modal-->
<modal v-if="deleteModal" @close="clearAll()">
    <h3 slot="head">Delete {{menuName}}</h3>
    <div slot="body" class="text-center">
        <p>{{choosehost.name}} </p>
        <p><h4>Do you want to delete this record?<h4></p>
    </div>

    <div slot="foot">
        <button class="btn btn-dark" @click="deleteModal = false; deletehost()" >Delete</button>
        <button class="btn" @click="deleteModal = false">Cancel</button>
    </div>
</modal>

