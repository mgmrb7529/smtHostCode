

var v = new Vue({
   el:'#clientapp',
    data:{
        menuName:'Hosting Details',
        url:'http://192.168.1.17/smthost/',
        username:'Manjula',
        showModal:false,
        addModal: false,
        editModal:false,
        deleteModal:false,
        showPaymentHistory:false,
        clients:[],
        hosts:[],
        search: {text: ''},
        emptyResult:false,
        clientRec:{
            id:'',
            name:'',
            email:'',
            conPerson:'',
            mobileNo:'',
            telNo:'',
            dollarValue:'',
            value:'',
            expDate:'',
            host:'',
            inactive:false},
        chooseClient:{},
        formValidate:[],
        clientHistory:[],
        successMSG:'',
        
        //pagination
        currentPage: 0,
        rowCountPage:10,
        totalClients:0,
        pageRange:2
    },
     created(){
      this.showAll(); 
    },
    methods:{
         showAll(){ 
            axios.get(this.url+"client/showAll").then(function(response){
                 if(response.data.clients == null){
                     v.noResult()
                    }else{
                        v.getData(response.data.clients);
                    }
            });

            axios.get(this.url+"host/showAll").then(function(response){
                 if(response.data.hosts == null){
                    
                 }else{                   
                    v.hosts=response.data.hosts;
                }
            })
        },



          searchclient(){
            var formData = v.formData(v.search);
              axios.post(this.url+"client/searchclient", formData).then(function(response){
                  if(response.data.clients == null){
                      v.noResult()
                    }else{
                      v.getData(response.data.clients);
                    
                    }  
            })
        },
         
          addclient(){ 
            alert(v.clientRec.host);

            var formData = v.formData(v.clientRec);

              axios.post(this.url+"client/addclient", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                    alert('Error.');
                }else{
                    alert('Saved successfully.');
                    v.successMSG = response.data.msg;
                    v.clearAll();
                    v.clearMSG();
                }
               })
        },


        updateClient(){            
            var formData = v.formData(v.clientRec);     
            axios.post(this.url+"client/updateClient", formData).then(function(response){
                if(response.data.error){
                    v.formValidate = response.data.msg;
                }else{
                    v.successMSG = response.data.msg;
                    v.clearAll();
                    v.clearMSG();                
                }
            })
        },
        
        deleteClient(){
             var formData = v.formData(v.chooseClient);
              axios.post(this.url+"client/deleteClient", formData).then(function(response){
                if(!response.data.error){
                     v.successMSG = response.data.success;
                    v.clearAll();
                    v.clearMSG();
                }
            })
        },

         formData(obj){
			var formData = new FormData();
		      for ( var key in obj ) {
		          formData.append(key, obj[key]);
		      } 
		      return formData;
		},

        getData(clients){
            v.emptyResult = false; // become false if has a record
            v.totalClients = clients.length //get total of client
            v.clients = clients.slice(v.currentPage * v.rowCountPage, (v.currentPage * v.rowCountPage) + v.rowCountPage); //slice the result for pagination

             // if the record is empty, go back a page
            if(v.clients.length == 0 && v.currentPage > 0){ 
                v.pageUpdate(v.currentPage - 1)
                v.clearAll();  
            }
        },

        paymentHistory(client){
            this.selectclient(client);
            var formData = v.formData(v.chooseClient);            
            axios.post(this.url+"client/getPaymentHistory", formData).then(function(response){
                if(!response.data.error){
                    v.clientHistory=response.data;
                    v.showPaymentHistory=true;
                }
            })
        },
            
        selectclient(client){
            v.chooseClient = client; 
            v.clientRec.id=client.id;
            v.clientRec.name=client.name;
            v.clientRec.email=client.email;
            v.clientRec.conPerson=client.conPerson;
            v.clientRec.mobileNo=client.mobileNo;
            v.clientRec.telNo=client.telNo;
            v.clientRec.value=client.value;
            v.clientRec.dollarValue=client.dollarValue;
            v.clientRec.expDate=client.expDate;   
            v.clientRec.host=client.host;   
            if (client.inactive==1){
                v.clientRec.inactive=true;      
            }else{
                v.clientRec.inactive=false;
            }            
        },

        clearMSG(){
            setTimeout(function(){
			 v.successMSG=''
			 },2000); // disappearing message success in 2 sec
        },
        
        clearAll(){
            v.clientRec = { 
            name:'',
            email:'',
            conPerson:'',
            mobileNo:'',
            telNo:'',
            dollarValue:'',
            value:'',
            expDate:''};

            v.formValidate = false;
            v.showModal=false;
            v.addModal= false;
            v.editModal=false;
            v.deleteModal=false;
            v.refresh()
            
        },

        noResult(){
          
               v.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      v.clients = null 
                     v.totalclients = 0 //remove current page if is empty
            
        },

        pageUpdate(pageNumber){
          
              v.currentPage = pageNumber; //receive currentPage number came from pagination template
              v.refresh()  
        },

        refresh(){
             v.search.text ? v.searchclient() : v.showAll(); //for preventing
            
        }
    }
})