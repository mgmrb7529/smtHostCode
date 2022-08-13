var utilitiesapp = new Vue({
    el:'#utilitiesapp',
 data:{
     url:'http://192.168.1.17/smthost/',
     dollarRate:361.00,     
 },
 created(){},
 methods:{
     updateDollarRate(){          
        axios.post(this.url+"settings/updateDollarRate").then(function(response){ 
            alert(response.data);
        });        
     },   
 },
})