<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_p_budget'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_request') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $p_request_id = $_SESSION['id_upd'];

                $item = $_POST['txt_item'];
                $quantity = $_POST['txt_quantity'];
                $unit_cost = $_POST['txt_unit_cost'];
                $amount = $_POST['txt_amount'];
                $entry_date = date("y-m-d");
                $User = $_SESSION['userid'];
                $measurement = $_POST['txt_measurement_id'];
                $request_no = $_POST['txt_request_no'];
                $upd_obj->update_p_request($item, $quantity, $unit_cost, $amount, $entry_date, $User, $measurement, $request_no, $p_request_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $item = $_POST['txt_item'];
            $quantity = $_POST['txt_quantity'];
            $unit_cost = $_POST['txt_unit_cost'];
            $amount = $_POST['txt_amount'];
            $entry_date = date("y-m-d");
            $User = $_SESSION['userid'];
            $measurement = trim($_POST['txt_measurement_id']);
            $request_no = $_POST['txt_request_no'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_p_request($item, $quantity, $unit_cost, $amount, $entry_date, $User, $measurement, $request_no);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            p_budget</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> 
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
        <style>
            .journal_entry_table thead{
                background-color: #234094;
            }
            .journal_entry_table .textbox{
                background-color: #f0f2f7;
                width: 100%;
                margin: auto;
            }
        </style>
    </head>
    <body>

        <?php include 'admin_header.php'; ?>
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

        <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
            <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
        <div class="parts eighty_centered off saved_dialog">
            p_budget saved successfully!
        </div>

        <div class="parts eighty_centered new_data_box off">
            <input type="hidden" style="float: right;" id="txt_project_id"   name="txt_project_id"/>
            <!--Below fields get the session values when the user has selected the year and the activity-->
            <input type="hidden" style="float: right;" id="txt_selected_fisc_year_id"   name="txt_f_year_process" value="<?php echo get_fisc_year_process(); ?>"  />
            <input type="hidden" style="float: right;" id="txt_selected_activity_id"   name="txt_f_activity_process" value="<?php echo get_activity_process(); ?>" />

            <table class="new_data_table selectable_table off">
                <tr class="off">
                    <td>Select Year</td>
                    <td><?php get_fisc_year_combo(); ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="parts full_center_two_h heit_free no_shade_noBorder big_title ">
                            Select Budget line <br/>
                            <span class="parts sml_title iconed pane_icon no_shade_noBorder">    This request will be saved along with the provided project</span>
                        </div>
                    </td>
                </tr>
                <tr><td class="new_data_tb_frst_cols">Budget Line </td><td> <?php get_project_combo(); ?>  </td></tr>
                <tr>
                    <td>Select Project</td>
                    <td><select class="textbox">
                            <option></option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Select the Activity</td>
                    <td> <select class="textbox tobe_refilled">
                            <option> --Activities--</option>
                        </select>  
                    </td>
                </tr>
                <tr>
                    <td> </td> <td><input type="submit" class="confirm_buttons" id="selct_f_year" value="Select" /> </td>
                </tr>
            </table>
            <form action="new_p_budget.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
                <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
                <input type="hidden" id="txt_account_id"   name="txt_account_id"/>
                <input type="hidden" id="txt_activity_id"   name="txt_activity_id"/>
                <input type="hidden"   id="txt_fisc_year_id"   name="txt_fisc_year_id"/>
                <div class="parts eighty_centered new_data_title thehidden_part off">  Requests list </div>
                <table class="dataList_table journal_entry_table thehidden_part " style="width: 80%;">
                    <thead>
                    <td>Item   </td><td>Measurement</td> <td>Quantity</td>    <td> Unit Cost  </td>  
                    </thead>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr class="ftd runtime">     <td>  <input type="text" name="txt_debit[]" class="textbox bgt_txt_item" />  </td>   <td><?php get_measurement_combo(); ?></td>    <td>  <input type="text" class="textbox bgt_txt_unitC" name="txt_credit[]"/> </td> <td>  <input type="text" class="textbox bgt_txt_qty" name="txt_credit[]"/> </td> </tr>
                    <tr><td colspan="4"> <input class="confirm_buttons" type="button" id="save_budget" value="Save"save_journal> </td></tr>
                </table>
                <table class=" off">
                    <tr><td><label for="txt_"budget_value>budget value </label></td><td> <input type="text"     name="txt_budget_value" required id="txt_budget_value" class="textbox" value="<?php echo trim(chosen_budget_value_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"description>Description </label></td><td> <input type="text"     name="txt_description" required id="txt_description" class="textbox" value="<?php echo trim(chosen_description_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_"is_active>Is Active </label></td><td> <input type="text"     name="txt_is_active" required id="txt_is_active" class="textbox" value="<?php echo trim(chosen_is_active_upd()); ?>"   />  </td></tr>
                    <tr><td class="new_data_tb_frst_cols">Activity </td><td> <?php get_activity_combo(); ?>  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_p_budget" value="Save"/>  </td></tr>
                </table>
            </form> 
            <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
                <table class="margin_free">
                    <td>
                        <form action="../web_exports/excel_export.php" method="post">
                            <input type="hidden" name="p_budget" value="a"/>
                            <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                        </form>
                    </td>
                    <td>
                        <form action="../prints/print_p_budget.php" method="post">
                            <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                        </form>
                    </td>
                </table>
            </div>
        </div>
        <div class="parts eighty_centered datalist_box" >
            <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Requests report</div>
            <?php
                $obj = new multi_values();
                $first = $obj->get_first_p_budget();
                $obj->list_p_budget($first);
            ?>
        </div>  
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?>
        </div>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script>
            var new_row = ' <tr>'
                    + ' <td>Item</td>'
                    + ' <td>Measurement</td>'
                    + ' <td>Quantity</td>'
                    + ' <td>Unit Cos</td>'
                    + ' </tr>';
            var fiscal_yr = "<?php echo $_SESSION['selected_fisc_year'] ?>";
            var activity = "<?php echo $_SESSION['activity'] ?>";
            var add_budget = 'c';

            //these are the data to be saved in the database;
            var item_name, mesrmt, unit_c, qty;
            $(document).ready(function () {
                save_budgets();
            });
            function save_budgets() {
                $('#save_budget').click(function () {
                    if (fiscal_yr !== '' && activity !== '') {
                        save_budget_now();
                    } else {
                        alert('Something went wrong, there is no fiscal year');
                    }
                });
                function save_budget_now() {
                    $('.bgt_txt_item').each(function name(i) {
                        if ($(this).val() != '') {
                            item_name = $(this).val();
                            $('.bgt_txt_msrment').each(function (m) {
                                mesrmt = $(this).val();
                                return false;
                            });
                            $('.bgt_txt_unitC').each(function (u) {
                                unit_c = $(this).val();
                                return false;
                            });
                            $('.bgt_txt_qty').each(function (q) {
                                qty = $(this).val();
                                return false;
                            });
                            $.post('handler.php', {
                                add_budget: add_budget,
                                mesrmt: mesrmt,
                                unit_c: unit_c,
                                qty: qty,
                                activity: activity,
                                item_name: item_name
                            }, function (data) {
                                alert(data);
                            }).complete(function () {
                                alert('The budget is successfully saved.');
                                $('.new_data_box').slideUp(700);
                                //add a row on the budget

                            });
                        }
                    });


                }

            }
        </script>
    </body>
</hmtl>


<?php

    function get_measurement_combo() {
        $obj = new multi_values();
        $obj->get_measurement_in_combo();
    }

    function get_project_combo() {
        $obj = new multi_values();
        $obj->get_project_in_combo_refill();
    }

    function get_fisc_year_combo() {
        $obj = new multi_values();
        $obj->get_fisc_year_in_combo();
    }

    function get_account_in_combo() {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $obj->get_account_in_combo_array();
    }

    function get_account_combo() {
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function chosen_budget_value_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $budget_value = new multi_values();
                return $budget_value->get_chosen_p_budget_budget_value($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_description_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $description = new multi_values();
                return $description->get_chosen_p_budget_description($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $account = new multi_values();
                return $account->get_chosen_p_budget_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_entry_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $entry_date = new multi_values();
                return $entry_date->get_chosen_p_budget_entry_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_active_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $is_active = new multi_values();
                return $is_active->get_chosen_p_budget_is_active($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_status_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $status = new multi_values();
                return $status->get_chosen_p_budget_status($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function get_activity_combo() {

        $obj = new multi_values();
        $obj->get_activity_in_combo();
    }

    function chosen_activity_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'p_budget') {
                $id = $_SESSION['id_upd'];
                $activity = new multi_values();
                return $activity->get_chosen_p_budget_activity($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function get_fisc_year_process() {
        if (isset($_SESSION['selected_fisc_year'])) {
            return (isset($_SESSION['selected_fisc_year'])) ? $_SESSION['selected_fisc_year'] : '';
        }
    }

    function get_activity_process() {
        return (isset($_SESSION['activity'])) ? $_SESSION['activity'] : '';
    }

    function foo() {
        ?><script>alert('Foo says no data found');</script><?php
    }
    