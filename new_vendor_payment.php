<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_vendor_payment'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $vendor_payment_id = $_SESSION['id_upd'];
                $vendor = trim($_POST['txt_vendor_id']);
                $gen_ledger_header = $_POST['txt_gen_ledger_header_id'];

                $pur_invoice_header = $_POST['txt_pur_invoice_header_id'];

                $number = $_POST['txt_number'];
                $date = $_POST['txt_date'];
                $amount = $_POST['txt_amount'];
                $upd_obj->update_vendor_payment($vendor, $gen_ledger_header, $pur_invoice_header, $number, $date, $amount, $vendor_payment_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $vendor = trim($_POST['txt_vendor_id']);
            $gen_ledger_header = trim($_POST['txt_gen_ledger_header_id']);
            $pur_invoice_header = trim($_POST['txt_pur_invoice_header_id']);
            $number = $_POST['txt_number'];
            $date = $_POST['txt_date'];
            $amount = $_POST['txt_amount'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_vendor_payment($vendor, $gen_ledger_header, $pur_invoice_header, $number, $date, $amount);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            vendor_payment
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_vendor_payment.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_vendor_id"   name="txt_vendor_id"/><input type="hidden" id="txt_gen_ledger_header_id"   name="txt_gen_ledger_header_id"/><input type="hidden" id="txt_pur_invoice_header_id"   name="txt_pur_invoice_header_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                vendor_payment saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  vendor_payment</div>
                <table class="new_data_table">
                    <tr><td>Vendor </td><td> <?php get_vendor_combo(); ?>  </td></tr> <tr><td>General Ledger Header </td><td> <?php get_gen_ledger_header_combo(); ?>  </td></tr> <tr><td>Purchase Invoice Header </td><td> <?php get_pur_invoice_header_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Number </label></td><td> <input type="text"     name="txt_number" required id="txt_number" class="textbox" value="<?php echo trim(chosen_number_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Date </label></td><td> <input type="text"     name="txt_date" required id="txt_date" class="textbox" value="<?php echo trim(chosen_date_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Amount </label></td><td> <input type="text"     name="txt_amount" required id="txt_amount" class="textbox" value="<?php echo trim(chosen_amount_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_vendor_payment" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">vendor payment List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_vendor_payment();
                    $obj->list_vendor_payment($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="vendor_payment" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_vendor_payment.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>   <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_vendor_combo() {
        $obj = new multi_values();
        $obj->get_vendor_in_combo();
    }

    function get_gen_ledger_header_combo() {
        $obj = new multi_values();
        $obj->get_gen_ledger_header_in_combo();
    }

    function get_pur_invoice_header_combo() {
        $obj = new multi_values();
        $obj->get_pur_invoice_header_in_combo();
    }

    function chosen_vendor_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                $id = $_SESSION['id_upd'];
                $vendor = new multi_values();
                return $vendor->get_chosen_vendor_payment_vendor($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_gen_ledger_header_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                $id = $_SESSION['id_upd'];
                $gen_ledger_header = new multi_values();
                return $gen_ledger_header->get_chosen_vendor_payment_gen_ledger_header($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_pur_invoice_header_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                $id = $_SESSION['id_upd'];
                $pur_invoice_header = new multi_values();
                return $pur_invoice_header->get_chosen_vendor_payment_pur_invoice_header($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_number_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                $id = $_SESSION['id_upd'];
                $number = new multi_values();
                return $number->get_chosen_vendor_payment_number($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                $id = $_SESSION['id_upd'];
                $date = new multi_values();
                return $date->get_chosen_vendor_payment_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor_payment') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_vendor_payment_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    