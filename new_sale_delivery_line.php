<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_sale_delivery_line'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sale_delivery_line') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $sale_delivery_line_id = $_SESSION['id_upd'];

                $item = trim($_POST['txt_item_id']);
                $measurement = $_POST['txt_measurement_id'];
                $sales_delivery_header = $_POST['txt_sales_delivery_header_id'];
                $sales_invoice_line = $_POST['txt_sales_invoice_line_id'];
                $upd_obj->update_sale_delivery_line($item, $measurement, $sales_delivery_header, $sales_invoice_line, $sale_delivery_line_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $item = trim($_POST['txt_item_id']);
            $measurement = trim($_POST['txt_measurement_id']);
            $sales_delivery_header = trim($_POST['txt_sales_delivery_header_id']);
            $sales_invoice_line = trim($_POST['txt_sales_invoice_line_id']);

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_sale_delivery_line($item, $measurement, $sales_delivery_header, $sales_invoice_line);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            sale_delivery_line</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_sale_delivery_line.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_item_id"   name="txt_item_id"/><input type="hidden" id="txt_measurement_id"   name="txt_measurement_id"/><input type="hidden" id="txt_sales_delivery_header_id"   name="txt_sales_delivery_header_id"/><input type="hidden" id="txt_sales_invoice_line_id"   name="txt_sales_invoice_line_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                sale_delivery_line saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  sale_delivery_line</div>
                <table class="new_data_table">
                    <tr><td>Item </td><td> <?php get_item_combo(); ?>  </td></tr> <tr><td>Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr> <tr><td>Sales Delivery Header </td><td> <?php get_sales_delivery_header_combo(); ?>  </td></tr> <tr><td>Sales Invoice Line </td><td> <?php get_sales_invoice_line_combo(); ?>  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_sale_delivery_line" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">sale delivery line List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_sale_delivery_line();
                    $obj->list_sale_delivery_line($first);
                ?>
            </div>  
        </form> <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>   <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
    <table class="margin_free">
        <td>
            <form action="../web_exports/excel_export.php" method="post">
                <input type="hidden" name="sale_delivery_line" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_sale_delivery_line.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>
<?php

    function get_item_combo() {
        $obj = new multi_values();
        $obj->get_item_in_combo();
    }

    function get_measurement_combo() {
        $obj = new multi_values();
        $obj->get_measurement_in_combo();
    }

    function get_sales_delivery_header_combo() {
        $obj = new multi_values();
        $obj->get_sales_delivery_header_in_combo();
    }

    function get_sales_invoice_line_combo() {
        $obj = new multi_values();
        $obj->get_sales_invoice_line_in_combo();
    }

    function chosen_item_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sale_delivery_line') {
                $id = $_SESSION['id_upd'];
                $item = new multi_values();
                return $item->get_chosen_sale_delivery_line_item($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sale_delivery_line') {
                $id = $_SESSION['id_upd'];
                $measurement = new multi_values();
                return $measurement->get_chosen_sale_delivery_line_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sales_delivery_header_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sale_delivery_line') {
                $id = $_SESSION['id_upd'];
                $sales_delivery_header = new multi_values();
                return $sales_delivery_header->get_chosen_sale_delivery_line_sales_delivery_header($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sales_invoice_line_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sale_delivery_line') {
                $id = $_SESSION['id_upd'];
                $sales_invoice_line = new multi_values();
                return $sales_invoice_line->get_chosen_sale_delivery_line_sales_invoice_line($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    