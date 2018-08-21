<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_vat_calculation'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vat_calculation') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $vat_calculation_id = $_SESSION['id_upd'];

                $purid_saleid = $_POST['txt_purid_saleid'];
                $vat_amount = $_POST['txt_vat_amount'];
                $entry_date = date("y-m-d");

                $User = $_SESSION['userid'];

                $vatid = $_POST['txt_vatid_id'];



                $upd_obj->update_vat_calculation($purid_saleid, $vat_amount, $entry_date, $User, $vatid, $vat_calculation_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $purid_saleid = $_POST['txt_purid_saleid'];
            $vat_amount = $_POST['txt_vat_amount'];
            $entry_date = date("y-m-d");
            $User = $_SESSION['userid'];
            $vatid = trim($_POST['txt_vatid_id']);

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_vat_calculation($purid_saleid, $vat_amount, $entry_date, $User, $vatid);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            vat_calculation
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> 
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_vat_calculation.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_vatid_id"   name="txt_vatid_id"/>
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
            <!--End dialog-->

            <div class="parts eighty_centered off saved_dialog">
                vat_calculation saved successfully!</div>




            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">vat calculation List</div>
                <?php
                    $obj = new multi_values();
                    $obj->list_vat_calculation();
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_vatid_combo() {
        $obj = new other_fx();
        $obj->get_vatid_in_combo();
    }

    function chosen_purid_saleid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vat_calculation') {
                $id = $_SESSION['id_upd'];
                $purid_saleid = new multi_values();
                return $purid_saleid->get_chosen_vat_calculation_purid_saleid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_vat_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vat_calculation') {
                $id = $_SESSION['id_upd'];
                $vat_amount = new multi_values();
                return $vat_amount->get_chosen_vat_calculation_vat_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vat_calculation') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_vat_calculation_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_User_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vat_calculation') {
                $id = $_SESSION['id_upd'];
                $User = new multi_values();
                return $User->get_chosen_vat_calculation_User($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_vatid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'vat_calculation') {
                $id = $_SESSION['id_upd'];
                $vatid = new multi_values();
                return $vatid->get_chosen_vat_calculation_vatid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    