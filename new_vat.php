<?php
session_start();
 require_once '../web_db/multi_values.php';
if (!isset($_SESSION)) {     session_start();
}if (!isset($_SESSION['login_token'])) {
    header('location:../index.php');
         }
 if(isset($_POST['send_vat'])){
              if(isset($_SESSION['table_to_update'])){
                 if ($_SESSION['table_to_update'] == 'vat'){
                      require_once '../web_db/updates.php';                      $upd_obj= new updates();
                      $vat_id=$_SESSION['id_upd'];
                      
$Total_val_of_Sup = $_POST['txt_Total_val_of_Sup'];
$exempted_sales = $_POST['txt_exempted_sales'];
$exports = $_POST['txt_exports'];
$total_not_taxable = $_POST['txt_total_not_taxable'];
$taxable_sales_sub_vat = $_POST['txt_taxable_sales_sub_vat'];
$vat_on_taxable_sales = $_POST['txt_vat_on_taxable_sales'];
$vat_reversecharge = $_POST['txt_vat_reversecharge'];
$vat_payable = $_POST['txt_vat_payable'];
$vat_paid_on_imports = $_POST['txt_vat_paid_on_imports'];
$vat_paidon_local_pur = $_POST['txt_vat_paidon_local_pur'];
$vat_rev_char_deduct = $_POST['txt_vat_rev_char_deduct'];
$vat_pay_cre_ref = $_POST['txt_vat_pay_cre_ref'];
$vat_with_hold_pub = $_POST['txt_vat_with_hold_pub'];
$vat_due_cred_pay = $_POST['txt_vat_due_cred_pay'];
$vat_refund = $_POST['txt_vat_refund'];
$vat_due = $_POST['txt_vat_due'];


$upd_obj->update_vat($Total_val_of_Sup, $exempted_sales, $exports, $total_not_taxable, $taxable_sales_sub_vat, $vat_on_taxable_sales, $vat_reversecharge, $vat_payable, $vat_paid_on_imports, $vat_paidon_local_pur, $vat_rev_char_deduct, $vat_pay_cre_ref, $vat_with_hold_pub, $vat_due_cred_pay, $vat_refund, $vat_due,$vat_id);
unset($_SESSION['table_to_update']);
}}else{$Total_val_of_Sup = $_POST['txt_Total_val_of_Sup'];
$exempted_sales = $_POST['txt_exempted_sales'];
$exports = $_POST['txt_exports'];
$total_not_taxable = $_POST['txt_total_not_taxable'];
$taxable_sales_sub_vat = $_POST['txt_taxable_sales_sub_vat'];
$vat_on_taxable_sales = $_POST['txt_vat_on_taxable_sales'];
$vat_reversecharge = $_POST['txt_vat_reversecharge'];
$vat_payable = $_POST['txt_vat_payable'];
$vat_paid_on_imports = $_POST['txt_vat_paid_on_imports'];
$vat_paidon_local_pur = $_POST['txt_vat_paidon_local_pur'];
$vat_rev_char_deduct = $_POST['txt_vat_rev_char_deduct'];
$vat_pay_cre_ref = $_POST['txt_vat_pay_cre_ref'];
$vat_with_hold_pub = $_POST['txt_vat_with_hold_pub'];
$vat_due_cred_pay = $_POST['txt_vat_due_cred_pay'];
$vat_refund = $_POST['txt_vat_refund'];
$vat_due = $_POST['txt_vat_due'];

require_once '../web_db/new_values.php';
 $obj = new new_values();
$obj->new_vat($Total_val_of_Sup, $exempted_sales, $exports, $total_not_taxable, $taxable_sales_sub_vat, $vat_on_taxable_sales, $vat_reversecharge, $vat_payable, $vat_paid_on_imports, $vat_paidon_local_pur, $vat_rev_char_deduct, $vat_pay_cre_ref, $vat_with_hold_pub, $vat_due_cred_pay, $vat_refund, $vat_due);
}}
?>

 <html>
<head>
  <meta charset="UTF-8">
<title>
vat</title>
      <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
</head>
   <body>
        <form action="new_vat.php" method="post" enctype="multipart/form-data">
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
            <!--End dialog--><div class="parts eighty_centered no_paddin_shade_no_Border hider_box">  
  <div class="parts  no_paddin_shade_no_Border new_data_hider"> Hide </div>  </div>
<div class="parts eighty_centered off saved_dialog">
 vat saved successfully!</div>


<div class="parts eighty_centered new_data_box off">
<div class="parts eighty_centered new_data_title">  vat Registration </div>
 <table class="new_data_table">


