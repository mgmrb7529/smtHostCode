
Vue.use("jspdf");
var dashboardapp = new Vue({
   el:'#dashboardapp',
    data:{
        url:'http://192.168.1.17/smthost/',
        payForm:false,
        msgShow:false,
        monthListShow:false,
        allInvoicesShow:false,
        deleteModal:false,
        invoices:[],
        allInvoices:[],
        allMonthTotal:[],
        monthList:[],
        selectedMonth:[],        
        selectedInvoice:{
            id:'',
            name:'',
            amount:0,
            amountInDollar:0,
            payment:0,
            paid:0,
            periodFrom:''
        },
        emptyResult:false,
        totalValue:0,
        totalPaid:0,
        paidPesentage:0,
        invoicePesentage:0,
        monthPesentage:0,
        anualTotal:0,
        monthTotal:0,
        todayDollarRate:0,
        
        //pagination
        currentPage: 0,
        rowCountPage:5,
        totalInvoices:0,
        pageRange:2        
    },

    computed: {
        balance () {
          return (parseFloat(this.selectedInvoice.amount)-(parseFloat(this.selectedInvoice.payment)+parseFloat(this.selectedInvoice.paid)));
        } 
    },

    created(){                       
      
        axios.get(this.url+"settings/getSettings").then(function(response){
            if(response.data == null){   
                todayDollarRate=0;
            }else{
                todayDollarRate=response.data[0].dollarRate;  
            }

        }); 
   
      
      this.getTotalAmount();
      this.get_monthTotal();  
      this.showInvoices();
    },    
    
    methods:{
         showInvoices:function(){
            axios.get(this.url+"dashboard/showInvoices").then(function(response){   
                
                 if(response.data.invoices == null){
                     this.noResult()
                }else{                                                     
                    dashboardapp.getData(response.data.invoices);                    
                }
            })
        },

        getData:function(invoices){     
            

            this.totalValue=0;
            this.totalPaid=0;

            //To get paid total
            axios.get(this.url+"dashboard/getPaidTot").then(function(response){                
                dashboardapp.totalPaid=response.data.tp;
            });   

             for(x=0;x<invoices.length;x++){                        
                 this.totalValue+=parseFloat(invoices[x].amount);
                 // this.totalPaid+=parseFloat(invoices[x].paid);
             }

            
             this.invoicePesentage=numeral((this.totalValue/this.monthTotal)*100).format('0.00');
             this.paidPesentage=numeral((dashboardapp.totalPaid/this.totalValue)*100).format('0.00');
             

             this.totalValue=numeral(this.totalValue).format('0,0.00');
             this.totalPaid=numeral(this.totalPaid).format('0,0.00');
             

                 this.emptyResult = false; // become false if has a record
                 this.totalInvoices = invoices.length //get total of client
                 this.invoices = invoices.slice(this.currentPage * this.rowCountPage, (this.currentPage * this.rowCountPage) + this.rowCountPage); //slice the result for pagination

                 // if the record is empty, go back a page
                if(this.invoices.length == 0 && this.currentPage > 0){ 
                    this.pageUpdate(this.currentPage - 1)
                    this.clearAll();  
                }
        },

   

    pageUpdate:function(pageNumber){              
              this.currentPage = pageNumber; //receive currentPage number came from pagination template
              this.refresh();
    },

     refresh:function(){
             this.showInvoices(); //for preventing
            
        },

    
    clearAll:function(){           
        this.payForm=false;
        this.msgShow=false;
        this.selectedInvoice.id='';
        this.selectedInvoice.name='';  
        this.selectedInvoice.amount=0;
        this.selectedInvoice.paid=0;
        this.selectedInvoice.payment=0;

        this.refresh();
    },

    selectInvoice:function(inv){
        this.selectedInvoice.id=inv.id;          
        this.selectedInvoice.name=inv.name;  
        this.selectedInvoice.amount=inv.amount; 
        this.selectedInvoice.amountInDollar=inv.amountInDollar; 
        this.selectedInvoice.paid=inv.paid; 
        
        if (parseFloat(this.selectedInvoice.paid)<parseFloat(this.selectedInvoice.amount)){
            this.payForm=true;
        }else{
            this.msgShow=true
        }               
    },

    delInvoice:function(inv){
        this.selectedInvoice.id=inv.id;          
        this.selectedInvoice.name=inv.name;  
        this.selectedInvoice.amount=inv.amount;        
        this.selectedInvoice.paid=inv.paid; 
        this.selectedInvoice.periodFrom=inv.periodFrom;

        if (parseFloat(this.selectedInvoice.paid)==0){
            this.deleteModal=true;
        }else{
            this.msgShow=true
        }               
    },

    deleteInvoice:function() {
        var formData = dashboardapp.formData(this.selectedInvoice);
        axios.post(this.url+"dashboard/deleteInvoice",formData).then(function(response){

        })
    },



    updateReceipt:function(){    
       
       var formData = dashboardapp.formData(this.selectedInvoice);
        axios.post(this.url+"dashboard/updateReceipt", formData).then(function(response){
            if(response.data.error){
                //this.formValidate = response.data.msg;
            }else{
                //this.successMSG = response.data.msg;
                dashboardapp.clearAll();     
            
            }
        })
    },

        formData:function(obj){
            var formData = new FormData();
              for ( var key in obj ) {
                  formData.append(key, obj[key]);
              } 
              return formData;
        },

        getTotalAmount:function(){
          axios.post(this.url+"client/getTotal").then(function(response){                                   
            dashboardapp.anualTotal=parseFloat(response.data.anual);
            dashboardapp.monthTotal=parseFloat(response.data.month);
          
            dashboardapp.monthPesentage=numeral((dashboardapp.monthTotal/dashboardapp.anualTotal)*100).format('0.00');
            
            
          });
        },

        get_monthTotal:function(){
          axios.post(this.url+"client/get_monthTotal").then(function(response){
            dashboardapp.allMonthTotal=response.data;
          });                                   
        },

        getMonthList:function(sm){
          dashboardapp.selectedMonth=sm
          var formData = dashboardapp.formData(sm);
          axios.post(this.url+"client/getMonthList",formData).then(function(response){
            dashboardapp.monthList=response.data;
            dashboardapp.monthListShow=true;
         });                        
        },

        get_given_month_invoices:function(sm){          
          dashboardapp.selectedMonth=sm
          var formData = dashboardapp.formData(sm);
          
            axios.post(this.url+"invoice/get_given_month_invoices",formData).then(function(response){
                dashboardapp.allInvoices =response.data;
                dashboardapp.allInvoicesShow =true;                       
            });  
                       
        },

        calculateInvoice:function(){
            axios.post(this.url+"invoice/addInvoice").then(function(response){
            });           
        },

        updateDollarRate(){          
            axios.post(this.url+"settings/updateDollarRate").then(function(response){ 
                todayDollarRate=response.data[0].dollarRate;
            });            
         },   

        printInvoice:function(inv){  
           var doc=new jspdf.jsPDF({
            orientation: 'l',
            unit: 'mm',
            format: 'a5'
            // format: '[139.7 , 250]'
            });                      

          
           var docName="Invoice-"+inv.id+".pdf";           
           var des="(Period From " + inv.periodFrom + " To " + inv.periodTo + " )";           
           

            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = date+' '+time;
            
            
           var img = new Image()
           img.src = 'assets/img/soft-master.png'
           doc.addImage(img, 'png', 20, 5, 35, 30);

           doc.setFontSize(30);           
           doc.setFont("helvetica","bold");
           doc.setTextColor(160, 160,160);           
           doc.text("INVOICE", 145, 18);                      
           

           doc.setFont("courier","bold");
           doc.setFontSize(10);
           doc.setTextColor(111, 148,54);
           doc.text("REFERENCE:",145,23); 
           doc.text("DATE:",145,27);
           
           doc.setTextColor(0,0,0);
           doc.text(inv.id,170,23);
           doc.text(date,170,27); 
           doc.text(time,170,31); 

           // 

           doc.setFont("helvetica","bold");   
           doc.setFontSize(14);     
           doc.setTextColor(111, 148,54);              
           doc.text("Our Information :",20,45);

           doc.setDrawColor(111, 148,54);
           doc.line(20, 48, 90, 48);

           doc.text("Billing To :",120,45);
           doc.line(120, 48, 190, 48);

           doc.setTextColor(0,0,0);
           doc.setFont("courier","bold");
           doc.setFontSize(10);
           doc.text("Softmaster Technologies(Pvt)Ltd",20,53);     
           doc.text(inv.name,120,53);
           
           doc.setFont("courier","normal");
           doc.text("No.07, George E De Silva Mw., Kandy",20,57);
           doc.text(inv.email,120,57);
           
           doc.setFontSize(12);
           doc.setFont("courier","bold");
           doc.text("DESCRIPTION",20,70);
           doc.text("AMOUNT(LKR)",170,70);
           doc.line(20,72,190,72);

           doc.setFont("courier","normal");
           doc.text("Annual Web Hosting Fee ( " + String(todayDollarRate) +" x  $" + String(inv.amountInDollar) +")",21,76);
           doc.text(String(numeral(todayDollarRate*inv.amountInDollar).format('0,0.00')),170,76);

           doc.setFontSize(10);
           doc.text(des,21,80);
           
           doc.line(20,110,190,110);
           doc.setFontSize(12);
           doc.setFont("courier","bold");
           doc.text("TOTAL LKR",21,114);           
           doc.text(String(numeral(todayDollarRate*inv.amountInDollar).format('0,0.00')),170,114);
                   
           doc.line(20,117,190,117);

           doc.setFontSize(10);
           doc.setFont("courier","bold");
           doc.text('Payment Method - Bank Transfer',21,123);
           doc.setFont("courier","normal");
           doc.text('Softmaster Technologies(Pvt)Ltd',21,127);
           doc.text('Nation Trust Bank - Kandy Branch',21,131);
           doc.text('100040006735',21,135);
           
           doc.setFont("courier","bold");
           doc.setTextColor(111, 148,54);
           doc.text('Note : ' ,128,123)
           doc.setTextColor(0,0,0);
           doc.setFont("courier","normal");
           doc.text('Last year web hosting charge ' ,128,127);
           doc.text("(200 x $"+inv.amountInDollar+")      " + String(200*inv.amountInDollar) + ".00",128,131); 
           doc.save(docName);          
        },
}
})

