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
            journal_entry_line
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
    </head>
    <body class="dull_body">
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
            <div class="parts eighty_centered no_paddin_shade_no_Border accept_abs">
                <div class="parts full_center_two_h heit_free margin_free no_paddin_shade_no_Border row_underline">
                    <div class="parts seventy_centered no_paddin_shade_no_Border ">
                        <table class="full_center_two_h heit_free margin_free no_paddin_shade_no_Border">
                            <td>Start date</td><td><input type="text" id="date1" class="textbox dates"></td>
                            <td>End date</td><td><input  type="text" id="date2" class="textbox dates"></td>
                            <td><input type="button"  class="confirm_buttons btn_books_date" data-bind="blns" value="Search" style= "background-image: none;margin-top: 0px;"/> </td>
                        </table>
                    </div>
                </div>
                <div class="parts report_note no_paddin_shade_no_Border link_cursor off "data-bind="balance_note"> </div>
                <?php
                    $other = new other_fx();
                    $min_date = $other->get_this_year_start_date();
                    $max_date = $other->get_this_year_end_date();
                    $tot_inc_exp = new other_fx();
                    $sum_assets = $tot_inc_exp->get_sum_assets(); // other than the fixed assets

                    $sum_liability = $tot_inc_exp->get_sum_liability_by_date($min_date, $max_date);
                    $equity = $sum_assets - $sum_liability;
                    $obj = new multi_values();

                    $sum_fixed_asst = ( $other->get_sum_fixed_assets_by_date($min_date, $max_date) > 0) ? $other->get_sum_fixed_assets_by_date($min_date, $max_date) : '';
                    $sum_current_asset = $other->get_sum_current_assets_by_date($min_date, $max_date);
                    $sum_tot_liab = $other->get_sum_liability();
                    $sum_cash_by_date = $other->get_sum_cash_by_date($min_date, $max_date);
                    $sum_acc_rec = $other->get_sum_acc_rec_by_date($min_date, $max_date);
                    $sum_inventory_bydate = $other->get_sum_inventory_by_date($min_date, $max_date);
                    $sum_prepaid_exp = $other->get_sum_prep_exp_by_date($min_date, $max_date);

                    $tot_current_asset = $sum_cash_by_date + $sum_acc_rec + $sum_inventory_bydate + $sum_prepaid_exp;
                    $tot_net_assets = $sum_fixed_asst + $sum_current_asset;
                    $tot_assets = $tot_net_assets + $tot_current_asset;

                    $sum_account_pay = $other->get_sum_acc_pay_by_date($min_date, $max_date);
                    $sum_acrud_exp = $other->get_sum_acrud_exp_by_date($min_date, $max_date);
                    $sum_current_debt = $other->get_sum_current_debt_by_date($min_date, $max_date);
                    $tot_liability = $sum_account_pay + $sum_acrud_exp + $sum_current_debt;

                    $sum_long_term_debt = $other->get_sum_longterm_debt_by_date($min_date, $max_date);
                    $sum_retained_earnings = $other->get_sum_retained_earn_by_date($min_date, $max_date);
                    $tot_equity = $sum_long_term_debt + $sum_retained_earnings + $tot_liability;
                    $tot_liab_equity = $tot_equity + $tot_liability;
                ?>
                <div class=" parts seventy_centered no_shade_noBorder  heit_free " style="font-size: 16px;">
                    <span style="font-weight: normal;"> Balance sheet from</span> <?php echo $min_date . '  to  ' . $max_date ?>
                    <br/>
                </div>
                <div class="parts eighty_centered heit_free no_paddin_shade_no_Border ">
                   <div class="parts push_right exprt_btn link_cursor no_shade_noBorder">                     
                <form action="../prints/rep_bal_sheet.php"target="blank" method="post">
                    <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                </form>
            </div>
                    <div class="parts no_shade_noBorder">
                        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border x_titles">
                            Assets
                        </div>

                        <table class="income_table2">
                            <tr class="row_bold group_label inc_cash">   <td>Cash</td><td><?php echo number_format($sum_cash_by_date); ?></td> </tr>
                            <tr class="group_label inc_acc_rec">   <td class="row_bold">Account Receivable</td><td><?php echo number_format($sum_acc_rec); ?></td> </tr>
                            <tr class="group_label inc_inventory">   <td class="row_bold">Inventory</td><td><?php echo number_format($sum_inventory_bydate); ?></td> </tr>
                            <tr class="row_underline group_label inc_prep_expense">   <td class="row_bold ">Prepaid expenses</td> <td><?php echo number_format($sum_prepaid_exp); ?></td></tr>
                            <tr class="row_bold ">
                                <td>CURRENT ASSETS</td><td> <?php echo number_format($tot_current_asset); ?></td>
                            </tr> 
                            <?php // $other->list_fixed_assets_by_date($min_date, $max_date);  ?>
                            <tr class="row_bold padding_top group_label">
                                <td>Other Current  Asset</td><td><?php echo number_format($sum_current_asset); ?></td>
                            </tr>
                            <tr class="row_bold  group_label inc_fixed_assets">
                                <td>Fixed asset at cost</td><td><?php echo number_format($sum_fixed_asst); ?></td>
                            </tr>
                            <tr class="row_bold row_underline group_label inc_accumulated_deprec">
                                <td>Accumulated depreciation</td><td><?php echo ($sum_current_asset > 0) ? $sum_current_asset : 0; ?></td>
                            </tr>
                            <tr class="row_bold  ">
                                <td>NET FIXED ASSETS</td><td><?php echo number_format($tot_net_assets); ?></td>
                            </tr>
                            <?php // $other->list_current_assets_by_date($min_date, $max_date);  ?>
                            <tr class="row_bold  padding_top row_underline row_double_underline">
                                <td>TOTAL ASSET</td><td><?php echo number_format($tot_assets); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="parts no_shade_noBorder ">
                        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border x_titles">
                            Liabilities and Equity
                        </div>
                        <table class="income_table2">
                            <tr class="row_bold off">
                                <td>Liability </td><td> <?php echo ( $sum_liability > 0) ? number_format($sum_liability) : 0; ?></td>
                            </tr>
                            <tr class="row_bold group_label inc_acc_pay">
                                <td>Accounts Payable </td><td> <?php echo number_format($sum_account_pay); ?></td>
                            </tr>
                            <tr class="row_bold group_label inc_accrued_expe">
                                <td>Accrued expenses</td><td> <?php echo number_format($sum_acrud_exp); ?></td>
                            </tr>
                            <tr class="row_bold group_label inc_income_tx">
                                <td>Income taxes payable</td><td> <?php echo 0; ?></td>
                            </tr>
                            <tr class="row_bold row_underline group_label   inc_current_portion">
                                <td>Current portion of debt</td><td> <?php echo number_format($sum_current_debt); ?></td>
                            </tr>
                            <tr class="row_bold "> <td>CURRENT LIABILITIES</td><td> <?php echo number_format($tot_liability); ?></td>
                            </tr>
                            <tr class="row_bold padding_top  group_label inc_longterm_debt"> <td>Long term debt</td><td> <?php echo number_format($sum_long_term_debt); ?></td>
                            </tr>
                            <tr class="row_bold group_label inc_capital_stock"> <td>Capital stock</td><td> <?php echo '0.00'; ?></td>
                            </tr>
                            <tr class="row_bold row_underline group_label"> <td>Retained earnings</td><td> <?php echo number_format($sum_long_term_debt); ?></td>
                            </tr>
                            <tr class="row_bold "> <td>SHAREHOLDER'S EQUITY</td><td> <?php echo number_format($tot_equity); ?></td>
                            </tr>
                            <?php //$other->list_liability_by_date($min_date, $max_date);  ?>
                            <tr class="row_bold  row_underline padding_top row_double_underline">
                                <td>TOT. LIABILITIES & EQUITY</td><td><?php echo number_format($tot_liab_equity) ?></td>
                            </tr>
                        </table>

                    </div>

                </div>

                <table class="dataList_table off">
                    <tr class="big_title"><td>Assets</td><td><?php echo number_format($sum_assets); ?></td></tr>  <?php ?><tr><td colspan="2">
                            <a href="#" style="color: #000080; text-decoration: none;">
                                <span class="details link_cursor"><div class="parts no_paddin_shade_no_Border full_center_two_h heit_free no_bg"> Details</div>
                                    <span class="off hidable full_center_two_h heit_free"> 
                                        <?php $other->list_assets(); ?>
                                    </span>
                                </span>
                            </a>
                        </td></tr>
                    <tr class="big_title"><td>Liability </td> <td><?php echo number_format($sum_liability); ?></td></tr>
                    <tr><td colspan="2"> 
                            <a href="#" style="color: #000080; text-decoration: none;">
                                <span class="details link_cursor"><div class="parts no_paddin_shade_no_Border full_center_two_h heit_free no_bg"> Details</div>
                                    <span class="off hidable full_center_two_h heit_free"> 
                                        <?php $other->list_liabilities(); ?>

                                    </span>
                                </span>
                            </a>
                        </td><?php ?></tr>
                    <tr class="big_title">
                        <td>Equity</td>
                        <td><?php echo (number_format($equity) < 1) ? '<span class="red_text">' . number_format($equity) . '</span>' : number_format($equity); ?></td>
                    </tr>
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
        <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script> <script src="../web_scripts/hide_headers.js" type="text/javascript"></script>
        <script>
            $('#ending_date, .dates').datepicker({
                dataFormat: 'yy-mm-dd'
            });
        </script>
        <script>
            $('#ending_date, .dates').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            //Here are the default(Set this year start date and the its ending date)
            var d = new Date();
            //        var month = d.getMonth() + 1;
            var month = 1;
            //        var day = d.getDate();
            var day = 1;
            var output = d.getFullYear() + '-' +
                    (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
            $('#date1').val(output);

            //The second date
            var month2 = d.getMonth() + 1;
            var day2 = d.getDate();
            var output2 = d.getFullYear() + '-' + (month2 < 10 ? '0' : '') + month2 + '-' +
                    (day2 < 10 ? '0' : '') + day2;
            //        var output2 =
            $('#date2').val(output2);
        </script>
    </body>
</hmtl>
<?php

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
    