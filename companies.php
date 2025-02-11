<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
	<title>Smarthr Admin Template</title>
	<?php include 'layouts/title-meta.php'; ?>
	<?php include 'layouts/head-css.php'; ?>
</head>

<body>
	<div id="global-loader" style="display: none;">
		<div class="page-loader"></div>
	</div>

	<div class="main-wrapper">
		<?php include 'layouts/menu.php'; ?>

		<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content">

				<!-- Breadcrumb -->
				<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
					<div class="my-auto mb-2">
						<h2 class="mb-1">School</h2>
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item">
									<a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									Application
								</li>
								<li class="breadcrumb-item active" aria-current="page">School List</li>
							</ol>
						</nav>
					</div>
					<div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
						<div class="me-2 mb-2">
							<div class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
									<i class="ti ti-file-export me-1"></i>Export
								</a>
								<ul class="dropdown-menu  dropdown-menu-end p-3">
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1"><i class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
									</li>
								</ul>
							</div>
						</div>
						<div class="mb-2">
							<a href="#" data-bs-toggle="modal" data-bs-target="#add_company" class="btn btn-primary d-flex align-items-center"><i class="ti ti-circle-plus me-2"></i>Add School</a>
						</div>
						<div class="ms-2 head-icons">
							<a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
								<i class="ti ti-chevrons-up"></i>
							</a>
						</div>
					</div>
				</div>
				<!-- /Breadcrumb -->

				<div class="row">

					<!-- Total Companies -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="card flex-fill">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center overflow-hidden">
									<span class="avatar avatar-lg bg-primary flex-shrink-0">
										<i class="ti ti-building fs-16"></i>
									</span>
									<div class="ms-2 overflow-hidden">
										<p class="fs-12 fw-medium mb-1 text-truncate">Total School</p>
										<h4 id="total_schools">0</h4>
									</div>
								</div>
								<div id="total-chart"></div>
							</div>
						</div>
					</div>
					<!-- /Total Companies -->

					<!-- Total Companies -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="card flex-fill">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center overflow-hidden">
									<span class="avatar avatar-lg bg-success flex-shrink-0">
										<i class="ti ti-building fs-16"></i>
									</span>
									<div class="ms-2 overflow-hidden">
										<p class="fs-12 fw-medium mb-1 text-truncate">Active School</p>
										<h4 id="total_active_school">0</h4>
									</div>
								</div>
								<div id="active-chart"></div>
							</div>
						</div>
					</div>
					<!-- /Total Companies -->

					<!-- Inactive Companies -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="card flex-fill">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center overflow-hidden">
									<span class="avatar avatar-lg bg-danger flex-shrink-0">
										<i class="ti ti-building fs-16"></i>
									</span>
									<div class="ms-2 overflow-hidden">
										<p class="fs-12 fw-medium mb-1 text-truncate">Inactive School</p>
										<h4 id="total_inactive_school">0</h4>
									</div>
								</div>
								<div id="inactive-chart"></div>
							</div>
						</div>
					</div>
					<!-- /Inactive Companies -->

					<!-- Company Location -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="card flex-fill">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div class="d-flex align-items-center overflow-hidden">
									<span class="avatar avatar-lg bg-skyblue flex-shrink-0">
										<i class="ti ti-map-pin-check fs-16"></i>
									</span>
									<div class="ms-2 overflow-hidden">
										<p class="fs-12 fw-medium mb-1 text-truncate">School Location</p>
										<h4 id="total_location">0</h4>
									</div>
								</div>
								<div id="location-chart"></div>
							</div>
						</div>
					</div>
					<!-- /Company Location -->

				</div>

				<div class="card">
					<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
						<h5>Companies List</h5>
						<div class="d-flex my-xl-auto right-content align-items-center flex-wrap row-gap-3">
							<div class="me-3">
								<div class="input-icon-end position-relative">
									<input type="text" class="form-control date-range bookingrange" placeholder="dd/mm/yyyy - dd/mm/yyyy">
									<span class="input-icon-addon">
										<i class="ti ti-chevron-down"></i>
									</span>
								</div>
							</div>
							<div class="dropdown me-3">
								<a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
									Select Plan
								</a>
								<ul class="dropdown-menu  dropdown-menu-end p-3">
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Advanced</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Basic</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Enterprise</a>
									</li>
								</ul>
							</div>
							<div class="dropdown me-3">
								<a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
									Select Status
								</a>
								<ul class="dropdown-menu  dropdown-menu-end p-3">
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Active</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Inactive</a>
									</li>
								</ul>
							</div>
							<div class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center" data-bs-toggle="dropdown">
									Sort By : Last 7 Days
								</a>
								<ul class="dropdown-menu  dropdown-menu-end p-3">
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Recently Added</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Ascending</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Desending</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Last Month</a>
									</li>
									<li>
										<a href="javascript:void(0);" class="dropdown-item rounded-1">Last 7 Days</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="custom-datatable-filter table-responsive">
							<table class="table datatable">
								<thead class="thead-light">
									<tr>
										<th class="no-sort">
											<div class="form-check form-check-md">
												<input class="form-check-input" type="checkbox" id="select-all">
											</div>
										</th>
										<th>Company Name</th>
										<th>Email</th>
										<th>Account URL</th>
										<th>Plan</th>
										<th>Created Date</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="companies_table">

								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>

			<div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
				<p class="mb-0">2014 - 2025 &copy; Go School.</p>
				<p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Go School</a></p>
			</div>

		</div>
		<!-- /Page Wrapper -->

		<!-- Add Company -->
		<div class="modal fade" id="add_company">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Add School</h4>
						<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
							<i class="ti ti-x"></i>
						</button>
					</div>
					<form id="company_form" action="companies.php" enctype="multipart/form-data">
						<div class=" modal-body pb-0">
							<div class="row">
								<div class="col-md-12">
									<div class="d-flex align-items-center flex-wrap row-gap-3 bg-light w-100 rounded p-3 mb-4">
										<div class="d-flex align-items-center justify-content-center avatar avatar-xxl rounded-circle border border-dashed me-2 flex-shrink-0 text-dark frames">
											<img id="img" src="assets/img/profiles/avatar-30.jpg" alt="img" class="rounded-circle">
										</div>
										<div class="profile-upload">
											<div class="mb-2">
												<h6 class="mb-1">Upload Profile Image</h6>
												<p class="fs-12">Image should be below 4 mb</p>
											</div>
											<div class="profile-uploader d-flex align-items-center">
												<div class="drag-upload-btn btn btn-sm btn-primary me-2">
													Upload
													<input name="profile" type="file" class="form-control image-sign" multiple="">
												</div>
												<a href="javascript:void(0);" class="btn btn-light btn-sm">Cancel</a>
											</div>

										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Name <span class="text-danger"> *</span></label>
										<input name="name" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Email Address</label>
										<input name="email" type="email" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Account URL</label>
										<input name="account_url" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Phone Number <span class="text-danger"> *</span></label>
										<input name="phone_number" type="number" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Website</label>
										<input name="website" type="text" class="form-control">
									</div>
								</div>

								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Address</label>
										<input name="address" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3 ">
										<label class="form-label">Plan Name <span class="text-danger"> *</span></label>
										<select name="plan_name" class="select">
											<option value="">Select</option>
											<option value="advanced">Advanced</option>
											<option value="basic">Basic</option>
											<option value="enterprise">Enterprise</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3 ">
										<label class="form-label">Plan Type <span class="text-danger"> *</span></label>
										<select name="plan_type" class="select">
											<option value="">Select</option>
											<option value="monthly">Monthly</option>
											<option value="yearly">Yearly</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Currency <span class="text-danger"> *</span></label>
										<select name="currency" class="select">
											<option value="">Select</option>
											<option value="usd">USD</option>
											<option value="euro">Euro</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Language <span class="text-danger"> *</span></label>
										<select name="language" class="select">
											<option value="">Select</option>
											<option value="english">English</option>
											<option value="arabic">Arabic</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Status</label>
										<select name="status" class="select">
											<option value="">Select</option>
											<option value="active">Active</option>
											<option value="inactive">Inactive</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Location</label>
										<select name="location" class="select">
											<option value="">Select</option>
											<option value="accra">Accra</option>
											<option value="volta">Volta</option>
											<option value="ashanti">Ashanti</option>


										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Add School</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Company -->

		<!-- Edit Company -->
		<div class="modal fade" id="edit_company">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Edit School</h4>
						<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
							<i class="ti ti-x"></i>
						</button>
					</div>
					<form id="edit_company_form">
						<div class="modal-body pb-0">
							<div class="row">
								<div class="col-md-12">
									<div class="d-flex align-items-center flex-wrap row-gap-3 bg-light w-100 rounded p-3 mb-4">
										<div class="d-flex align-items-center justify-content-center avatar avatar-xxl rounded-circle border border-dashed me-2 flex-shrink-0 text-dark frames">
											<img name='edit_img' src="assets/img/profiles/avatar-30.jpg" alt="img" class="rounded-circle">
										</div>
										<div class="profile-upload">
											<div class="mb-2">
												<h6 class="mb-1">Upload Profile Image</h6>
												<p class="fs-12">Image should be below 4 mb</p>
											</div>
											<div class="profile-uploader d-flex align-items-center">
												<div class="drag-upload-btn btn btn-sm btn-primary me-2">
													Upload
													<input name="edit_profile" type="file" class="form-control image-sign" multiple="">
												</div>
												<a href="javascript:void(0);" class="btn btn-light btn-sm">Cancel</a>
											</div>
											<input name="edit_id" type="hidden">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Name <span class="text-danger"> *</span></label>
										<input name="edit_name" type="text" class="form-control" value="Stellar Dynamics">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Email Address</label>
										<input name="edit_email" type="email" class="form-control" value="sophie@example.com">
									</div>
								</div>
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Account URL</label>
										<input name="edit_account_url" type="text" class="form-control" value="sd.example.com">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Phone Number <span class="text-danger"> *</span></label>
										<input name="edit_phone_number" type="text" class="form-control" value="+1 895455450">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Website</label>
										<input name="edit_website" type="text" class="form-control" value="Admin Website">
									</div>
								</div>

								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Address</label>
										<input name="edit_address" type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3 ">
										<label class="form-label">Plan Name <span class="text-danger"> *</span></label>
										<select name="edit_plan_name" class="select">
											<option value="">Select</option>
											<option value="advanced">Advanced</option>
											<option value="basic">Basic</option>
											<option value="enterprise">Enterprise</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3 ">
										<label class="form-label">Plan Type <span class="text-danger"> *</span></label>
										<select name="edit_plan_type" class="select">
											<option value="">Select</option>
											<option value="monthly">Monthly</option>
											<option value="yearly">Yearly</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Currency <span class="text-danger"> *</span></label>
										<select name="edit_currency" class="select">
											<option value="">Select</option>
											<option value="usd">USD</option>
											<option value="euro">Euro</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Language <span class="text-danger"> *</span></label>
										<select name="edit_language" class="select">
											<option value="">Select</option>
											<option value="english">English</option>
											<option value="arabic">Arabic</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Status</label>
										<select name="edit_status" class="select">
											<option value="">Select</option>
											<option value="active">Active</option>
											<option value="inactive">Inactive</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3 ">
										<label class="form-label">Location</label>
										<select name="edit_location" class="select">
											<option value="">Select</option>
											<option value="accra">Accra</option>
											<option value="volta">Volta</option>
											<option value="ashanti">Ashanti</option>


										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Edit Company -->

		<!-- Upgrade Information -->
		<div class="modal fade" id="upgrade_info">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Upgrade Package</h4>
						<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
							<i class="ti ti-x"></i>
						</button>
					</div>
					<div class="p-3 mb-1">
						<div class="rounded bg-light p-3">
							<h5 class="mb-3">Current Plan Details</h5>
							<div class="row align-items-center">
								<div class="col-md-4">
									<div class="mb-3">
										<p class="fs-12 mb-0">Company Name</p>
										<p class="text-gray-9">BrightWave Innovations</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3">
										<p class="fs-12 mb-0">Plan Name</p>
										<p class="text-gray-9">Advanced</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3">
										<p class="fs-12 mb-0">Plan Type</p>
										<p class="text-gray-9">Monthly</p>
									</div>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-md-4">
									<div class="mb-3">
										<p class="fs-12 mb-0">Price</p>
										<p class="text-gray-9">200</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3">
										<p class="fs-12 mb-0">Register Date</p>
										<p class="text-gray-9">12 Sep 2024</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mb-3">
										<p class="fs-12 mb-0">Expiring On</p>
										<p class="text-gray-9">11 Oct 2024</p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<form action="companies.php">
						<div class="modal-body pb-0">
							<h5 class="mb-4">Change Plan</h5>
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3 ">
										<label class="form-label">Plan Name <span class="text-danger">*</span></label>
										<select class="select">
											<option>Select</option>
											<option>Advanced</option>
											<option>Basic</option>
											<option>Enterprise</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3 ">
										<label class="form-label">Plan Type <span class="text-danger">*</span></label>
										<select class="select">
											<option>Select</option>
											<option>Monthly</option>
											<option>Yearly</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Ammount<span class="text-danger">*</span></label>
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Payment Date <span class="text-danger">*</span></label>
										<div class="input-icon-end position-relative">
											<input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy">
											<span class="input-icon-addon">
												<i class="ti ti-calendar text-gray-7"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Next Payment Date <span class="text-danger">*</span></label>
										<div class="input-icon-end position-relative">
											<input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy">
											<span class="input-icon-addon">
												<i class="ti ti-calendar text-gray-7"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Expiring On <span class="text-danger">*</span></label>
										<div class="input-icon-end position-relative">
											<input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy">
											<span class="input-icon-addon">
												<i class="ti ti-calendar text-gray-7"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Upgrade Information -->

		<!-- Company Detail -->
		<div class="modal fade" id="company_detail">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Company Detail</h4>
						<button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
							<i class="ti ti-x"></i>
						</button>
					</div>
					<div class="moday-body ">
						<div class="p-3">
							<div class="d-flex justify-content-between align-items-center rounded bg-light p-3">
								<div class="file-name-icon d-flex align-items-center">
									<a href="#" class="avatar avatar-md border rounded-circle flex-shrink-0 me-2">
										<img src="assets/img/company/company-01.svg" class="img-fluid" alt="img">
									</a>
									<div>
										<p id="name" class="text-gray-9 fw-medium mb-0 text-capitalize"></p>
										<p id='email' class='text-capitalize'></p>
									</div>
								</div>
								<span id="status" class="badge text-capitalize"></span>
							</div>
						</div>
						<div class="p-3">
							<p class="text-gray-9 fw-medium">Basic Info</p>
							<div class="pb-1 border-bottom mb-4">
								<div class="row align-items-center">
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Account URL</p>
											<p id="account_url" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0 text-capitalize">Phone Number</p>
											<p id="phone_number" class="text-gray-9  text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Website</p>
											<p id="website" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Currency</p>
											<p id="currency" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Language</p>
											<p id="language" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Addresss</p>
											<p id="address" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
								</div>
							</div>
							<p class="text-gray-9 fw-medium">Plan Details</p>
							<div>
								<div class="row align-items-center">
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Plan Name</p>
											<p id="plan_name" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Plan Type</p>
											<p id="plan_type" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Price</p>
											<p id="price" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
								</div>
								<div class="row align-items-center">
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Register Date</p>
											<p id="created_at" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="mb-3">
											<p class="fs-12 mb-0">Expiring On</p>
											<p id="expiring_on" class="text-gray-9 text-capitalize"></p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>


				</div>
			</div>
		</div>
		<!-- /Company Detail -->

		<!-- Delete Modal -->
		<div class="modal fade" id="delete_modal">
			<div class="modal-dialog modal-dialog-centered modal-sm">
				<div class="modal-content">
					<div class="modal-body text-center">
						<span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
							<i class="ti ti-trash-x fs-36"></i>
						</span>
						<h4 class="mb-1">Confirm Delete</h4>
						<p class="mb-3">You want to delete all the marked items, this cant be undone once you delete.</p>
						<input type="hidden" name="delete_id" id="delete_id">
						<div class="d-flex justify-content-center">
							<a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
							<a id="delete_company" href="javascript:void(0);" class="btn btn-danger">Yes, Delete</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Delete Modal -->


	</div>
	<!-- end main wrapper-->
	<!-- JAVASCRIPT -->
	<?php include 'layouts/vendor-scripts.php'; ?>
	<script src="assets/js/companies.js"></script>

</body>

</html>