<?php
    session_start();
    require_once '../web_db/multi_values.php';
    require_once '../web_db/other_fx.php';
    require_once '../web_db/new_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }

    $obj = new new_values();
    $m = new other_fx();
    $found = $m->get_exitst_common_budtline();
    if (empty($found)) {
        $obj->new_p_type_project('common');
    }


    if (isset($_POST['send_p_budget_items'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget_items') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_budget_items_id = $_SESSION['id_upd'];
                $item_name = $_POST['txt_item_name'];
                $description = $_POST['txt_description'];
                $created_by = $_SESSION['userid'];
                $entry_date = date("y-m-d");
                $chart_account = 0; //$_POST['txt_chart_account_id'];
                $upd_obj->update_p_budget_items($item_name, $description, $created_by, $entry_date, $chart_account, $p_budget_items_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            // <editor-fold defaultstate="collapsed" desc="---Add common category">
            //   Because the items (p_budget items) can be found in many budget lines()for example wate can be in agriculture category and construction at the same time), 
            // We have to add a nother category called "Common". the system, initially will check if that budget line exts(common),
            // then if not it will automatically add it. it will not be show on new_p_type_project but it will appear in the p_budget_items page in the
            // combobox
// </editor-fold>


            $item_name = $_POST['txt_item_name'];
            $description = $_POST['txt_description'];
            $created_by = $_SESSION['userid'];
            $entry_date = date("y-m-d h:m:s");
            $chart_account = 0; // trim($_POST['txt_chart_account_id']);
            $type = $_POST['type'];
            ?><script>alert('<?php echo $_POST['type']; ?>');</script><?php
            $obj->new_p_budget_items($item_name, $description, $created_by, $entry_date, $chart_account, $type);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_budget_items</title>
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
        <form action="new_p_budget_items.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_chart_account_id"   name="txt_chart_account_id"/>
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

            <!--Start of opening Pane(The pane that allow the user to add the data in a different table without leaving the current one)-->
            <div class="parts abs_full eighty_centered onfly_pane_p_budget_items">
                <div class="parts  full_center_two_h heit_free">
                    <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                        <table class="new_data_table" >
                            <thead>Add new p_budget_items</thead>
                            <tr>     <td>item_name</td> <td><input type="text" class="textbox"  id="onfly_txt_item_name" />  </td>
                            <tr>     <td>description</td> <td><input type="text" class="textbox"  id="onfly_txt_description" />  </td>
                            <tr>     <td>created_by</td> <td><input type="text" class="textbox"  id="onfly_txt_created_by" />  </td>
                            <tr>     <td>entry_date</td> <td><input type="text" class="textbox"  id="onfly_txt_entry_date" />  </td>
                            <tr>     <td>chart_account</td> <td><input type="text" class="textbox"  id="onfly_txt_chart_account" />  </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="confirm_buttons btn_onfly_save_p_budget_items" name="send_p_budget_items" value="Save & close"/> 
                                    <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>
            <!--End of opening Pane-->
            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Add Item </div>
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>            </div>
            <div class="parts eighty_centered off saved_dialog">
                p_budget_items saved successfully!</div>

            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Items Registration </div>
                <table class="new_data_table">
                    <tr><td><label for="txt_item_name">Name </label></td><td> <input type="text" autocomplete="off"    name="txt_item_name" required id="txt_item_name" class="textbox" value="<?php echo trim(chosen_item_name_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_description">Description </label></td><td> <textarea    name="txt_description" required id="txt_description" class="textbox"><?php echo trim(chosen_description_upd()); ?></textarea>  </td></tr>
                    <tr><td><label for="txt_type">Destination Category </label></td><td> <?php get_item_common_combo(); ?></textarea>  </td></tr>
                    <tr class="off"><td class="new_data_tb_frst_cols ">Chart Account </td><td> <?php get_chart_account_combo(); ?>  </td></tr>
                    <tr ><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_budget_items" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Items List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_budget_items();
                    $obj->list_p_budget_items($first);
                ?>
            </div>  
        </form> 
        <div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="p_budget_items" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_p_budget_prep.php"target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <div class="parts full_center_two_h heit_free footer"> Copyrights <?php echo '2018 - ' . date("Y") . ' MUHABURA MULTICHOICE COMPANY LTD Version 1.0' ?></div>
    </body>
</hmtl>

<?php

    function get_item_common_combo() {
        $obj = new other_fx();
        $obj->get_type_project_and_common_in_combo();
    }

    function get_chart_account_combo() {
        $obj = new multi_values();
        $obj->get_chart_account_in_combo();
    }

    function chosen_item_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget_items') {
                $id = $_SESSION['id_upd'];
                $item_name = new multi_values();
                return $item_name->get_chosen_p_budget_items_item_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_description_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget_items') {
                $id = $_SESSION['id_upd'];
                $description = new multi_values();
                return $description->get_chosen_p_budget_items_description($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_created_by_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget_items') {
                $id = $_SESSION['id_upd'];
                $created_by = new multi_values();
                return $created_by->get_chosen_p_budget_items_created_by($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget_items') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_p_budget_items_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_chart_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget_items') {
                $id = $_SESSION['id_upd'];
                $chart_account = new multi_values();
                return $chart_account->get_chosen_p_budget_items_chart_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    