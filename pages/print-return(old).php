<?php require_once 'core/init.php';
        require_once 'core/init2.php';
    restricted();
    ?>
<?php include_once 'inc/header-2.php'; ?>
<?php
if (isset($_POST['submit'])) {
    if (isset($_GET['go'])) {
        $search = $_POST['search'];
        $mon = $_POST['month'];
        $yea = $_POST['year'];

            $sql = mysqli_query($con, "SELECT * FROM `tbl_ppt` WHERE missionid ='" .$search."' AND month ='".$mon."' AND year= '".$yea."' ") or die();
            if ($r = mysqli_fetch_array($sql)) {

                ?>
<!-- Page content -->

      <div class="container-fluid pt-8">
                <?php error($errors); ?>
                <div class="row" id="print">
                    <div class="col-md-12">
                        <div class="card-box card shadow">
                            <div class="card-body">
                                <div class="clearfix">
                                    <h3 style="text-align: center"><strong>NIGERIA IMMIGRATION SERVICE</strong><br />
                                        FOREIGN MISSIONS MONTHLY E-REPORT
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body" >
                                <div class="mb-0">
                                    <div class="row border-bottom">
                                        <div class="col-md-12">
                                            <div class="float-right"><h3 class="mb-0">FOR: <strong><?php echo $r['month']."  ".$r['year']; ?></strong></h3></div>
                                            <div class="float-left">
                                                <h4>Mission: <strong><?php echo $r['missionid'].", ".$r['countryid']; ?></strong></h4>
                                            </div>

                                        </div><!-- end col -->

                                    </div>
                                    <!-- end row -->

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <h3 style="text-align: center"><strong>PASSPORT MONTHLY RETURNS</strong></h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-t-30 text-nowrap">
                                                    <thead >
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Opening Balance</th>
                                                        <th>Issuance</th>
                                                        <th>Damaged</th>
                                                        <th>Balance in stock</th>
                                                        <th class="text-right">Revenue(USD)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><strong>32 PAGES</strong></td>
                                                        <td><?php echo $r['opn_bal_32']; ?></td>
                                                        <td><?php echo $r['ppt_32']; ?></td>
                                                        <td><?php echo $r['dam_32']; ?></td>
                                                        <td><?php echo $r['stock_bal_32']; ?></td>
                                                        <td class="text-right"><?php echo $r['ppt_rev_32']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>64 PAGES</strong></td>
                                                        <td><?php echo $r['opn_bal_64']; ?></td>
                                                        <td><?php echo $r['ppt_64']; ?></td>
                                                        <td><?php echo $r['dam_64']; ?></td>
                                                        <td><?php echo $r['stock_bal_64']; ?></td>
                                                        <td class="text-right"><?php echo $r['ppt_rev_64']; ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                <hr />
                                            <?php } ?>

        <?php
        $sqq = mysqli_query($con, "SELECT * FROM `tbl_visa_class` WHERE missionid='" . $search . "' AND month='" . $mon . "' AND year='" . $yea . "'") or die();
        if ($p = mysqli_fetch_array($sqq)) {
            ?>

                                            <h3 style="text-align: center"><strong>VISA RETURNS</strong></h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-t-30 text-nowrap">
                                                    <thead >
                                                    <tr>
                                                        <th>Opening Balance</th>
                                                        <th>Issuance</th>
                                                        <th>Damaged</th>
                                                        <th>Balance in stock</th>
                                                        <th class="text-right">Revenue(USD)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><?php echo $p['opn_bal']; ?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="table-responsive" style="padding-top: 25px">
                                                <h3 style="text-align: center">VISA CLASSIFICATION</h3>
                                                <table class="table table-bordered align-items-center">
                                                    <tbody>
                                                    <tr>
                                                        <td>Type</td>
                                                        <td class="text-right">Number Issued</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span></span></td>
                                                        <td class="text-right text-muted"><span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Total</span></td>
                                                        <td><h2 class="price text-right mb-0"></h2></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <hr />
                                            <h3 style="text-align: center"><strong>STAFF MANAGEMENT NOMINAL ROLL</strong></h3>
                                            <div class="">
                                                <table class="table table-bordered w-100 text-nowrap">
                                                    <thead >
                                                    <tr>
                                                        <th class="wd-5p">S/N</th>
                                                        <th class="wd-10p">NIS No.</th>
                                                        <th class="wd-15p">Full Name</th>
                                                        <th class="wd-5p">Rank</th>
                                                        <th class="wd-5p">Date Posted</th>
                                                        <th class="wd-5p">State of Origin</th>
                                                        <th class="wd-15p">E-mail</th>
                                                        <th class="wd-10p">Phone No</th>
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
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="table-responsive" style="padding-top: 25px">
                                                <h3 style="text-align: center">LOCAL STAFF</h3>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered m-t-30 text-nowrap">
                                                        <thead >
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Name</th>
                                                            <th>Designation</th>
                                                            <th>Salary (per month)</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>

                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-print-none">
                                        <div class="float-right">
                                            <a href="javascript:window.print('print')" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                                            <a href="#" class="btn btn-default"><i class="fa fa-paper-plane" aria-hidden="true"></i> Export</a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php }
            }
}
?>

                <?php include_once 'inc/footer.php';  ?>