<?php require_once 'core/init.php';
      require_once 'core/init2.php';
         admin();
        if (!isAdmin()){
        redirectTo ('dash.php');
        }
            ?>

<?php include_once 'inc/header-2.php'; ?>
            <!-- Page content -->
                <div class="container-fluid pt-8">

							<div class="page-header mt-0 shadow p-3">
								<ol class="breadcrumb mb-sm-0">
									<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Monthly Reports</li>
								</ol>
							</div>
                            <div class="col-md-12">
				                <h2>MONTHLY REPORT GENERATION</h2>
	                           <a href="report.php"><button class="btn btn-default"><i class="fa fa-book"></i> MISSION</button></a>
	                           <a href="#"><button class="btn btn-success"><i class="fa fa-globe"></i> CONTINENT</button></a>
                                <div class="clearfix" style="margin-bottom: 20px;"></div>



                    <div class="card shadow">
                       <div class="card-body">
                           <form action="print-return.php?go" method="post" id="searchform">
                           <div class="nav-wrapper p-0">
												<ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
													<li class="nav-item">
														<div class="form-group">
												    <select class="form-control mission" name="search" required />
													<option value="">-- Choose Mission --</option>
													<?php
														$mission = $mission->getMissions();
                                                            foreach($mission as $mission) {
		                                                      echo "<option value='".$mission['mission']."'";
		                                                      echo stickySelect('missionid', $mission['mission']);
		                                                      echo ">".$mission['mission']."</option>";
														}
													?>
												    </select>
											         </div>
                                                    </li>
												    <li class="nav-item">
														<div class="form-group">
												    <select class="form-control month" name="month" required />
													<option value="">-- Choose Month --</option>
													<?php
														$month = $month->getMonth();
                                                            foreach($month as $month) {
		                                                      echo "<option value='".$month['month']."'";
		                                                      echo stickySelect('monthid', $month['month']);
		                                                      echo ">".$month['month']."</option>";
														}
													?>
												    </select>
											         </div>
													</li>
                                                    <li class="nav-item">
														<div class="form-group">
												    <select class="form-control year" name="year" required />
													<option value="">-- Choose Year --</option>
													<?php
														$year = $year->getYear();
                                                            foreach($year as $year) {
		                                                      echo "<option value='".$year['year']."'";
		                                                      echo stickySelect('yearid', $year['year']);
		                                                      echo ">".$year['year']."</option>";
														}
													?>
												    </select>
											         </div>
													</li>
													<li class="nav-item">
                                                        <button type="submit" name="submit" class="btn btn-success"><i class="far fa-images mr-2"></i>Submit</button>
													</li>
												</ul>
											</div>
                                        </form>
                               </div>
                </div>
          </div>
                            
<?php include_once 'inc/footer.php';  ?>