<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_users'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_users') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_users_id = $_SESSION['id_upd'];

                $username = $_POST['txt_username'];
                $password = $_POST['txt_password'];
                $position = $_POST['txt_position'];
                $is_active = $_POST['txt_is_active'];
                $role = $_POST['txt_role_id'];
                $upd_obj->update_p_users($username, $password, $position, $is_active, $role, $p_users_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];
            $position = $_POST['txt_position'];
            $is_active = $_POST['txt_is_active'];
            $role = trim($_POST['txt_role_id']);

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_p_users($username, $password, $position, $is_active, $role);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_users</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_p_users.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_role_id"   name="txt_role_id"/>
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
                p_users saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  p_users Registration </div>
                <table class="new_data_table">


                    <tr><td><label for="txt_"username>Username </label></td><td> <input type="text"     name="txt_username" required id="txt_username" class="textbox" value="<?php echo trim(chosen_username_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"password>Password </label></td><td> <input type="text"     name="txt_password" required id="txt_password" class="textbox" value="<?php echo trim(chosen_password_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"position>Position </label></td><td> <input type="text"     name="txt_position" required id="txt_position" class="textbox" value="<?php echo trim(chosen_position_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"is_active>Is Active </label></td><td> <input type="text"     name="txt_is_active" required id="txt_is_active" class="textbox" value="<?php echo trim(chosen_is_active_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Role </td><td> <?php get_role_combo(); ?>  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_users" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">p_users List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_users();
                    $obj->list_p_users($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
    <table class="margin_free">
        <td>
            <form action="../web_exports/excel_export.php" method="post">
                <input type="hidden" name="p_users" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_p_users.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>
<?php

    function get_role_combo() {
        $obj = new multi_values();
        $obj->get_role_in_combo();
    }

    function chosen_username_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_users') {
                $id = $_SESSION['id_upd'];
                $username = new multi_values();
                return $username->get_chosen_p_users_username($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_password_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_users') {
                $id = $_SESSION['id_upd'];
                $password = new multi_values();
                return $password->get_chosen_p_users_password($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_position_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_users') {
                $id = $_SESSION['id_upd'];
                $position = new multi_values();
                return $position->get_chosen_p_users_position($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_active_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_users') {
                $id = $_SESSION['id_upd'];
                $is_active = new multi_values();
                return $is_active->get_chosen_p_users_is_active($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_role_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_users') {
                $id = $_SESSION['id_upd'];
                $role = new multi_values();
                return $role->get_chosen_p_users_role($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    