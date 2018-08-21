<?php
    session_start();
    require_once '../web_db/multi_values.php';
    require_once '../web_db/other_fx.php';
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
            account
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
        </style>
    </head>
    <body>
        <?php
            include 'admin_header.php';
        ?>
        <div class="parts eighty_centered more_settings">
            <?php
                $obj = new other_fx();
            ?>
            <a id="sett_location" href="new_p_province.php"> Locations </a>
            <a id="sett_department" href="new_staff_positions.php"> Staff Departments</a>
            <a id="sett_measurement" href="new_measurement.php">measurement</a>
            <a style="display:none" id="sett_ledger" href="new_ledger_settings.php">ledger settings</a>
            <a style="display:none" id="sett_request" href="new_p_request_type.php">Request types</a>
            <a id="sett_currency" href="new_p_Currency.php">Currency</a>
            <a id="sett_currency" href="new_bank.php">Bank</a>
            <a id="sett_currency" href="new_tax_calculations.php">tax Firmulae</a>
            <div class="parts seventy_centered heit_free no_paddin_shade_no_Border">
                <table border="1">
                    <thead>
                        <tr>
                            <td>SETTING NAME</td>
                            <td>ENABLE/DISABLE</td>
                        </tr></thead>
                    <tr>
                        <td colspan="2"><b>
                                TAXES
                            </b></td>
                    </tr> 
                    <?php
                        $obj->list_taxgroup_toenable_disable();
                    ?><tr>
                        <td colspan="2"><b>ACCOUNTS</b></td>
                    </tr><?php
                        $obj->list_account_toenable_disable();
                    ?>
                </table>
            </div>
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
    