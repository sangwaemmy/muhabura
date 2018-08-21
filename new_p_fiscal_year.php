<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_fiscal_year'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_fiscal_year') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_fiscal_year_id = $_SESSION['id_upd'];
                $fiscal_year_name = $_POST['txt_fiscal_year_name'];
                $start_date = $_POST['txt_start_date'];
                $end_date = $_POST['txt_end_date'];
                $entry_date = date('y-m-d');
                $account = $_SESSION['userid'];
                $upd_obj->update_p_fiscal_year($fiscal_year_name, $start_date, $end_date, $p_fiscal_year_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $fiscal_year_name = $_POST['txt_fiscal_year_name'];
            $start_date = $_POST['txt_start_date'];
            $end_date = $_POST['txt_end_date'];
            $entry_date = date('y-m-d');
            $account = $_SESSION['userid'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_p_fiscal_year($fiscal_year_name, $start_date, $end_date, $entry_date, $account);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_fiscal_year</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_p_fiscal_year.php" method="post" enctype="multipart/form-data">
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
            <!--End dialog-->

            <!--Start of opening Pane(The pane that allow the user to add the data in a different table without leaving the current one)-->
            <div class="parts abs_full eighty_centered onfly_pane_p_fiscal_year">
                <div class="parts  full_center_two_h heit_free">
                    <div class="parts pane_opening_balance  full_center_two_h heit_free no_shade_noBorder">
                        <table class="new_data_table" >
                            <thead>Add new p_fiscal_year</thead>
                            <tr>     <td>fiscal_year_name</td> <td><input type="text" required class="textbox"  id="onfly_txt_fiscal_year_name" />  </td>
                            <tr>     <td>fiscal_year_name</td> <td><input type="text" required class="textbox"  id="onfly_txt_fiscal_year_name" />  </td>
                            <tr>     <td>start_date</td> <td><input type="text" required class="textbox"  id="onfly_txt_start_date" />  </td>
                            <tr>     <td>end_date</td> <td><input type="text" required class="textbox"  id="onfly_txt_end_date" />  </td>
                            <tr>     <td>entry_date</td> <td><input type="text" required class="textbox"  id="onfly_txt_entry_date" />  </td>
                            <tr>     <td>account</td> <td><input type="text" required class="textbox"  id="onfly_txt_account" />  </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="confirm_buttons btn_onfly_save_p_fiscal_year" name="send_p_fiscal_year" value="Save & close"/> 
                                    <input type="button" class="confirm_buttons reverse_bg_btn reverse_color cancel_btn_onfly" name="send_account" value="Cancel"/> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>
            <!--End of opening Pane-->


            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Add   Fiscal </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                p_fiscal_year saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered new_data_title">  add more Fiscal year </div>
                <table class="new_data_table">
                    <tr><td><label for="txt_fiscal_year_name">Fiscal Year Name </label></td><td> <input type="text"     name="txt_fiscal_year_name" required id="txt_fiscal_year_name" class="textbox " value="<?php echo trim(chosen_fiscal_year_name_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_start_date">Start Date </label></td><td> <input type="text"     name="txt_start_date" required id="txt_start_date" class="textbox dates" value="<?php echo trim(chosen_start_date_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_end_date">End Date </label></td><td> <input type="text"     name="txt_end_date" required id="txt_end_date" class="textbox dates" value="<?php echo trim(chosen_end_date_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_fiscal_year" value="Save"/>  </td></tr>
                </table>
            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Fiscal years </div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_p_fiscal_year();
                    $obj->list_p_fiscal_year($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="p_fiscal" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_fiscal_year.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script> 
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('.dates').datepicker({
                    dateFormat: 'yy-mm-dd',
                    onSelect: function () {
                        var dt2 = $('#txt_end_date');
                        $('#txt_end_date').prop('disabled', false);
                        var startDate = $(this).datepicker('getDate');
                        //add 30 days to selected date
                        startDate.setDate(startDate.getDate() + 100);
                        var minDate = $(this).datepicker('getDate');
                        //minDate of dt2 datepicker = dt1 selected day
                        dt2.datepicker('setDate', minDate);
                        //sets dt2 maxDate to the last day of 30 days window
//                        dt2.datepicker('option', 'maxDate', startDate);
                        //first day which can be selected in dt2 is selected date in dt1
                        dt2.datepicker('option', 'minDate', minDate);
                        //same for dt1
//                        $(this).datepicker('option', 'minDate', minDate);
                    }
                });


            });
        </script>
    </body>
</hmtl>
<?php

    function chosen_fiscal_year_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_fiscal_year') {
                $id = $_SESSION['id_upd'];
                $fiscal_year_name = new multi_values();
                return $fiscal_year_name->get_chosen_p_fiscal_year_fiscal_year_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_start_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_fiscal_year') {
                $id = $_SESSION['id_upd'];
                $start_date = new multi_values();
                return $start_date->get_chosen_p_fiscal_year_start_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_end_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_fiscal_year') {
                $id = $_SESSION['id_upd'];
                $end_date = new multi_values();
                return $end_date->get_chosen_p_fiscal_year_end_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    