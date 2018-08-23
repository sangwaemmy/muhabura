<?php
    session_start();
    require_once '../web_db/multi_values.php';
    require_once '../web_db/other_fx.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_journal_entry_line'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_line') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $journal_entry_line_id = $_SESSION['id_upd'];
                $accountid = trim($_POST['txt_accountid_id']);
                $dr_cr = $_POST['txt_dr_cr'];
                $amount = $_POST['txt_amount'];
                $memo = $_POST['txt_memo'];
                $journal_entry_header = $_POST['txt_journal_entry_header_id'];
                $upd_obj->update_journal_entry_line($accountid, $dr_cr, $amount, $memo, $journal_entry_header, $journal_entry_line_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $accountid = trim($_POST['txt_accountid_id']);
            $dr_cr = $_POST['txt_dr_cr'];
            $amount = $_POST['txt_amount'];
            $memo = $_POST['txt_memo'];
            $journal_entry_header = trim($_POST['txt_journal_entry_header_id']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_journal_entry_line($accountid, $dr_cr, $amount, $memo, 0);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            journal entry line
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/financial_rep.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">
        <style>

        </style>
    </head>
    <body>
        <?php require_once './fin_book_details/balance_sheet.php'; ?>
        <div class="parts fin_details_box off">
        </div>

        <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
        <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
        <input type="hidden" id="txt_accountid_id"   name="txt_accountid_id"/>
        <input type="hidden" id="txt_journal_entry_header_id"   name="txt_journal_entry_header_id"/>
        <input type="hidden" id="txt_acc_type_id" style="float: right;"   name="txt_acc_type_id"/>
        <input type="hidden" id="txt_subacc_id" style="float: right;"   name="txt_subacc_id"/>
        <input type="hidden" id="txt_acc_class_id"   name="txt_acc_class_id"/>
        <!--when the opening balance is available the below fields are used-->
        <input type="hidden" id="txt_end_balance_id"   name="txt_end_balance_id"/>
        <input type="hidden" id="txt_end_date_id"   name="txt_end_date_id"/>
        <?php
            include 'admin_header.php';
        ?>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">
        </div>
        <!--End Tuype Details-->

        <table class="new_data_table off">
            <tr><td>Account </td><td> <?php get_account_in_combo(); ?>  </td></tr>
            <tr><td><label for="txt_tuple">Debit or Credit </label></td><td> <input type="text"     name="txt_dr_cr"  id="txt_dr_cr" class="textbox" value="<?php echo trim(chosen_dr_cr_upd()); ?>"   />  </td></tr>
            <tr><td><label for="txt_tuple">Amount </label></td><td> <input type="text"     name="txt_amount"  id="txt_amount" class="textbox" value="<?php echo trim(chosen_amount_upd()); ?>"   />  </td></tr>
            <tr><td><label for="txt_tuple">Memo </label></td><td> <input type="text"     name="txt_memo"  id="txt_memo" class="textbox" value="<?php echo trim(chosen_memo_upd()); ?>"   />  </td></tr>
            <tr><td>Journal Entry Header </td><td> <?php get_journal_entry_header_combo(); ?>  </td></tr>
            <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="" value="Save"/>  </td></tr>
        </table>
    </div>
    <div class="parts eighty_centered heit_free no_paddin_shade_no_Border  margin_free accept_abs" >
        <div class="parts report_note no_paddin_shade_no_Border link_cursor   off" data-bind="inc_note"> </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border margin_free row_underline">
            <div class="parts full_center_two_h heit_free   margin_free ">
                <table class="full_center_two_h heit_free margin_free margin_free">
                    <td><select class="cbo_rep_period_options">
                            <option>All</option>
                            <option>Today</option>
                            <option>This week</option>
                            <option>This week-to-date</option>
                            <option>This month</option>
                            <option>This month-to-date</option>
                            <option>This fiscal quarter</option>
                            <option>This fiscal quarter-to-date</option>
                            <option>This fiscal year</option>
                            <option>This fiscal year-to-Last Month</option>
                            <option>This fiscal year-to-date</option>
                            <option>Yesterday</option>
                            <option>Last week</option>
                            <option>Last week-to-date</option>
                            <option>Last month</option>
                            <option>Last month-to-date</option>
                            <option>Last fiscal quarter</option>
                            <option>Last fiscal quarter-to-date</option>
                            <option>Last Year</option>
                            <option>Last Year-to-date</option>
                        </select>
                    </td>
                    <td>Start date</td><td><input type="text" id="date1" value="<?php echo start_date(); ?>" class="textbox dates"></td>
                    <td>End date</td><td><input   type="text" id="date2" value="<?php echo end_date(); ?>" class="textbox dates"></td>
                    <td></td><td>
                        <select>
                            <option>Sort by</option>
                            <option>Type</option>
                            <option>Date</option>
                            <option>Num</option>
                            <option>Name</option>
                            <option>Memo</option>
                            <option>Amount</option>
                        </select> </td>
                    <td><input type="button"  class="confirm_buttons btn_books_date" data-bind="incm" value="Search" style= "background-image: none;margin-top: 0px;"/> </td>
                </table>
            </div>
        </div>
        <?php
            require_once '../web_db/Reports.php';

            $tot_inc_exp = new other_fx();

             $start_date = $tot_inc_exp->get_this_year_start_date();
            $end_date = $tot_inc_exp->get_this_year_end_date();
            $stock = new Reports();
            $sum_income = $tot_inc_exp->get_sum_income_or_expenses('income', $start_date,$end_date );
            $sum_expense = $tot_inc_exp->get_sum_income_or_expenses('expense');
            $net = $sum_income - $sum_expense;
            $obj = new multi_values();
            $other = new other_fx();
            $first = $obj->get_first_journal_entry_line();

           
            $opening_stock = $stock->get_opening_stock($start_date, $end_date);
            $closing_stock = $stock->get_closing_stock($start_date, $end_date);
            $purchase_ofperiod = $stock->get_purchases_ofPeriod($start_date, $end_date);

            $gen_expenses = $other->get_sum_gen_expe_by_date($start_date, $end_date);
            $sum_research_dev = $other->get_research_dev_by_date($start_date, $end_date);
//            $tot_cogs = $opening_stock + $purchase_ofperiod - $closing_stock; //This is wrong
            $tot_cogs = $other->get_sum_cogs_by_date($start_date, $end_date);
            $sum_gross_margin = $sum_income - $tot_cogs;

            $gross_profit = $sum_income + $tot_cogs;
            $tot_op_expense = $sum_gross_margin - $tot_cogs; // these are the operating exp.
            $sum_income_ope = $gross_profit - $tot_op_expense;
            $sum_interest_income = 0; //This is calculated by accountant manually
            $sum_income_tax = 0; //This is what calculated by accountant manually

            $tot_net_income = $sum_income_ope + $sum_interest_income - $sum_income_tax; //                $opening_stock_by_budget = $stock->get_openingstock_by_budget($date1, $date2);
        ?><div class=" parts seventy_centered no_shade_noBorder  heit_free" style="font-size: 16px;">
            <span style="font-weight: normal;">Income Statement from   </span> <?php echo $start_date . '  to ' . $end_date; ?>
            <br/>
        </div>
        <div class="parts seventy_centered no_shade_noBorder">
            <div class="parts push_right exprt_btn link_cursor no_shade_noBorder">                     
                <form action="../prints/rep_income_statement.php"target="blank" method="post">


                    <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                </form>
            </div>
            <table   class="income_table2">
                <tr class="row_bold group_label balnc_sales_revenue">  <td>Sales revenue</td><td class="note_cells">1</td><td><?php echo number_format($sum_income) ?></td></tr>
                <?php //$other->list_sum_income_or_expenses('income');  ?>
                <tr class="row_bold row_underline group_label balnc_cogs">  <td>Cost of good sold</td><td class="note_cells">2</td><td> <?php echo number_format($tot_cogs); ?> </td>  </tr>
                <tr class="row_bold ">
                    <td >GROSS MARGIN</td><td></td><td class="row_underline"><?php echo number_format($gross_profit); ?></td>
                </tr>
                <tr class="off">  <td class="inner_sub">Opening stock</td><td><?php echo number_format($opening_stock); ?></td>  </tr>
                <tr class="off">  <td class="inner_sub2">Closing Stock by budget stock</td><td><?php echo $stock->list_closingstock_by_date($start_date, $end_date) ?></td>  </tr>
                <tr class="off">  <td class="inner_sub">Closing stock</td><td><?php echo number_format($closing_stock); ?></td>  </tr>
                <tr class="off">  <td class="inner_sub">Purchases</td><td><?php echo number_format($purchase_ofperiod); ?></td>  </tr>
                <tr class="off">  <td><b>Gross profit</b></td><td><?php echo number_format($gross_profit) ?></td>  </tr>
                <tr class="row_bold padding_top group_label balnc_research">  <td>  Research and development    </td><td class="note_cells">3</td><td><?php echo number_format($sum_research_dev) ?><td>             </td>       </tr>
                <tr class="row_bold row_underline group_label balnc_gen_explist_gen_expe_by_date">  <td><b> General & administrative   </b></td><td class="note_cells">4</td><td> <?php echo number_format($gen_expenses) ?></td>      </td> 
                </tr>
                <tr class="row_bold ">  <td>OPERATING EXPENSES</td><td></td><td><?php echo number_format($tot_op_expense) ?></td>  </tr>
                <tr class="row_bold padding_top  balnc_income_op">  <td><b> INCOME FROM OPERATIONS  </b></td><td><?php echo number_format($sum_income_ope) ?></td>  </tr>
                <tr class="row_bold group_label padding_top balnc_interest_income">  <td><b>  Interest income </b></td><td class="note_cells">5</td> <td>Not calculated</td>                                                </td> 
                </tr>
                <tr class="row_bold group_label row_underline balnc_income_tx">  <td>   Income tax  </td><td class="note_cells">6</td><td><?php echo $sum_income_tax . ' '; ?>Not calculated</td>     
                    </td> 
                </tr>
                <tr class="row_bold row_double_underline">  <td>NET INCOME</td><td  class="note_cells">7</td><td><?php echo number_format($tot_net_income) ?></td>  </tr>
            </table>
        </div>

        <table class="dataList_table off">
            <tr class="big_title"><td>Income</td><td><?php echo number_format($sum_income); ?></td></tr>  <?php ?><tr><td colspan="2">
                    <a href="#" style="color: #000080; text-decoration: none;">
                        <span class="details link_cursor"><div class="parts no_paddin_shade_no_Border full_center_two_h heit_free no_bg"> Details</div>
                            <span class=" hidable full_center_two_h heit_free"> 
                                <?php $other->list_journal_entry_line('income'); ?>
                            </span>
                        </span>
                    </a>
                </td></tr>
            <tr class="big_title"><td>Expenses</td> <td><?php echo number_format($sum_expense); ?></td></tr>
            <tr><td colspan="2"> 
                    <a href="#" style="color: #000080; text-decoration: none;">
                        <span class="details link_cursor"><div class="parts no_paddin_shade_no_Border full_center_two_h heit_free no_bg"> Details</div>
                            <span class=" hidable full_center_two_h heit_free"> 
                                <?php $other->list_journal_entry_line('Expense'); ?>
                            </span>
                        </span>
                    </a>
                </td><?php ?></tr>
            <tr class="big_title">
                <td>Net</td>
                <td><?php echo (number_format($net) < 1) ? '<span class="red_text">' . number_format($net) . '</span>' : number_format($net); ?></td>
            </tr>
        </table>
    </div> 
    <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box off">
        <table class="margin_free">
            <td>
                <form action="../web_exports/excel_export.php" method="post">
                    <input type="hidden" name="account" value="a"/>
                    <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                </form>
            </td>
            <td>
                <form action="../prints/custom_p_income.php" target="blank" method="post">
                    <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                </form>
            </td>
        </table>
    </div>

    <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
        <?php require_once './navigation/add_nav.php'; ?> 
    </div>
    <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="admin_script.js" type="text/javascript"></script>

    <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
    <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
    <script src="../web_scripts/date_picker/jquery-ui.js" type="text/javascript"></script>
    <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../web_scripts/hide_headers.js" type="text/javascript"></script>
    <script>
        $('#ending_date, .dates').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        //Here are the default(Set this year start date and the its ending date)
        var d = new Date();
        var month = 1;
        var day = 1;
        var output = d.getFullYear() + '-' +
                (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
//        $('#date1').val(output);

        //The second date
        var month2 = d.getMonth() + 1;
        var day2 = d.getDate();
        var output2 = d.getFullYear() + '-' + (month2 < 10 ? '0' : '') + month2 + '-' +
                (day2 < 10 ? '0' : '') + day2;

//        $('#date2').val(output2);
    </script>
</body>
</hmtl>
<?php

    function start_date() {
        $m = new other_fx();
        return $m->get_this_year_start_date();
    }

    function end_date() {
        $m = new other_fx();
        return $m->get_this_year_end_date();
    }

    function get_acc_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_account_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function get_parties_in_combo() {
        $obj = new other_fx();
        $obj->get_vendors_suppliers_in_combo_array();
    }

    function get_account_in_combo() {
        $obj = new other_fx();
        $obj->get_account_in_combo_array();
    }

    function get_journal_entry_header_combo() {
        $obj = new multi_values();
        $obj->get_journal_entry_header_in_combo();
    }

    function chosen_accountid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_line') {
                $id = $_SESSION['id_upd'];
                $accountid = new multi_values();
                return $accountid->get_chosen_journal_entry_line_accountid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_dr_cr_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_line') {
                $id = $_SESSION['id_upd'];
                $dr_cr = new multi_values();
                return $dr_cr->get_chosen_journal_entry_line_dr_cr($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_line') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_journal_entry_line_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_memo_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_line') {
                $id = $_SESSION['id_upd'];
                $memo = new multi_values();
                return $memo->get_chosen_journal_entry_line_memo($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_journal_entry_header_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_line') {
                $id = $_SESSION['id_upd'];
                $journal_entry_header = new multi_values();
                return $journal_entry_header->get_chosen_journal_entry_line_journal_entry_header($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function send_journal() {
        if (isset($_POST['send_journal'])) {
            require_once '../web_db/new_values.php';
            $debit = $_POST['txt_debit'];
            $credit = $_POST['txt_credit'];
            $memos = $_POST['txt_memo'];
            $all_debit = 0;
            $all_credit = 0;
            $amnt_debt = 0;
            $amnt_crdt = 0;
            //get sums
            $sum_debt = 0;
            $sum_crdt = 0;
            $account = $_POST['acc_name_combo'];

            foreach ($debit as $dbt) {
                $sum_debt += $dbt;
            }
            foreach ($credit as $crdt) {
                $sum_crdt += $crdt;
            }
            if ($sum_debt != $sum_crdt) {
                ?><script>alert('The credit side is not equal debit side');</script><?php
            } else {
                foreach ($account as $acc) {
                    if (!empty($acc)) {
                        foreach ($debit as $dbt) {
                            if (!empty($dbt)) {
                                $all_debit += 1;
                                $amnt_debt += $dbt;
                                $newobj = new new_values();
                            }
                            break;
                        }
                        foreach ($credit as $crdt) {
                            if (!empty($crdt)) {
                                $amnt_crdt += $crdt;
                                $all_credit += 1;
                                $newobj = new new_values();
                            } break;
                        }
                        foreach ($memos as $memo) {
                            if (!empty($memo)) {
                                
                            }
                            break;
                        }
                        $newobj->new_journal_entry_line($acc, 0, $amnt_crdt, $memo, 0);
                        echo 'Account: ' . $acc . '  Debit side: ' . $sum_crdt . ' Credit side: ' . $sum_debt . '   <br/>';
                    }
                }
            }
        }
    }
    