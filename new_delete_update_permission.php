<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_delete_update_permission'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'delete_update_permission') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $delete_update_permission_id = $_SESSION['id_upd'];
                $user = trim($_POST['txt_user_id']);
                $permission = $_POST['txt_permission_id'];
                $upd_obj->update_delete_update_permission($user, $permission, $delete_update_permission_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $user = trim($_POST['txt_user_id']);
            $permission = trim($_POST['txt_permission_id']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_delete_update_permission($user, $permission);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            delete_update_permission</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_delete_update_permission.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_user_id"   name="txt_user_id"/><input type="hidden" id="txt_permission_id"   name="txt_permission_id"/>
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
            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                delete_update_permission saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  delete_update_permission Registration </div>
                <table class="new_data_table">
                    <tr><td class="new_data_tb_frst_cols">User </td><td> <?php get_user_combo(); ?>  </td></tr> <tr><td class="new_data_tb_frst_cols">Permission </td><td> <?php get_permission_combo(); ?>  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_delete_update_permission" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts no_paddin_shade_no_Border export_box  eighty_centered heit_free">
                <form action="../web_exports/delete_update_permission.php" method="post">
                    <input type="hidden" name="delete_update_permission" value="a"/>
                    <input type="submit" name="delete_update_permission" class="exprt_btn  exprt_btn_delete_update_permission" value="Export to Excel"/>
                </form>
            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">delete_update_permission List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_delete_update_permission();
                    $obj->list_delete_update_permission($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_user_combo() {
        $obj = new multi_values();
        $obj->get_user_in_combo();
    }

    function chosen_user_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'delete_update_permission') {
                $id = $_SESSION['id_upd'];
                $user = new multi_values();
                return $user->get_chosen_delete_update_permission_user($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_permission_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'delete_update_permission') {
                $id = $_SESSION['id_upd'];
                $permission = new multi_values();
                return $permission->get_chosen_delete_update_permission_permission($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    