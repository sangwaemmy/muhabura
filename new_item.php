<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
    if (isset($_POST['send_item'])) {
        if (isset($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                require_once '../web_db/updates.php';
                $upd_obj = new updates();
                $item_id = $_SESSION['id_upd'];

                $measurement = trim($_POST['txt_measurement_id']);
                $vendor = $_POST['txt_vendor_id'];

                $item_group = $_POST['txt_item_group_id'];

                $item_category = $_POST['txt_item_category_id'];

                $smallest_measurement = $_POST['txt_smallest_measurement'];
                $sale_measurement = $_POST['txt_sale_measurement'];
                $purchase_measurement = $_POST['txt_purchase_measurement'];
                $sales_account = $_POST['txt_sales_account'];
                $inventory_accid = $_POST['txt_inventory_accid'];
                $inventoty_adj_accid = $_POST['txt_inventoty_adj_accid'];
                $number = $_POST['txt_number'];
                $Code = $_POST['txt_Code'];
                $description = $_POST['txt_description'];
                $purchase_desc = $_POST['txt_purchase_desc'];
                $sale_desc = $_POST['txt_sale_desc'];
                $cost = $_POST['txt_cost'];
                $price = $_POST['txt_price'];


                $upd_obj->update_item($measurement, $vendor, $item_group, $item_category, $smallest_measurement, $sale_measurement, $purchase_measurement, $sales_account, $inventory_accid, $inventoty_adj_accid, $number, $Code, $description, $purchase_desc, $sale_desc, $cost, $price, $item_id);
                unset($_SESSION['table_to_update']);
            }
        } else {
            $measurement = trim($_POST['txt_measurement_id']);
            $vendor = trim($_POST['txt_vendor_id']);
            $item_group = trim($_POST['txt_item_group_id']);
            $item_category = trim($_POST['txt_item_category_id']);
            $smallest_measurement = $_POST['txt_smallest_measurement'];
            $sale_measurement = $_POST['txt_sale_measurement'];
            $purchase_measurement = $_POST['txt_purchase_measurement'];
            $sales_account = $_POST['txt_sales_account'];
            $inventory_accid = $_POST['txt_inventory_accid'];
            $inventoty_adj_accid = $_POST['txt_inventoty_adj_accid'];
            $number = $_POST['txt_number'];
            $Code = $_POST['txt_Code'];
            $description = $_POST['txt_description'];
            $purchase_desc = $_POST['txt_purchase_desc'];
            $sale_desc = $_POST['txt_sale_desc'];
            $cost = $_POST['txt_cost'];
            $price = $_POST['txt_price'];

            require_once '../web_db/new_values.php';
            $obj = new new_values();
            $obj->new_item($measurement, $vendor, $item_group, $item_category, $smallest_measurement, $sale_measurement, $purchase_measurement, $sales_account, $inventory_accid, $inventoty_adj_accid, $number, $Code, $description, $purchase_desc, $sale_desc, $cost, $price);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            item</title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>  <meta name="viewport" content="width=device-width, initial scale=1.0"/>
    </head>
    <body>
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <form action="new_item.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="txt_shall_expand_toUpdate" value="<?php echo (isset($_SESSION['table_to_update'])) ? trim($_SESSION['table_to_update']) : '' ?>" />
            <!--this field  (shall_expand_toUpdate)above is for letting the form expand using js for updating-->

            <input type="hidden" id="txt_measurement_id"   name="txt_measurement_id"/><input type="hidden" id="txt_vendor_id"   name="txt_vendor_id"/><input type="hidden" id="txt_item_group_id"   name="txt_item_group_id"/><input type="hidden" id="txt_item_category_id"   name="txt_item_category_id"/>
            <?php
                include 'admin_header.php';
            ?>

            <div class="parts eighty_centered no_paddin_shade_no_Border">  
                <div class="parts  no_paddin_shade_no_Border new_data_hider <?php echo without_admin(); ?>"> Hide </div>  
            </div>
            <div class="parts eighty_centered off saved_dialog">
                item saved successfully!</div>


            <div class="parts eighty_centered new_data_box off">
                <div class="parts eighty_centered ">  item</div>
                <table class="new_data_table">


                    <tr><td>Measurement </td><td> <?php get_measurement_combo(); ?>  </td></tr> <tr><td>Vendor </td><td> <?php get_vendor_combo(); ?>  </td></tr> <tr><td>Item Group </td><td> <?php get_item_group_combo(); ?>  </td></tr> <tr><td>Item Category </td><td> <?php get_item_category_combo(); ?>  </td></tr><tr><td><label for="txt_tuple">Smallest Measurement </label></td><td> <input type="text"     name="txt_smallest_measurement" required id="txt_smallest_measurement" class="textbox" value="<?php echo trim(chosen_smallest_measurement_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Sale Meausurement </label></td><td> <input type="text"     name="txt_sale_measurement" required id="txt_sale_measurement" class="textbox" value="<?php echo trim(chosen_sale_measurement_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Purchase Measurement </label></td><td> <input type="text"     name="txt_purchase_measurement" required id="txt_purchase_measurement" class="textbox" value="<?php echo trim(chosen_purchase_measurement_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Sales Account </label></td><td> <input type="text"     name="txt_sales_account" required id="txt_sales_account" class="textbox" value="<?php echo trim(chosen_sales_account_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Inventory Account </label></td><td> <input type="text"     name="txt_inventory_accid" required id="txt_inventory_accid" class="textbox" value="<?php echo trim(chosen_inventory_accid_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Inventory Adjustment Account </label></td><td> <input type="text"     name="txt_inventoty_adj_accid" required id="txt_inventoty_adj_accid" class="textbox" value="<?php echo trim(chosen_inventoty_adj_accid_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Number </label></td><td> <input type="text"     name="txt_number" required id="txt_number" class="textbox" value="<?php echo trim(chosen_number_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Code </label></td><td> <input type="text"     name="txt_Code" required id="txt_Code" class="textbox" value="<?php echo trim(chosen_Code_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Description </label></td><td> <input type="text"     name="txt_description" required id="txt_description" class="textbox" value="<?php echo trim(chosen_description_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Purchase description </label></td><td> <input type="text"     name="txt_purchase_desc" required id="txt_purchase_desc" class="textbox" value="<?php echo trim(chosen_purchase_desc_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Sale Description </label></td><td> <input type="text"     name="txt_sale_desc" required id="txt_sale_desc" class="textbox" value="<?php echo trim(chosen_sale_desc_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Cost </label></td><td> <input type="text"     name="txt_cost" required id="txt_cost" class="textbox" value="<?php echo trim(chosen_cost_upd()); ?>"   />  </td></tr>
                    <tr><td><label for="txt_tuple">Price </label></td><td> <input type="text"     name="txt_price" required id="txt_price" class="textbox" value="<?php echo trim(chosen_price_upd()); ?>"   />  </td></tr>


                    <tr><td colspan="2"> <input type="submit" class="confirm_buttons" name="send_item" value="Save"/>  </td></tr>
                </table>
            </div>

            <div class="parts eighty_centered datalist_box" >
                <div class="parts no_shade_noBorder xx_titles no_bg whilte_text">item List</div>
                <?php
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

                    $obj = new multi_values();
                    $first = $obj->get_first_item();
                    $obj->list_item($first);
                ?>
            </div>  
        </form>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="item" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_item.php" method="post">
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

    function get_measurement_combo() {
        $obj = new multi_values();
        $obj->get_measurement_in_combo();
    }

    function get_vendor_combo() {
        $obj = new multi_values();
        $obj->get_vendor_in_combo();
    }

    function get_item_group_combo() {
        $obj = new multi_values();
        $obj->get_item_group_in_combo();
    }

    function get_item_category_combo() {
        $obj = new multi_values();
        $obj->get_item_category_in_combo();
    }

    function chosen_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $measurement = new multi_values();
                return $measurement->get_chosen_item_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_vendor_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $vendor = new multi_values();
                return $vendor->get_chosen_item_vendor($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_item_group_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $item_group = new multi_values();
                return $item_group->get_chosen_item_item_group($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_item_category_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $item_category = new multi_values();
                return $item_category->get_chosen_item_item_category($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_smallest_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $smallest_measurement = new multi_values();
                return $smallest_measurement->get_chosen_item_smallest_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sale_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $sale_measurement = new multi_values();
                return $sale_measurement->get_chosen_item_sale_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_purchase_measurement_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $purchase_measurement = new multi_values();
                return $purchase_measurement->get_chosen_item_purchase_measurement($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sales_account_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $sales_account = new multi_values();
                return $sales_account->get_chosen_item_sales_account($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_inventory_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $inventory_accid = new multi_values();
                return $inventory_accid->get_chosen_item_inventory_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_inventoty_adj_accid_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $inventoty_adj_accid = new multi_values();
                return $inventoty_adj_accid->get_chosen_item_inventoty_adj_accid($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_number_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $number = new multi_values();
                return $number->get_chosen_item_number($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_Code_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $Code = new multi_values();
                return $Code->get_chosen_item_Code($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_description_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $description = new multi_values();
                return $description->get_chosen_item_description($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_purchase_desc_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $purchase_desc = new multi_values();
                return $purchase_desc->get_chosen_item_purchase_desc($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_sale_desc_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $sale_desc = new multi_values();
                return $sale_desc->get_chosen_item_sale_desc($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_cost_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $cost = new multi_values();
                return $cost->get_chosen_item_cost($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_price_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'item') {
                $id = $_SESSION['id_upd'];
                $price = new multi_values();
                return $price->get_chosen_item_price($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    