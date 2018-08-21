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
            $entry_date = date('y-m-d h:m:s');
            $journal_entry_header = trim($_POST['txt_journal_entry_header_id']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_journal_entry_line($accountid, $dr_cr, $amount, $memo, 0, $entry_date);
        }
    }

// <editor-fold defaultstate="collapsed" desc="--save journal in db ---">
    function send_journal() {
        $entry_date = date('y-m-d h:m:s');
        $amnt_debt = 0;
        $amnt_crdt = 0;
        $switch_dc = '';
        if (isset($_POST['send_journal'])) {
            require_once '../web_db/new_values.php';
            $debit = $_POST['txt_debit'];
            $credit = $_POST['txt_credit_arr'];
            $credit_second = $_POST['txt_credit_arr'];
            $all_memo = $_POST['txt_memo_arr'];
            //get sums
            $sum_debt = 0;
            $sum_crdt = 0;
            $account = $_POST['acc_name_com'];
            $party_arr = $_POST['acc_party_in_combo'];
            foreach ($debit as $c_dbt) {
                $sum_debt += $c_dbt;
            }
            foreach ($credit as $c_crdt) {
                $sum_crdt += $c_crdt;
            }
            if ($sum_debt != $sum_crdt) {
                ?><script>alert('The credit side is not equal debit side');</script><?php
            } else {

//            $m = new MultipleIterator();
                $index_ac = new ArrayIterator($account);
                $index_debit = new ArrayIterator($debit);
                $index_credit = new ArrayIterator($credit);
                $index_memo = new ArrayIterator($all_memo);
                $index_party = new ArrayIterator($party_arr);
                $mit = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
                $mit->attachIterator($index_ac, "Account");
                $mit->attachIterator($index_debit, "Debit");
                $mit->attachIterator($index_credit, "Credit");
                $mit->attachIterator($index_memo, "memo");
                $mit->attachIterator($index_party, "partyi");
                foreach ($mit as $fruit) {
                    $dc = json_decode(json_encode($fruit), true);
                    foreach ($dc as $val) {
                        if (!empty($dc['Account'])) {
                            $switch_dc = (!empty($dc['Debit'])) ? 'Debit' : 'Credit';
                            $amount = (!empty($dc['Debit'])) ? $dc['Debit'] : $dc['Credit'];
//                          echo '  --  Account: ' . $dc['Account'] . ' --  ' . $switch_dc . '   -- Amount: ' . $amount . '   --   ' . $dc['memo'];
                            $newobj = new new_values();
                            $newobj->new_journal_entry_header($dc['partyi'], 'payable', date('y-m-d'), $dc['memo'], '', '');
                            $m = new multi_values();
                            $last_header = $m->get_last_journal_entry_header();
                            $newobj->new_journal_entry_line($dc['Account'], $switch_dc, filter_var($amount, FILTER_SANITIZE_NUMBER_INT), $dc['memo'], $last_header, $entry_date);
                            break;
                        }
                    }
                }
            }
        }
    }

