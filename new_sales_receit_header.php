<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_sales_receit_header'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $sales_receit_header_id = $_SESSION['id_upd'];
                $sales_invoice = trim($_POST['txt_sales_invoice_id']);
                $entry_date = date("y-m-d h:m:s");
                $User = $_SESSION['userid'];
                $amount = filter_var($_POST['txt_amount'], FILTER_SANITIZE_NUMBER_INT);
                $approved = $_POST['txt_approved'];
                $upd_obj->update_sales_receit_header($sales_invoice, $entry_date, $User, $amount, $approved, $sales_invoice, $entry_date, $User, $amount, $approve, $sales_receit_header_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $sales_invoice = trim($_POST['txt_sales_invoice_header_id']);
            $entry_date = date("y-m-d h:m:s");
            $User = $_SESSION['userid'];
            $approved = 'yes';
            $quantity = $_POST['txt_quantity'];
            $unit_cost = trim($_POST['txt_unit_cost']);
            $client = trim($_POST['txt_client_id']);
            $budget_prep = trim($_POST['txt_activity_id']);
            $account = trim($_POST['txt_account_id']);
            $tot = $quantity * $unit_cost;
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_sales_receit_header($sales_invoice, $entry_date, $User, $tot, $approved, $quantity, filter_var($unit_cost, FILTER_SANITIZE_NUMBER_INT), $client, $budget_prep, $account);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            sales_receit_header</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> 
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <?php
            include 'admin_header.php';
        ?>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
            <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Add Sale Receipt </div>
            <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>        </div>
        <div class="parts eighty_centered new_data_box off">
            <table class="new_data_table selectable_table">
                <input type="hidden" name="txt_project_id" id="onfly_txt_project_id" />
                <tr>
                    <td colspan="2">
                        <div class="parts eighty_centered new_data_title">  Select a budget line </div>
                    </td>
                </tr>
                <tr><td class="new_data_tb_frst_cols">Budget line </td><td> <?php get_type_project_combo(); ?>  </td></tr>  
                <tr>
                    <td>project</td>
                    <td>
                        <select class="textbox cbo_fill_projects cbo_p_project cbo_project">
                            <option> --Projects--</option>
                        </select>  
                    </td>
                </tr>
                <tr>
                    <td>Select the Activity</td>
                    <td> <select class="textbox tobe_refilled cbo_activity cbo_fill_activity">
                            <option> --Activities--</option>
                        </select>  
                    </td>
                </tr>
                <tr>
                    <td> </td> <td>
                        <input type="submit" class="confirm_buttons" id="selct_f_year" value="Select" />


                    </td>
                </tr>
            </table>

        </div>
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
        <!--Start of opening Budget line Pane(The pane that allow the user to add the data in a different table without leaving the current one)-->
        <div class="parts abs_full eighty_centered onfly_pane_p_type_project">
            <div class="parts  full_center_two_h heit_free">
                <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                    <table class="new_data_table" >
                        <thead>Add new Budget Line</thead>
                        <tr>
                            <td>Name</td> <td><input type="text" required class="textbox"  id="onfly_txt_name" />  </td>
                        </tr>
                        <tr>
                            <td colspan="2">                                
                                <input type="button" class="confirm_buttons btn_onfly_save_p_type_project" name="send_account" value="Save & close"/> 
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>
        <!--End of opening Pane-->

        <!--Start of opening p_budget_prepPane(The pane that allow the user to add the data in a different table without leaving the current one)-->
        <div class="parts abs_full eighty_centered  onfly_pane_p_project">
            <div class="parts  full_center_two_h heit_free">
                <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                    <table class="new_data_table" >
                        <thead>Add new p_budget_prep</thead>
                        <tr>     <td>project_type</td> <td><input type="text"    autocomplete="off"   required class="textbox"     id="onfly_txt_project_type" />  </td>
                        <tr>     <td>user</td> <td><input          type="text"   autocomplete="off"   required class="textbox"    id="onfly_txt_user" />  </td>
                        <tr>     <td>entry_date</td> <td><input type="text"      autocomplete="off"    required class="textbox"       id="onfly_txt_entry_date" />  </td>
                        <tr>     <td>budget_type</td> <td><input type="text"     autocomplete="off"     required class="textbox"      id="onfly_txt_budget_type" />  </td>
                        <tr>     <td>activity_desc</td> <td><input type="text" autocomplete="off"  required class="textbox"    id="onfly_txt_activity_desc" />  </td>
                        <tr class="off">     <td>account</td> <td><input type="text" autocomplete="off" required class="textbox"          id="onfly_txt_account" />  </td>
                        </tr>
                        <tr>     <td>amount</td> <td><input type="text" autocomplete="off" required class="textbox"  id="onfly_txt_amount" />  </td>
                        <tr>     <td>name</td> <td><input type="text" autocomplete="off" required class="textbox"  id="onfly_saleinvoice_txt_name" />  </td>

                        <tr>
                            <td colspan="2">
                                <input type="button" class="confirm_buttons btn_onfly_save_p_project" name="send_p_budget_prep" value="Save & close"/> 
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>
        <!--End of opening Pane-->

        <!--Start of opening p_activity Pane(The pane that allow the user to add the data in a different table without leaving the current one)-->
        <div class="parts abs_full eighty_centered onfly_pane_p_activity">
            <div class="parts  full_center_two_h heit_free">
                <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                    <table class="new_data_table" >
                        <thead>Add new p_activity</thead>
                        <tr>     <td>project</td> <td><input type="text" required class="textbox"  id="onfly_txt_project" />  </td>
                        <tr>     <td>name</td> <td><input type="text" required class="textbox"  id="onfly_activity_txt_name" />  </td>
                        <tr>     <td>fisc_year</td> <td><input type="text" required class="textbox"  id="onfly_txt_fisc_year" />  </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="confirm_buttons btn_onfly_save_p_activity" name="send_p_activity" value="Save & close"/> 
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>
        <!--End of opening Pane-->
        <form action="new_sales_receit_header.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->


            <input type="hidden" id="txt_sales_invoice_id"   name="txt_sales_invoice_id"/>
            <input type="hidden" style="float: right;" id="txt_activity_id"   name="txt_activity_id"/>
            <input type="hidden"  id="txt_client_id"   name="txt_client_id"/>
            <input type="hidden"  id="txt_account_id"   name="txt_account_id"/>
            <input type="hidden"  style="float: right;"  id="txt_sales_invoice_header_id"   name="txt_sales_invoice_header_id"/>
            <div class="parts eighty_centered off saved_dialog">
                sales_receit_header saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Add Sale Receipt  </div>
                <table class="new_data_table off rehide">
                    <tr><td class="new_data_tb_frst_cols">Account </td><td> <?php get_account_combo(); ?>  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Client </td><td> <?php get_client_combo(); ?>  </td></tr> 
                    <tr><td class="new_data_tb_frst_cols">Sales Invoice </td><td> <?php get_sales_invoice_combo(); ?>  </td></tr>


                    <tr>
                        <td colspan="2">
                            <span class="parts no_paddin_shade_no_Border load_res off"></span>
                            <div class="parts continuous_res no_paddin_shade_no_Border ">

                            </div>
                        </td>
                    </tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_sales_receit_header" value="Save"/> 
                            <button class="back_wiz push_right">Back</button>
                        </td></tr>
                </table>


            </div>
        </form>
        <div class="parts eighty_centered datalist_box" >
            <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Sale Receipt List</div>
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
                $first = $obj->get_first_sales_receit_header();
                $obj->list_sales_receit_header($first);
            ?>
        </div>  

        <div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="sales_receit_header" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_sales_receit_header.php"target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td></table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div> 
        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

    </body>
</hmtl>
<?php

    function get_type_project_combo() {
        $obj = new multi_values();
        $obj->get_type_project_in_combo();
    }

    function get_sale_invoice_combo() {
        $obj = new multi_values();
        $obj->get_sales_invoice_in_combo();
    }

    function get_sales_invoice_combo() {
        $obj = new multi_values();
        $obj->get_sales_invoice_in_combo();
    }

    function get_client_combo() {
        $obj = new multi_values();
        $obj->get_client_in_combo();
    }

    function chosen_sales_invoice_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                $id = $_SESSION['id_upd'];
                $sales_invoice = new multi_values();
                return $sales_invoice->get_chosen_sales_receit_header_sales_invoice($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function get_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo_enabled_receivable();
    }

    function chosen_quantity_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $quantity = new multi_values();
                return $quantity->get_chosen_sales_invoice_line_quantity($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_sales_receit_header_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_unit_cost_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $unit_cost = new multi_values();
                return $unit_cost->get_chosen_sales_invoice_line_unit_cost($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_sales_receit_header_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_approved_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                $id = $_SESSION['id_upd'];
                $approved = new multi_values();
                return $approved->get_chosen_sales_receit_header_approved($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_User_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                $id = $_SESSION['id_upd'];
                $User = new multi_values();
                return $User->get_chosen_sales_receit_header_User($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_approve_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_receit_header') {
                $id = $_SESSION['id_upd'];
                $approve = new multi_values();
                return $approve->get_chosen_sales_receit_header_approve($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    