<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_bank'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'bank') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $bank_id = $_SESSION['id_upd'];
                $account = trim($_POST['txt_account_id']);
                $bank_name = trim($_POST['txt_name']);
                $upd_obj->update_bank($account, $bank_name, $bank_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $account = trim($_POST['txt_account_id']);
            $bank_name = trim($_POST['txt_name']);
            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_bank($account, $bank_name);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            bank</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_bank.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->
            <input type="hidden" id="txt_account_id"   name="txt_account_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                bank saved successfully!
            </div>
            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered "> Add bank accounts</div>
                <table class="new_data_table">

                    <tr><td>Name </td><td>  <input type="text" name="txt_name" class="textbox">  </td></tr>
                    <tr><td>Account no. </td><td>  <input type="text" name="txt_account_id" class="textbox">  </td></tr><tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_bank" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">Our banks</div>
                <?php
                    $obj = new multi_values();
                    $first = $obj->get_first_bank();
                    $obj->list_bank($first);
                ?>
            </div>  
        </form>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="bank" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_bank.php" method="post">
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

    function get_account_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function chosen_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'bank') {
                $id = $_SESSION['id_upd'];
                $account = new multi_values();
                return $account->get_chosen_bank_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    