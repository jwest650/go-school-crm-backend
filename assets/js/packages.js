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
            currency_plan:{
                required:true,
               
            },
            price:{
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
formData.append('add_packages',1)

axios.post(`api/packages.php`,formData).then(res=>{
    let result=res.data
   if(result.status == 'success'){
    new Notify({
        title: 'Add',
        text: 'Added Successfully',
        status: 'success', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
    $('#add_plans').modal('hide');
    return
   }else{
    new Notify({
        title: 'Add',
        text: 'Not Added Duplicate Plan Name And Type',
        status: 'error', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
   }
       
   console.log(result)
     
        
   
   
}).catch(error=>{
    new Notify({
        title: 'Add',
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
$('#edit_form').on('submit',function(e){
    e.preventDefault()

    $('#edit_form').validate({
        rules:{
          
          
            edit_plan_name:{
                required:true,
               
            },
            edit_plan_type:{
                required:true,
               
            },
           
            edit_plan_currency:{
                required:true,
               
            },
            edit_currency_plan:{
                required:true,
               
            },
            edit_price:{
                required:true,
               
            },
            edit_discount_type:{
                required:true,
               
            },
            edit_discount:{
                required:true,
               
            },
            edit_status:{
                required:true,
               
            },
        },
       
    })

    if(!$('#edit_form').valid()){
return
    }

const formData = new FormData(this);
formData.append('update_packages',1)
axios.post(`api/packages.php`,formData).then(res=>{
    let result=res.data
    console.log(result)

   if(result.status == 'success'){
    new Notify({
        title: 'Update',
        text: 'Updated Successfully',
        status: 'success', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
    $('#edit_plans').modal('hide');
    return
   }else{
    new Notify({
        title: 'Update',
        text: 'Not Updated ',
        status: 'error', // can be 'success', 'error', etc.
        effect: 'fade',
        speed: 300,
        autoclose: true,
        autotimeout: 3000,
    });
   }
       
   console.log(result)
     
        
   
   
}).catch(error=>{
    new Notify({
        title: 'Update',
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


$(document).ready(async function (){
    let html =``
   
    let result = await get_data()
    if(!result)return
    insert_total(result.total)

    $.each(result.packages,function(index,value){
        html+=`<tr>
										<td>
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox">
											</div>
										</td>
										<td>
											<h6 class="fw-medium"><a href="#">${value.plan_name}</a></h6>
										</td>
										
										<td>${value.plan_type}</td>
										<td>${value.total_subscribers}</td>
										<td>${value.price}</td>
                                        <td>${value.created_at}</td>
										<td>
											<span class="badge badge-success d-inline-flex align-items-center badge-sm">
												<i class="ti ti-point-filled me-1"></i>${value.status}
											</span>
										</td>
										<td>
											<div class="action-icon d-inline-flex">
												<a href="#" data-id=${value.id} class="me-2" data-bs-toggle="modal" data-bs-target="#edit_plans"><i class="ti ti-edit"></i></a>
												<a href="#" data-id=${value.id} data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
											</div>
										</td>
									</tr>`
    })

    $('#packages_table').html(html)
})



function get_data(){
   return axios.post(`api/packages.php`,{
        'get_packages':1
    },{
        headers:{
            'Content-Type': 'multipart/form-data'
        }
    }).then(res=>{
        let result=res.data
       

       if(result.status == 'success'){
       return result.data
        
       }else{
        return null
       }
           
            
            
       
       
    }).catch(error=>{
       return null
        console.log('error',error)
    })
}


function insert_total(data){
    $('#total_plans').html(data.total_plans)
    $('#total_active_plans').html(data.total_active_plans)
    $('#total_inactive_plans').html(data.total_inactive_plans)
    $('#total_plans_type').html(data.total_plans_type)
}

$('#edit_plans').on('show.bs.modal', function (e) {
    var triggerElement = $(e.relatedTarget); // Button that triggered the modal
    var dataId = triggerElement.data('id'); // Extract info from data-* attributes
    console.log(dataId)


    axios.post(`api/packages.php`,{
        'edit_packages':dataId
    },{
        headers:{
            'Content-Type': 'multipart/form-data'
        }
    }).then(res=>{
        let result=res.data
       
        console.log(result)
       if(result.status == 'success'){
       insert_edit_data(result.data)
        
       }else{
        return null
       }
           
            
            
       
       
    }).catch(error=>{
       return null
        console.log('error',error)
    })
});

$('#delete_modal').on('show.bs.modal', function (e) {
    var triggerElement = $(e.relatedTarget); // Button that triggered the modal
    var dataId = triggerElement.data('id'); // Extract info from data-* attributes
    console.log(dataId)
    $('#delete_id').val(dataId).change();
});

$('#delete_package').on('click',function(e){
    e.preventDefault()
    let id =$('#delete_id').val();
    console.log(id)
    axios.post(`api/packages.php`,{
        'delete_packages':1,
        id
    },{
        headers:{
            'Content-Type': 'multipart/form-data'
        }
    }).then(res=>{
        let result=res.data
       
        console.log(result)
       if(result.status == 'success'){
        new Notify({
            title: 'Delete',
            text: 'Deleted',
            status: 'success', // can be 'success', 'error', etc.
            effect: 'fade',
            speed: 300,
            autoclose: true,
            autotimeout: 3000,
        });
        $('#delete_modal').modal('hide');

      setTimeout(() => {

        window.location.reload()
      }, 1000);
       }else{
        new Notify({
            title: 'Delete',
            text: 'error',
            status: 'error', // can be 'success', 'error', etc.
            effect: 'fade',
            speed: 300,
            autoclose: true,
            autotimeout: 3000,
        });
       }
           
            
            
       
       
    }).catch(error=>{
        new Notify({
            title: 'Delete',
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


function insert_edit_data(data){
    $('[name="edit_plan_name"]').val(data.plan_name).change();
    $('[name="edit_plan_type"]').val(data.plan_type).change();
    $('[name="edit_plan_currency"]').val(data.plan_currency).change();
    $('[name="edit_currency_plan"]').val(data.currency_plan).change();
    $('[name="edit_discount_type"]').val(data.discount_type).change();
    $('[name="edit_discount"]').val(data.discount).change();
    $('[name="edit_trial_days"]').val(data.trial_days).change();
    $('[name="edit_status"]').val(data.status).change();
    $('[name="edit_price"]').val(data.price).change();
    $('[name="id"]').val(data.id).change();

}