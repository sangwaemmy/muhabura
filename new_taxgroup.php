<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_taxgroup'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'taxgroup') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $taxgroup_id = $_SESSION['id_upd'];

                $description = $_POST['txt_description'];
                $tax_applied = $_POST['txt_tax_applied'];
                $is_active = $_POST['txt_is_active'];
                $upd_obj->update_taxgroup($description, $tax_applied, $is_active, $taxgroup_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $description = $_POST['txt_description'];
            $tax_applied = 0; //$_POST['txt_tax_applied'];
            $is_active = 'yes'; //$_POST['txt_is_active'];
            $pur_sale = $_POST['pur_sale'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_taxgroup($description, $tax_applied, $is_active, $pur_sale);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            taxgroup</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_taxgroup.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add more taxes </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                taxgroup saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  Tax registration</div>
                <table class="new_data_table">
                    <tr><td><label for="txt_tuple">Description </label></td><td> <input type="text"     name="txt_description" required id="txt_description" class="textbox" value="<?php echo trim(chosen_description_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Type </label></td><td>
                            <input type="radio" id="pur" value="purchase" name="pur_sale" /> <label for="pur">Purchase</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio"id="sale"  value="sale" name="pur_sale" /> <label for="sale">sale</label> 

                    <tr class="off"><td><label for="txt_tuple">Tax Applied </label></td><td> <input type="text"     name="txt_tax_applied"  id="txt_tax_applied" class="textbox" value="<?php echo trim(chosen_tax_applied_upd()); ?>"   />  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_taxgroup" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">tax   </div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_taxgroup();
                    $obj->list_tax
//                    $obj->list_taxgroup($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="taxgroup" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_taxgroup.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>    <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>


        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function chosen_description_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'taxgroup') {
                $id = $_SESSION['id_upd'];
                $description = new multi_values();
                return $description->get_chosen_taxgroup_description($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_tax_applied_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'taxgroup') {
                $id = $_SESSION['id_upd'];
                $tax_applied = new multi_values();
                return $tax_applied->get_chosen_taxgroup_tax_applied($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_active_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'taxgroup') {
                $id = $_SESSION['id_upd'];
                $is_active = new multi_values();
                return $is_active->get_chosen_taxgroup_is_active($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    