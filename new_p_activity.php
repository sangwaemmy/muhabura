<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_activity'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_activity') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $project = trim($_POST['txt_project_id']);
                $name = $_POST['txt_name'];
                $fisc_year = $_POST['txt_fisc_year_id'];
                $upd_obj->update_p_activity($project, $name, $fisc_year);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $project = trim($_POST['txt_project_id']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $name = $_POST['txt_name'];
            $fisc_year = trim($_POST['txt_fisc_year_id']);
            $field = $_POST['txt_field_id'];
            $amount = filter_input(INPUT_POST, 'txt_amount', FILTER_SANITIZE_NUMBER_INT);
            $obj->new_p_activity($project, $name, $fisc_year, $amount, $field);
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            activity</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon"> </head>
    <body>
        <?php
            include 'admin_header.php';
        ?>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
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
        <div class="parts abs_full eighty_centered onfly_pane_p_type_project">
            <div class="parts  full_center_two_h heit_free">
                <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                    <table class="new_data_table" >
                        <thead>Add new Budget Line</thead>
                        <tr>
                            <td>Name</td> <td><input type="text" autocomplete="off"  class="textbox"  id="onfly_txt_name" />  </td>
                        </tr>
                        <tr>
                            <td colspan="2">                                
                                <input type="button" class="confirm_buttons btn_onfly_save_p_type_project" name="send_account" value="Save & close"/> 
                                <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>  
        </div>
        <!--End of opening Pane-->

        <form action="new_p_activity.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <input type="hidden" id="txt_p_type_project_id"    name="txt_type_project_id"/>
            <input type="hidden" id="txt_field_id" style="float: right"   name="txt_field_id"/>
            <input type="hidden" id="txt_fisc_year_id"   name="txt_fisc_year_id"/>
            <input type="hidden" id="txt_project_id"   name="txt_project_id"/>

            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Add More Activities  </div> 
                <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
            </div>
            <div class="parts eighty_centered off saved_dialog">
                p_activity saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title ">  Add more activities for the projects </div>
                <table class="new_data_table">
                    <tr><td class="new_data_tb_frst_cols">Budget line </td><td> <?php get_type_project_combo(); ?>  </td></tr>
                    <tr>
                        <td>project</td><td>
                            <select name="activity_project" class="textbox put_in_textbox cbo_fill_projects">
                                <option> --Project--</option>
                            </select>  
                        </td>
                    </tr>
                    <tr><td><label for="txt_"name>Name </label></td><td> <input type="text"  autocomplete="off"    name="txt_name" required id="txt_name" class="textbox" value="<?php echo trim(chosen_name_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_amount"name>Amount </label></td><td> <input type="text"  autocomplete="off"    name="txt_amount" required id="txt_amount" class="textbox only_numbers" value="<?php //echo trim(chosen_name_upd());                ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Fiscal Year: </td><td> <?php get_fisc_year_combo(); ?>  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Field: </td><td> <?php get_field_combo(); ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_activity" value="Save"/>  </td></tr>
                </table>
            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">All activities</div>
                <?php
                    // <editor-fold defaultstate="collapsed" desc="--paging init---">
                    if (isset($_POST['prev'])) {
                        $_SESSION['page'] = ($_SESSION['page'] < 1) ? 1 : ($_SESSION['page'] -= 1);
                        $last = ($_SESSION['page'] > 1) ? $_SESSION['page'] * 30 : 30;
                        $first = $last - 30;
                    } else if (isset($_POST['page_level'])) {//this is next
                        $_SESSION['page'] = ($_SESSION['page'] < 1) ? 1 : ($_SESSION['page'] += 1);
                        $last = $_SESSION['page'] * 30;
                        $first = $last - 30;
                    } else if (isset($_SESSION['page']) && isset($_POST['paginated']) && $_SESSION['page'] > 0) {// the use is on another page(other than the first) and clicked the page inside
                        $last = $_POST['paginated'] * 30;
                        $first = $last - 30;
                    } else if (isset($_POST['paginated']) && $_SESSION['page'] = 0) {
                        $first = 0;
                    } else if (isset($_POST['paginated'])) {
                        $last = $_POST['paginated'] * 30;
                        $first = $last - 30;
                    } else if (isset($_POST['first'])) {
                        $_SESSION['page'] = 1;
                        $first = 0;
                    } else {
                        $first = 0;
                    }

// </editor-fold>
                    $obj = new multi_values();
                    $first = $obj->get_first_p_activity();
                    $obj->list_p_activity($first);
                ?>
            </div>  
        </form><div class="parts no_paddin_shade_no_Border eighty_centered no_bg">
            <table>
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="p_activity" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_p_activity.php"target="blank" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td></table>
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

    function get_type_project_combo() {
        $obj = new multi_values();
        $obj->get_type_project_in_combo();
    }

    function get_fisc_year_combo() {
        $obj = new multi_values();
        $obj->get_fisc_year_in_combo();
    }

    function get_field_combo() {
        $obj = new multi_values();
        $obj->get_field_in_combo();
    }

    function chosen_project_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_activity') {
                $id = $_SESSION['id_upd'];
                $project = new multi_values();
                return $project->get_chosen_p_activity_project($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_amount_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_activity') {
                $id = $_SESSION['id_upd'];
                $amount = new multi_values();
                return $amount->get_chosen_p_activity_amount($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_activity') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_p_activity_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_field_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_activity') {
                $id = $_SESSION['id_upd'];
                $field = new multi_values();
                return $field->get_chosen_p_activity_field($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    