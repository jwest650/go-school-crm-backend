<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<head>
<title>Smarthr Admin Template</title>
 <?php include 'layouts/title-meta.php'; ?>
 <?php include 'layouts/head-css.php'; ?>
<!-- Owl Carousel -->
<link rel="stylesheet" href="assets/plugins/owlcarousel/owl.carousel.min.css">
<!-- Player CSS -->
<link rel="stylesheet" href="assets/css/plyr.css">

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
						<h2 class="mb-1">Resignation</h2>
						<nav>
							<ol class="breadcrumb mb-0">
								<li class="breadcrumb-item">
									<a href="admin-dashboard.php"><i class="ti ti-smart-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									Performance
								</li>
								<li class="breadcrumb-item active" aria-current="page">Resignation</li>
							</ol>
						</nav>
					</div>
					<div class="d-flex my-xl-auto right-content align-items-center flex-wrap ">
						<div class="mb-2">
							<a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#new_resignation"><i class="ti ti-circle-plus me-2"></i>Add Resignation</a>
						</div>
						<div class="head-icons ms-2">
							<a href="javascript:void(0);" class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
								<i class="ti ti-chevrons-up"></i>
							</a>
						</div>
					</div>
				</div>
				<!-- /Breadcrumb -->

				<!-- Resignation List -->
                <div class="row">
					<div class="col-sm-12">
						<div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                <h5 class="d-flex align-items-center">Resignation List</h5>
                                <div class="d-flex align-items-center flex-wrap row-gap-3">
                                    <div class="input-icon position-relative me-2">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control date-range bookingrange" placeholder="dd/mm/yyyy - dd/mm/yyyy ">
                                    </div>
                                    <div class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle btn btn-white d-inline-flex align-items-center fs-12" data-bs-toggle="dropdown">
                                            <p class="fs-12 d-inline-flex me-1">Sort By : </p>
                                            Last 7 Days
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
												<th>Resigning Employee</th>
												<th>Department</th>
												<th>Reason</th>
												<th>Notice Date</th>
												<th>Resignation Date</th>
                                                <th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
                                                <td>
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>                                        
                                                </td>
												<td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="invoice-details.php" class="avatar avatar-md me-2">
                                                            <img src="assets/img/users/user-32.jpg" class="rounded-circle" alt="user">
                                                        </a>
                                                        <h6 class="fw-medium"><a href="invoice-details.php">Anthony Lewis</a></h6>
                                                    </div>
                                                </td>
												<td>Finance</td>
												<td>Career Change</td>
												<td>14 Jan 2024</td>
												<td>14 Mar 2024</td>
                                                <td>
                                                    <div class="action-icon d-inline-flex">
                                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_resignation"><i class="ti ti-edit"></i></a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
											</tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>                                        
                                                </td>
												<td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="invoice-details.php" class="avatar avatar-md me-2">
                                                            <img src="assets/img/users/user-09.jpg" class="rounded-circle"
                                                                alt="user">
                                                        </a>
                                                        <h6 class="fw-medium"><a href="invoice-details.php">Brian Villalobos</a></h6>
                                                    </div>
                                                </td>
												<td>Application Development</td>
												<td>Entrepreneurial Pursuits</td>
												<td>21 Jan 2024</td>
												<td>21 Mar 2024</td>
                                                <td>
                                                    <div class="action-icon d-inline-flex">
                                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_resignation"><i class="ti ti-edit"></i></a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
											</tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>                                        
                                                </td>
												<td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="invoice-details.php" class="avatar avatar-md me-2">
                                                            <img src="assets/img/users/user-01.jpg" class="rounded-circle" alt="user">
                                                        </a>
                                                        <h6 class="fw-medium"><a href="invoice-details.php">Harvey Smith</a></h6>
                                                    </div>
                                                </td>
												<td>Web Development</td>
												<td>Relocation</td>
												<td>18 Feb 2024</td>
												<td>18 Apr 2024</td>
                                                <td>
                                                    <div class="action-icon d-inline-flex">
                                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_resignation"><i class="ti ti-edit"></i></a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
											</tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>                                        
                                                </td>
												<td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="invoice-details.php" class="avatar avatar-md me-2">
                                                            <img src="assets/img/users/user-33.jpg" class="rounded-circle" alt="user">
                                                        </a>
                                                        <h6 class="fw-medium"><a href="invoice-details.php">Stephan Peralt</a></h6>
                                                    </div>
                                                </td>
												<td>UI / UX</td>
												<td>Health Reasons</td>
												<td>14 Mar 2024</td>
												<td>14 Apr 2024</td>
                                                <td>
                                                    <div class="action-icon d-inline-flex">
                                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_resignation"><i class="ti ti-edit"></i></a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
											</tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-md">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>                                        
                                                </td>
												<td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="invoice-details.php" class="avatar avatar-md me-2">
                                                            <img src="assets/img/users/user-34.jpg" class="rounded-circle" alt="user">
                                                        </a>
                                                        <h6 class="fw-medium"><a href="invoice-details.php">Doglas Martini</a></h6>
                                                    </div>
                                                </td>
												<td>Marketing</td>
												<td>Personal Development</td>
												<td>10 Apr 2024</td>
												<td>10 Jun 2024</td>
                                                <td>
                                                    <div class="action-icon d-inline-flex">
                                                        <a href="#" class="me-2" data-bs-toggle="modal" data-bs-target="#edit_resignation"><i class="ti ti-edit"></i></a>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
											</tr>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Resignation List  -->
			</div>

			<!-- Footer -->
			<div class="footer d-sm-flex align-items-center justify-content-between bg-white border-top p-3">
				<p class="mb-0">2014 - 2025 &copy; SmartHR.</p>
				<p>Designed &amp; Developed By <a href="#" class="text-primary">Dreams</a></p>
			</div>
			<!-- /Footer -->

		</div>

		<!-- /Page Wrapper -->

        <!-- Add Resignation -->
            <div class="modal fade" id="new_resignation">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Resignation</h4>
                            <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                        <form action="resignation.php">
                            <div class="modal-body pb-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Resigning Employee</label>
                                            <select class="select">
                                                <option>Select</option>
                                                <option>Anthony Lewis</option>
                                                <option>Brian Villalobos</option>
                                                <option>Doglas Martini</option>
                                            </select>
                                        </div>									
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Notice Date</label>
                                            <div class="input-icon-end position-relative">
                                                <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-calendar text-gray-7"></i>
                                                </span>
                                            </div>
                                        </div>									
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Resignation Date</label>
                                            <div class="input-icon-end position-relative">
                                                <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-calendar text-gray-7"></i>
                                                </span>
                                            </div>
                                        </div>									
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Reason</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white border me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Resignation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- /Add Resignation -->

        <!-- Edit Resignation -->
            <div class="modal fade" id="edit_resignation">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Resignation</h4>
                            <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="ti ti-x"></i>
                            </button>
                        </div>
                        <form action="resignation.php">
                            <div class="modal-body pb-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Resigning Employee</label>
                                            <input type="text" class="form-control" value="Anthony Lewis">
                                        </div>									
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Notice Date</label>
                                            <div class="input-icon-end position-relative">
                                                <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy" value="14 Jan 2024">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-calendar text-gray-7"></i>
                                                </span>
                                            </div>
                                        </div>									
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Resignation Date</label>
                                            <div class="input-icon-end position-relative">
                                                <input type="text" class="form-control datetimepicker" placeholder="dd/mm/yyyy" value="14 Mar 2024">
                                                <span class="input-icon-addon">
                                                    <i class="ti ti-calendar text-gray-7"></i>
                                                </span>
                                            </div>
                                        </div>									
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Reason</label>
                                            <textarea class="form-control" rows="3">Career Change</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white border me-2" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- /Edit Resignation -->

		<!-- Delete Modal -->
		<div class="modal fade" id="delete_modal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<span class="avatar avatar-xl bg-transparent-danger text-danger mb-3">
							<i class="ti ti-trash-x fs-36"></i>
						</span>
						<h4 class="mb-1">Confirm Delete</h4>
						<p class="mb-3">You want to delete all the marked items, this cant be undone once you delete.</p>
						<div class="d-flex justify-content-center">
							<a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
							<a href="resignation.php" class="btn btn-danger">Yes, Delete</a>
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
<!-- Owl Carousel -->
<script src="assets/plugins/owlcarousel/owl.carousel.min.js"></script>

</body>
</html>