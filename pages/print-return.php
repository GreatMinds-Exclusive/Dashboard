<?php require_once 'core/init.php';
        require_once 'core/init2.php';
    restricted();
    ?>
<?php include_once 'inc/header-2.php'; ?>

<!-- Page content -->

      <div class="container-fluid pt-8">
                <?php error($errors); ?>
                <div class="row" id="print">
                    <div class="col-md-12">
                        <div class="card-box card shadow">
                            <div class="card-body">
                                <div class="clearfix">
                                    <h3 style="text-align: center"><strong>NIGERIA IMMIGRATION SERVICE</strong><br />
                                        FOREIGN MISSIONS MONTHLY E-REPORT<br />
                                        PASSPORT MONTHLY RETURNS
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body" >
                                <div class="mb-0">
                            <?php
                            if (isset($_POST['submit'])) {
                            if (isset($_GET['go'])) {
                            $search = $_POST['search'];
                            $yea = $_POST['year'];

                            $sql = mysqli_query($con, "SELECT * FROM `tbl_ppt` WHERE missionid ='" .$search."' AND year= '".$yea."' ") or die();
                                while ($r = mysqli_fetch_array($sql)) {
                            ?>
                                  <div class="row mt-4">
                                        <div class="col-md-12">

                                            <h3><strong> <?php echo $r['missionid'].", ".$r['countryid']; ?>
                                                </strong>
                                            </h3>
                                            <h3 style="text-align: right"><strong><?php echo $r['month']." ".$r['year']; ?>
                                                </strong>
                                            </h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-t-30 text-nowrap">
                                                    <thead >
                                                    <?php
                                                        $c = 1; ?>
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
                                                    <?php
                                                    $c++;
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
            <?php }
    }
} else if (isset($_POST['save'])) {
        if (isset($_GET['go'])) {
         $search = $_POST['search'];
          $yea = $_POST['year'];

          $query = mysqli_query($con, "SELECT * FROM `tbl_ppt` WHERE continent_id ='" .$search."' AND year= '".$yea."' ") or die();
            while ($s = mysqli_fetch_array($query)) {
?>
            <div class="row mt-4">
                 <div class="col-md-12">

                    <h3><strong><?php echo $s['continent_id'] ?> PASSPORT RETURNS <?php echo $s['year'] ?></strong></h3>
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-t-30 text-nowrap">
                                                    <thead>
                                                    <tr>
                                                        <th class="wd-5p">S/N</th>
                                                    </tr>
                                                    </thead>
                                        </div>
                                    </div>
                                    </div>
                                    <?php }
                                    }
                                }
                            ?>
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
      </div>
<?php include_once 'inc/footer.php';  ?>