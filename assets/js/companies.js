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
        
    })

    if(!$('#company_form').valid()){
return
    }

const formData = new FormData(this);
console.log(formData)


axios.post(`api/companies.php`,formData).then(res=>{
    let result=res.data
    console.log(result)
   if(result.status == 'success'){
    new Notify({
        title: 'Added',
        text: 'companies added',
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

$('[name="profile"]').on('change',function(e){
    e.preventDefault()
    $('#img').attr('src',URL.createObjectURL(e.target.files[0]))
    console.log('yh')

})