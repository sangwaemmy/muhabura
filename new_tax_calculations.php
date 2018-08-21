<?php
    session_start();
    require_once '../web_db/multi_values.php';
    require_once '../web_db/other_fx.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_tax_calculations'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $tax_calculations_id = $_SESSION['id_upd'];

                $self_id = $_POST['txt_self_id'];
                $source_tax = $_POST['txt_source_tax'];
                $dest_tax = $_POST['txt_dest_tax'];
                $sign = $_POST['txt_sign'];
                $is_self_existing = $_POST['txt_is_self_existing'];
                $group_type = $_POST['txt_group_type'];
                $tax = $_POST['txt_tax'];
                $valued = $_POST['txt_valued'];


                $upd_obj->update_tax_calculations($self_id, $source_tax, $dest_tax, $sign, $is_self_existing, $group_type, $tax, $valued, $tax_calculations_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $self_id = $_POST['txt_self_id'];
            $source_tax = $_POST['txt_source_tax'];
            $dest_tax = $_POST['txt_dest_tax'];
            $sign = $_POST['txt_sign'];
            $is_self_existing = $_POST['txt_is_self_existing'];
            $group_type = $_POST['txt_group_type'];
            $tax = $_POST['txt_tax'];
            $valued = $_POST['txt_valued'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_tax_calculations($self_id, $source_tax, $dest_tax, $sign, $is_self_existing, $group_type, $tax, $valued);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            tax_calculations</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">
    </head>
    <body>
        <form action="new_tax_calculations.php" method="post" enctype="multipart/form-data">
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
            <div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Edit  Calculations </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                tax_calculations saved successfully!</div>
            <div class="parts eighty_centered new_data_box ">
                <div class="parts eighty_centered new_data_title no_paddin_shade_no_Border">  tax calculations Registration 
                    <div class="part full_center_two_h heit_free no_shade_noBorder sml_title">
                        The formula you add on the taxes will be permanently be saved and applied to your sales and purchases you make
                    </div>
                </div>
                <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border">
                    <div class="parts tips_res top_off_x x_width_one_h x_height_two_fifty">

                    </div>
                    <div class="parts no_paddin_shade_no_Border">
                        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border margin_free">
                            <table   class="sign_table">
                                <tr>
                                    <td class="sign_tds" id="pls">+</td>
                                    <td class="sign_tds" id="mns">-</td>
                                    <td class="sign_tds" id="dvd">/</td>
                                    <td class="sign_tds" id="mult">x</td>
                                </tr> 

                            </table>
                            <div id="warn_box"  class="parts full_center_two_h heit_free no_paddin_shade_no_Border" style="color: #000;">

                            </div>
                        </div>
                        <?php
                            $ot = new other_fx();
                            $ot->list_taxgroup_to_make_calculations();
                        ?>
                    </div></div>

            </div>
            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title off">tax calculations List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_tax_calculations();
//                    $obj->list_tax_calculations($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script src="../web_scripts/Tax_calculations.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {

                $('#header2').slideUp();
                $('#my_header').slideUp();
            });
        </script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function chosen_self_id_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $self_id = new multi_values();
                return $self_id->get_chosen_tax_calculations_self_id($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_source_tax_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $source_tax = new multi_values();
                return $source_tax->get_chosen_tax_calculations_source_tax($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_dest_tax_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $dest_tax = new multi_values();
                return $dest_tax->get_chosen_tax_calculations_dest_tax($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sign_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $sign = new multi_values();
                return $sign->get_chosen_tax_calculations_sign($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_is_self_existing_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $is_self_existing = new multi_values();
                return $is_self_existing->get_chosen_tax_calculations_is_self_existing($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_group_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $group_type = new multi_values();
                return $group_type->get_chosen_tax_calculations_group_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_tax_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $tax = new multi_values();
                return $tax->get_chosen_tax_calculations_tax($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_valued_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'tax_calculations') {
                $id = $_SESSION['id_upd'];
                $valued = new multi_values();
                return $valued->get_chosen_tax_calculations_valued($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    