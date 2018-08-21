<?php
session_start();
require_once '../web_db/multi_values.php';
if (!isset($_SESSION)) {
    session_start();
}if (!isset($_SESSION['login_token'])) {
    header('location:../index.php');
}
if (isset($_POST['send_purchase_invoice_header'])) {
    if (isset($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            require_once '../web_db/updates.php';
            $upd_obj = new updates();
            $purchase_invoice_header_id = $_SESSION['id_upd'];
            $inv_control_journal = trim($_POST['txt_inv_control_journal_id']);
            $item = $_POST['txt_item_id'];
            $measurement = $_POST['txt_measurement_id'];
            $quantity = $_POST['txt_quantity'];
            $receieved_qusntinty = $_POST['txt_receieved_qusntinty'];
            $cost = $_POST['txt_cost'];
            $discount = $_POST['txt_discount'];
            $purchase_order_line = $_POST['txt_purchase_order_line_id'];
            $upd_obj->update_purchase_invoice_header($inv_control_journal, $item, $measurement, $quantity, $receieved_qusntinty, $cost, $discount, $purchase_order_line, $purchase_invoice_header_id);
            unset($_SESSION['table_to_update']);
        }
    } else {
        $inv_control_journal = trim($_POST['txt_inv_control_journal_id']);
        $item = trim($_POST['txt_item_id']);
        $measurement = trim($_POST['txt_measurement_id']);
        $quantity = $_POST['txt_quantity'];
        $receieved_qusntinty = $_POST['txt_receieved_qusntinty'];
        $cost = $_POST['txt_cost'];
        $discount = $_POST['txt_discount'];
        $purchase_order_line = trim($_POST['txt_purchase_order_line_id']);

        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $obj->new_purchase_invoice_header($inv_control_journal, $item, $measurement, $quantity, $receieved_qusntinty, $cost, $discount, $purchase_order_line);
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            purchase_invoice_header</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_purchase_invoice_header.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_inv_control_journal_id"   name="txt_inv_control_journal_id"/><input type="hidden" id="txt_item_id"   name="txt_item_id"/><input type="hidden" id="txt_measurement_id"   name="txt_measurement_id"/><input type="hidden" id="txt_purchase_order_line_id"   name="txt_purchase_order_line_id"/>
            <?php
            include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                purchase_invoice_header saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  purchase invoice header</div>
                <table class="new_data_table">
                    <tr><td>Inventory Control Journal </td><td> <?php get_inv_control_journal_combo(); ?>  </td></tr> <tr><td>Item </td><td> <?php get_item_combo(); ?>  </td></tr> <tr><td>Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Quantity </label></td><td> <input type="text"     name="txt_quantity" required id="txt_quantity" class="textbox" value="<?php echo trim(chosen_quantity_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Received Quantity </label></td><td> <input type="text"     name="txt_receieved_qusntinty" required id="txt_receieved_qusntinty" class="textbox" value="<?php echo trim(chosen_receieved_qusntinty_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Cost </label></td><td> <input type="text"     name="txt_cost" required id="txt_cost" class="textbox" value="<?php echo trim(chosen_cost_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Discount </label></td><td> <input type="text"     name="txt_discount" required id="txt_discount" class="textbox" value="<?php echo trim(chosen_discount_upd()); ?>"   />  </td></tr>
                    <tr><td>Purchase Order Line </td><td> <?php get_purchase_order_line_combo(); ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_purchase_invoice_header" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">purchase_invoice_header List</div>
                <?php
                $obj = new multi_values();
                $first = $obj->get_first_purchase_invoice_header();
                $obj->list_purchase_invoice_header($first);
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
                        <input type="hidden" name="purchase_invoice_header" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_purchase_invoice_header.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
<?php

function get_inv_control_journal_combo() {
    $obj = new multi_values();
    $obj->get_inv_control_journal_in_combo();
}

function get_item_combo() {
    $obj = new multi_values();
    $obj->get_item_in_combo();
}

function get_measurement_combo() {
    $obj = new multi_values();
    $obj->get_measurement_in_combo();
}

function get_purchase_order_line_combo() {
    $obj = new multi_values();
    $obj->get_purchase_order_line_in_combo();
}

function chosen_inv_control_journal_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $inv_control_journal = new multi_values();
            return $inv_control_journal->get_chosen_purchase_invoice_header_inv_control_journal($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_item_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $item = new multi_values();
            return $item->get_chosen_purchase_invoice_header_item($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_measurement_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $measurement = new multi_values();
            return $measurement->get_chosen_purchase_invoice_header_measurement($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_quantity_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $quantity = new multi_values();
            return $quantity->get_chosen_purchase_invoice_header_quantity($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_receieved_qusntinty_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $receieved_qusntinty = new multi_values();
            return $receieved_qusntinty->get_chosen_purchase_invoice_header_receieved_qusntinty($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_cost_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $cost = new multi_values();
            return $cost->get_chosen_purchase_invoice_header_cost($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_discount_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $discount = new multi_values();
            return $discount->get_chosen_purchase_invoice_header_discount($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_purchase_order_line_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'purchase_invoice_header') {
            $id = $_SESSION['id_upd'];
            $purchase_order_line = new multi_values();
            return $purchase_order_line->get_chosen_purchase_invoice_header_purchase_order_line($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}
