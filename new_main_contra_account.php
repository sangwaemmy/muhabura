<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_main_contra_account'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'main_contra_account') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $main_contra_account_id = $_SESSION['id_upd'];
                $main_contra_acc = trim($_POST['txt_main_contra_acc_id']);
                $related_contra_acc = $_POST['txt_related_contra_acc'];
                $upd_obj->update_main_contra_account($main_contra_acc, $related_contra_acc, $main_contra_account_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $main_contra_acc = trim($_POST['txt_main_contra_acc_id']);
            $related_contra_acc = $_POST['txt_related_contra_acc'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_main_contra_account($main_contra_acc, $related_contra_acc);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            main_contra_account</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>    <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_main_contra_account.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_main_contra_acc_id"   name="txt_main_contra_acc_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                main_contra_account saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  main_contra_account</div>
                <table class="new_data_table">


                    <tr><td>Main Contra Account </td><td> <?php get_main_contra_acc_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Related Contra Account </label></td><td> <input type="text"     name="txt_related_contra_acc" required id="txt_related_contra_acc" class="textbox" value="<?php echo trim(chosen_related_contra_acc_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_main_contra_account" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">Main Contra Accounts</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_main_contra_account();
                    $obj->list_main_contra_account($first);
                ?>
            </div>  
        </form> <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
    <table class="margin_free">
        <td>
            <form action="../web_exports/excel_export.php" method="post">
                <input type="hidden" name="main_contra_account" value="a"/>
                <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
            </form>
        </td>
        <td>
            <form action="../prints/print_main_contra_account.php" method="post">
                <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
            </form>
        </td>
    </table>
</div>

<?php

    function get_main_contra_acc_combo() {
        $obj = new multi_values();
        $obj->get_main_contra_acc_in_combo();
    }

    function chosen_main_contra_acc_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'main_contra_account') {
                $id = $_SESSION['id_upd'];
                $main_contra_acc = new multi_values();
                return $main_contra_acc->get_chosen_main_contra_account_main_contra_acc($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_related_contra_acc_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'main_contra_account') {
                $id = $_SESSION['id_upd'];
                $related_contra_acc = new multi_values();
                return $related_contra_acc->get_chosen_main_contra_account_related_contra_acc($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    