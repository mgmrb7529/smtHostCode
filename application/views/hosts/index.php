<div id="hostapp">
  
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
                   <td><input placeholder="Search"type="search" class="form-control" v-model="search.text" @keyup="searchhost" name="search"></td>
               </tr>
           </table>

            <table class="table table-sm is-bordered is-hoverable">
               <thead class="text-white bg-dark" >
                
                <th class="text-white">ID</th>
                <th class="text-white">Company</th>                
                <th class="text-white">Name</th>                
                <th class="text-white">Url</th>                
                <th class="text-white">Exp Date</th>
                <th class="text-white">Cost</th>
                <th class="text-white">Inc</th>
                <th class="text-white">Pro</th>
                <th class="text-white">%</th>
                <th colspan="3" class="text-center text-white">Action</th>
                </thead>
                <tbody class="table-light">
                    <tr v-for="h in hosts" class="table-default">
                        <td>{{h.id}}</td>
                        <td>{{h.company}}</td>
                        <td>{{h.name}}</td>
                        <td>{{h.url}}</td>
                        <td>{{h.expDate}}</td>                                                
                        <td style="text-align:right">{{doFormat((h.value*12)*USDrate)}}</td>                        
                        <td style="text-align:right">{{doFormat(h.inc)}}</td>
                        <td style="text-align:right">{{doFormat(h.inc-(doFormat((h.value*12)*USDrate)))}}</td>
                        <td style="text-align:right">{{doFormat(((h.inc-(doFormat((h.value*12)*USDrate)))/h.inc)*100)}}</td>
                        <td><button class="btn btn-sm btn-success fa fa-search" @click="getMonthList(h)"></button></td>
                        <td><button class="btn btn-info fa fa-edit" @click="editModal = true; ;showModal=true; selecthost(h)"></button></td>
                        <td><button class="btn btn-danger fa fa-trash" @click="deleteModal = true; selecthost(h)"></button></td>
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
         :total_records="totalHosts"
         :page_range="pageRange"
         >
      </pagination>


  </div>
  
  <?php 
    include 'modal.php';
    include 'monthlyList.php';
  ?>

</div>


