<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_payment_voucher'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $payment_voucher_id = $_SESSION['id_upd'];
                $item = trim($_POST['txt_item_id']);
                $entry_date = date("y-m-d");
                $User = $_SESSION['userid'];
                $quantity = filter_input(INPUT_POST, 'txt_quantity', FILTER_SANITIZE_NUMBER_INT);
                $unit_cost = filter_input(INPUT_POST, 'txt_unit_cost', FILTER_SANITIZE_NUMBER_INT);
                $budget_prep = $_POST['txt_budget_prep_id'];
                $tot = $unit_cost * $quantity;
                $upd_obj->update_payment_voucher($item, $entry_date, $User, $quantity, $unit_cost, $tot, $budget_prep, $payment_voucher_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $item = trim($_POST['txt_item_id']);
            $entry_date = date("y-m-d h:m:s");
            $User = $_SESSION['userid'];
            $quantity = $_POST['txt_quantity'];
            $unit_cost = filter_input(INPUT_POST, 'txt_unit_cost', FILTER_SANITIZE_NUMBER_INT);
            $budget_prep = trim($_POST['txt_activity_id']);
            $tot = $unit_cost * $quantity;
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_payment_voucher($item, $entry_date, $User, $quantity, $unit_cost, $tot, $budget_prep);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            payment_voucher
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_payment_voucher.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <input type="hidden" id="txt_item_id"   name="txt_item_id"/>
            <input type="hidden" id="txt_budget_prep_id"   name="txt_budget_prep_id"/>
            <input type="hidden" style="float: right;" id="txt_activity_id"   name="txt_activity_id"/>
            <?php
                include 'admin_header.php';
            ?>
            <!--Start of Type Details-->
            <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

            </div>
            <!--End Tuype Details-->   
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
            <!--End dialog-->
            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add New Payment Voucher </div>
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                payment_voucher saved successfully!
            </div>

            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  payment voucher Registration </div>
                <table class="new_data_table">
                    <tr>
                        <td class="new_data_tb_frst_cols">Budget line </td><td> <?php get_type_project_combo(); ?>  </td></tr>   <tr>
                        <td>project</td><td>
                            <select class="textbox cbo_fill_projects cbo_project cbo_onfly_p_project_change">
                                <option> --Project--</option>
                            </select>  
                        </td>
                    </tr>
                    <tr>
                        <td>Select the Activity</td>
                        <td> <select class="textbox tobe_refilled cbo_fill_activity cbo_activity  cbo_onfly_p_activity_change">
                                <option> --Activities--</option>
                            </select>  
                        </td>
                    </tr>
                    <tr><td class="new_data_tb_frst_cols">Item </td><td> <?php get_item_combo(); ?>  </td></tr>
                    <tr><td><label for="txt_quantity">Quantity </label></td><td> <input type="text"     name="txt_quantity" required id="txt_quantity" class="textbox" value="<?php echo trim(chosen_quantity_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_unit_cost">unit cost </label></td><td> <input type="text"     name="txt_unit_cost" required id="txt_unit_cost" class="textbox" value="<?php echo trim(chosen_unit_cost_upd()); ?>"   />  </td></tr>
                    <tr class="off"><td class="new_data_tb_frst_cols">Budget prep </td><td> <?php //get_budget_prep_combo();                                        ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_payment_voucher" value="Save"/>  </td></tr>
                </table>
            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">payment vouchers List</div>
                <?php
                    $obj = new multi_values();
                    $obj->list_payment_voucher();
                ?>
            </div>  
        </form> 
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free ">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="payment_voucher" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_paymet_voucher.php"target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
    </body>
</hmtl>
<?php

    function get_type_project_combo() {
        $obj = new multi_values();
        $obj->get_type_project_in_combo();
    }

    function get_project_combo() {
        $obj = new multi_values();
        $obj->get_project_in_combo_refill();
    }

    function get_item_combo() {
        $obj = new multi_values();
        $obj->get_item_in_combo();
    }

    function chosen_item_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $item = new multi_values();
                return $item->get_chosen_payment_voucher_item($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_payment_voucher_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_User_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $User = new multi_values();
                return $User->get_chosen_payment_voucher_User($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_quantity_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $quantity = new multi_values();
                return $quantity->get_chosen_payment_voucher_quantity($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_unit_cost_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $unit_cost = new multi_values();
                return $unit_cost->get_chosen_payment_voucher_unit_cost($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_payment_voucher_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_budget_prep_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'payment_voucher') {
                $id = $_SESSION['id_upd'];
                $budget_prep = new multi_values();
                return $budget_prep->get_chosen_payment_voucher_budget_prep($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    