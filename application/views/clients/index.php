<div id="clientapp">
  
  <div class="container-fluid">
    <div class="row">
        <transition
                enter-active-class="animated fadeInLeft"
                     leave-active-class="animated fadeOutRight">
                     <div class="notification is-success text-center px-5 top-middle" v-if="successMSG" @click="successMSG = false">{{successMSG}}</div>
        </transition>
        
        <div class="col-md-12">
           <table class="table bg-dark my-2">
               <tr>
                   <td> <button class="btn btn-default btn-block" @click="addModal= true;showModal=true">Add</button></td>
                   <td><input placeholder="Search"type="search" class="form-control" v-model="search.text" @keyup="searchclient" name="search"></td>
               </tr>
           </table>

            <table class="table table-sm is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
                
                <th class="text-white">ID</th>
                <th class="text-white">Name</th>                
                <th class="text-white">Email</th>
                <th class="text-white">Con.Person</th>
                <th class="text-white">Mobile No</th>
                <th class="text-white">Tel. No</th>
                <th class="text-white">Exp Date</th>
                <th class="text-white">$</th>
                <th class="text-white">Value</th>
                <th colspan="3" class="text-center text-white">Action</th>
                </thead>
                <tbody class="table-light">                    
                        <tr v-for="client in clients" class="table-default">
                            <td v-if="client.inactive==true">INC</td>
                            <td v-else>{{client.id}}</td>
                            <td>{{client.name}}</td>
                            <td>{{client.email}}</td>
                            <td>{{client.conPerson}}</td>
                            <td>{{client.mobileNo}}</td>
                            <td>{{client.telNo}}</td>
                            <td>{{client.expDate}}</td>
                            <td style="text-align:right">{{client.dollarValue}}</td>                        
                            <td style="text-align:right">{{client.value}}</td>                        
                            <td><button class="btn btn-info fa fa-edit" @click="editModal = true; ;showModal=true; selectclient(client)"></button></td>
                            <td><button class="btn btn-danger fa fa-trash" @click="deleteModal = true; selectclient(client)"></button></td>
                            <td><button class="btn btn-info fa fa-bars" @click="paymentHistory(client)"></button></td>
                        </tr>                    
                    <tr v-if="emptyResult">
                      <td colspan="9" rowspan="4" class="text-center h1">No Record Found</td>
                  </tr>
                </tbody>
                
            </table>
            
        </div>
        
    </div>

     <pagination     
        :current_page="currentPage"
        :row_count_page="rowCountPage"
         @page-update="pageUpdate"
         :total_records="totalClients"
         :page_range="pageRange"
         >
      </pagination>


  </div>
  <?php include 'modal.php';?>
  <?php include 'paymentHistory.php';?>
</div>


