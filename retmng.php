<?php require_once 'core/init2.php';
?>

<?php if (count($_POST) > 0){
    $sqq = mysqli_query($con, "SELECT * FROM tbl_ppt WHERE id='" .$_SESSION["missionid"] . "' ");
    $row = mysqli_fetch_array($sqq);
    if ($_POST['submit']) {
    $sql = mysqli_query($con, "UPDATE tbl_ppt SET opn_bal_32 ='" . htmlspecialchars($_REQUEST['opn_bal_32'], ENT_QUOTES) . "', ppt_32='" . htmlspecialchars($_REQUEST['ppt_32'], ENT_QUOTES) . "', dam_32='" . htmlspecialchars($_REQUEST['dam_32'], ENT_QUOTES) . "', stock_bal_32='" . htmlspecialchars($_REQUEST['stock_bal_32'], ENT_QUOTES) . "', ppt_rev_32='" . htmlspecialchars($_REQUEST['ppt_rev_32'], ENT_QUOTES) . "', opn_bal_64 ='" . htmlspecialchars($_REQUEST['opn_bal_64'], ENT_QUOTES) . "', ppt_64='" . htmlspecialchars($_REQUEST['ppt_64'], ENT_QUOTES) . "', dam_64='" . htmlspecialchars($_REQUEST['dam_64'], ENT_QUOTES) . "', stock_bal_64='" . htmlspecialchars($_REQUEST['stock_bal_64'], ENT_QUOTES) . "', ppt_rev_64='" . htmlspecialchars($_REQUEST['ppt_rev_64'], ENT_QUOTES) . "' WHERE id ='" . htmlspecialchars($_REQUEST['id'], ENT_QUOTES) . "'");
        $message = "Return Entry Updated Successfully";
        header("Location:retmng.php");
    } else
        $message = "There was problem updating the entry" . mysqli_error($con);
}
?>
    <?php require_once 'inc/header.php'; ?>
