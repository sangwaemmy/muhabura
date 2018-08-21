<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_items_expenses'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_items_expenses_id = $_SESSION['id_upd'];
                $description = $_POST['txt_description'];
                $amount = $_POST['txt_amount'];
                $date = date('y-m-d');
                $finalized = 'no';
                $is_deleted = 'no';
                $account = $_SESSION['userid'];
                $item = $_POST['txt_item_id'];
                $upd_obj->update_p_items_expenses($item, $description, $amount, $date, $finalized, $is_deleted, $account, $date, $item, $p_items_expenses_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $description = $_POST['txt_description'];
            $amount = $_POST['txt_amount'];
            $finalized = 'no';
            $is_deleted = 'no';
            $account = $_SESSION['userid'];
            $date = date('y-m-d');
            $item = trim($_POST['txt_item_id']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_p_items_expenses($item, $description, $amount, $date, $finalized, $is_deleted, $account);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_items_expenses</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_p_items_expenses.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden"style="float: right;" id="txt_item_id"   name="txt_item_id"/>
            <input type="hidden" id="txt_account_id"   name="txt_account_id"/>

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
                p_items_expenses saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  Activities expenses List </div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_budget_items();
                    $obj->list_p_budget_items_selectable($first);
                ?>
                <table class="new_data_table off">
                    <tr>
                        <td><a href="#" id="item_link" style="color: #060817;   ">Choose Activity</a></td>
                        <td></td>
                    </tr>

                    <tr><td><label for="txt_"description>Description </label></td><td> <input type="text"     name="txt_description" required id="txt_description" class="textbox" value="<?php echo trim(chosen_description_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"amount>Amount </label></td><td> <input type="text"     name="txt_amount" required id="txt_amount" class="textbox" value="<?php echo trim(chosen_amount_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_items_expenses" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Activities expenses </div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_items_expenses();
                    $obj->list_p_items_expenses($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="p_items_expenses" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_p_items_expenses.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php
                require_once './navigation/add_nav.php';
            ?>
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function get_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function get_item_combo() {
        $obj = new multi_values();
        $obj->get_item_in_combo();
    }

    function chosen_item_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $item = new multi_values();
                return $item->get_chosen_p_items_expenses_item($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_description_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $description = new multi_values();
                return $description->get_chosen_p_items_expenses_description($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_p_items_expenses_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $date = new multi_values();
                return $date->get_chosen_p_items_expenses_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_finalized_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $finalized = new multi_values();
                return $finalized->get_chosen_p_items_expenses_finalized($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_deleted_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $is_deleted = new multi_values();
                return $is_deleted->get_chosen_p_items_expenses_is_deleted($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_items_expenses') {
                $id = $_SESSION['id_upd'];
                $account = new multi_values();
                return $account->get_chosen_p_items_expenses_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    