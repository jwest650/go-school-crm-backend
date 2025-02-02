$('#packages_form').on('submit',function(e){
    e.preventDefault()

    $('#packages_form').validate({
        rules:{
          
          
            plan_name:{
                required:true,
               
            },
            plan_type:{
                required:true,
               
            },
            language:{
                required:true,
               
            },
            plan_currency:{
                required:true,
               
            },
            currency_paln:{
                required:true,
               
            },
            discount_type:{
                required:true,
               
            },
            discount:{
                required:true,
               
            },
            status:{
                required:true,
               
            },
        },
       
    })

    if(!$('#packages_form').valid()){
return
    }

const formData = new FormData(this);



axios.post(`api/packages.php`,formData).then(res=>{
    let result=res.data
   if(result.status == 'success'){
    $('#add_plans').modal('hide');
   }
       
        
        
   
   
}).catch(error=>{

    console.log('error',error)
})

})