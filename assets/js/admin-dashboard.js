$('#teacher_form').on('submit',function (e) {
    e.preventDefault(); // Prevent default form submission

   

    // Validate the form
    $('#teacher_form').validate({
        rules: {
            name: {
                required: true,
                minlength: 5,
            },
            last_name: {
                required: true,
                minlength: 5
            },
            start_date: {
                required: true,
               
            },
            end_date: {
                required: true,
                
            },
            department: {
                required: true,
                
            },
            description: {
                required: true,
                minlength: 5
            },
           
        }
    });

    // Check if the form is valid
    if (!$('#teacher_form').valid()) {
        return; // Stop execution if invalid
    }

    // Create FormData object
    let formData = new FormData(this);
    console.log(formData)

    // Send data using Axios
    axios.post(`api/teachers.php`, formData)
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
})