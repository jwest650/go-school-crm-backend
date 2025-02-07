$(document).ready(function(){

    axios.get(`api/profile.php`).then(res=>{
        let result=res.data
        console.log(result)
       if(result.status == 'success'){
        let {data} =result
           $('[name="name"]').val(data.name)
           $('[name="id"]').val(data.id)
           $('[name="last_name"]').val(data.last_name)
           $('[name="email"]').val(data.email)
           $('[name="country"]').val(data.country)
           $('[name="city"]').val(data.city)
           $('[name="address"]').val(data.address)
           $('[name="phone"]').val(data.phone)
           $('[name="postal_code"]').val(data.postal_code)
           $('[name="password"]').val(data.password)
           let img =`<img src='api/${data.profile}'  class="w-full h-full "  alt="">`
           $('#profile-img').html(img)
       }else{
            $('#profile_form :input').prop('disabled',true)
       }
           
            
            
       
       
    }).catch(error=>{
    
        console.log('error',error)
    })

})

$('#profile_form').on('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    // Custom validation method
    $.validator.addMethod("notEqualToOld", function(value, element) {
        return this.optional(element) || value !== $("[name='password']").val();
    }, "New password cannot be the same as the old password.");

    // Validate the form
    $('#profile_form').validate({
        rules: {
            name: {
                required: true,
                minlength: 5,
            },
            new_password: {
                notEqualToOld: true,
                minlength: 5
            },
            confirm_password: {
                equalTo: $('[name="new_password"]')
            }
        }
    });

    // Check if the form is valid
    if (!$('#profile_form').valid()) {
        return; // Stop execution if invalid
    }

    // Create FormData object
    let formData = new FormData(this);

    // Send data using Axios
    axios.post(`api/profile.php`, formData)
        .then(res => {
            let result = res.data;
            if (result.status == 'success') {
                new Notify({
                    title: 'Update',
                    text: 'Profile Updated',
                    status: 'success', // can be 'success', 'error', etc.
                    effect: 'fade',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000,
                });
            } else {
                new Notify({
                    title: 'Update',
                    text: 'Cant Update',
                    status: 'error', // can be 'success', 'error', etc.
                    effect: 'fade',
                    speed: 300,
                    autoclose: true,
                    autotimeout: 3000,
                });
                console.log(result)
            }
        })
        .catch(error => {
            new Notify({
                title: 'Update',
                text: 'Update Error',
                status: 'error', // can be 'success', 'error', etc.
                effect: 'fade',
                speed: 300,
                autoclose: true,
                autotimeout: 3000,
            });
            console.log('error', error);
        });
});



$('[name="profile"]').on('change',function(e){
    let img =`<img src=${URL.createObjectURL(event.target.files[0])}  class="w-full h-full "  alt="">`
    $('#profile-img').html(img)
    console.log('yh')

})