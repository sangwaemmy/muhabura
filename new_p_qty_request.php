<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_qty_request'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_qty_request') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_qty_request_id = $_SESSION['id_upd'];

                $request = trim($_POST['txt_request_id']);
                $unit_cost = $_POST['txt_unit_cost'];
                $quantity = $_POST['txt_quantity'];
                $measurement = $_POST['txt_measurement_id'];
                $requirement = $_POST['txt_requirement_id'];
                $upd_obj->update_p_qty_request($request, $unit_cost, $quantity, $measurement, $requirement, $p_qty_request_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $request = trim($_POST['txt_request_id']);
            $unit_cost = $_POST['txt_unit_cost'];
            $quantity = $_POST['txt_quantity'];
            $measurement = trim($_POST['txt_measurement_id']);
            $requirement = trim($_POST['txt_requirement_id']);

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_p_qty_request($request, $unit_cost, $quantity, $measurement, $requirement);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_qty_request</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_p_qty_request.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_request_id"   name="txt_request_id"/><input type="hidden" id="txt_measurement_id"   name="txt_measurement_id"/><input type="hidden" id="txt_requirement_id"   name="txt_requirement_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <!--Start dialog's-->
            <div class="parts abs_full y_n_dialog off">
                <div class="parts dialog_yes_no no_paddin_shade_no_Border reverse_border">
                    <div class="parts full_center_two_h heit_free margin_free skin">
                        Do you really want to delete this record?
                    </div>
                    <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border top_off_x margin_free">
                        <div class="parts yes_no_btns no_shade_noBorder reverse_border left_off_xx link_cursor yes_dlg_btn" id="citizen_yes_btn">Yes</div>
                        <div class="parts yes_no_btns no_shade_noBorder reverse_border left_off_seventy link_cursor no_btn" id="no_btn">No</div>
                    </div>
                </div>
            </div>   
            <!--End dialog--><div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                p_qty_request saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Make new Requests </div>
                <table class="new_data_table">
                    <tr><td class="new_data_tb_frst_cols">Request </td><td> <?php get_request_combo(); ?>  </td></tr><tr><td><label for="txt_unit_cost">Unit Cost </label></td><td> <input type="text"     name="txt_unit_cost" required id="txt_unit_cost" class="textbox" value="<?php echo trim(chosen_unit_cost_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_quantity">Quantity </label></td><td> <input type="text"     name="txt_quantity" required id="txt_quantity" class="textbox" value="<?php echo trim(chosen_quantity_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr> <tr><td class="new_data_tb_frst_cols">Request </td><td> <?php get_requirement_combo(); ?>  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_qty_request" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Requests</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_qty_request();
                    $obj->list_p_qty_request($first);
                ?>
            </div>  
        </form> <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
    <table class="margin_free">
        <td>
            <form action="../web_exports/excel_export.php" method="post">
                <input type="hidden" name="p_qty_request" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_p_qty_request.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>
<?php

    function get_request_combo() {
        $obj = new multi_values();
        $obj->get_request_in_combo();
    }

    function get_measurement_combo() {
        $obj = new multi_values();
        $obj->get_measurement_in_combo();
    }

    function get_requirement_combo() {
        $obj = new multi_values();
        $obj->get_requirement_in_combo();
    }

    function chosen_request_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_qty_request') {
                $id = $_SESSION['id_upd'];
                $request = new multi_values();
                return $request->get_chosen_p_qty_request_request($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_unit_cost_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_qty_request') {
                $id = $_SESSION['id_upd'];
                $unit_cost = new multi_values();
                return $unit_cost->get_chosen_p_qty_request_unit_cost($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_quantity_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_qty_request') {
                $id = $_SESSION['id_upd'];
                $quantity = new multi_values();
                return $quantity->get_chosen_p_qty_request_quantity($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_qty_request') {
                $id = $_SESSION['id_upd'];
                $measurement = new multi_values();
                return $measurement->get_chosen_p_qty_request_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_requirement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_qty_request') {
                $id = $_SESSION['id_upd'];
                $requirement = new multi_values();
                return $requirement->get_chosen_p_qty_request_requirement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    