<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_sales_quote_line'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $sales_quote_line_id = $_SESSION['id_upd'];
                $quantity = $_POST['txt_quantity'];
                $unit_cost = $_POST['txt_unit_cost'];
                $entry_date = date("y-m-d");
                $User = $_SESSION['userid'];
                $amount = $_POST['txt_amount'];
                $measurement = $_POST['txt_measurement_id'];
                $item = $_POST['txt_item'];

                $upd_obj->update_sales_quote_line($quantity, $unit_cost, $entry_date, $User, $amount, $measurement, $item, $sales_quote_line_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $quantity = $_POST['txt_quantity'];
//            filter_var($amount, FILTER_SANITIZE_NUMBER_INT);
            $unit_cost = $_POST['txt_unit_cost'];
            $entry_date = date("y-m-d h:m:s");
            $User = $_SESSION['userid'];

            $measurement = trim($_POST['txt_measurement_id']);
            $item = $_POST['txt_item_id'];
            $tot = $quantity * $unit_cost;
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_sales_quote_line($quantity, filter_var($unit_cost, FILTER_SANITIZE_NUMBER_INT), $entry_date, $User, filter_var($tot, FILTER_SANITIZE_NUMBER_INT), $measurement, $item);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            sales_quote_line</title>
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
        <form action="new_sales_quote_line.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" style="float: right" id="txt_measurement_id"   name="txt_measurement_id"/>
            <input type="hidden" id="txt_quotationid_id"   name="txt_quotationid_id"/>
            <input type="hidden" id="txt_item_id"   name="txt_item_id"/>
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
            <!--End dialog-->
            <!--Start of opening Pane(The pane that allow the user to add the data in a different table without leaving the current one)-->
            <div class="parts abs_full eighty_centered onfly_pane_measurement">
                <div class="parts  full_center_two_h heit_free">
                    <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                        <table class="new_data_table" >
                            <thead>Add new measurement</thead>
                            <tr>     <td>code</td> <td>       <input type="text" autocomplete="off"  class="textbox"  id="onfly_txt_code" />  </td>
                            <tr>     <td>description</td> <td><input type="text" autocomplete="off"  class="textbox"  id="onfly_txt_description" />  </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="confirm_buttons btn_onfly_save_measurement" name="send_measurement" value="Save & close"/> 
                                    <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>                        
            </div>
            <!--End of opening Pane-->
            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Add a sale quotation </div>
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                sales_quote_line saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Sales Quotation Registration </div>
                <table class="new_data_table">
                    <tr><td><label for="txt_item">item </label></td><td> 
                            <?php get_item_combo(); ?>
                        </td></tr>
                    <tr><td><label for="txt_quantity">Quantity </label></td><td> <input type="text"  autocomplete="off"   name="txt_quantity" required id="txt_quantity" class="textbox" value="<?php echo trim(chosen_quantity_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_unit_cost">Unit Cost </label></td><td> <input type="text"  autocomplete="off"   name="txt_unit_cost" required id="txt_unit_cost" class="textbox only_numbers" value="<?php echo trim(chosen_unit_cost_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_sales_quote_line" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Sales Quotation List</div>
                <?php
                    // <editor-fold defaultstate="collapsed" desc="--paging init---">
                    if (isset($_POST['prev'])) {
                        $_SESSION['page'] = ($_SESSION['page'] < 1) ? 1 : ($_SESSION['page'] -= 1);
                        $last = ($_SESSION['page'] > 1) ? $_SESSION['page'] * 30 : 30;
                        $first = $last - 30;
                    } else if (isset($_POST['page_level'])) {//this is next
                        $_SESSION['page'] = ($_SESSION['page'] < 1) ? 1 : ($_SESSION['page'] += 1);
                        $last = $_SESSION['page'] * 30;
                        $first = $last - 30;
                    } else if (isset($_SESSION['page']) && isset($_POST['paginated']) && $_SESSION['page'] > 0) {// the use is on another page(other than the first) and clicked the page inside
                        $last = $_POST['paginated'] * 30;
                        $first = $last - 30;
                    } else if (isset($_POST['paginated']) && $_SESSION['page'] = 0) {
                        $first = 0;
                    } else if (isset($_POST['paginated'])) {
                        $last = $_POST['paginated'] * 30;
                        $first = $last - 30;
                    } else if (isset($_POST['first'])) {
                        $_SESSION['page'] = 1;
                        $first = 0;
                    } else {
                        $first = 0;
                    }

// </editor-fold>
                    $obj = new multi_values();
                    $first = $obj->get_first_sales_quote_line();
                    $obj->list_sales_quote_line();
                ?>
            </div>  
        </form><div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="sale_quote_line" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_sales_quote_line.php"target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td></table>
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

    function chosen_item_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $item = new multi_values();
                return $item->get_chosen_sales_quote_line_item($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function get_item_combo() {
        $obj = new multi_values();
        $obj->get_item_in_combo();
    }

    function get_measurement_combo() {
        $obj = new multi_values();
        $obj->get_measurement_in_combo();
    }

    function chosen_quantity_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $quantity = new multi_values();
                return $quantity->get_chosen_sales_quote_line_quantity($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_unit_cost_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $unit_cost = new multi_values();
                return $unit_cost->get_chosen_sales_quote_line_unit_cost($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_sales_quote_line_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_User_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $User = new multi_values();
                return $User->get_chosen_sales_quote_line_User($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_sales_quote_line_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_quote_line') {
                $id = $_SESSION['id_upd'];
                $measurement = new multi_values();
                return $measurement->get_chosen_sales_quote_line_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    