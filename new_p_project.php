<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_project'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_project_id = $_SESSION['id_upd'];
                $name = $_POST['txt_name'];
                $last_update_date = date('y-m-d');
                $project_contract_no = $_POST['txt_project_contract_no'];
                $project_spervisor = $_POST['txt_project_spervisor'];
                $budget = $_POST['txt_budget_id'];

                $prohect_sector = $_POST['txt_prohect_sector'];
                $account = $_SESSION['userid'];
                $entry_date = date('y-m-d');
                $active = 'active';
                $status = 'active';
                $field = $_POST['txt_field_id'];
                $upd_obj->update_p_project($name, $last_update_date, $project_contract_no, $project_spervisor, $budget, $prohect_sector, $account, $entry_date, $active, $status, $p_project_id, $field);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $name = $_POST['txt_name'];
            $last_update_date = date('y-m-d');
            $project_contract_no = $_POST['txt_project_contract_no'];
            $project_spervisor = $_POST['txt_project_spervisor'];
            $budget = trim($_POST['txt_budget_id']);
            $type_project = trim($_POST['txt_type_project_id']);
            if (empty($type_project)) {
                ?><script>alert('You have to choose the project type ');</script><?php
            } else {
                $account = $_SESSION['userid'];
                $entry_date = date('y-m-d');
                $active = 'active';
                $status = 'active';
                $field = $_POST['txt_field_id'];
                require_once '../web_db/new_values.php';
                $obj = new new_values();
                $obj->new_p_project($name, $last_update_date, $project_contract_no, $project_spervisor, $account, $entry_date, $active, $status, $type_project, $field);
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_project
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> 
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_p_project.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <input type="hidden" id="txt_budget_id"   name="txt_budget_id"/>
            <input type="hidden" id="txt_account_id"   name="txt_account_id"/>
            <input type="hidden" id="txt_field_id"   name="txt_field_id"/>
            <input type="hidden" id="txt_type_project_id"   name="txt_type_project_id"/>
            <?php
                include 'admin_header.php';
            ?>
            <div class="parts abs_full" style="position: fixed; top: 0px; left: 0px; width: 100%;height: 100%;">
                df
            </div>

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
                <div class="parts  no_paddin_shade_no_Border new_data_hider link_cursor"> Hide </div> 
            </div>
            <div class="parts eighty_centered off saved_dialog">
                p_project saved successfully!</div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title no_shade_noBorder">  add more project Registration </div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_budget();
//                $obj->list_p_type_project_selectable($first);
                ?>
                <table class="new_data_table ">
                    <tr>
                        <td>Project type</td><td><?php get_type_project_combo(); ?></td>
                    </tr>
                    <tr><td><label for="txt_"name>Name </label></td><td> <input type="text"     name="txt_name" required id="txt_name" class="textbox" value="<?php echo trim(chosen_name_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"project_contract_no>Project Contract Number </label></td><td> <input type="text"     name="txt_project_contract_no"  id="txt_project_contract_no" class="textbox" value="<?php echo trim(chosen_project_contract_no_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"project_spervisor>Project Supervisor </label></td><td> <input type="text"     name="txt_project_spervisor" required id="txt_project_spervisor" class="textbox" value="<?php echo trim(chosen_project_spervisor_upd()); ?>"   />  </td></tr>
                    <tr class="off"><td class="new_data_tb_frst_cols">Budget </td><td> 
                            <?php get_budget_combo(); ?>  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Filed </td><td> <?php get_field_combo(); ?>  </td></tr> <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_project" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">all Projects </div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_project();
                    $obj->list_p_project($first);
                ?>
            </div>  
            <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
                <?php require_once './navigation/add_nav.php'; ?>
            </div>
        </form>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
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
                <input type="hidden" name="p_project" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_p_project.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>
<?php

    function get_field_combo() {
        $obj = new multi_values();
        $obj->get_field_in_combo();
    }

    function get_type_project_combo() {
        $obj = new multi_values();
        $obj->get_type_project_in_combo();
    }

    function get_budget_combo() {
        $obj = new multi_values();
        $obj->get_budget_in_combo();
    }

    function get_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_p_project_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_last_update_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $last_update_date = new multi_values();
                return $last_update_date->get_chosen_p_project_last_update_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_project_contract_no_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $project_contract_no = new multi_values();
                return $project_contract_no->get_chosen_p_project_project_contract_no($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_project_spervisor_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $project_spervisor = new multi_values();
                return $project_spervisor->get_chosen_p_project_project_spervisor($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_budget_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $budget = new multi_values();
                return $budget->get_chosen_p_project_budget($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_prohect_sector_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $prohect_sector = new multi_values();
                return $prohect_sector->get_chosen_p_project_prohect_sector($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $account = new multi_values();
                return $account->get_chosen_p_project_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_p_project_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_active_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $active = new multi_values();
                return $active->get_chosen_p_project_active($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_status_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_project') {
                $id = $_SESSION['id_upd'];
                $status = new multi_values();
                return $status->get_chosen_p_project_status($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    