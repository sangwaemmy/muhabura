<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_purchase_receit_header'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'purchase_receit_header') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $purchase_receit_header_id = $_SESSION['id_upd'];
                $gen_ledger_header = trim($_POST['txt_gen_ledger_header_id']);
                $date = $_POST['txt_date'];
                $status = $_POST['txt_status'];
                $number = $_POST['txt_number'];
                $upd_obj->update_purchase_receit_header($gen_ledger_header, $date, $status, $number, $purchase_receit_header_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $gen_ledger_header = trim($_POST['txt_gen_ledger_header_id']);
            $date = $_POST['txt_date'];
            $status = $_POST['txt_status'];
            $number = $_POST['txt_number'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_purchase_receit_header($gen_ledger_header, $date, $status, $number);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            purchase_receit_header</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_purchase_receit_header.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_gen_ledger_header_id"   name="txt_gen_ledger_header_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                purchase_receit_header saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  purchase_receit_header</div>
                <table class="new_data_table">


                    <tr><td>General Ledger Header </td><td> <?php get_gen_ledger_header_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Date </label></td><td> <input type="text"     name="txt_date" required id="txt_date" class="textbox" value="<?php echo trim(chosen_date_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Status </label></td><td> <input type="text"     name="txt_status" required id="txt_status" class="textbox" value="<?php echo trim(chosen_status_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Number </label></td><td> <input type="text"     name="txt_number" required id="txt_number" class="textbox" value="<?php echo trim(chosen_number_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_purchase_receit_header" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">purchase receit header List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_purchase_receit_header();
                    $obj->list_purchase_receit_header($first);
                ?>
            </div>  
        </form> <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
    <table class="margin_free">
        <td>
            <form action="../web_exports/excel_export.php" method="post">
                <input type="hidden" name="purchase_receit_header" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_purchase_receit_header.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>
<?php

    function get_gen_ledger_header_combo() {
        $obj = new multi_values();
        $obj->get_gen_ledger_header_in_combo();
    }

    function chosen_gen_ledger_header_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'purchase_receit_header') {
                $id = $_SESSION['id_upd'];
                $gen_ledger_header = new multi_values();
                return $gen_ledger_header->get_chosen_purchase_receit_header_gen_ledger_header($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'purchase_receit_header') {
                $id = $_SESSION['id_upd'];
                $date = new multi_values();
                return $date->get_chosen_purchase_receit_header_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_status_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'purchase_receit_header') {
                $id = $_SESSION['id_upd'];
                $status = new multi_values();
                return $status->get_chosen_purchase_receit_header_status($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_number_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'purchase_receit_header') {
                $id = $_SESSION['id_upd'];
                $number = new multi_values();
                return $number->get_chosen_purchase_receit_header_number($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    