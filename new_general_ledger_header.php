<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_general_ledger_header'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_header') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $general_ledger_header_id = $_SESSION['id_upd'];
                $date = $_POST['txt_date'];
                $doc_type = $_POST['txt_doc_type'];
                $desc = $_POST['txt_desc'];
                $upd_obj->update_general_ledger_header($date, $doc_type, $desc, $general_ledger_header_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $date = $_POST['txt_date'];
            $doc_type = $_POST['txt_doc_type'];
            $desc = $_POST['txt_desc'];
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_general_ledger_header($date, $doc_type, $desc);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            general_ledger_header</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_general_ledger_header.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                general_ledger_header saved successfully!
            </div>

            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  general ledger header</div>
                <table class="new_data_table">


                    <tr><td><label for="txt_tuple">Date </label></td><td> <input type="text"     name="txt_date" required id="txt_date" class="textbox" value="<?php echo trim(chosen_date_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Document Type </label></td><td> <input type="text"     name="txt_doc_type" required id="txt_doc_type" class="textbox" value="<?php echo trim(chosen_doc_type_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Description </label></td><td> <input type="text"     name="txt_desc" required id="txt_desc" class="textbox" value="<?php echo trim(chosen_desc_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_general_ledger_header" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">general_ledger_header List</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_general_ledger_header();
                    $obj->list_general_ledger_header($first);
                ?>
            </div>  
        </form> 
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="general_ledge_header" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_general_ledger_header.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>   <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

    function chosen_date_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_header') {
                $id = $_SESSION['id_upd'];
                $date = new multi_values();
                return $date->get_chosen_general_ledger_header_date($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_doc_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_header') {
                $id = $_SESSION['id_upd'];
                $doc_type = new multi_values();
                return $doc_type->get_chosen_general_ledger_header_doc_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_desc_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'general_ledger_header') {
                $id = $_SESSION['id_upd'];
                $desc = new multi_values();
                return $desc->get_chosen_general_ledger_header_desc($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    