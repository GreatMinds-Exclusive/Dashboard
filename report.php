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
    <div class="row">
    <div class="col-md-12">
    <div class="card shadow">
        <div class="card-header">
            <h2 class="mb-0">MONTHLY REPORT GENERATION </h2>
        </div>
        <div class="card-body">
            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active border" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fe fe-book mr-2"></i>Passport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 border" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fe fe-credit-card mr-2"></i>Visa</a>
                    </li>
                </ul>
            </div>
            <div class="card shadow mb-0">
                <div class="card-body ">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <a href="report.php?p=1"><button class="btn btn-lg btn-success"><i class="fa fa-book"></i> BY MISSION</button></a>
                            <a href="report.php?p=2"><button class="btn btn-lg btn-danger"><i class="fa fa-globe"></i> BY CONTINENT</button></a>

                            <?php if (@$_GET['p'] == 1) { ?>

                                <div class="card-body">
                                    <form action="print-return.php?p=1&go" method="post" id="searchform">
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
                                               <!-- <li class="nav-item">
                                                    <div class="form-group">
                                                        <select class="form-control month" name="month" required />
                                                        <option value="">-- Choose Month --</option>

                                                        </select>
                                                    </div>
                                                </li>-->
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
                            <?php } ?>

                            <?php if (@$_GET['p'] == 2) { ?>
                                <div class="card-body">
                                    <form action="print-return.php?p=2&go" method="post" id="searchform">
                                        <div class="nav-wrapper p-0">
                                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                                <li class="nav-item">
                                                    <div class="form-group">
                                                        <select class="form-control continent" name="search" required />
                                                        <option value="">-- Choose Continent --</option>
                                                        <option>Africa</option>
                                                        <option>Asia</option>
                                                        <option>America</option>
                                                        <option>Oceania</option>
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
                                                    <button type="submit" name="save" class="btn btn-danger"><i class="far fa-images mr-2"></i>Submit</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>

                            <?php } ?>
                        </div>


                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



          </div>
                            
<?php include_once 'inc/footer.php';  ?>