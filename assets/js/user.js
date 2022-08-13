var userapp = new Vue({
   	el:'#userapp',
    data:{
    	url:'http://192.168.1.17/smthost/',
    	user:{userName:'',password:''}
    },
   
    methods:{
    	userValidate:function(){
    		var formData = userapp.formData(this.user);
             axios.post(this.url+"login/validate",formData).then(function(response){
			
				if (response.data==1){
					window.open('dashboard', "_self");
				}else{
					alert("Inavlid user or password  !");
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


    }
})