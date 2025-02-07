

$('form').on('submit',function (e) {
    e.preventDefault()
    const formData = new FormData(this);
    $('#signin div').addClass(`loader-spinner`)
    $('#signin span').html('signing in')
    axios.post(`api/admin.php`,formData).then(res=>{
        let result=res.data
        if(result.status == 'success'){
            let {data} =result
            let sessionData= new FormData()
            sessionData.append('name',data.name)
            sessionData.append('role',data.role)
            sessionData.append('status',data.status)
            sessionData.append('id',data.id)
           sessionData.append('email',data.email)
           sessionData.append('profile',data.profile)
            
                axios.post(`session-data.php`,sessionData).then((response)=>{
                    new Notify({
                        title: 'Sign In',
                        text: 'User Signed In',
                        status: 'success', // can be 'success', 'error', etc.
                        effect: 'fade',
                        speed: 300,
                        autoclose: true,
                        autotimeout: 3000,
                    });
                    
               setTimeout(()=>{
                 window.location.href='dashboard.php'
               },1000)
            }).catch((error) => {
                console.error('Error posting session data:', error);
            })

        }else{
            new Notify({
                title: 'Sign In',
                text: 'User Not Found',
                status: 'error', // can be 'success', 'error', etc.
                effect: 'fade',
                speed: 300,
                autoclose: true,
                autotimeout: 3000,
            });
            $('#signin span').html('sign in')

            console.log('empty')
        }
       
       
    }).catch(error=>{
        new Notify({
            title: 'Sign In',
            text: 'Server Error',
            status: 'error', // can be 'success', 'error', etc.
            effect: 'fade',
            speed: 300,
            autoclose: true,
            autotimeout: 3000,
        });
        $('#signin span').html('sign in')

        console.log('error',error)
    })

})