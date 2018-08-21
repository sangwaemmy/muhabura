<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_general_ledger_line'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_line') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $general_ledger_line_id = $_SESSION['id_upd'];
                $general_ledge_header = trim($_POST['txt_general_ledge_header_id']);
                $accountid = $_POST['txt_accountid_id'];
                $upd_obj->update_general_ledger_line($general_ledge_header, $accountid, $general_ledger_line_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $general_ledge_header = trim($_POST['txt_general_ledge_header_id']);
            $accountid = trim($_POST['txt_accountid_id']);

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_general_ledger_line($general_ledge_header, $accountid);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            general ledger line</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_general_ledger_line.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_general_ledge_header_id"   name="txt_general_ledge_header_id"/><input type="hidden" id="txt_accountid_id"   name="txt_accountid_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                general_ledger_line saved successfully!
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="part eighty_centered">
                    <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">general ledger line List</div>
                    <?php
                        $obj = new other_fx();
                        $start_date = $obj->get_this_year_start_date();
                        $end_date = $obj->get_this_year_end_date();
                        $obj->list_general_ledger_line($start_date, $end_date);
                    ?></div>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="general_ledger_line" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_general_ledger_line.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_general_ledge_header_combo() {
        $obj = new multi_values();
        $obj->get_general_ledge_header_in_combo();
    }

    function get_accountid_combo() {
        $obj = new multi_values();
        $obj->get_accountid_in_combo();
    }

    function chosen_general_ledge_header_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_line') {
                $id = $_SESSION['id_upd'];
                $general_ledge_header = new multi_values();
                return $general_ledge_header->get_chosen_general_ledger_line_general_ledge_header($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_accountid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_line') {
                $id = $_SESSION['id_upd'];
                $accountid = new multi_values();
                return $accountid->get_chosen_general_ledger_line_accountid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    