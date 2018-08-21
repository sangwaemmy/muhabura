<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_journal_entry_header'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $journal_entry_header_id = $_SESSION['id_upd'];

                $party = trim($_POST['txt_party_id']);
                $voucher_type = $_POST['txt_voucher_type'];
                $date = $_POST['txt_date'];
                $memo = $_POST['txt_memo'];
                $reference_number = $_POST['txt_reference_number'];
                $posted = $_POST['txt_posted'];


                $upd_obj->update_journal_entry_header($party, $voucher_type, $date, $memo, $reference_number, $posted, $journal_entry_header_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $party = trim($_POST['txt_party_id']);
            $voucher_type = $_POST['txt_voucher_type'];
            $date = $_POST['txt_date'];
            $memo = $_POST['txt_memo'];
            $reference_number = $_POST['txt_reference_number'];
            $posted = $_POST['txt_posted'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_journal_entry_header($party, $voucher_type, $date, $memo, $reference_number, $posted);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            journal_entry_header</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_journal_entry_header.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_party_id"   name="txt_party_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                journal_entry_header saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  journalentryheader</div>
                <table class="new_data_table">


                    <tr><td>Party </td><td> <?php get_party_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Voucher Type </label></td><td> <input type="text"     name="txt_voucher_type" required id="txt_voucher_type" class="textbox" value="<?php echo trim(chosen_voucher_type_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Date </label></td><td> <input type="text"     name="txt_date" required id="txt_date" class="textbox" value="<?php echo trim(chosen_date_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Memo </label></td><td> <input type="text"     name="txt_memo" required id="txt_memo" class="textbox" value="<?php echo trim(chosen_memo_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Reference Number </label></td><td> <input type="text"     name="txt_reference_number" required id="txt_reference_number" class="textbox" value="<?php echo trim(chosen_reference_number_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Posted </label></td><td> <input type="text"     name="txt_posted" required id="txt_posted" class="textbox" value="<?php echo trim(chosen_posted_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_journal_entry_header" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">journal entry header List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_journal_entry_header();
                    $obj->list_journal_entry_header($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="journal_entry_header" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_journal_entry_header.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>   <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_party_combo() {
        $obj = new multi_values();
        $obj->get_party_in_combo();
    }

    function chosen_party_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                $id = $_SESSION['id_upd'];
                $party = new multi_values();
                return $party->get_chosen_journal_entry_header_party($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_voucher_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                $id = $_SESSION['id_upd'];
                $voucher_type = new multi_values();
                return $voucher_type->get_chosen_journal_entry_header_voucher_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                $id = $_SESSION['id_upd'];
                $date = new multi_values();
                return $date->get_chosen_journal_entry_header_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_memo_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                $id = $_SESSION['id_upd'];
                $memo = new multi_values();
                return $memo->get_chosen_journal_entry_header_memo($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_reference_number_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                $id = $_SESSION['id_upd'];
                $reference_number = new multi_values();
                return $reference_number->get_chosen_journal_entry_header_reference_number($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_posted_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'journal_entry_header') {
                $id = $_SESSION['id_upd'];
                $posted = new multi_values();
                return $posted->get_chosen_journal_entry_header_posted($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    