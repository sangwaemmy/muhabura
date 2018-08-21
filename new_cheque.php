<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_cheque'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $cheque_id = $_SESSION['id_upd'];

                $bank = $_POST['txt_bank'];
                $address = $_POST['txt_address'];
                $expense_items = $_POST['txt_expense_items'];
                $account = $_POST['txt_account_id'];

                $amount = $_POST['txt_amount'];
                $memo = $_POST['txt_memo'];
                $party = $_POST['txt_party_id'];



                $upd_obj->update_cheque($bank, $address, $expense_items, $account, $amount, $memo, $party, $cheque_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $bank = $_POST['txt_bank'];
            $address = $_POST['txt_address'];
            $expense_items = ''; //$_POST['txt_expense_items'];
            $account = trim($_POST['txt_account_id']);
            $amount = $_POST['txt_amount'];
            $memo = $_POST['txt_memo'];
            $party = trim($_POST['txt_party_id']);

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_cheque($bank, $address, $expense_items, $account, $amount, $memo, $party);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            cheque</title>
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
    </head>
    <body>
        <form action="new_cheque.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_account_id"   name="txt_account_id"/>
            <input type="hidden" id="txt_party_id"   name="txt_party_id"/>
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
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Write a cheque </div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                cheque saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  cheque Registration </div>
                <table class="new_data_table">


                    <tr><td><label for="txt_bank">Bank </label></td><td>
                            <?php get_bank_combo(); ?>
                        </td></tr>

                    <tr><td><label for="txt_address">Address </label></td><td> <input type="text"     name="txt_address" required id="txt_address" class="textbox" value="<?php echo trim(chosen_address_upd()); ?>"   />  </td></tr>
                    <tr class="off"><td><label for="txt_expense_items">Expense or Items </label></td><td> <input type="text"     name="txt_expense_items"  id="txt_expense_items" class="textbox" value="<?php echo trim(chosen_expense_items_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Account </td><td> <?php get_account_combo(); ?>  </td></tr><tr><td><label for="txt_amount">Amount </label></td><td> <input type="text"     name="txt_amount" required id="txt_amount" class="textbox" value="<?php echo trim(chosen_amount_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_memo">Memo </label></td><td> <input type="text"     name="txt_memo" required id="txt_memo" class="textbox" value="<?php echo trim(chosen_memo_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Customer </td><td> <?php get_client_combo(); ?>  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_cheque" value="Save"/>  </td></tr>
                </table>
            </div>


            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">cheque List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_cheque();
                    $obj->list_cheque($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_bank_combo() {
        $obj = new multi_values();
        $obj->get_bank_in_combo();
    }

    function get_client_combo() {
        $obj = new multi_values();
        $obj->get_client_in_combo();
    }

    function get_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo_enabled();
    }

    function chosen_bank_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $bank = new multi_values();
                return $bank->get_chosen_cheque_bank($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_address_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $address = new multi_values();
                return $address->get_chosen_cheque_address($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_expense_items_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $expense_items = new multi_values();
                return $expense_items->get_chosen_cheque_expense_items($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $account = new multi_values();
                return $account->get_chosen_cheque_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_cheque_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_memo_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $memo = new multi_values();
                return $memo->get_chosen_cheque_memo($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_party_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'cheque') {
                $id = $_SESSION['id_upd'];
                $party = new multi_values();
                return $party->get_chosen_cheque_party($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    