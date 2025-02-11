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
            loacation:{
                required:true,
               
            },
        },
        
    })

    if(!$('#company_form').valid()){
return
    }

const formData = new FormData(this);
formData.append('add_companies',1)



axios.post(`api/companies.php`,formData).then(res=>{
    let result=res.data
    console.log(result)
   if(result.status == 'success'){
    new Notify({
        title: 'Added',
        text: 'school added',
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
$('[name="edit_profile"]').on('change',function(e){
    e.preventDefault()
    $('#edit_img').attr('src',URL.createObjectURL(e.target.files[0]))

})

function get_data(){
    return axios.post(`api/companies.php`,{
        'get_companies':1
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

$(document).ready(async function(){
let data =await get_data()
console.log(data)
insert_total(data.total)
let html =``;
    $.each(data.schools,function(i,item){
        html +=`
        	<tr>
				<td>
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox">
											</div>
										</td>
										<td>
											<div class="d-flex align-items-center file-name-icon">
												<a href="#" class="avatar avatar-md border rounded-circle">
												${
                                                    item.profile ? `<img src="api/${item.profile}" class="img-fluid" alt="img">` : `<img src="assets/img/company/company-01.svg" class="img-fluid" alt="img">`
                                                }
												</a>
												<div class="ms-2">
													<h6 class="fw-medium"><a href="#">${item.name}</a></h6>
												</div>
											</div>
										</td>
										<td>${item.email|| "_"}</td>
										<td>${item.account_url}</td>
										<td>
											<div class="d-flex align-items-center justify-content-between">
												<p class="mb-0 me-2">${item.plan_name} (${item.plan_type})</p>
												<a href="#" data-bs-toggle="modal" data-id=${item.id} class="badge badge-purple badge-xs" data-bs-target="#upgrade_info">Upgrade</a>
											</div>
										</td>
										<td>${item.created_at||"_"}</td>
										<td>
											<span class="badge ${item.status == "active" ? "badge-success" : "badge-danger"} d-inline-flex align-items-center badge-xs">
												<i class="ti ti-point-filled me-1"></i>${item.status}
											</span>
										</td>
										<td>
											<div class="action-icon d-inline-flex">
												<a href="#" class="me-2" data-bs-toggle="modal" data-id=${item.id} data-bs-target="#company_detail"><i class="ti ti-eye"></i></a>
												<a href="#" class="me-2" data-bs-toggle="modal" data-id=${item.id} data-bs-target="#edit_company"><i class="ti ti-edit"></i></a>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-id=${item.id} data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
											</div>
										</td>
									</tr>
        `


    })


    $('#companies_table').html(html)
});

function insert_total(data){
    $('#total_schools').html(data.total_schools)
    $('#total_active_school').html(data.total_active_schools)
    $('#total_inactive_school').html(data.total_inactive_schools)
    $('#total_location').html(data.total_locations)
}

function insert_edit_data(data){
    $('[name="edit_plan_name"]').val(data.plan_name).change()
    $('[name="edit_name"]').val(data.name).change()
    $('[name="edit_address"]').val(data.address).change()
    $('[name="edit_email"]').val(data.email).change()
    $('[name="edit_account_url"]').val(data.account_url).change()
    $('[name="edit_phone_number"]').val(data.phone_number).change()
    $('[name="edit_website"]').val(data.website).change()
    $('[name="edit_currency"]').val(data.currency).change()
    $('[name="edit_language"]').val(data.language).change()
    $('[name="edit_plan_type"]').val(data.plan_type).change()
    $('[name="edit_status"]').val(data.status).change()
    $('[name="edit_id"]').val(data.id).change()
    $('[name="edit_location"]').val(data.location).change()

    if(data.profile){
        $('[name="edit_img"]').attr('src',`api/${data.profile}`).change()
    }
   
}

$('#edit_company').on('show.bs.modal', function (e) {
    var triggerElement = $(e.relatedTarget); // Button that triggered the modal
    var dataId = triggerElement.data('id'); // Extract info from data-* attributes

    axios.post(`api/companies.php`,{
        'edit_school':dataId
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

function insert_details_data(data){
   $('#account_url').html(data.account_url)
   $('#name').html(data.name)
   $('#status').addClass(`${data.status == 'active' ? "badge-success":"badge-danger"}`).html(`<i class="ti ti-point-filled"></i>${data.status}`)
   $('#email').html(data.email)
  
   $('#plan_name').html(data.plan_name)
   $('#plan_type').html(data.plan_type)
   $('#price').html(data.price)
 $('#currency').html(data.currency)
 $('#phone_number').html(data.phone_number)
 $('#website').html(data.website)
 $('#address').html(data.address)
 $('#created_at').html(data.created_at)
 $('#language').html(data.language)

 let currentDate = moment(data.created_at);

// Add one year
let nextYear = null
if(data.plan_type == 'yearly'){
    nextYear = currentDate.add(1, 'years').format('YYYY-MM-DD'); // Format the date
  }else{
    nextYear = currentDate.add(1, 'months').format('YYYY-MM-DD'); // Format the date
  }

   $('#expiring_on').html(nextYear)
}

$('#company_detail').on('show.bs.modal', function (e) {
    var triggerElement = $(e.relatedTarget); // Button that triggered the modal
    var dataId = triggerElement.data('id'); // Extract info from data-* attributes
    axios.post(`api/companies.php`,{
        'school_details':1,
        id:dataId
    },{
        headers:{
            'Content-Type': 'multipart/form-data'
        }
    }).then(res=>{
        let result=res.data
       
        console.log(result)
       if(result.status == 'success'){
       insert_details_data(result.data)
        
       }else{
        return null
       }
           
            
            
       
       
    }).catch(error=>{
       return null
        console.log('error',error)
    })
});

$('#edit_company_form').on('submit',function(e){
    e.preventDefault()

    $('#edit_company_form').validate({
        rules:{
          
          
            edit_plan_name:{
                required:true,
               
            },
            edit_plan_type:{
                required:true,
               
            },
           
          
            edit_currency:{
                required:true,
               
            },
            edit_name:{
                required:true,
               
            },
           
           
           
            edit_phone_number:{
                required:true,
               
            },
           
            edit_language:{
                required:true,
               
            },
          
           
        },
       
    })

    if(!$('#edit_company_form').valid()){
return
    }

const formData = new FormData(this);
formData.append('update_company',1)
axios.post(`api/companies.php`,formData).then(res=>{
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
    $('#edit_company').modal('hide');
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


$('#delete_modal').on('show.bs.modal', function (e) {
    var triggerElement = $(e.relatedTarget); // Button that triggered the modal
    var dataId = triggerElement.data('id'); // Extract info from data-* attributes
    $('#delete_id').val(dataId).change();
});

$('#delete_company').on('click',function(e){
    e.preventDefault()
    let id =$('#delete_id').val();
    axios.post(`api/companies.php`,{
        'delete_companies':1,
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


