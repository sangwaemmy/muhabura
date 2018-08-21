+<?php
session_start();
require_once '../web_db/multi_values.php';
if (!isset($_SESSION)) {
    session_start();
}if (!isset($_SESSION['login_token'])) {
    header('location:../index.php');
}
if (isset($_POST['send_contact'])) {
    if (isset($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'contact') {
            require_once '../web_db/updates.php';
            $upd_obj = new updates();
            $contact_id = $_SESSION['id_upd'];

            $party = trim($_POST['txt_party_id']);


            $upd_obj->update_contact($party, $contact_id);
            unset($_SESSION['table_to_update']);
        }
    } else {
        $party = trim($_POST['txt_party_id']);

        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $obj->new_contact($party);
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            contact</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_contact.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_party_id"   name="txt_party_id"/>
            <?php
            include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                contact saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  contact</div>
                <table class="new_data_table">


                    <tr><td>party </td><td> <?php get_party_combo(); ?>  </td></tr>

                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_contact" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">contact List</div>
                <?php
                $obj = new multi_values();
                $first = $obj->get_first_contact();
                $obj->list_contact($first);
                ?>
            </div>  
        </form> 
          <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="contact" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_contact.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

function get_party_combo() {
    $obj = new multi_values();
    $obj->get_party_in_combo();
}

function chosen_party_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'contact') {
            $id = $_SESSION['id_upd'];
            $party = new multi_values();
            return $party->get_chosen_contact_party($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}
