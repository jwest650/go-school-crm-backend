$('#company_form').on('submit',function(e){
    e.preventDefault()

    $('#company_form').validate({
        rules:{
            name:{
                required:true,
                minlength:3
            },
            phone_number:{
                required:true,
                minlength:10
            },
            password:{
                required:true,
                minlength:5
            },
            confirm_password:{
                required:true,
                minlength:5,
                equalTo:$("input[name='password']")
            },
            plan_name:{
                required:true,
               
            },
            plan_type:{
                required:true,
               
            },
            language:{
                required:true,
               
            },
            currency:{
                required:true,
               
            },
        },
        messages:{
            password:{
                minlength:'password should be more than 5 characters'
            },
            confirm_password:{
                equalTo:'password must must match',
                 minlength:'password should be more than 5 characters'
            }
            
        }
    })

    if(!$('#company_form').valid()){
return
    }

const formData = new FormData(this);



axios.post(`api/companies.php`,formData).then(res=>{
    let result=res.data
   if(result.status == 'success'){
    $('#add_company').modal('hide');
   }
       
        
        
   
   
}).catch(error=>{

    console.log('error',error)
})

})