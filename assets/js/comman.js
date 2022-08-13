function getDollerRate(){
    var drate=0;
    // debugger
    axios.post("http://apilayer.net/api/live?access_key=6d7c2904f2a6a39eb1c6d4cf56667eeb&currencies=LKR&source=USD&format=1").then(function(response){                        
        return response.data.quotes.USDLKR;             
    })            
    
}