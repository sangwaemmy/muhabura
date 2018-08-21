<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_item_category'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $item_category_id = $_SESSION['id_upd'];
                $measurement = trim($_POST['txt_measurement_id']);
                $sales_accid = $_POST['txt_sales_accid_id'];
                $inventory_accid = $_POST['txt_inventory_accid_id'];
                $cost_good_sold_accid = $_POST['txt_cost_good_sold_accid_id'];
                $adjustment_accid = $_POST['txt_adjustment_accid'];
                $assembly_accid = $_POST['txt_assembly_accid_id'];
                $name = $_POST['txt_name'];


                $upd_obj->update_item_category($measurement, $sales_accid, $inventory_accid, $cost_good_sold_accid, $adjustment_accid, $assembly_accid, $name, $item_category_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $measurement = trim($_POST['txt_measurement_id']);
            $sales_accid = trim($_POST['txt_sales_accid_id']);
            $inventory_accid = trim($_POST['txt_inventory_accid_id']);
            $cost_good_sold_accid = trim($_POST['txt_cost_good_sold_accid_id']);
            $adjustment_accid = $_POST['txt_adjustment_accid'];
            $assembly_accid = trim($_POST['txt_assembly_accid_id']);
            $name = $_POST['txt_name'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_item_category($measurement, $sales_accid, $inventory_accid, $cost_good_sold_accid, $adjustment_accid, $assembly_accid, $name);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            item_category</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_item_category.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_measurement_id"   name="txt_measurement_id"/><input type="hidden" id="txt_sales_accid_id"   name="txt_sales_accid_id"/><input type="hidden" id="txt_inventory_accid_id"   name="txt_inventory_accid_id"/><input type="hidden" id="txt_cost_good_sold_accid_id"   name="txt_cost_good_sold_accid_id"/><input type="hidden" id="txt_assembly_accid_id"   name="txt_assembly_accid_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                item_category saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  item_category</div>
                <table class="new_data_table">
                    <tr><td>Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr> <tr><td>Sales Account </td><td> <?php get_sales_accid_combo(); ?>  </td></tr> <tr><td>Inventory Account </td><td> <?php get_inventory_accid_combo(); ?>  </td></tr> <tr><td>Cost Of Good Sold </td><td> <?php get_cost_good_sold_accid_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Adjustment Account </label></td><td> <input type="text"     name="txt_adjustment_accid" required id="txt_adjustment_accid" class="textbox" value="<?php echo trim(chosen_adjustment_accid_upd()); ?>"   />  </td></tr>
                    <tr><td>Assembly_accid </td><td> <?php get_assembly_accid_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Name </label></td><td> <input type="text"     name="txt_name" required id="txt_name" class="textbox" value="<?php echo trim(chosen_name_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_item_category" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">item_category List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_item_category();
                    $obj->list_item_category($first);
                ?>
            </div>  
        </form> 
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="item_category" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_item_category.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script> <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_measurement_combo() {
        $obj = new multi_values();
        $obj->get_measurement_in_combo();
    }

    function get_sales_accid_combo() {
        $obj = new multi_values();
        $obj->get_sales_accid_in_combo();
    }

    function get_inventory_accid_combo() {
        $obj = new multi_values();
        $obj->get_inventory_accid_in_combo();
    }

    function get_cost_good_sold_accid_combo() {
        $obj = new multi_values();
        $obj->get_cost_good_sold_accid_in_combo();
    }

    function get_assembly_accid_combo() {
        $obj = new multi_values();
        $obj->get_assembly_accid_in_combo();
    }

    function chosen_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $measurement = new multi_values();
                return $measurement->get_chosen_item_category_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sales_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $sales_accid = new multi_values();
                return $sales_accid->get_chosen_item_category_sales_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_inventory_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $inventory_accid = new multi_values();
                return $inventory_accid->get_chosen_item_category_inventory_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_cost_good_sold_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $cost_good_sold_accid = new multi_values();
                return $cost_good_sold_accid->get_chosen_item_category_cost_good_sold_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_adjustment_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $adjustment_accid = new multi_values();
                return $adjustment_accid->get_chosen_item_category_adjustment_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_assembly_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $assembly_accid = new multi_values();
                return $assembly_accid->get_chosen_item_category_assembly_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_category') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_item_category_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    