// </editor-fold>
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
        <link href="../web_scripts/date_picker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>

        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">
        <style>
            input[type="submit"], .confirm_buttons{
                margin-top: 5px;
                float: left;
                margin-left: 2%;
                min-width: 120px;
            }


        </style>
    </head>
    <body>
        <?php
            include 'admin_header.php';
        ?>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <!--Start of opening balance pane (Here are two panes that come accordingly)-->
        <div class="parts abs_full pane_sect1">
            <div class="parts  full_center_two_h heit_free no_paddin_shade_no_Border first_pane">
                <div class="parts pane_opening_balance other_pane full_center_two_h heit_free">
                    <div class="parts  x_height_3x accounts_expln x_width_thr_h">
                        Choose the account Type from Right
                    </div>
                    <table class="new_data_table" >
                        <tr><td>
                            </td><td> 
                                <table>
                                    <tr class="tb_rows"><td>Chose the account type</td>     </tr>
                                    <tr class="tb_rows"><td>
                                            <input type="radio" class="radios" id="expense" name="account_type" value="2"><label for="expense">Expense</label><br/><br/>
                                            <input type="radio"  class="radios" id="income" name="account_type" value="1"><label for="income">Income</label><br/><br/>
                                            &nbsp;&nbsp;Or track the values of your assets and liabilities <br/><br/>
                                            <input type="radio"  class="radios" id="bank" name="account_type" value="17"><label for="bank">Bank</label><br/><br/>
                                            <input type="radio"  class="radios" id="loan" name="account_type" value="18"><label for="loan">Loan</label><br/><br/>
                                            <input type="radio"  class="radios" id="asset" name="account_type" value="7"><label for="asset">Fixed Asset</label><br/><br/>
                                        </td>
                                        <td> 

                                        </td>
                                    </tr>
                                    <tr class="off tb_rows"><td>Other Account types</td></tr>
                                    <tr class="tb_rows">
                                        <td>
                                            <input  type="radio"   id="other" name="account_type"  ><label for="other">Other Fixed Asset</label><br/><br/>
                                            <select  name="txt_account_type" disabled class="drop_down">
                                                <option></option>
                                                <option value="6">Account Receivable</option>
                                                <option value="10">Other Current asset</option>
                                                <option value="11">Other Asset</option>
                                                <option value="5">Account Payable</option>
                                                <option value="12">Other Current Liability</option>
                                                <option value="13">Long term Liability</option>
                                                <option value="14">Cost Of Good Sold</option>
                                                <option value="15">Other Income</option>
                                                <option value="16">Other Expense</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="tb_rows next_row off">
                            <td><label for="txt_tuple">Name </label>
                            </td><td> 
                                <input type="text"  name="txt_name" required id="txt_name" class="textbox " value="<?php echo trim(chosen_name_upd()); ?>"   />  </td>
                        </tr>
                        <tr class="next_row off">
                            <td></td>
                            <td>
                                &nbsp; &nbsp;
                                <input type="checkbox" style="float: left;"  id="check_acc" class="" value="sub_acc" name="sub_acc" />
                                <label for="check_acc"> Sub account of</label>  <br/><br/>
                                <?php get_acc_combo(); ?>
                            </td>
                        </tr>
                        <tr class="tb_rows next_row off">
                            <td>Description</td>
                            <td> <textarea name="txt_acc_desc"  class="textbox"></textarea></td>
                        </tr>
                        <tr class="tb_rows next_row off acc_bo_row">
                            <td>Account No.</td>
                            <td> <input type="text"  class="textbox"><br/>

                            </td>
                        </tr>
                        <tr class="tb_rows next_row off opn_b_row">
                            <td></td>
                            <td> <button id="balance_btn" class="small_btns second_pane_caller">Enter Opening Balance ..</button></td>
                        </tr>

                        <tr class="tb_rows">
                            <td colspan="2">

                                <input type="button" disabled class="confirm_buttons" id="acc_next" name="send_account" value="Continue"/> 
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_acc_type" name="send_account" value="Cancel"/> 
                            </td>
                        </tr>
                        <tr class="next_button off">
                            <td colspan="2">
                                <input type="button" class="confirm_buttons save_close" name="send_account" value="Save & close"/> 
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_acc_type" name="send_account" value="Cancel"/> 
                            </td>
                        </tr>
                    </table>

                </div>
            </div>  
            <div class="parts  eighty_centered no_paddin_shade_no_Border">
                <div class="parts pane_opening_balance second_pane off">
                    <form action="new_journal_entry_line.php">

                    </form>
                    <table>
                        <tr>
                            <td colspan="2">
                                <b>Enter the ending date and balance</b> from 
                                the last <span class="chosen_acc"></span><br/>
                                <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border iconed pane_icon">
                                    <b> Attention.  </b>If this account did not have a balance before your first time
                                    to use this system,click cancel and use transaction to put money in this account
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Statement Ending Balance</td>
                            <td><input type="text" class="textbox"  id="ending_balance" /> </td>
                        </tr>
                        <tr>
                            <td>Statement Ending Date</td>
                            <td><input type="text" class="textbox" id="ending_date"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color" value="Help" />
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color js_cancel_btn" value="Cancel" />
                                <input type="button" class="confirm_buttons ok_opening"  value="OK" />

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!--End of opening balance pane-->

        <form action="new_journal_entry_line.php" method="post" enctype="multipart/form-data">
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

            <div class="parts eighty_centered no_paddin_shade_no_Border ">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider link_cursor <?php echo without_admin(); ?>"> New Journal entry </div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                journal_entry_line saved successfully!</div>

            <div class="parts eighty_centered new_data_box no_paddin_shade_no_Border reverse_border off">
                <div class="parts full_center_two_h heit_free margin_free">
                    <div class="parts   no_paddin_shade_no_Border " style="font-size: 14px;  margin-left: 2%; ">
                        General Journal entry
                    </div>
                    <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
                </div>
                <table class="dataList_table journal_entry_table tab_only_joutnal" style="width: 80%;">
                    <thead>
                    <td>ACCOUNT</td> <td>DEBIT</td>    <td>CREDIT   </td> <td>MEMO</td> <td>NAME</td> 
                    </thead>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit1" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit1" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit2" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit2" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit3" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit3" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit4" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit4" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit5" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit5" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit6" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit6" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit7" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit7" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                    <tr class="ftd runtime">     <td>  <?php get_acc_combo_arr(); ?>  </td>   <td><input type="text" autocomplete="off" name="txt_debit[]" id="txt_debit8" class="textbox j_debit_txt only_numbers" style="width: 100px;" /></td>    <td>  <input type="text" autocomplete="off" class="textbox j_credit_txt only_numbers" id="txt_credit8" name="txt_credit_arr[]"  /> </td>  <td><input type="text" autocomplete="off" class="textbox only numbers" onkeypress="myFunction(event)" name="txt_memo_arr[]" /> </td>   <td><?php get_parties_in_combo(); ?> </td>         </tr>
                </table>
                <?php send_journal(); ?>
                <table style="width: 80%;">
                    <tr>

                        <td colspan="5">
                            <input type="submit" class="confirm_buttons" id="save_journal" name="send_journal" value="Save" style="margin-right: 0px;" />
                        </td>
                    </tr>
                </table>
                <table class="new_data_table off">
                    <tr><td>Account </td><td> <?php get_account_in_combo(); ?>  </td></tr>
                    <tr><td><label for="txt_tuple">Debit or Credit </label></td><td> <input type="text"     name="txt_dr_cr"  id="txt_dr_cr" class="textbox" value="<?php echo trim(chosen_dr_cr_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Amount </label></td><td> <input type="text"     name="txt_amount"  id="txt_amount" class="textbox" value="<?php echo trim(chosen_amount_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Memo </label></td><td> <input type="text"     name="txt_memo"  id="txt_memo" class="textbox" value="<?php echo trim(chosen_memo_upd()); ?>"   />  </td></tr>
                    <tr><td>Journal Entry Header </td><td> <?php ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_journal_entry_line" value="Save"/>  </td></tr>
                </table>
            </div>
            <div class="parts eighty_centered datalist_box " >
                <?php
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
                ?><div class="parts datalist_box full_center_two_h heit_free no_paddin_shade_no_Border ">
                    <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border xx_titles dataList_title">
                        Journal Entries
                    </div>
                </div><?php
                    $obj = new multi_values();
                    $obj->list_journal_entry_line($first, 30);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="journal_entry_line" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_journal_entry_line.php" target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script src="../web_scripts/Journal_auto_type.js" type="text/javascript">

        </script>

    </body>
</hmtl>


<?php

    function get_acc_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function get_acc_combo_arr() {

        $obj_acc = new other_fx();
        $obj_acc->get_account_in_combo_array();
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
    