<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_province'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_province') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_province_id = $_SESSION['id_upd'];
                $name = $_POST['txt_name'];
                $upd_obj->update_p_province($name, $p_province_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $name = $_POST['txt_name'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_p_province($name);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Locations</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>



        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
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
            <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add new Locations </div>  </div>
        <div class="parts eighty_centered off saved_dialog">
            p_province saved successfully!</div>
        <div class="parts eighty_centered new_data_box off">

            <a href="new_p_district.php"><div class="parts two_fifty_left">
                    district</div></a>
            <a href="new_p_sector.php">  <div class="parts two_fifty_left">
                    sector
                </div></a>

            <form action="new_p_province.php" method="post" enctype="multipart/form-data">
                <div class="parts eighty_centered new_data_title">  Province Registration </div>
                <table class="new_data_table">
                    <tr><td><label for="txt_"name>Name </label></td><td> <input type="text"     name="txt_name" required id="txt_name" class="textbox" value="<?php echo trim(chosen_name_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_province" value="Save"/>  </td></tr>
                </table>
            </form>


        </div>

        <div class="parts eighty_centered datalist_box" >
            <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Locations List</div>
            <?php
                $obj = new multi_values();
                $first = $obj->get_first_p_province();
//                $obj->list_p_province($first);
            ?>
        </div>  

        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
    <table class="margin_free">
        <td>
            <form action="../web_exports/excel_export.php" method="post">
                <input type="hidden" name="p_province" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_p_province.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>
<?php

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_province') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_p_province_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    