<?php
    session_start();
    require_once '../web_db/multi_values.php';
   
 if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_sales_invoice_line'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $sales_invoice_line_id = $_SESSION['id_upd'];
                $quantity = $_POST['txt_quantity'];
                $unit_cost = $_POST['txt_unit_cost'];
                $amount = $_POST['txt_amount'];
                $entry_date = date("y-m-d");
                $User = $_SESSION['userid'];
                $client = $_POST['txt_client_id'];
                $sales_order = $_POST['txt_sales_order_id'];
                $budget_prep_id = $_POST['txt_budget_prep_id_id'];
                $upd_obj->update_sales_invoice_line($quantity, $unit_cost, $amount, $entry_date, $User, $client, $sales_order, $budget_prep_id, $sales_invoice_line_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
//            
//            filter_var($amount, FILTER_SANITIZE_NUMBER_INT)
            $quantity = $_POST['txt_quantity'];
            $unit_cost = $_POST['txt_unit_cost'];
//            $amount = $_POST['txt_amount'];
            $entry_date = date("y-m-d h:m:s");
            $User = $_SESSION['userid'];
            $client = trim($_POST['txt_client_id']);
            $sales_order = trim($_POST['txt_sales_order_id']);
            $budget_prep_id = trim($_POST['txt_activity_id']);
            $account = trim($_POST['txt_account_id']);
            $credit_account = trim($_POST['acc_sales_credit_combo']);
            $tot = $quantity * $unit_cost;
            $pay_method = filter_input(INPUT_POST, 'txt_pay_method');
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $tax_inclusive = (filter_input(INPUT_POST, 'chk_tax_inc')) ? 'yes' : 'no';

            $obj->new_sales_invoice_line($quantity, filter_var($unit_cost, FILTER_SANITIZE_NUMBER_INT), filter_var($tot, FILTER_SANITIZE_NUMBER_INT), $entry_date, $User, $client, $sales_order, $budget_prep_id, $account, $pay_method, $tax_inclusive);
            //now save the account payable in the journal;
            $obj->new_journal_entry_line($account, 'Debit', filter_var($tot, FILTER_SANITIZE_NUMBER_INT), "Invoice in (Sales)", 0, date("y-m-d h:m:s"));

            $obj->new_journal_entry_line($credit_account, 'Credit', filter_var($tot, FILTER_SANITIZE_NUMBER_INT), "Invoice in (Sales)", 0, date("y-m-d h:m:s"));


            if (!empty($tax_inclusive)) {
                $percentage = filter_input(INPUT_POST, 'txt_percentage');
                $m = new multi_values();
                $amount = $tot / 1.18;
                $lat_sale = $m->get_last_sales_invoice_line();
                $vat_amount = $amount;
                $pur_sale = 'sale';
                $obj->new_vat_calculation($lat_sale, $vat_amount, $entry_date, $User, 0, $pur_sale);
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            sales_invoice_line
        </title>
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
                        <tr>     <td>project</td> <td> <span id="onfly_selected_project"  </td>
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


        <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
            <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add Sale Invoice </div> 
            <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
        </div>
        <div class="parts eighty_centered off saved_dialog">
            sales_invoice_line saved successfully!</div>
        <div class="parts eighty_centered new_data_box off">
            <div class="parts eighty_centered new_data_title">  Sales Invoice Registration </div>
            <input type="hidden" name="txt_project_id" id="onfly_txt_project_id" />
            <table class="new_data_table selectable_table"> 
                <tr><td class="new_data_tb_frst_cols">Budget line </td>
                    <td> <?php get_type_project_combo(); ?>  </td>
                </tr>  
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
                    <td> </td> <td><input type="submit" class="confirm_buttons" id="selct_f_year" value="Select" /> </td>
                </tr>
            </table>
            <form action="new_sales_invoice_line.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
                <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
                <input type="hidden" id="txt_client_id"   name="txt_client_id"/>
                <input type="hidden"   id="txt_sales_order_id"   name="txt_sales_order_id"/>
                <input type="hidden" id="txt_p_budget_prep_id"   name="txt_budget_prep_id_id"/>
                <input type="hidden" style="float: right;"  id="txt_p_type_project_id"    name="txt_type_project_id"/>
                <input type="hidden" id="txt_activity_id"   name="txt_activity_id"/>
                <input type="hidden" id="txt_account_id"   name="txt_account_id"/>
                
                <table class="new_data_table off rehide">
                    <tr><td class="new_data_tb_frst_cols">Client </td><td> <?php get_client_combo(); ?>  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Account </td><td> <?php get_account_combo(); ?>  </td></tr>
                     <tr><td class="new_data_tb_frst_cols">Credit Account </td><td> <?php get_credit_account_combo(); ?>  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Payment Method </td><td> <input type="text" class="textbox" name="txt_pay_method"  />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Sales order </td><td> <?php get_sales_order_combo(); ?>  </td></tr> 
                    <tr><td class="new_data_tb_frst_cols"><label for="chk_tax_inc">Is tax inclusive</label> </td><td> <input type="checkbox"id="chk_tax_inc" name="chk_tax_inc" />  </td></tr>
                    <tr style="display: none;" class="off perc_row">
                        <td>percentage</td><td><input type="text" class="textbox txt_prec" name="txt_percentage" />  </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="parts no_paddin_shade_no_Border load_res off"></span>
                            <div class="parts continuous_res no_paddin_shade_no_Border ">

                            </div>
                        </td>
                    </tr>
                    <tr><td colspan="2">

                            <input type="submit" class="confirm_buttons" name="send_sales_invoice_line" value="Save"/>
                            <button class="back_wiz push_right">Back</button>
                        </td></tr>
                </table> 
            </form>
            <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
                <table class="margin_free">
                    <td>
                        <form action="../web_exports/excel_export.php" method="post">
                            <input type="hidden" name="sales_invoice_line" value="a"/>
                            <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                        </form>
                    </td>
                    <td>
                        <form action="../prints/print_sales_invoice_line.php" target="blank" method="post">
                            <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                        </form>
                    </td>
                </table>
            </div>
        </div>
        <div class="parts eighty_centered datalist_box" >
            <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Sales Invoice List</div>
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
                $first = $obj->get_first_sales_invoice_line();
                $obj->list_sales_invoice_line($first, $first, 30);
            ?>
        </div>  

        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
    </body>
</hmtl>
<?php

    function get_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo_enabled_receivable();
    }
 function get_credit_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo_ac_sales();
    }

    function get_type_project_combo() {
        $obj = new multi_values();
        $obj->get_type_project_in_combo();
    }

    function get_fisc_year_combo() {
        $obj = new multi_values();
        $obj->get_fisc_year_in_combo();
    }

    function get_client_combo() {
        $obj = new multi_values();
        $obj->get_client_in_combo();
    }

    function get_sales_order_combo() {
        $obj = new multi_values();
        $obj->get_sales_order_in_combo();
    }

    function get_budget_prep_id_combo() {
        $obj = new multi_values();
        $obj->get_budget_prep_id_in_combo();
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
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_sales_invoice_line_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_sales_invoice_line_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_User_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $User = new multi_values();
                return $User->get_chosen_sales_invoice_line_User($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_client_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $client = new multi_values();
                return $client->get_chosen_sales_invoice_line_client($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sales_order_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $sales_order = new multi_values();
                return $sales_order->get_chosen_sales_invoice_line_sales_order($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_budget_prep_id_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'sales_invoice_line') {
                $id = $_SESSION['id_upd'];
                $budget_prep_id = new multi_values();
                return $budget_prep_id->get_chosen_sales_invoice_line_budget_prep_id($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    