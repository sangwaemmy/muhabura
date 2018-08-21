<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_sales_order_line'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $sales_order_line_id = $_SESSION['id_upd'];
                $quantity = $_POST['txt_quantity'];
                $unit_cost = $_POST['txt_unit_cost'];
                $amount = $_POST['txt_amount'];
                $entry_date = date("y-m-d");
                $User = $_SESSION['userid'];
                $quotationid = $_POST['txt_quotationid_id'];
                $upd_obj->update_sales_order_line($quantity, $unit_cost, $amount, $entry_date, $User, $quotationid, $sales_order_line_id);
                unset($_SESSION['table_to_update']);
            }
        } else {

            $quantity = $_POST['txt_quantity'];
            $unit_cost = $_POST['txt_unit_cost'];
//            $amount = $_POST['txt_amount'];
            $entry_date = date("y-m-d");
            $User = $_SESSION['userid'];
            $quotationid = trim($_POST['txt_quotationid_id']);
            $tot = $quantity * $unit_cost;
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_sales_order_line($quantity, filter_var($unit_cost, FILTER_SANITIZE_NUMBER_INT), filter_var($tot, FILTER_SANITIZE_NUMBER_INT), $entry_date, $User, $quotationid);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            sales_order_line</title>
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
        <form action="new_sales_order_line.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_quotationid_id"   name="txt_quotationid_id"/>
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

            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add Sale Order </div>
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                sales_order_line saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Sale Order Registration </div>

                <table class="new_data_table">
                    <tr><td class="new_data_tb_frst_cols">Quotation </td><td> <?php get_quotationid_combo(); ?>  </td></tr>
                    <tr>
                        <td colspan="2">
                            <span class="parts no_paddin_shade_no_Border load_res off"></span>
                        </td>
                    </tr>
                </table>
                <div class="parts continuous_res no_paddin_shade_no_Border ">

                </div>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Sale orders List</div>
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
                    $first = $obj->get_first_sales_order_line();
                    $obj->list_sales_order_line($first);
                ?>
            </div>  
        </form> 
        <div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="sales_order_line" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_sales_order_line.php"target="blank" method="post">
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

    function get_quotationid_combo() {
        $obj = new multi_values();
        $obj->get_quotationid_in_combo();
    }

    function chosen_quantity_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                $id = $_SESSION['id_upd'];
                $quantity = new multi_values();
                return $quantity->get_chosen_sales_order_line_quantity($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_unit_cost_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                $id = $_SESSION['id_upd'];
                $unit_cost = new multi_values();
                return $unit_cost->get_chosen_sales_order_line_unit_cost($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_sales_order_line_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_sales_order_line_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_User_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                $id = $_SESSION['id_upd'];
                $User = new multi_values();
                return $User->get_chosen_sales_order_line_User($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_quotationid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_order_line') {
                $id = $_SESSION['id_upd'];
                $quotationid = new multi_values();
                return $quotationid->get_chosen_sales_order_line_quotationid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    