<?php require_once 'core/init.php'; ?>
<?php admin(); 
        if (!isAdmin()){
        redirectTo ('../dash.php');
        }
?>

<?php include_once 'inc/header.php'; 
?>
<!-- Page content -->
						<div class="container-fluid pt-8">
							<div class="page-header mt-0 shadow p-3">
								<ol class="breadcrumb mb-sm-0">
									<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Approved Applications</li>
								</ol>
							</div>
                            
                            <div class="row">
                            <div class="col-lg-12">
									<div class="card shadow">
										<div class="card-header ">
											<h2 class="mb-0">Approved Applications</h2>
										</div>
										<div class="card-body">
											<div class="table-responsive ">
												<table class="table table-bordered align-items-center">
													<thead>
														<tr>
															<th>S/N</th>
															<th>Passport No.</th>
															<th>Type of Request</th>
															<th>Old Data</th>
															<th>New Data</th>
															<th>Documents</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td></td>
															<td></td>
                                                            <td></td>
															<td></td>
															<td></td>
															<td></td>
															<td><a class="btn btn-success btn-md" href="">Approved</a>
                                                            </td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            
                            
                            
                            
                            

<?php include_once 'inc/footer.php';  ?>