<?php require_once 'core/init.php';
      require_once 'core/init2.php';
        $user = $_SESSION['us3rid'];
if (count($_POST) > 0) {
    $result = mysqli_query($con, "SELECT * from users WHERE id='".$user."'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["password"]) {
        mysqli_query($con, "UPDATE users set password='" . $_POST["newPassword"] . "' WHERE id='" . $_SESSION["us3rid"] . "'");
        $session->message("Password Changed");
        redirectTo('logout.php');
    } else
        $errors = "Current Password is not correct";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Nigeria Immigration Foreign Diplomatic Missions Dashboard" name="description">
    <meta content="MIckyT" name="author">

    <!-- Title -->
    <title>NIS DIPLOMATIC MISSIONS E-DESK DASHBOARD</title>

    <!-- Favicon -->
    <link href="assets/img/brand/favicon.ico" rel="icon" type="image/icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <!-- Icons -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Ansta CSS -->
    <link href="assets/css/dashboard.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    <script>
        function validatePassword() {
            var currentPassword,newPassword,confirmPassword,output = true;

            currentPassword = document.frmChange.currentPassword;
            newPassword = document.frmChange.newPassword;
            confirmPassword = document.frmChange.confirmPassword;

            if(!currentPassword.value) {
                currentPassword.focus();
                document.getElementById("currentPassword").innerHTML = "required";
                output = false;
            }
            else if(!newPassword.value) {
                newPassword.focus();
                document.getElementById("newPassword").innerHTML = "required";
                output = false;
            }
            else if(!confirmPassword.value) {
                confirmPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "required";
                output = false;
            }
            if(newPassword.value != confirmPassword.value) {
                newPassword.value="";
                confirmPassword.value="";
                newPassword.focus();
                document.getElementById("confirmPassword").innerHTML = "not same";
                output = false;
            }
            return output;
        }
    </script>
</head>
<body class="app sidebar-mini rtl" oncontextmenu="return false;">
<div id="global-loader" ></div>
<div class="page">
    <div class="page-main">
        <div class="app-content ">
            <div class="side-app">
                <div class="main-content">
                    <div class="p-2 d-block d-sm-none navbar-sm-search">
                        <!-- Form -->
                        <form class="navbar-search navbar-search-dark form-inline ml-lg-auto">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div><input class="form-control" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Top navbar -->
                    <nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
                        <div class="container-fluid">

                            <?php echo "" . date("F, D-M-Y  h:i:sa"); ?> | <?php echo $profile->getMission($_SESSION['profile']); ?>

                            <!-- User -->
                            <ul class="navbar-nav align-items-center ">

                                <?php if(loggedIn()): ?>
                                <li class="nav-item dropdown">
                                    <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0" data-toggle="dropdown" href="#" role="button">
                                        <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src=""></span>
                                            <div class="">
                                                <span class="mb-0 "><?php echo $profile->getName($_SESSION['profile']); ?></span>
                                            </div>
                                        </div></a>
                                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                                        <div class=" dropdown-header noti-title">
                                            <h6 class="text-overflow m-0">Logged in!</h6>
                                        </div>
                                        <?php if ($_SESSION['profile'] == 118): ?>
                                            <a class="dropdown-item" href="#"><i class="ni ni-single-02"></i> <span>Settings</span></a>
                                        <?php endif; ?>
                                        <a class="dropdown-item" href="manage.php"><i class="fa fa-user"></i> <span>Profile</span></a>
                                        <a class="dropdown-item" href="logout.php"><i class="ni ni-user-run"></i> <span>Logout</span></a>
                                        <?php else: ?>
                                            <a class="dropdown-item" href="index.php"><i class="ni ni-lock-circle-open"></i> <span>Login</span></a>
                                        <?php endif; ?>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
        <?php error($errors); success($message); ?>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-5">
                    <form class="login100-form" name="frmChange" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return validatePassword()">
					<span class="login100-form-title">
						Change Password
					</span>
                        <div class="wrap-input100">
                            <input class="input100" type="password" name="currentPassword" placeholder="Current Password"  required />
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
							<i class="fas fa-lock" aria-hidden="true"></i>
						</span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="password" name="newPassword"  placeholder="New Password" required />
                            <span class="focus-input100" ></span>
                            <span class="symbol-input100">
							<i class="fas fa-lock" aria-hidden="true"></i>
						</span>
                        </div>
                        <div class="wrap-input100">
                            <input class="input100" type="password" name="confirmPassword"  placeholder="Confirm Password">
                            <span class="focus-input100" ></span>
                            <span class="symbol-input100">
							<i class="fas fa-lock" aria-hidden="true"></i>
						</span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn btn-success">Change</button>
                        </div>
                        <input type="hidden" name="submit" value="Submit" />
                    </form>
                </div>
            </div>
        </div>


<?php require_once 'inc/footer.php'; ?>

