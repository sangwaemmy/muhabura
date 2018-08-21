<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <style>
            a{
                color: #fff;
            }
        </style>
    </head>
    <body id="bg_login">
        <form action="login.php" method="post">
            <div class=" parts  full_center_two_h title margin_free skin">
                <div class="parts margin_free no_paddin_shade_no_Border margin_free">
                    <div class="parts box logo no_paddin_shade_no_Border margin_free">
                    </div>
                    <div class="two_fifty_left">
                        <a href="index.php">Return home</a>
                    </div>
                </div>

            </div>
            <div class=" parts eighty_centered top_off_x no_paddin_shade_no_Border">
                <div class="xxx_titles iconed title_icon whilte_text" style="text-align: left">
                    Enter you email and password, all fields are required
                </div>
            </div>
            <div class="parts eighty_centered no_paddin_shade_no_Border top_off_x">
                <div class="parts eighty_centered no_paddin_shade_no_Border"><?php
                        login();
                    ?></div>
                <div class="parts pane no_bg no_paddin_shade_no_Border">
                    <div class="parts xx_titles  margin_free  skin">
                        Login
                    </div>
                    <div class="partsn x_titles no_paddin_shade_no_Border reverse_margin left_off_eighty">
                        Email Address
                    </div>
                    <div class="parts no_paddin_shade_no_Border left_off_eighty">
                        <input type="email" name="username" class="textbox" required>
                    </div>
                    <div class="parts no_paddin_shade_no_Border x_titles reverse_margin left_off_eighty">
                        Password:
                    </div>
                    <div class="parts no_paddin_shade_no_Border left_off_eighty">
                        <input type="password" name="password" class="textbox" required>
                    </div>
                    <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border">
                        <input type="submit"name="send" class="button right_off_eighty" value="Login">

                    </div>
                </div>
                <div class="parts box" id="hous_in_hand"></div>
                <div class="parts two_fifty_right " id="side_pic"> </div>
                <div class="parts two_fifty_right " id="side_pic2"> </div>
                <div class="parts two_fifty_right sixty_percent  whilte_text no_shade_noBorder" >
                    By owning an account you get access to all available house around your area
                </div>
            </div>
        </form>
        <script src="web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="web_scripts/scriptsAddon.js" type="text/javascript"></script>
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
            $cat = trim($obj->get_user_category($username, $password));
            if (isset($cat)) {
                $_SESSION['names'] = $obj->get_name_logged_in($username, $password);
                $_SESSION['userid'] = $obj->get_id_logged_in($username, $password);
                $_SESSION['cat'] = $obj->get_user_category($username, $password);
                $_SESSION['login_token'] = $_SESSION['userid'];
                $_SESSION['user_departmt'] = $obj->get_user_department($username, $password);
                //update that the user is online
                //$obj_update->get_user_online($_SESSION['userid']);
                if ($cat == 'dmin') {//he is sector
//                    header('location: Admin/Admin_dashboard.php');
                } else if ($cat == 'manager') {// he is district
//                header('location: District/districtDashboard.php');
                } else if ($cat == 'agent') {// he is minagri
//                    header('location: Minagri/MinagriDashboard.php');
                } else if ($cat == 'admin') {// he is amdinistrator
//                    header('location: AdminDash/index.php');
                }
            } else {
                echo '<div class="red_message">Username or password invalid</div>';
            }
        }
    }

    class more_db_op {

        function get_user_category($username, $password) {
            require_once 'Admin/dbConnection.php';
            $con = new my_connection();
            $sql = "select     account_category.name from  account join account_category on account_category.account_category_id=account.account_category where  account.username=:username and  account.password =:password";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cat = $row['name'];
            return $cat;
        }

        function get_name_logged_in($username, $password) {
            require_once 'Admin/dbConnection.php';
            $con = new my_connection();
            $sql = "select user.Firstname,user.Lastname from user where username=:username and user.password=:password ";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $res = $stmt->execute();
            ?><script>alert('The result of names:  <?php echo $res; ?>')</script><?php
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $cat = $row['Firstname'] . ' ' . $row['Lastname'];
            return $cat;
        }

        function get_userid_by_Acc_cat($name) {
            require_once '../Admin/dbConnection.php';
            $con = new my_connection();
            $sql = "select    account.account_id from  account join account_category on account_category.account_category_id=account.account_category where   name = :name";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $row['account_id'];
            return $userid;
        }

        function get_id_logged_in($username, $password) {
            require_once 'Admin/dbConnection.php';
            $con = new my_connection();
            $sql = "select    account.account_id from account where  account.username=:username and  account.password =:password";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $row['account_id'];
            return $userid;
        }

        function get_user_department($username, $password) {
            require_once 'Admin/dbConnection.php';
            $con = new my_connection();
            $sql = "select   p_department.department_name    from  user    join p_department on p_department.p_department_id=user.position_depart where  user.username =:username and user.password =:password";
            $stmt = $con->openconnection()->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $userid = $row['department_name'];
            return $userid;
        }

    }
    