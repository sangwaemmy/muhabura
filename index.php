<?php
    session_start();

    if (filter_has_var(INPUT_POST, 'send_recover')) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers = "From: info@gurusofts.com" . "\r\n" .
                $msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg, 70);
// send email
        $txt_email = filter_var(INPUT_post, 'txt_email');
        mail($txt_email, "Testing email", $msg, $headers);
        ?><script>alert('Check your email, we have sent you a link to recover your email');</script><?php
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Home</title>
        <link href = "web_style/styles.css" rel = "stylesheet" type = "text/css"/>
        <link href = "web_style/StylesAddon.css" rel = "stylesheet" type = "text/css"/>
        <meta name = "viewport" content = "width=device-width, initial scale=1.0"/>
        <link rel = "shortcut icon" href = "web_images/tab_icon.png" type = "image/x-icon">
        <style>
            #login_table{
                width: 90%;
                margin-left: 2%;
            }
            #login_table td{
                padding: 5px;
            }
            #login_table .confirm_buttons{
                margin-right: 10px;
            }
            #login_table .textbox{
                float: right;
                width: 95%;
            }
            .nomargin_tr td{
                margin: 0px;
            }
            #forgot_link{
                text-align: center;
            }
            #my_header{
                background-color: #fff;
                border-bottom: 1px solid  #000066;
                background-size: 71%;
                background-repeat: no-repeat;
                height: 80px;
                background-position-x: 70px;
                background-image: url('web_images/header.jpg');
            }
            .confirm_buttons, input[type="submit"]{
                float: none;
                min-width: 200px;
            }
            .footer{
                margin-top: 0px;
            }

            /*Forgot password pd*/

            #forgot_pass_pane{
                position: absolute;
                z-index: 3;
                margin-top: 20%;
            }
            .btn_recover{
                float: right;
            }
        </style>
    </head>
    <body>
        <div class="parts abs_full margin_free hidable off">

        </div>
        <div class="parts fifty_centered hidable off" id="forgot_pass_pane">
            Forgot Password
            <!--            <form action="index.php" method="post">-->
            <table>
                <tr>
                    <td>
                        Enter your email
                    </td>
                    <td>
                        <input type="text" class="textbox x_width_four_h" name="txt_email"  />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="confirm_buttons push_right cancel_recover" id="cancel_rec" >Cancel</span>
                        <input type="submit" class="confirm_buttons push_right btn_recover" name="send_recover" value="Recover"/>
                    </td>
                </tr>
            </table>
            <!--</form>-->

        </div>
        <?php
            include 'header_menu.php';
        ?>
        <div id="fb-root"></div>

        <div class="parts seventy_centered" style="margin-left: 15%; margin-top: 7%; margin-bottom: 0px;">
            <div class="parts  full_center_two_h heit_free no_shade_noBorder" id="my_header">    
            </div>
            <form action="index.php" method="post">
                <div class="parts full_center_two_h no_shade_noBorder" style="min-height: 230px;">
                    <div class="parts full_center_two_h heit_free no_shade_noBorder off">
                        Enter your username and password to continue
                    </div>
                    <table id="login_table"  >
                        <?php login(); ?>
                        <tr> <td style="width: 60px;">Username  </td> <td>     <input type="email"     name="username" required autocomplete="off"  placeholder="Username" class="textbox eighty_centered heit_free" style="float: left;"></td> </tr>
                        <tr> <td style="width: 60px;">Password  </td> <td>   <input type="password" name="password" required autocomplete="off"  class="textbox eighty_centered" placeholder="Password" style="float: left;"></td> </tr>
                        <tr>
                            <td colspan="2"> <center>   <input type="submit" name="send" class="confirm_buttons" value="Login"   ></center>
                        </td>
                        </tr>
                        <tr class="nomargin_tr">
                            <td colspan="2">
                        <center>
                            <a href="#" style="color: #000066;" id="forgot_link">Forgot Password</a>
                        </center>
                        </td>
                        </tr>
                    </table>
                </div> 
            </form>
        </div>
        <div class="parts seventy_centered footer " style="margin-left: 15%;">
            Copyrights <?php echo '2018 - ' . date("Y") . '    MUHABURA MULTICHOICE COMPANY LTD Version 1.0 '; ?>
        </div>  
        <script>

            $('#cancel_rec').click(function () {
                alert('The button has been clicked');
            });

        </script>
    </body>
</html>
<?php

    function login() {
        if (isset($_POST['send'])) {

            $obj = new more_db_op();
//        require_once './web_db/updates.php';
//        $obj_update = new updates();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cat = $obj->get_user_category($username, $password);
            if (isset($cat)) {
                $_SESSION['names'] = $obj->get_name_logged_in($username, $password);
                $_SESSION['userid'] = $obj->get_id_logged_in($username, $password);
                $_SESSION['cat'] = $cat;
                $_SESSION['login_token'] = $_SESSION['userid'];
                $_SESSION['shall_delete'] = $obj->get_if_delete_allowed($username, $password);
                //update that the user is online
                //$obj_update->get_user_online($_SESSION['userid']);
                ?>
                <script>
                    window.location.replace('admin/admin_dashboard.php');
                </script>
                <?php
                if ($cat == 'dev') {//he is sector
                    header('location: admin/admin_dashboard.php');
                } else if ($cat == 'manager') {// he is district
//                header('location: District/districtDashboard.php');
                } else if ($cat == 'agent') {// he is minagri
                    header('location: Minagri/MinagriDashboard.php');
                } else if ($cat == 'admin') {// he is amdinistrator
                    header('location: adminDash/index.php');
                }
            } else {
                echo '<div class="red_message">Username or password invalid</div>';
            }
        }
    }

    class more_db_op {

        function get_user_category($username, $password) {
            require_once 'admin/dbConnection.php';
            $con = new dbconnection();
            $sql = " SELECT role.name FROM role
                    join user on role.role_id=user.Roleid
                    where user.username=:username and user.Password=:password ";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cat = $row['name'];
            return $cat;
        }

        function get_name_logged_in($username, $password) {
            require_once 'admin/dbConnection.php';
            $con = new dbconnection();
            $sql = "select user.Firstname,user.Lastname from user where username=:username and user.password=:password ";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cat = $row['Firstname'] . ' ' . $row['Lastname'];
            return $cat;
        }

        function get_userid_by_Acc_cat($name) {
            require_once '../admin/dbConnection.php';
            $con = new dbconnection();
            $sql = "select    account.account_id from  account join account_category on account_category.account_category_id=account.account_category where   name = :name";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $row['account_id'];
            return $userid;
        }

        function get_id_logged_in($username, $password) {
            require_once 'admin/dbConnection.php';
            $con = new dbconnection();
            $sql = "select    user.StaffID from user where user.username=:username and  user.password =:password";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $row['StaffID'];
            return $userid;
        }

        function get_if_delete_allowed($username, $password) {
            require_once 'admin/dbConnection.php';
            $con = new dbconnection();
            $sql = " select delete_update_permission.user
                        from delete_update_permission
                        join user on user.staffID= delete_update_permission.user
                        where user.username=:username and user.password=:password and delete_update_permission.permission='delete'";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $row['user'];
            return $userid;
        }

    }
    