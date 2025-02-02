

$('form').on('submit',function (e) {
    e.preventDefault()
    const formData = new FormData(this);
    $('#signin').html(`<img src='assets/loaders/spinning-circles.svg' width='25px' height='25px'   />`)
    axios.post(`api/admin.php`,formData).then(res=>{
        let result=res.data
        if(result.status == 'success'){
            let {data} =result
            let sessionData= new FormData()
            sessionData.append('name',data.name)
            sessionData.append('role',data.role)
            sessionData.append('status',data.status)
           
            
            axios.post(`session-data.php`,sessionData).then((response)=>{
                console.log('Session data:', response.data); 
                window.location.href='dashboard.php'
            }).catch((error) => {
                console.error('Error posting session data:', error);
            })

        }else{
            $('#signin').html(`Signin`)

            console.log('empty')
        }
       
       
    }).catch(error=>{
        $('#signin').html(`Signin`)

        console.log('error',error)
    })

})