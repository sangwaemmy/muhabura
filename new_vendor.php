<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_vendor'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $vendor_id = $_SESSION['id_upd'];
                $venndor_number = $_POST['txt_venndor_number'];
                $payment_term = $_POST['txt_payment_term_id'];
                $tax_group = $_POST['txt_tax_group_id'];
                $purchase_acc = $_POST['txt_purchase_acc'];
                $pur_discount_accid = $_POST['txt_pur_discount_accid'];
                $primary_contact = $_POST['txt_primary_contact'];
                $acc_payble = $_POST['txt_acc_payble'];
                $upd_obj->update_vendor($venndor_number, $party, $payment_term, $tax_group, $purchase_acc, $pur_discount_accid, $primary_contact, $acc_payble, $vendor_id);
                unset($_SESSION['table_to_update']);
            } if ($_SESSION['table_to_update'] == 'party') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $party_id = $_SESSION['id_upd'];
                $party_type = 'customer';
                $name = $_POST['txt_name'];
                $email = $_POST['txt_email'];
                $website = $_POST['txt_website'];
                $phone = $_POST['txt_phone'];
                $is_active = 'yes';
                $upd_obj->update_party($party_type, $name, $email, $website, $phone, $is_active, $party_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            //new party
            $party_type = 'supplier';
            $name = $_POST['txt_name'];
            $email = $_POST['txt_email'];
            $website = $_POST['txt_website'];
            $phone = $_POST['txt_phone'];
            $is_active = 'yes';
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_party($party_type, $name, $email, $website, $phone, $is_active);
            $m = new multi_values();
            $last_party = $m->get_last_party();

            //new supplier
            $venndor_number = $_POST['txt_venndor_number'];

//        $payment_term = trim($_POST['txt_payment_term_id']);
//        $tax_group = trim($_POST['txt_tax_group_id']);
//        $purchase_acc = $_POST['txt_purchase_acc'];
            $pur_discount_accid = $_POST['txt_pur_discount_accid'];
            $primary_contact = $_POST['txt_primary_contact'];
            $acc_payble = $_POST['txt_acc_payable_id'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_vendor($venndor_number, $last_party, 0, 0, 0, 9, $primary_contact, $acc_payble);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            vendor</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_vendor.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_party_id"   name="txt_party_id"/>
            <input type="hidden" id="txt_payment_term_id"   name="txt_payment_term_id"/>
            <input type="hidden" id="txt_tax_group_id"   name="txt_tax_group_id"/>
            <input type="hidden" style="float: right; " id="txt_acc_payable_id"   name="txt_acc_payable_id"/>
            <?php
                include 'admin_header.php';
            ?>
            <div class="parts eighty_centered no_paddin_shade_no_Border  ">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Add new Supplier </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                vendor saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title ">  Add more suppliers</div>
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
                <table class="new_data_table">
                    <?php require_once './new_party.php'; ?>
                    <tr class="off"><td><label for="txt_tuple">Tax Code </label></td><td> <input type="text"     name="txt_venndor_number"  id="txt_venndor_number" class="textbox" value="<?php echo trim(chosen_venndor_number_upd()); ?>"   />  </td></tr>
                    <tr class="off"><td><label for="txt_tuple">Purchase Account </label></td><td> <input type="text"     name="txt_purchase_acc"  id="txt_purchase_acc" class="textbox" value="<?php echo trim(chosen_purchase_acc_upd()); ?>"   />  </td></tr>
                    <tr class="off"><td><label for="txt_tuple">Purchase disccount Account </label></td><td> <input type="text"     name="txt_pur_discount_accid"  id="txt_pur_discount_accid" class="textbox" value="<?php echo trim(chosen_pur_discount_accid_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Primary Contact  </label></td><td> <input type="text" autocomplete="off"    name="txt_primary_contact" required id="txt_primary_contact" class="textbox" value="<?php echo trim(chosen_primary_contact_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Account Payable </td><td> <?php get_acc_payable_combo(); ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_vendor" value="Save"/>  </td></tr>
                </table>
            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder  no_bg new_data_title">Suppliers List</div>
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
                    $first = $obj->get_first_vendor();
                    $obj->list_vendor($first);
                ?>
            </div>  
        </form>
        <div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="vendor" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_vendor.php"target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td></table>
        </div>

        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>    <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
    </body>
</hmtl>
<?php

    function get_acc_payable_combo() {
        $obj = new multi_values();
        $obj->get_acc_payable_in_combo();
    }

    function get_party_combo() {
        $obj = new multi_values();
        $obj->get_party_in_combo();
    }

    function get_payment_term_combo() {
        $obj = new multi_values();
        $obj->get_payment_term_in_combo();
    }

    function get_tax_group_combo() {
        $obj = new multi_values();
        $obj->get_tax_group_in_combo();
    }

    function chosen_venndor_number_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $venndor_number = new multi_values();
                return $venndor_number->get_chosen_vendor_venndor_number($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_party_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $party = new multi_values();
                return $party->get_chosen_vendor_party($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_payment_term_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $payment_term = new multi_values();
                return $payment_term->get_chosen_vendor_payment_term($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_tax_group_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $tax_group = new multi_values();
                return $tax_group->get_chosen_vendor_tax_group($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_purchase_acc_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $purchase_acc = new multi_values();
                return $purchase_acc->get_chosen_vendor_purchase_acc($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_pur_discount_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $pur_discount_accid = new multi_values();
                return $pur_discount_accid->get_chosen_vendor_pur_discount_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_primary_contact_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $primary_contact = new multi_values();
                return $primary_contact->get_chosen_vendor_primary_contact($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_acc_payble_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vendor') {
                $id = $_SESSION['id_upd'];
                $acc_payble = new multi_values();
                return $acc_payble->get_chosen_vendor_acc_payble($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    