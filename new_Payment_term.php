<?php
session_start();
require_once '../web_db/multi_values.php';
if (!isset($_SESSION)) {
    session_start();
}if (!isset($_SESSION['login_token'])) {
    header('location:../index.php');
}
if (isset($_POST['send_Payment_term'])) {
    if (isset($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Payment_term') {
            require_once '../web_db/updates.php';
            $upd_obj = new updates();
            $Payment_term_id = $_SESSION['id_upd'];

            $description = $_POST['txt_description'];
            $payment_type = $_POST['txt_payment_type'];
            $due_after_days = $_POST['txt_due_after_days'];
            $is_active = $_POST['txt_is_active'];


            $upd_obj->update_Payment_term($description, $payment_type, $due_after_days, $is_active, $Payment_term_id);
            unset($_SESSION['table_to_update']);
        }
    } else {
        $description = $_POST['txt_description'];
        $payment_type = $_POST['txt_payment_type'];
        $due_after_days = $_POST['txt_due_after_days'];
        $is_active = $_POST['txt_is_active'];

        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $obj->new_Payment_term($description, $payment_type, $due_after_days, $is_active);
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Payment_term</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <form action="new_Payment_term.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->


            <?php
            include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
            <div class="parts eighty_centered off saved_dialog">
                Payment_term saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  Payment term</div>
                <table class="new_data_table">
                    <tr><td><label for="txt_tuple">Description </label></td><td> <input type="text"     name="txt_description" required id="txt_description" class="textbox" value="<?php echo trim(chosen_description_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Payment Type </label></td><td> <input type="text"     name="txt_payment_type" required id="txt_payment_type" class="textbox" value="<?php echo trim(chosen_payment_type_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">DueAfterDays </label></td><td> <input type="text"     name="txt_due_after_days" required id="txt_due_after_days" class="textbox" value="<?php echo trim(chosen_due_after_days_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Is Active </label></td><td> <input type="text"     name="txt_is_active" required id="txt_is_active" class="textbox" value="<?php echo trim(chosen_is_active_upd()); ?>"   />  </td></tr>
                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_Payment_term" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">Payment term List</div>
                <?php
                $obj = new multi_values();
                $first = $obj->get_first_Payment_term();
                $obj->list_Payment_term($first);
                ?>
            </div>  
        </form>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>  <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
    </body>
</hmtl>
<?php

function chosen_description_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Payment_term') {
            $id = $_SESSION['id_upd'];
            $description = new multi_values();
            return $description->get_chosen_Payment_term_description($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_payment_type_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Payment_term') {
            $id = $_SESSION['id_upd'];
            $payment_type = new multi_values();
            return $payment_type->get_chosen_Payment_term_payment_type($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_due_after_days_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Payment_term') {
            $id = $_SESSION['id_upd'];
            $due_after_days = new multi_values();
            return $due_after_days->get_chosen_Payment_term_due_after_days($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}

function chosen_is_active_upd() {
    if (!empty($_SESSION['table_to_update'])) {
        if ($_SESSION['table_to_update'] == 'Payment_term') {
            $id = $_SESSION['id_upd'];
            $is_active = new multi_values();
            return $is_active->get_chosen_Payment_term_is_active($id);
        } else {
            return '';
        }
    } else {
        return '';
    }
}