<!-- Page content -->
						<div class="container-fluid pt-8">
							<div class="page-header mt-0 shadow p-3">
								<ol class="breadcrumb mb-sm-0">
									<li class="breadcrumb-item"><a href="dash.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Manage Returns</li>
								</ol>
							</div>
                            <h2><?php if (isset($message)) { echo $message; } ?></h2>
                            <?php if (isset($_REQUEST['preview'])) {
                                $sqlquery = mysqli_query($con, "SELECT * FROM tbl_ppt WHERE missionid='" . htmlspecialchars($_REQUEST['preview'], ENT_QUOTES) . "' ");

                                if(mysqli_num_rows($sqlquery) == 0) {
                                    echo "<h3 style=\"color:#0000cc;text-align:center;\">No Information to display..!</h3>";
                                }
                                else if ($p = mysqli_fetch_array($sqlquery)) {
                                    ?>
                                    <div class="modal-dialog modal-lg" role="document" tabindex="1">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h2 class="modal-title" ><?php echo $p['missionid']." ".$p['month']; ?> PASSPORT RETURN SUMMARY</h2>
                                                <button type="button" class="close" aria-label="Close">
                                                    <a href="retmng.php"><span aria-hidden="true">&times;</span></a>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered m-t-30 text-nowrap">
                                                        <thead >
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>32 pages</th>
                                                            <th>64 pages</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><strong>Opening Balance</strong></td>
                                                            <td><?php echo $p['opn_bal_32']; ?></td>
                                                            <td><?php echo $p['opn_bal_64']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Issuance</strong></td>
                                                            <td><?php echo $p['ppt_32']; ?></td>
                                                            <td><?php echo $p['ppt_64']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Damaged</strong></td>
                                                            <td><?php echo $p['dam_32']; ?></td>
                                                            <td><?php echo $p['dam_64']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Balance</strong></td>
                                                            <td><?php echo $p['stock_bal_32']; ?></td>
                                                            <td><?php echo $p['stock_bal_64']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Revenue ($USD)</strong></td>
                                                            <td><?php echo $p['ppt_rev_32']; ?></td>
                                                            <td><?php echo $p['ppt_rev_64']; ?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            ?>



                              <?php  if (isset($_REQUEST['edit'])) {
                                $sql = mysqli_query($con, "SELECT * FROM tbl_ppt WHERE id='" . htmlspecialchars($_REQUEST['edit'], ENT_QUOTES) . "' ");

                                if(mysqli_num_rows($sql) == 0) {
                                    echo "<h3 style=\"color:#0000cc;text-align:center;\">No Information to display..!</h3>";
                                }
                                else if ($r = mysqli_fetch_array($sql)) {
                             ?>

                         <div class="card shadow">
                        <div class="card-body">
                            <div class="inbox card-body">
                                <form name="retmng" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="col-md-6 btn-group-vertical">
                                <div class="input-group mb-4">
                                    <div class="col-md-6"><h2> Category</h2></div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control"  placeholder="32 pages" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Opening Stock </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="bal32" value="<?php echo htmlspecialchars_decode($r['opn_bal_32'],ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Issuance</div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="issue32" value="<?php echo htmlspecialchars_decode($r['ppt_32'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Damaged</div>
                                    <div class="col-md-6">
                                        <input type="number" name="dam32" class="form-control" value="<?php echo htmlspecialchars_decode($r['dam_32'],ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Balance</div>
                                    <div class="col-md-6">
                                        <input type="number" name="stockbal32" class="form-control" value="<?php echo htmlspecialchars_decode($r['stock_bal_32'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Revenue (in USD)</div>
                                    <div class="col-md-6">
                                        <input type="number" name="ppt_revenue32" class="form-control" value="<?php echo htmlspecialchars_decode($r['ppt_rev_32'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 btn-group-vertical" style="float:right;">
                                <div class="input-group mb-4">
                                    <div class="col-md-6"><h2> Category</h2></div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="64 pages" disabled>
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Opening Stock </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="bal64" value="<?php echo htmlspecialchars_decode($r['opn_bal_64'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Issuance</div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" name="issue64" value="<?php echo htmlspecialchars_decode($r['ppt_64'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Damaged</div>
                                    <div class="col-md-6">
                                        <input type="number" name="dam64" class="form-control" value="<?php echo htmlspecialchars_decode($r['dam_64'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Balance</div>
                                    <div class="col-md-6">
                                        <input type="number" name="stockbal64" class="form-control" value="<?php echo htmlspecialchars_decode($r['stock_bal_64'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="col-md-6">Revenue (in USD)</div>
                                    <div class="col-md-6">
                                        <input type="number" name="ppt_revenue64" class="form-control" value="<?php echo htmlspecialchars_decode($r['ppt_rev_64'], ENT_QUOTES); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3">
                                    <textarea class="form-control" name="message" rows="5" value="<?php echo htmlspecialchars_decode($r['comments'], ENT_QUOTES); ?>"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-lg btn-success mt-1 mb-1">Update</button>
                                </div>
                                <input type="hidden" name="submit" value="submit">
                            </div>
                            </form>
                        </div>
                        </div>
                         </div>
                      <?php
                           }
                      }
                   ?>



    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-gradient-success">
                    <h2 class="mb-0 text-white">PASSPORT RETURNS</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                     <?php if (isset($_SESSION['mission'])) {
                         $misn = $_SESSION['mission'];

                        $sql = mysqli_query($con, "SELECT * FROM tbl_ppt WHERE missionid ='".$misn."';");
                        $c=1;
                        ?>
                         <table id="example" class="table table-striped table-bordered w-100 text-nowrap">
                            <thead>
                                <th class="wd-5p">mission</th>
                                <th class="wd-10p">DATE</th>
                                <th class="wd-25p">32p Opening</th>
                                <th class="wd-25p">64p Opening </th>
                                <th class="wd-25p">32p Issuance</th>
                                <th class="wd-25p">64p Issuance</th>
                                <th class="wd-10p">32p Balance</th>
                                <th class="wd-10p">64p Balance</th>
                                <th class="wd-5p">manage</th>
                            </thead>
                             <tbody>
                <?php
                while ($result = mysqli_fetch_array($sql))
                {
               ?>
                            <tr>
                                <td><?php echo $result['missionid']; ?></td>
                                <td><?php echo $result['month']." ".$result['year']; ?></td>
                                <td><?php echo $result['opn_bal_32']; ?></td>
                                <td><?php echo $result['opn_bal_64']; ?></td>
                                <td><?php echo $result['ppt_32']; ?></td>
                                <td><?php echo $result['ppt_64']; ?></td>
                                <td><?php echo $result['stock_bal_32']; ?></td>
                                <td><?php echo $result['stock_bal_64']; ?></td>
                                <td class="text-success" align="center">
                                <?php echo "<a title=\"preview " . htmlspecialchars_decode($result['month'], ENT_QUOTES) . "\" href=\"retmng.php?preview=" . htmlspecialchars_decode($result['missionid'], ENT_QUOTES) . "\" ><i class=\"fa fa-2x fa-book-open\" /></i></a>"; ?>
                                <?php echo "<a title=\"edit " . htmlspecialchars_decode($result['month'], ENT_QUOTES) . "\" href=\"retmng.php?edit=" . htmlspecialchars_decode($result['id'], ENT_QUOTES) . "\" ><i class=\"fa fa-2x fa-user-edit\" /></i></a>"; ?>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php if (isset($_REQUEST['view'])) {
            $visaquery = mysqli_query($con, "SELECT * FROM tbl_visa_class WHERE missionid='" . htmlspecialchars($_REQUEST['view'], ENT_QUOTES) . "' ");

            if(mysqli_num_rows($visaquery) == 0) {
                echo "<h3 style=\"color:red;text-align:center;\">No Information to display..!</h3>";
            }
            else if ($visa = mysqli_fetch_array($visaquery)) {
                ?>
                <div class="modal-dialog modal-lg" role="document" tabindex="1">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" ><?php echo $visa['missionid']." ".$visa['month']; ?> VISA RETURN SUMMARY</h2>
                            <button type="button" class="close" aria-label="Close">
                                <a href="return-manager.php"><span aria-hidden="true">&times;</span></a>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered m-t-30 text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Visa Class</th>
                                        <th>Dip</th>
                                        <th>Bus</th>
                                        <th>Tou</th>
                                        <th>Tra</th>
                                        <th>Off</th>
                                        <th>TWP</th>
                                        <th>STR</th>
                                        <th style="text-align: right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><strong>Opening Balance</strong></td>
                                        <td colspan="8" style="text-align: right"><?php echo $visa['opn_bal']; ?></td>
                                       </tr>
                                    <tr>
                                        <td><strong>Issuance</strong></td>
                                        <td><?php echo $visa['diplomatic']; ?></td>
                                        <td><?php echo $visa['business']; ?></td>
                                        <td><?php echo $visa['tourist']; ?></td>
                                        <td><?php echo $visa['transit']; ?></td>
                                        <td><?php echo $visa['official']; ?></td>
                                        <td><?php echo $visa['twp']; ?></td>
                                        <td><?php echo $visa['str']; ?></td>
                                        <td style="text-align: right"><?php echo $visa['diplomatic'] + $visa['tourist'] + $visa['business'] + $visa['transit'] + $visa['str'] + $visa['twp'] + $visa['official']; ?></td>

                                    </tr>
                                    <tr>
                                        <td><strong>Damaged</strong></td>
                                        <td colspan="8" style="text-align: right"><?php echo $visa['damage']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Balance</strong></td>
                                        <td colspan="8" style="text-align: right"><?php echo $visa['stockbal']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Revenue ($USD)</strong></td>
                                        <td colspan="8" style="text-align: right"><?php echo $visa['visa_rev']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            <?php }
        }
        ?>

        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-gradient-red">
                    <h2 class="mb-0 text-white">VISA RETURNS</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $misin = $_SESSION['mission'];

                        $query = mysqli_query($con, "SELECT * FROM tbl_visa_class WHERE missionid ='".$misin."' ;");
                        $x=1;
                        ?>
                        <table id="example1" class="table table-striped table-bordered w-100 text-nowrap">
                            <thead>
                            <tr>
                                <th class="wd-5p">Mission</th>
                                <th class="wd-5p">Date</th>
                                <th class="wd-10p">Diplomatic</th>
                                <th class="wd-10p">Business</th>
                                <th class="wd-10p">Tourist</th>
                                <th class="wd-10p">TWP</th>
                                <th class="wd-10p">STR</th>
                                <th class="wd-10p">Transit</th>
                                <th class="wd-10p">Official</th>
                                <th class="wd-10p">Total Issued</th>
                                <th>view</th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php
                while ($r = mysqli_fetch_array($query))
                {
               ?>
                            <tr>
                                <td><?php echo $r['missionid']; ?></td>
                                <td><?php echo $r['month']." ".$r['yearid']; ?></td>
                                <td><?php echo $r['diplomatic']; ?></td>
                                <td><?php echo $r['business']; ?></td>
                                <td><?php echo $r['tourist']; ?></td>
                                <td><?php echo $r['twp']; ?></td>
                                <td><?php echo $r['str']; ?></td>
                                <td><?php echo $r['transit']; ?></td>
                                <td><?php echo $r['official']; ?></td>
                                <td style><?php echo $r['diplomatic'] + $r['tourist'] + $r['business'] + $r['transit'] + $r['str'] + $r['twp'] + $r['official']; ?></td>
                                <td class="text-danger" align="center"><?php echo "<a title=\"preview " . htmlspecialchars_decode($r['month'], ENT_QUOTES) . "\" href=\"retmng.php?view=" . htmlspecialchars_decode($r['missionid'], ENT_QUOTES) . "\" ><i class=\"fa-2x fa fa-book-open\" /></a>"; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once 'inc/footer.php';  ?>