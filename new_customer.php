<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_customer'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'party') {
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
            if ($_SESSION['table_to_update'] == 'customer') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $customer_id = $_SESSION['id_upd'];
                $party_id = trim($_POST['txt_party_id_id']);
                $contact = $_POST['txt_contact_id'];
                $number = $_POST['txt_number'];
                $tax_group = $_POST['txt_tax_group_id'];
                $payment_term = $_POST['txt_payment_term_id'];
                $sales_accid = $_POST['txt_sales_accid_id'];
                $acc_rec_accid = $_POST['txt_acc_rec_accid_id'];
                $promp_pyt_disc_accid = $_POST['txt_promp_pyt_disc_accid'];
                $upd_obj->update_customer($party_id, $contact, $number, $tax_group, $payment_term, $sales_accid, $acc_rec_accid, $promp_pyt_disc_accid, $customer_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            //new party
            $party_type = 'customer';
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
            //new customer
//        $contact = trim($_POST['txt_contact_id']);
            $number = $_POST['txt_number'];
//        $tax_group = trim($_POST['txt_tax_group_id']);
//        $payment_term = trim($_POST['txt_payment_term_id']);
//        $sales_accid = trim($_POST['txt_sales_accid_id']);
            $acc_rec_accid = ($acc_rec_accid != 0) ? trim($_POST['txt_acc_rec_accid_id']) : 0;
            $promp_pyt_disc_accid = $_POST['txt_promp_pyt_disc_accid'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_customer($last_party, 0, $number, 0, 0, 0, $acc_rec_accid, $promp_pyt_disc_accid);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            customer</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_customer.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_party_id_id"   name="txt_party_id_id"/>
            <input type="hidden" id="txt_contact_id"   name="txt_contact_id"/>
            <input type="hidden" id="txt_tax_group_id"   name="txt_tax_group_id"/>
            <input type="hidden" id="txt_payment_term_id"   name="txt_payment_term_id"/>
            <input type="hidden" id="txt_sales_accid_id"   name="txt_sales_accid_id"/>
            <input type="hidden" style="float: right;" id="txt_acc_rec_accid_id"   name="txt_acc_rec_accid_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Add new Client </div> 
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                customer saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title <?php echo without_admin(); ?>">  customer Registration</div>
                <table class="new_data_table">
                    <?php require_once './new_party.php'; ?>
                    <tr class="off"><td>Contact </td><td> <?php get_contact_combo(); ?>  </td></tr>
                    <tr class="off"><td><label for="txt_tuple">Number </label></td><td> 
                            <input type="text"     name="txt_number"  id="txt_number" class="textbox" value="<?php echo trim(chosen_number_upd()); ?>"   />  </td></tr>
                    <tr class="off"><td>Tax Group </td><td> <?php get_tax_group_combo(); ?>  </td></tr> 
                    <tr class="off"><td>Payment Term </td><td> <?php get_payment_term_combo(); ?>  </td></tr> 
                    <tr class="off"><td>Sales Account </td><td> <?php get_sales_accid_combo(); ?>  </td></tr> 
                    <tr><td>Account Receivable Acc </td><td> <?php get_acc_rec_accid_combo(); ?>  </td></tr>
                    <tr class="off"><td><label for="txt_tuple">Prompt payment Disctount  </label></td><td> <input type="text"     name="txt_promp_pyt_disc_accid"  id="txt_promp_pyt_disc_accid" class="textbox" value="<?php echo trim(chosen_promp_pyt_disc_accid_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_customer" value="Save"/>  </td></tr>
                </table>
            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">Our customers </div>
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
                    $first = $obj->get_first_customer();
                    $obj->list_customer($first);
                ?>
            </div>  
        </form> 
        <div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="customer" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_customer.php"target="blank" method="post">
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

    function get_party_id_combo() {
        $obj = new multi_values();
        $obj->get_party_id_in_combo();
    }

    function get_contact_combo() {
        $obj = new multi_values();
        $obj->get_contact_in_combo();
    }

    function get_tax_group_combo() {
        $obj = new multi_values();
        $obj->get_tax_group_in_combo();
    }

    function get_payment_term_combo() {
        $obj = new multi_values();
        $obj->get_payment_term_in_combo();
    }

    function get_sales_accid_combo() {
        $obj = new multi_values();
        $obj->get_sales_accid_in_combo();
    }

    function get_acc_rec_accid_combo() {
        $obj = new multi_values();
        $obj->get_acc_rec_accid_in_combo();
    }

    function chosen_party_id_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $party_id = new multi_values();
                return $party_id->get_chosen_customer_party_id($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_contact_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $contact = new multi_values();
                return $contact->get_chosen_customer_contact($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_number_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $number = new multi_values();
                return $number->get_chosen_customer_number($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_tax_group_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $tax_group = new multi_values();
                return $tax_group->get_chosen_customer_tax_group($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_payment_term_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $payment_term = new multi_values();
                return $payment_term->get_chosen_customer_payment_term($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sales_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $sales_accid = new multi_values();
                return $sales_accid->get_chosen_customer_sales_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_acc_rec_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $acc_rec_accid = new multi_values();
                return $acc_rec_accid->get_chosen_customer_acc_rec_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_promp_pyt_disc_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'customer') {
                $id = $_SESSION['id_upd'];
                $promp_pyt_disc_accid = new multi_values();
                return $promp_pyt_disc_accid->get_chosen_customer_promp_pyt_disc_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    