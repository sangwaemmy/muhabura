<?php
    session_start();
    if (isset($_SESSION['cat'])) {
        
    } else {
        header('location: ../index.php');
    }
    if (filter_has_var(INPUT_POST, 'send_update')) {
        require_once '../web_db/updates.php';
        $upd = new updates();
        $username = filter_input(INPUT_POST, 'txt_username');
        $password = filter_input(INPUT_POST, 'txt_password');
        $update_self = $_SESSION['userid'];
        $upd->update_user_username_password($username, $password, $update_self);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">
        <style>
            .footer{
                position: fixed;
                bottom: 0px;
                margin-bottom: 0px;
                margin: 0px;
                left: -0px;
            }
            .slid_left{
                margin-top: 10%;
                background:none;
            }
            body{
                background-color: #c0e6e8;
            }
            .loggedin_user{
                font-size: 12px;
                margin-top: 100px;
                float: left;
                margin-bottom: 0px;
                margin-left: 45%;
                text-transform: capitalize;
            }
            .loggedin_user::after{
                content: '  Dashboard'
            }
        </style>
    </head>
    <body>
        <?php include './admin_header.php'; ?>
        <div class="parts gen_full off"><div class="parts no_paddin_shade_no_Border seventy_centered">
                <span class="parts no_paddin_shade_no_Border push_right link_cursor close_gen_full" style="width: 32px; height: 32px; background-image: url('../web_images/close_btn.png');"></span>
            </div>  <div class="parts seventy_centered">
                <form action="admin_dashboard.php" method="post"> 
                    <table class="new_data_table">
                        <tr>   <td>New Username</td>  <td><input type="email" class="textbox" name="txt_username"  /></td></tr>
                        <tr>  <td>New Password</td><td><input type="password" class="textbox" name="txt_password"  /></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td>    <input type="submit" class="confirm_buttons" value="Update" name="send_update" data-bind="<?php echo $_SESSION['userid']; ?>" />      </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="parts eighty_centered heit_free margin_free no_paddin_shade_no_Border  no_paddin_shade_no_Border title slid_left off">
            Welcome to MUHABURA MULTICHOICE COMPANY LTD
            <br/>
            Integrated Reporting Management Information System
            <br/>
            <span class="loggedin_user">
                <?php
                    echo '<a id="self_edit_link" href="#">' . $_SESSION['cat'] . '  (' . $_SESSION['names'] . ')</a>';
//                    echo $user = ($_SESSION['cat'] == 'mates') ? 'test' : $_SESSION['cat'];
                ?>
            </span>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded no_bg" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <div class="parts full_center_two_h heit_free footer mid"             
             style="position: fixed;
             bottom: 0px;
             margin-bottom: 0px;
             margin: 0px;
             left: -0px;"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
    </body>
    <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="admin_script.js" type="text/javascript"></script>
    <script>
        $('#self_edit_link').click(function () {

            var update_self = $(this).data('bind');
            $('.gen_full').fadeIn(200);

            return false;
        });
        $('.close_gen_full').click(function () {
            $('.gen_full').fadeOut(200);
        });
    </script>
</html>
