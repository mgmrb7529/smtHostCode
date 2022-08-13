
var host = new Vue({
   el:'#hostapp',
    data:{
        menuName:'Server Details',
        url:'http://192.168.1.17/smthost/',
        username:'Manjula',
        showModal:false,
        addModal: false,
        editModal:false,
        deleteModal:false,
        monthListShow:false,
        hosts:[],
        selectedHost:[],
        monthList:[],
        search: {text: ''},
        emptyResult:false,
        hostRec:{
            id:'',
            company:'',
            name:'',
            url:'',            
            value:'',
            expDate:''},
        choosehost:{},
        formValidate:[],
        successMSG:'',
        USDrate:0,
        pm:75,
        totHostCharges:0,
        //pagination
        currentPage: 0,
        rowCountPage:10,
        totalHosts:0,
        pageRange:2
    },
     created(){
      this.showAll(); 
      // this.getDollerRate();
    },
    methods:{
         showAll(){ axios.get(this.url+"host/showAll").then(function(response){

                 if(response.data.hosts == null){
                     host.noResult()
                 }else{                   
                        host.getData(response.data.hosts);
                 }
            })

        },



          searchhost(){
            var formData = host.formData(host.search);
              axios.post(this.url+"host/searchhost", formData).then(function(response){
                  if(response.data.hosts == null){
                      host.noResult()
                    }else{
                      host.getData(response.data.hosts);
                    
                    }  
            })
        },
         
          addhost(){   
            var formData = host.formData(host.hostRec);

              axios.post(this.url+"host/addhost", formData).then(function(response){
                if(response.data.error){
                    host.formValidate = response.data.msg;
                    alert('Error.');
                }else{
                    alert('Saved successfully.');
                    host.successMSG = response.data.msg;
                    host.clearAll();
                    host.clearMSG();
                }
               })
        },


        updatehost(){            
            var formData = host.formData(host.hostRec);
            axios.post(this.url+"host/updatehost", formData).then(function(response){
                if(response.data.error){
                    host.formValidate = response.data.msg;
                }else{
                    host.successMSG = response.data.msg;
                    host.clearAll();
                    host.clearMSG();
                
                }
            })
        },
        
        deletehost(){
             var formData = host.formData(host.choosehost);
              axios.post(this.url+"host/deletehost", formData).then(function(response){
                if(!response.data.error){
                     host.successMSG = response.data.success;
                    host.clearAll();
                    host.clearMSG();
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

        getData(hosts){
            host.emptyResult = false; // become false if has a record
            host.totalHosts = hosts.length //get total of host
            host.hosts = hosts.slice(host.currentPage * host.rowCountPage, (host.currentPage * host.rowCountPage) + host.rowCountPage); //slice the result for pagination

             // if the record is empty, go back a page
            if(host.hosts.length == 0 && host.currentPage > 0){ 
                host.pageUpdate(host.currentPage - 1)
                host.clearAll();  
            }
        },
            
        selecthost(host){            
            this.choosehost = host; 
            this.hostRec.id=host.id;
            this.hostRec.company=host.company;
            this.hostRec.name=host.name;
            this.hostRec.url=host.url;            
            this.hostRec.value=host.value;
            this.hostRec.expDate=host.expDate;             
        },

        clearMSG(){
            setTimeout(function(){
			 host.successMSG=''
			 },2000); // disappearing message success in 2 sec
        },
        
        clearAll(){
            host.hostRec = { 
            company:'',
            name:'',
            url:'',            
            value:'',
            expDate:''};

            host.formValidate = false;
            host.showModal=false;
            host.addModal= false;
            host.editModal=false;
            host.deleteModal=false;
            host.refresh()
            
        },

        noResult(){          
               host.emptyResult = true;  // become true if the record is empty, print 'No Record Found'
                      host.hosts = null 
                     host.totalHosts = 0 //remove current page if is empty
            
        },

        pageUpdate(pageNumber){          
              host.currentPage = pageNumber; //receive currentPage number came from pagination template
              host.refresh()  
        },

        refresh(){
             host.search.text ? host.searchhost() : host.showAll(); //for preventing            
        },

        getDollerRate(){
            // debugger
            axios.post("http://apilayer.net/api/live?access_key=6d7c2904f2a6a39eb1c6d4cf56667eeb&currencies=LKR&source=USD&format=1").then(function(response){                
                host.USDrate=response.data.quotes.USDLKR;                
            })            
        },

        doFormat(myval){
            return numeral(myval).format('0.00');
        },

         getMonthList:function(sh){
           host.selectedHost=sh
           var formData = host.formData(sh);
           axios.post(this.url+"host/getMonthList",formData).then(function(response){
             host.monthList=response.data;
             host.monthListShow=true;
          });                        
                  
        },
    }
})