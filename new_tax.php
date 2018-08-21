<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_tax'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $tax_id = $_SESSION['id_upd'];
                $sales_accid = trim($_POST['txt_sales_accid_id']);
                $purchase_accid = $_POST['txt_purchase_accid_id'];
                $tax_name = $_POST['txt_tax_name'];
                $upd_obj->update_tax($sales_accid, $purchase_accid, $tax_name, $tax_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $sales_accid = trim($_POST['txt_sales_accid_id']);
            $purchase_accid = trim($_POST['txt_purchase_accid_id']);
            $tax_name = $_POST['txt_tax_name'];
            $entry_date = date("y-m-d");
            $User = $_SESSION['userid'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_tax($sales_accid, $purchase_accid, $tax_name, $entry_date, $user);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            tax</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_tax.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_sales_accid_id"   name="txt_sales_accid_id"/><input type="hidden" id="txt_purchase_accid_id"   name="txt_purchase_accid_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                tax saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  tax</div>
                <table class="new_data_table">
                    <tr><td>Sales Account  </td><td> <?php get_sales_accid_combo(); ?>  </td></tr> 
                    <tr><td>Purchase Account </td><td> <?php get_purchase_accid_combo(); ?>  </td></tr>
                    <tr><td><label for="txt_tuple">Tax Name </label></td><td> <input type="text"     name="txt_tax_name" required id="txt_tax_name" class="textbox" value="<?php echo trim(chosen_tax_name_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_tax" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">tax List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_tax();
                    $obj->list_tax($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="tax" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_tax.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_sales_accid_combo() {
        $obj = new multi_values();
        $obj->get_sales_accid_in_combo();
    }

    function get_purchase_accid_combo() {
        $obj = new multi_values();
        $obj->get_purchase_accid_in_combo();
    }

    function chosen_sales_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax') {
                $id = $_SESSION['id_upd'];
                $sales_accid = new multi_values();
                return $sales_accid->get_chosen_tax_sales_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_purchase_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax') {
                $id = $_SESSION['id_upd'];
                $purchase_accid = new multi_values();
                return $purchase_accid->get_chosen_tax_purchase_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_tax_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax') {
                $id = $_SESSION['id_upd'];
                $tax_name = new multi_values();
                return $tax_name->get_chosen_tax_tax_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    