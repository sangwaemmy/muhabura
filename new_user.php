<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_user'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $user_id = $_SESSION['id_upd'];
                $LastName = $_POST['txt_LastName'];
                $FirstName = $_POST['txt_FirstName'];
                $UserName = $_POST['txt_UserName'];
                $EmailAddress = $_POST['txt_EmailAddress'];
                $Roleid = $_POST['txt_Roleid'];
                $IsActive = 'yes';
                $Password = $_POST['txt_Password'];
                $position_depart = $_POST['txt_position_depart_id'];
                $upd_obj->update_user($LastName, $FirstName, $UserName, $EmailAddress, $IsActive, $Password, $Roleid, $position_depart, $user_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $LastName = $_POST['txt_LastName'];
            $FirstName = $_POST['txt_FirstName'];
            $UserName = $_POST['txt_UserName'];
            $EmailAddress = $_POST['txt_EmailAddress'];
            $IsActive = 'yes';
            $Password = $_POST['txt_Password'];
            $Roleid = trim($_POST['txt_Roleid_id']);
            $position_depart = trim($_POST['txt_position_depart_id']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_user($LastName, $FirstName, $UserName, $EmailAddress, $Roleid, $IsActive, $Password, $position_depart);
            if (filter_has_var(INPUT_POST, 'chk_delete_update')) {
                $m = new multi_values();
                $last_user = $m->get_last_user();
                $obj->new_delete_update_permission($last_user, 'delete');
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            user</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> 
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->   
        <form action="new_user.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_position_depart_id"   name="txt_position_depart_id"/>
            <input type="hidden" style="float: right;" id="txt_Roleid_id"   name="txt_Roleid_id"/>
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
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add User </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                user saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Add more users in the system </div>
                <table class="new_data_table">
                    <tr><td><label for="txt_"LastName>Last Name </label></td><td> <input type="text"     name="txt_LastName" required id="txt_LastName" class="textbox" value="<?php echo trim(chosen_LastName_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"FirstName>First Name </label></td><td> <input type="text"     name="txt_FirstName" required id="txt_FirstName" class="textbox" value="<?php echo trim(chosen_FirstName_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"UserName>Username </label></td><td> <input type="text"     name="txt_UserName" required id="txt_UserName" class="textbox" value="<?php echo trim(chosen_UserName_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"Password>Password </label></td><td> <input type="text"     name="txt_Password" required id="txt_Password" class="textbox" value="<?php echo trim(chosen_Password_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"EmailAddress>Email </label></td><td> <input type="text"     name="txt_EmailAddress" required id="txt_EmailAddress" class="textbox" value="<?php echo trim(chosen_EmailAddress_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Department </td><td> <?php get_position_depart_combo(); ?>  </td></tr>
                    <tr class="off"><td><label for="txt_"IsActive>IsActive </label></td><td> <input type="checkbox" name="txt_IsActive"   id="txt_IsActive"  value="isactive" />        </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Role in the system </td><td> <?php get_Roleid_combo(); ?>  </td></tr> 
                    <?php if ($_SESSION['cat'] == 'admin') { ?>
                            <tr>
                                <td colspan="2" class="no_paddin_shade_no_Border">
                                    <a href="#" style="color: #3300ff;" class="push_right dele_upd_link">  More user settings  </a><br><br/>
                                    <span class="push_right off hide_delete_update">
                                        <label for="chk_delete_update">Allow user to delete</label>    
                                        <input type="checkbox" id="chk_delete_update" name="chk_delete_update" />
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    <tr><td colspan="2"> 
                            <input type="submit" class="confirm_buttons" name="send_user" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">user List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_user();
                    $obj->list_user($first);
                ?>
            </div>  
        </form>  
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="user" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_user.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script> <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_position_depart_combo() {
        $obj = new multi_values();
        $obj->get_position_depart_in_combo();
    }

    function get_Roleid_combo() {
        $obj = new multi_values();
        $obj->get_Roleid_in_combo();
    }

    function chosen_LastName_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $LastName = new multi_values();
                return $LastName->get_chosen_user_LastName($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_FirstName_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $FirstName = new multi_values();
                return $FirstName->get_chosen_user_FirstName($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_UserName_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $UserName = new multi_values();
                return $UserName->get_chosen_user_UserName($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_EmailAddress_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $EmailAddress = new multi_values();
                return $EmailAddress->get_chosen_user_EmailAddress($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_Roleid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $Roleid = new multi_values();
                return $Roleid->get_chosen_user_Roleid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_IsActive_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $IsActive = new multi_values();
                return $IsActive->get_chosen_user_IsActive($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_Password_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'user') {
                $id = $_SESSION['id_upd'];
                $Password = new multi_values();
                return $Password->get_chosen_user_Password($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    