<tr><td><label for="txt_Total_val_of_Sup">Total Value of Supplies </label></td><td> <input type="text"     name="txt_Total_val_of_Sup" required id="txt_Total_val_of_Sup" class="textbox" value="<?php echo trim(chosen_Total_val_of_Sup_upd());?>"   />  </td></tr>
<tr><td><label for="txt_exempted_sales">Exempted Sales </label></td><td> <input type="text"     name="txt_exempted_sales" required id="txt_exempted_sales" class="textbox" value="<?php echo trim(chosen_exempted_sales_upd());?>"   />  </td></tr>
<tr><td><label for="txt_exports">Exports </label></td><td> <input type="text"     name="txt_exports" required id="txt_exports" class="textbox" value="<?php echo trim(chosen_exports_upd());?>"   />  </td></tr>
<tr><td><label for="txt_total_not_taxable">Total Not Taxable </label></td><td> <input type="text"     name="txt_total_not_taxable" required id="txt_total_not_taxable" class="textbox" value="<?php echo trim(chosen_total_not_taxable_upd());?>"   />  </td></tr>
<tr><td><label for="txt_taxable_sales_sub_vat">Taxable Sales subject to VAT </label></td><td> <input type="text"     name="txt_taxable_sales_sub_vat" required id="txt_taxable_sales_sub_vat" class="textbox" value="<?php echo trim(chosen_taxable_sales_sub_vat_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_on_taxable_sales">VAT on Taxable Sales </label></td><td> <input type="text"     name="txt_vat_on_taxable_sales" required id="txt_vat_on_taxable_sales" class="textbox" value="<?php echo trim(chosen_vat_on_taxable_sales_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_reversecharge">VAT Reverse charge </label></td><td> <input type="text"     name="txt_vat_reversecharge" required id="txt_vat_reversecharge" class="textbox" value="<?php echo trim(chosen_vat_reversecharge_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_payable">VAT Payable </label></td><td> <input type="text"     name="txt_vat_payable" required id="txt_vat_payable" class="textbox" value="<?php echo trim(chosen_vat_payable_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_paid_on_imports">VAT Paid on Imports </label></td><td> <input type="text"     name="txt_vat_paid_on_imports" required id="txt_vat_paid_on_imports" class="textbox" value="<?php echo trim(chosen_vat_paid_on_imports_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_paidon_local_pur">VAT Paid on Local Purchases </label></td><td> <input type="text"     name="txt_vat_paidon_local_pur" required id="txt_vat_paidon_local_pur" class="textbox" value="<?php echo trim(chosen_vat_paidon_local_pur_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_rev_char_deduct">VAT Reverse Charge deductible </label></td><td> <input type="text"     name="txt_vat_rev_char_deduct" required id="txt_vat_rev_char_deduct" class="textbox" value="<?php echo trim(chosen_vat_rev_char_deduct_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_pay_cre_ref">VAT Payable/Credit Refundable </label></td><td> <input type="text"     name="txt_vat_pay_cre_ref" required id="txt_vat_pay_cre_ref" class="textbox" value="<?php echo trim(chosen_vat_pay_cre_ref_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_with_hold_pub">withhold Pub Inst </label></td><td> <input type="text"     name="txt_vat_with_hold_pub" required id="txt_vat_with_hold_pub" class="textbox" value="<?php echo trim(chosen_vat_with_hold_pub_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_due_cred_pay">VAT Due  Credit Payable </label></td><td> <input type="text"     name="txt_vat_due_cred_pay" required id="txt_vat_due_cred_pay" class="textbox" value="<?php echo trim(chosen_vat_due_cred_pay_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_refund">VAT Refund Claim </label></td><td> <input type="text"     name="txt_vat_refund" required id="txt_vat_refund" class="textbox" value="<?php echo trim(chosen_vat_refund_upd());?>"   />  </td></tr>
<tr><td><label for="txt_vat_due">VAT Due </label></td><td> <input type="text"     name="txt_vat_due" required id="txt_vat_due" class="textbox" value="<?php echo trim(chosen_vat_due_upd());?>"   />  </td></tr>


<tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_vat" value="Save"/>  </td></tr>
</table>
</div>

<div class="parts eighty_centered datalist_box" >
  <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">vat List</div>
<?php 
 $obj = new multi_values();
                    $first = $obj->get_first_vat();
                    $obj->list_vat($first);
                
?>
</div>  
</form>
    <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

<div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
</body>
</hmtl>
<?php

function chosen_Total_val_of_Sup_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $Total_val_of_Sup = new multi_values();
               return $Total_val_of_Sup->get_chosen_vat_Total_val_of_Sup($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_exempted_sales_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $exempted_sales = new multi_values();
               return $exempted_sales->get_chosen_vat_exempted_sales($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_exports_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $exports = new multi_values();
               return $exports->get_chosen_vat_exports($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_total_not_taxable_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $total_not_taxable = new multi_values();
               return $total_not_taxable->get_chosen_vat_total_not_taxable($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_taxable_sales_sub_vat_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $taxable_sales_sub_vat = new multi_values();
               return $taxable_sales_sub_vat->get_chosen_vat_taxable_sales_sub_vat($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_on_taxable_sales_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_on_taxable_sales = new multi_values();
               return $vat_on_taxable_sales->get_chosen_vat_vat_on_taxable_sales($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_reversecharge_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_reversecharge = new multi_values();
               return $vat_reversecharge->get_chosen_vat_vat_reversecharge($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_payable_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_payable = new multi_values();
               return $vat_payable->get_chosen_vat_vat_payable($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_paid_on_imports_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_paid_on_imports = new multi_values();
               return $vat_paid_on_imports->get_chosen_vat_vat_paid_on_imports($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_paidon_local_pur_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_paidon_local_pur = new multi_values();
               return $vat_paidon_local_pur->get_chosen_vat_vat_paidon_local_pur($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_rev_char_deduct_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_rev_char_deduct = new multi_values();
               return $vat_rev_char_deduct->get_chosen_vat_vat_rev_char_deduct($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_pay_cre_ref_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_pay_cre_ref = new multi_values();
               return $vat_pay_cre_ref->get_chosen_vat_vat_pay_cre_ref($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_with_hold_pub_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_with_hold_pub = new multi_values();
               return $vat_with_hold_pub->get_chosen_vat_vat_with_hold_pub($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_due_cred_pay_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_due_cred_pay = new multi_values();
               return $vat_due_cred_pay->get_chosen_vat_vat_due_cred_pay($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_refund_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_refund = new multi_values();
               return $vat_refund->get_chosen_vat_vat_refund($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}function chosen_vat_due_upd() {
    if (!empty($_SESSION['table_to_update'])) {
           if ($_SESSION['table_to_update'] == 'vat') {               $id = $_SESSION['id_upd'];
               $vat_due = new multi_values();
               return $vat_due->get_chosen_vat_vat_due($id);
           } else {
               return '';
        }    } else {
        return '';
    }
}
