<?php
session_start();
require_once '../web_db/multi_values.php';
if (!isset($_SESSION)) {
    session_start();
}if (!isset($_SESSION['login_token'])) {
    header('location:../index.php');
}
if (isset($_POST['send_Inventory_control_journal'])) {
    if (isset($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            require_once '../web_db/updates.php';
            $upd_obj = new updates();
            $Inventory_control_journal_id = $_SESSION['id_upd'];

            $measurement = trim($_POST['txt_measurement_id']);
            $item = $_POST['txt_item_id'];

            $doc_type = $_POST['txt_doc_type'];
            $In_qty = $_POST['txt_In_qty'];
            $Out_qty = $_POST['txt_Out_qty'];
            $date = $_POST['txt_date'];
            $total_cost = $_POST['txt_total_cost'];
            $tot_amount = $_POST['txt_tot_amount'];
            $is_reverse = $_POST['txt_is_reverse'];


            $upd_obj->update_Inventory_control_journal($measurement, $item, $doc_type, $In_qty, $Out_qty, $date, $total_cost, $tot_amount, $is_reverse, $Inventory_control_journal_id);
            unset($_SESSION['table_to_update']);
        }
    } else {
        $measurement = trim($_POST['txt_measurement_id']);
        $item = trim($_POST['txt_item_id']);
        $doc_type = $_POST['txt_doc_type'];
        $In_qty = $_POST['txt_In_qty'];
        $Out_qty = $_POST['txt_Out_qty'];
        $date = $_POST['txt_date'];
        $total_cost = $_POST['txt_total_cost'];
        $tot_amount = $_POST['txt_tot_amount'];
        $is_reverse = $_POST['txt_is_reverse'];

        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $obj->new_Inventory_control_journal($measurement, $item, $doc_type, $In_qty, $Out_qty, $date, $total_cost, $tot_amount, $is_reverse);
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Inventory_control_journal</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_Inventory_control_journal.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_measurement_id"   name="txt_measurement_id"/><input type="hidden" id="txt_item_id"   name="txt_item_id"/>
            <?php
            include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                Inventory_control_journal saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  Inventory control journal</div>
                <table class="new_data_table">

                    <tr><td>Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr> <tr><td>Item </td><td> <?php get_item_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Document Type </label></td><td> <input type="text"     name="txt_doc_type" required id="txt_doc_type" class="textbox" value="<?php echo trim(chosen_doc_type_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">In Quantity </label></td><td> <input type="text"     name="txt_In_qty" required id="txt_In_qty" class="textbox" value="<?php echo trim(chosen_In_qty_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Out Quantity </label></td><td> <input type="text"     name="txt_Out_qty" required id="txt_Out_qty" class="textbox" value="<?php echo trim(chosen_Out_qty_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Date </label></td><td> <input type="text"     name="txt_date" required id="txt_date" class="textbox" value="<?php echo trim(chosen_date_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Total Cost </label></td><td> <input type="text"     name="txt_total_cost" required id="txt_total_cost" class="textbox" value="<?php echo trim(chosen_total_cost_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Total Amount </label></td><td> <input type="text"     name="txt_tot_amount" required id="txt_tot_amount" class="textbox" value="<?php echo trim(chosen_tot_amount_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Is reverse </label></td><td> <input type="text"     name="txt_is_reverse" required id="txt_is_reverse" class="textbox" value="<?php echo trim(chosen_is_reverse_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_Inventory_control_journal" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">Inventory Controls</div>
                <?php
                $obj = new multi_values();
                $first = $obj->get_first_Inventory_control_journal();
                $obj->list_Inventory_control_journal($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

function get_measurement_combo() {
    $obj = new multi_values();
    $obj->get_measurement_in_combo();
}

function get_item_combo() {
    $obj = new multi_values();
    $obj->get_item_in_combo();
}

function chosen_measurement_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $measurement = new multi_values();
            return $measurement->get_chosen_Inventory_control_journal_measurement($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_item_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $item = new multi_values();
            return $item->get_chosen_Inventory_control_journal_item($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_doc_type_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $doc_type = new multi_values();
            return $doc_type->get_chosen_Inventory_control_journal_doc_type($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_In_qty_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $In_qty = new multi_values();
            return $In_qty->get_chosen_Inventory_control_journal_In_qty($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_Out_qty_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $Out_qty = new multi_values();
            return $Out_qty->get_chosen_Inventory_control_journal_Out_qty($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_date_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $date = new multi_values();
            return $date->get_chosen_Inventory_control_journal_date($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_total_cost_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $total_cost = new multi_values();
            return $total_cost->get_chosen_Inventory_control_journal_total_cost($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_tot_amount_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $tot_amount = new multi_values();
            return $tot_amount->get_chosen_Inventory_control_journal_tot_amount($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_is_reverse_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Inventory_control_journal') {
            $id = $_SESSION['id_upd'];
            $is_reverse = new multi_values();
            return $is_reverse->get_chosen_Inventory_control_journal_is_reverse($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}
