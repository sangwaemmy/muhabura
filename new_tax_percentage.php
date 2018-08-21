<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_tax_percentage'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_percentage') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $tax_percentage_id = $_SESSION['id_upd'];

                $pur_sale = $_POST['txt_pur_sale'];
                $percentage = $_POST['txt_percentage'];
                $purid_saleid = $_POST['txt_purid_saleid'];


                $upd_obj->update_tax_percentage($pur_sale, $percentage, $purid_saleid, $tax_percentage_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $pur_sale = $_POST['txt_pur_sale'];
            $percentage = $_POST['txt_percentage'];
            $purid_saleid = $_POST['txt_purid_saleid'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_tax_percentage($pur_sale, $percentage, $purid_saleid);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            tax_percentage</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    <body>
        <form action="new_tax_percentage.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->


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
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                tax_percentage saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title xx_titles no_paddin_shade_no_Border">  tax percentage Registration </div>
                <table class="new_data_table">
                    <tr><td><label for="txt_pur_sale">Purchase or Sale </label></td><td> <input type="text"     name="txt_pur_sale" required id="txt_pur_sale" class="textbox" value="<?php echo trim(chosen_pur_sale_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_percentage">Percentage </label></td><td> <input type="text"     name="txt_percentage" required id="txt_percentage" class="textbox" value="<?php echo trim(chosen_percentage_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_purid_saleid">Purchaseid Sale id </label></td><td> <input type="text"     name="txt_purid_saleid" required id="txt_purid_saleid" class="textbox" value="<?php echo trim(chosen_purid_saleid_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_tax_percentage" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <?php
                    $m = new other_fx();
                    $start_date = $m->get_this_year_start_date();
                    $end_date = $m->get_this_year_end_date();
                ?>
                <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border">
                    <table>
                        <tr class="xx_titles"><td colspan="2">Income tax on purcahses and sales of Fiscal year <?php echo '<b>' . $start_date . ' - ' . $end_date . '</b>' ?></td></tr>
                        <tr>
                            <td>Total tax on Purchases <?php echo $m->get_total_tax_on_pur_sale_by_date($start_date, $end_date, 'purchase'); ?></td></tr>
                        <tr>   <td>Total tax on Sales <?php echo $m->get_total_tax_on_pur_sale_by_date($start_date, $end_date, 'sale'); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="parts no_shade_noBorder xx_titles no_paddin_shade_no_Border no_bg whilte_text dataList_title ">tax percentage List</div>
                <?php
                    $obj = new other_fx();
                    $first = $obj->get_first_tax_percentage();
                    $obj->list_tax_percentage($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>    <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>


        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function chosen_pur_sale_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_percentage') {
                $id = $_SESSION['id_upd'];
                $pur_sale = new multi_values();
                return $pur_sale->get_chosen_tax_percentage_pur_sale($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_percentage_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_percentage') {
                $id = $_SESSION['id_upd'];
                $percentage = new multi_values();
                return $percentage->get_chosen_tax_percentage_percentage($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_purid_saleid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_percentage') {
                $id = $_SESSION['id_upd'];
                $purid_saleid = new multi_values();
                return $purid_saleid->get_chosen_tax_percentage_purid_saleid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    