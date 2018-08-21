<?php
    session_start();
    require_once '../web_db/multi_values.php';
    require_once '../web_db/Reports.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Admin reports
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>

        <link href="../web_scripts/date_picker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">
        <style>
            .accounts_expln{
                width: 250px;
            }
            .dataList_table{
                width: 100%;
            } 
            .smaller_font{
                font-size: 13px;
                margin-top: 40px;
            }
            .admin_rep_panelevel1{
                width: 200px;
                height: 150px;
            }
            .admin_rep_panelevel1:hover{
                background-color: #1776a5;
                color: #fff;
                border: 1px solid #78ff00;
            }
        </style>
    </head>
    <body>
        <?php
            include 'admin_header.php';
        ?>
        <div class="parts eighty_centered more_settings no_paddin_shade_no_Border">
            <?php
                // <editor-fold defaultstate="collapsed" desc="--paging init---">
                if (isset($_POST['prev'])) {
                    $_SESSION['page'] = ($_SESSION['page'] < 1) ? 1 : ($_SESSION['page'] -= 1);
                    $last = ($_SESSION['page'] > 1) ? $_SESSION['page'] * 30 : 30;
                    $first = $last - 30;
                } else if (isset($_POST['page_level'])) {//this is next
                    $_SESSION['page'] = ($_SESSION['page'] < 1) ? 1 : ($_SESSION['page'] += 1);
                    $last = $_SESSION['page'] * 30;
                    $first = $last - 30;
                } else if (isset($_SESSION['page']) && isset($_POST['paginated']) && $_SESSION['page'] > 0) {// the use is on another page(other than the first) and clicked the page inside
                    $last = $_POST['paginated'] * 30;
                    $first = $last - 30;
                } else if (isset($_POST['paginated']) && $_SESSION['page'] = 0) {
                    $first = 0;
                } else if (isset($_POST['paginated'])) {
                    $last = $_POST['paginated'] * 30;
                    $first = $last - 30;
                } else if (isset($_POST['first'])) {
                    $_SESSION['page'] = 1;
                    $first = 0;
                } else {
                    $first = 0;
                }
// </editor-fold>
                $obj = new Reports();
                $obj->list_p_type_project_admin($first, 30);
            ?>

        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script>
        <script>
            $('#ending_date').datepicker({
                dataFormat: 'yy-mm-dd'
            });
        </script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_acc_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function get_acc_type_combo() {
        $obj = new multi_values();
        $obj->get_acc_type_in_combo();
    }

    function get_acc_class_combo() {
        $obj = new multi_values();
        $obj->get_acc_class_in_combo();
    }

    function chosen_acc_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $acc_type = new multi_values();
                return $acc_type->get_chosen_account_acc_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_acc_class_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $acc_class = new multi_values();
                return $acc_class->get_chosen_account_acc_class($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_account_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    