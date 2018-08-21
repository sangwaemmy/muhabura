<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_account'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $account_id = $_SESSION['id_upd'];
                $acc_type = trim($_POST['txt_acc_type_id']);
                $acc_class = $_POST['txt_acc_class_id'];
                $name = $_POST['txt_name'];
                $DrCrSide = $_POST['txt_DrCrSide'];
                $acc_code = $_POST['txt_acc_code'];
                $acc_desc = $_POST['txt_acc_desc'];
                $is_cash = $_POST['txt_is_cash'];
                $is_contra_acc = $_POST['txt_is_contra_acc'];
                $is_row_version = $_POST['txt_is_row_version'];
                $upd_obj->update_account($acc_type, $acc_class, $name, $DrCrSide, $acc_code, $acc_desc, $is_cash, $is_contra_acc, $is_row_version, $account_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $acc_type = trim($_POST['txt_acc_type_id']);
            $acc_class = 0;
            $name = trim($_POST['txt_name']);
            $DrCrSide = 'none';
            $acc_code = 0;
            $acc_desc = $_POST['txt_acc_desc'];
            $is_cash = 'yes';
            $is_contra_acc = '';
            $is_row_version = '';
            $amount = 0;
            $entry_date = date('y-m-d');
            require_once '../web_db/other_fx.php';
            $of = new other_fx();
            $acc = $of->get_account_exist($name);
            if (!empty($acc)) {
                ?><script>alert('The account is already in use, please use another account');</script><?php
            } else {
                $obj->new_account($acc_type, $acc_class, $name, $DrCrSide, $acc_code, $acc_desc, $is_cash, $is_contra_acc, $is_row_version);
                $m = new multi_values();
                $last_acc = $m->get_last_account();
//      $obj->new_account($acc_type, $acc_class, $name, $DrCrSide, $acc_code, $acc_desc, $is_cash, $is_contra_acc, $is_row_version);

                if (!empty($_POST['txt_if_save_Journal'])) {//if it is not income or expense category
                    $amount = ($_POST['txt_end_balance_id'] > 0) ? $_POST['txt_end_balance_id'] : 0;
                    $obj->new_journal_entry_line($last_acc, 'debit', filter_var($amount, FILTER_SANITIZE_NUMBER_INT), 'Opening balance', 0, $entry_date);
                    if (isset($_POST['sub_acc'])) {//sub account checkbox is selected
                        $sub_name = $_POST['acc_name_combo'];
                        $obj->new_main_contra_account($sub_name, $last_acc);
                    }
                } else {
                    if (isset($_POST['sub_acc'])) {//sub account checkbox is selected
                        $sub_name = $_POST['acc_name_combo'];
                        $obj->new_main_contra_account($sub_name, $last_acc);
                    }
                }
                //the save the journal line
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            account
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>

        <link href="../web_scripts/date_picker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">
        <style>
            .accounts_expln{
                width: 250px;
            }
            .dataList_table{
                width: 100%;
            } 

        </style>
    </head>
    <body>
        <form action="new_account.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <input type="hidden" id="txt_acc_type_id" style="float: right;"   name="txt_acc_type_id"/>
            <input type="hidden" id="txt_subacc_id" style="float: right;"   name="txt_subacc_id"/>
            <input type="hidden" id="txt_acc_class_id"   name="txt_acc_class_id"/>
            <!--when the opening balance is available the below fields are used-->
            <input type="hidden" id="txt_end_balance_id"   name="txt_end_balance_id"/>
            <input type="hidden" id="txt_end_date_id"   name="txt_end_date_id"/>
            <!--this below check if we shall save the in the journal-->
            <input type="hidden" id="txt_if_save_Journal" class="right_side" name="txt_if_save_Journal"/>
            <?php
                include 'admin_header.php';
            ?>
            <!--Start of opening balance pane-->
            <div class="parts abs_full">
                <div class="part  eighty_centered no_paddin_shade_no_Border ">
                    <div class="parts pane_opening_balance other_pane">
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
                                <td><input type="text" class="textbox only_numbers"  id="ending_balance" /> </td>
                            </tr>
                            <tr>
                                <td>Statement Ending Date</td>
                                <td><input type="text" class="textbox" id="ending_date"/></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="confirm_buttons reverse_bg_btn reverse_color" value="Help" />
                                    <input type="button" class="confirm_buttons reverse_bg_btn reverse_color js_cancel_btn" value="Cancel" />
                                    <input type="button" class="confirm_buttons" id="opn_balnce_btn" value="OK" />

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>
            <!--End of opening balance pane-->
            <!--Start of Type Details-->
            <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

            </div>
            <!--End Tuype Details-->
            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider link_cursor <?php echo without_admin(); ?>"> New Account </div> 

            </div>
            <div class="parts eighty_centered off saved_dialog">
                account saved successfully!
            </div>

            <div class="parts eighty_centered new_data_box off">

                <div class="parts  x_height_3x accounts_expln">
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
                                        <input type="radio"  class="radios" id="equity" name="account_type" value="9"><label for="equity">Equity</label><br/><br/>
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
                            <input type="text"  autocomplete="off" name="txt_name" required id="txt_name" class="textbox " value="<?php echo trim(chosen_name_upd()); ?>"   />  </td>
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
                        <td> <button id="balance_btn" class="small_btns">Enter Opening Balance ..</button></td>
                    </tr>

                    <tr class="tb_rows">
                        <td colspan="2">
                            <input type="button" disabled class="confirm_buttons" id="acc_next" name="send_account" value="Continue"/> 
                        </td>
                    </tr>
                    <tr class="next_button off">
                        <td colspan="2">
                            <input type="submit" class="confirm_buttons" name="send_account" value="Save & close"/> 
                            <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_acc_type" name="send_account" value="Cancel"/> 
                        </td>
                    </tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts off no_shade_noBorder xx_titles no_bg whilte_text">account List</div>
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

                    $obj = new multi_values();
                    $first = $obj->get_first_account();
                    $obj->list_account($first, 30);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="account" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_account.php" target="blank" method="post">
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
        <script src="../web_scripts/date_picker/jquery-ui.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script>
        <script>
                    $('#ending_date').datepicker({
                        dataFormat: 'yy-mm-dd'
                    });
        </script>
        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
    </body>
</hmtl>
<?php

    function get_acc_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function get_acc_type_combo() {
        $obj = new multi_values();
        $obj->get_acc_type_in_combo();
    }

    function get_acc_class_combo() {
        $obj = new multi_values();
        $obj->get_acc_class_in_combo();
    }

    function chosen_acc_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $acc_type = new multi_values();
                return $acc_type->get_chosen_account_acc_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_acc_class_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $acc_class = new multi_values();
                return $acc_class->get_chosen_account_acc_class($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
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
    