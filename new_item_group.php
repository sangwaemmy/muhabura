<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_item_group'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_group') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $item_group_id = $_SESSION['id_upd'];
                $name = $_POST['txt_name'];
                $is_full_exempt = $_POST['txt_is_full_exempt'];
                $upd_obj->update_item_group($name, $is_full_exempt, $item_group_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $name = $_POST['txt_name'];
            $is_full_exempt = $_POST['txt_is_full_exempt'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_item_group($name, $is_full_exempt);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            item_group</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>   <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_item_group.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->


            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                item_group saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  item group</div>
                <table class="new_data_table">
                    <tr><td><label for="txt_tuple">Name </label></td><td> <input type="text"     name="txt_name" required id="txt_name" class="textbox" value="<?php echo trim(chosen_name_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Full exempt </label></td><td> <input type="text"     name="txt_is_full_exempt" required id="txt_is_full_exempt" class="textbox" value="<?php echo trim(chosen_is_full_exempt_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_item_group" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">item_group List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_item_group();
                    $obj->list_item_group($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="item_group" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_item_group.php" method="post">
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

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_group') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_item_group_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_full_exempt_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item_group') {
                $id = $_SESSION['id_upd'];
                $is_full_exempt = new multi_values();
                return $is_full_exempt->get_chosen_item_group_is_full_exempt($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    