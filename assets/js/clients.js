$('#admin_form').on('submit',function(e){
    e.preventDefault()

    $('#admin_form').validate({
        rules:{
            name:{
                required:true,
                minlength:3
            },
            email:{
                required:true,
               
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

    if(!$('#admin_form').valid()){
return
    }

const formData = new FormData(this);
console.log(formData)


axios.post(`api/add_admin.php`,formData).then(res=>{
    let result=res.data
    console.log(result)
   if(result.status == 'success'){
    new Notify({
        title: 'Added',
        text: 'Admin added',
        status: 'success', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
    $('#add_company').modal('hide');
   }else{
    new Notify({
        title: 'Added',
        text: 'Not Added',
        status: 'error', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
   }
       
        
        
   
   
}).catch(error=>{
    new Notify({
        title: 'Added',
        text: 'Server Error',
        status: 'error', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
    console.log('error',error)
})
})