<?php require_once 'core/init.php';
        $us3r = $_SESSION['us3rid'];
if (count($_POST) > 0) {
    $result = mysqli_query($con, "SELECT * from users WHERE id='".$us3r."'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["password"]) {
        mysqli_query($con, "UPDATE users set password='" . md5($_POST["newPassword"]) . "' WHERE id='" .$us3r. "'");
        $session->message("Password Changed");
        //header('Location:logout.php');
    } else
        $errors[] = "Current Password is not correct";
}
?>
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
<?php include_once 'inc/header.php';
?>


<?php include_once 'inc/footer.php'; ?>

