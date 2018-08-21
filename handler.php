<?php
    session_start();

    if (isset($_POST['cbo_acc_type'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_acc_type_id_by_acc_type_name($_POST['cbo_acc_type']);
        return $id;
    }
    if (isset($_POST['cbo_acc_class'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_acc_class_id_by_acc_class_name($_POST['cbo_acc_class']);
        return $id;
    }
    if (isset($_POST['cbo_account'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_account_id_by_account_name($_POST['cbo_account']);
        return $id;
    }
    if (isset($_POST['cbo_general_ledge_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_general_ledge_header_id_by_general_ledge_header_name($_POST['cbo_general_ledge_header']);
        return $id;
    }
    if (isset($_POST['cbo_accountid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_accountid_id_by_accountid_name($_POST['cbo_accountid']);
        return $id;
    }
    if (isset($_POST['cbo_main_contra_acc'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_main_contra_acc_id_by_main_contra_acc_name($_POST['cbo_main_contra_acc']);
        return $id;
    }
    if (isset($_POST['cbo_customerid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customerid_id_by_customerid_name($_POST['cbo_customerid']);
        return $id;
    }
    if (isset($_POST['cbo_general_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_general_ledger_header_id_by_general_ledger_header_name($_POST['cbo_general_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_account'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_account_id_by_account_name($_POST['cbo_account']);
        return $id;
    }
    if (isset($_POST['cbo_customer'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customer_id_by_customer_name($_POST['cbo_customer']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_accountid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_accountid_id_by_accountid_name($_POST['cbo_accountid']);
        return $id;
    }
    if (isset($_POST['cbo_journal_entry_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_journal_entry_header_id_by_journal_entry_header_name($_POST['cbo_journal_entry_header']);
        return $id;
    }
    if (isset($_POST['cbo_sales_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_accid_id_by_sales_accid_name($_POST['cbo_sales_accid']);
        return $id;
    }
    if (isset($_POST['cbo_purchase_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_purchase_accid_id_by_purchase_accid_name($_POST['cbo_purchase_accid']);
        return $id;
    }
    if (isset($_POST['cbo_party'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_party_id_by_party_name($_POST['cbo_party']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_tax_group'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_tax_group_id_by_tax_group_name($_POST['cbo_tax_group']);
        return $id;
    }
    if (isset($_POST['cbo_party'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_party_id_by_party_name($_POST['cbo_party']);
        return $id;
    }
    if (isset($_POST['cbo_party_id'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_party_id_id_by_party_id_name($_POST['cbo_party_id']);
        return $id;
    }
    if (isset($_POST['cbo_contact'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_contact_id_by_contact_name($_POST['cbo_contact']);
        return $id;
    }
    if (isset($_POST['cbo_tax_group'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_tax_group_id_by_tax_group_name($_POST['cbo_tax_group']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_sales_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_accid_id_by_sales_accid_name($_POST['cbo_sales_accid']);
        return $id;
    }
    if (isset($_POST['cbo_acc_rec_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_acc_rec_accid_id_by_acc_rec_accid_name($_POST['cbo_acc_rec_accid']);
        return $id;
    }
    if (isset($_POST['cbo_party'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_party_id_by_party_name($_POST['cbo_party']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_vendor'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_vendor_id_by_vendor_name($_POST['cbo_vendor']);
        return $id;
    }
    if (isset($_POST['cbo_item_group'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_group_id_by_item_group_name($_POST['cbo_item_group']);
        return $id;
    }
    if (isset($_POST['cbo_item_category'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_category_id_by_item_category_name($_POST['cbo_item_category']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_sales_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_accid_id_by_sales_accid_name($_POST['cbo_sales_accid']);
        return $id;
    }
    if (isset($_POST['cbo_inventory_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_inventory_accid_id_by_inventory_accid_name($_POST['cbo_inventory_accid']);
        return $id;
    }
    if (isset($_POST['cbo_cost_good_sold_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_cost_good_sold_accid_id_by_cost_good_sold_accid_name($_POST['cbo_cost_good_sold_accid']);
        return $id;
    }
    if (isset($_POST['cbo_assembly_accid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_assembly_accid_id_by_assembly_accid_name($_POST['cbo_assembly_accid']);
        return $id;
    }
    if (isset($_POST['cbo_vendor'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_vendor_id_by_vendor_name($_POST['cbo_vendor']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_pur_invoice_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_pur_invoice_header_id_by_pur_invoice_header_name($_POST['cbo_pur_invoice_header']);
        return $id;
    }
    if (isset($_POST['cbo_customer'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customer_id_by_customer_name($_POST['cbo_customer']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_sales_delivery_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_delivery_header_id_by_sales_delivery_header_name($_POST['cbo_sales_delivery_header']);
        return $id;
    }
    if (isset($_POST['cbo_sales_invoice_line'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_invoice_line_id_by_sales_invoice_line_name($_POST['cbo_sales_invoice_line']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_sales_delivery_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_delivery_header_id_by_sales_delivery_header_name($_POST['cbo_sales_delivery_header']);
        return $id;
    }
    if (isset($_POST['cbo_sales_invoice_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_invoice_header_id_by_sales_invoice_header_name($_POST['cbo_sales_invoice_header']);
        return $id;
    }
    if (isset($_POST['cbo_sales_order_line'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_order_line_id_by_sales_order_line_name($_POST['cbo_sales_order_line']);
        return $id;
    }
    if (isset($_POST['cbo_customer'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customer_id_by_customer_name($_POST['cbo_customer']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_sales_order_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_order_header_id_by_sales_order_header_name($_POST['cbo_sales_order_header']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_customer'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customer_id_by_customer_name($_POST['cbo_customer']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_sales_quote_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_sales_quote_header_id_by_sales_quote_header_name($_POST['cbo_sales_quote_header']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_customer'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customer_id_by_customer_name($_POST['cbo_customer']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_customerid'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customerid_id_by_customerid_name($_POST['cbo_customerid']);
        return $id;
    }
    if (isset($_POST['cbo_general_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_general_ledger_header_id_by_general_ledger_header_name($_POST['cbo_general_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_account'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_account_id_by_account_name($_POST['cbo_account']);
        return $id;
    }
    if (isset($_POST['cbo_customer'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_customer_id_by_customer_name($_POST['cbo_customer']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_inv_control_journal'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_inv_control_journal_id_by_inv_control_journal_name($_POST['cbo_inv_control_journal']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_purchase_order_line'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_purchase_order_line_id_by_purchase_order_line_name($_POST['cbo_purchase_order_line']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_pur_invoice_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_pur_invoice_header_id_by_pur_invoice_header_name($_POST['cbo_pur_invoice_header']);
        return $id;
    }
    if (isset($_POST['cbo_pur_order_line'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_pur_order_line_id_by_pur_order_line_name($_POST['cbo_pur_order_line']);
        return $id;
    }
    if (isset($_POST['cbo_inventory_control_journal'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_inventory_control_journal_id_by_inventory_control_journal_name($_POST['cbo_inventory_control_journal']);
        return $id;
    }
    if (isset($_POST['cbo_vendor'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_vendor_id_by_vendor_name($_POST['cbo_vendor']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_payment_term'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_payment_term_id_by_payment_term_name($_POST['cbo_payment_term']);
        return $id;
    }
    if (isset($_POST['cbo_pur_order_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_pur_order_header_id_by_pur_order_header_name($_POST['cbo_pur_order_header']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_gen_ledger_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_gen_ledger_header_id_by_gen_ledger_header_name($_POST['cbo_gen_ledger_header']);
        return $id;
    }
    if (isset($_POST['cbo_pur_recceit_header'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_pur_recceit_header_id_by_pur_recceit_header_name($_POST['cbo_pur_recceit_header']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['cbo_Inventory_control_Journal'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_Inventory_control_Journal_id_by_Inventory_control_Journal_name($_POST['cbo_Inventory_control_Journal']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_measurement'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_measurement_id_by_measurement_name($_POST['cbo_measurement']);
        return $id;
    }
    if (isset($_POST['cbo_item'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $id = $obj->get_item_id_by_item_name($_POST['cbo_item']);
        return $id;
    }
    if (isset($_POST['table_to_update'])) {
        $id_upd = $_POST['id_update'];
        $table_upd = $_POST['table_to_update'];
        $pref = 'upd_';
        $sufx = $table_upd;
        $_SESSION['table_to_update'] = $table_upd;
        $_SESSION['id_upd'] = $id_upd;
        echo $_SESSION['id_upd'];
    }


//The Delete from account
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'account') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_account($id);
    }
//The Delete from account_type
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'account_type') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_account_type($id);
    }
//The Delete from ledger_settings
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'ledger_settings') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_ledger_settings($id);
    }
//The Delete from bank
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'bank') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_bank($id);
    }
//The Delete from account_class
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'account_class') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_account_class($id);
    }
//The Delete from general_ledger_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'general_ledger_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_general_ledger_line($id);
    }
//The Delete from main_contra_account
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'main_contra_account') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_main_contra_account($id);
    }
//The Delete from sales_receit_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_receit_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_receit_header($id);
    }
//The Delete from measurement
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'measurement') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_measurement($id);
    }
//The Delete from journal_entry_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'journal_entry_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_journal_entry_line($id);
    }
//The Delete from tax
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'tax') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_tax($id);
    }
//The Delete from vendor
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'vendor') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_vendor($id);
    }
//The Delete from general_ledger_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'general_ledger_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_general_ledger_header($id);
    }
//The Delete from party
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'party') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_party($id);
    }
//The Delete from contact
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'contact') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_contact($id);
    }
//The Delete from customer
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'customer') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_customer($id);
    }
//The Delete from taxgroup
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'taxgroup') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_taxgroup($id);
    }
//The Delete from journal_entry_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'journal_entry_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_journal_entry_header($id);
    }
//The Delete from Payment_term
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'Payment_term') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_Payment_term($id);
    }
//The Delete from item
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'item') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_item($id);
    }
//The Delete from item_group
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'item_group') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_item_group($id);
    }
//The Delete from item_category
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'item_category') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_item_category($id);
    }
//The Delete from vendor_payment
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'vendor_payment') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_vendor_payment($id);
    }
//The Delete from sales_delivery_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_delivery_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_delivery_header($id);
    }
//The Delete from sale_delivery_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sale_delivery_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sale_delivery_line($id);
    }
//The Delete from sales_invoice_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_invoice_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_invoice_line($id);
    }
//The Delete from sales_invoice_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_invoice_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_invoice_header($id);
    }
//The Delete from sales_order_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_order_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_order_line($id);
    }
//The Delete from sales_order_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_order_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_order_header($id);
    }
//The Delete from sales_quote_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_quote_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_quote_line($id);
    }
//The Delete from sales_quote_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_quote_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_quote_header($id);
    }
//The Delete from sales_receit_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'sales_receit_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_sales_receit_header($id);
    }
//The Delete from purchase_invoice_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'purchase_invoice_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_purchase_invoice_header($id);
    }
//The Delete from purchase_invoice_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'purchase_invoice_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_purchase_invoice_line($id);
    }
//The Delete from purchase_order_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'purchase_order_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_purchase_order_header($id);
    }
//The Delete from purchase_order_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'purchase_order_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_purchase_order_line($id);
    }
//The Delete from purchase_receit_header
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'purchase_receit_header') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_purchase_receit_header($id);
    }
//The Delete from purchase_receit_line
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'purchase_receit_line') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_purchase_receit_line($id);
    }
//The Delete from Inventory_control_journal
    if (isset($_POST['table_to_delete']) && $_POST['table_to_delete'] == 'Inventory_control_journal') {
        require_once '../web_db/deletions.php';
        $obj = new deletions();
        $id = $_POST['id_delete'];
        $obj->deleteFrom_Inventory_control_journal($id);
    }
    if (isset($_POST['pagination_n'])) {
        $_SESSION['pagination_n'] = $_POST['pagination_n'];
        $_SESSION['paginated_page'] = $_POST['paginated_page'];
        echo $_SESSION['paginated_page'];
    }
    if (isset($_POST['page_no_iteml'])) {
        unset($_SESSION['pagination_n']);
        $_SESSION['page_no_iteml'] = $_POST['page_no_iteml'];
        $_SESSION['paginated_page'] = $_POST['paginated_page'];
        echo $_SESSION['page_no_iteml'];
    }
    if (isset($_POST['accountid'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $obj->new_account($acc_type, $acc_class);
    }
    if (isset($_POST['sector_by_distr'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $res = $obj->specl_sectors_by_district($_POST['sector_by_distr']);
        echo $res;
    }
    if (isset($_POST['distr_by_prov'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        $res = $obj->specl_distr_by_prov($_POST['distr_by_prov']);
        echo $res;
    }
    if (isset($_POST['project_by_budget_line'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_project_by_project_line($_POST['project_by_budget_line']);
        echo $res;
    }
    if (isset($_POST['onfly_saving_p_budget_prep'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_project_type = $_POST['onfly_txt_project_type'];
        $onfly_txt_user = $_POST['onfly_txt_user'];
        $onfly_txt_entry_date = $_POST['onfly_txt_entry_date'];
        $onfly_txt_budget_type = $_POST['onfly_txt_budget_type'];
        $onfly_txt_activity_desc = $_POST['onfly_txt_activity_desc'];
        $onfly_txt_amount = $_POST['onfly_txt_amount'];
        $onfly_txt_name = $_POST['onfly_txt_name'];
        echo $obj->new_p_budget_prep($onfly_txt_project_type, $onfly_txt_user, $onfly_txt_entry_date, $onfly_txt_budget_type, $onfly_txt_activity_desc, $onfly_txt_amount, $onfly_txt_name);
    }
//When going from purchase order to invoice etc..
    if (isset($_POST['on_from_purchase_order_line'])) {
        $_SESSION['on_from_purchase_order_line'] = $_POST['on_from_purchase_order_line'];
    }
    if (isset($_POST['on_from_purchase_invoice_line'])) {
        $_SESSION['key_next_purchase_invoice_line'] = $_POST['on_from_purchase_invoice_line'];
    }
    if (isset($_POST['on_from_sales_invoice_line'])) {
        $_SESSION['key_next_sales_invoice_line'] = $_POST['on_from_sales_invoice_line'];
    }

    if (isset($_POST['get_items_by_request'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        echo $obj->get_items_by_request($_POST['get_items_by_request']);
    }
    if (isset($_POST['activities_by_project'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        echo $obj->get_activities_by_projectid($_POST['activities_by_project']);
    }

// <editor-fold defaultstate="collapsed" desc="---Budget----">
    if (isset($_POST['selected_activity'])) {
//        $_SESSION['selected_fisc_year'] = $_POST['selected_year'];
        $_SESSION['activity'] = $_POST['activity'];
        echo 'The activity is: ' . $_POST['activity'];
//  echo 'The fiscal year value:' . $_SESSION['selected_fisc_year'] . ' Activity: ' . $_SESSION['activity'];
    }
    if (isset($_POST['add_budget'])) {
        require_once '../web_db/new_values.php';
        $new_var = new new_values();
        $entry_date = date('y-m-d');
        $activity = $_POST['activity'];
        $unit_c = $_POST['unit_c'];
        $qty = $_POST['qty'];
        $mesrmt = $_POST['mesrmt'];
        $user = $_SESSION['userid'];
        $item_name = $_POST['item_name'];
        $new_var->new_p_budget('', $entry_date, 'yes', 'orginal', $activity, $unit_c, $qty, $mesrmt, $user, $item_name);
    }
    if (isset($_POST['act_by_proj'])) {
        require_once '../web_db/multi_values.php';
        $obj = new multi_values();
        echo $res = $obj->specl_activities_by_proj($_POST['act_by_proj']);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="---journal entry---">
    if (isset($_POST['save_account'])) {
        $of = new other_fx();
        $acc = $of->get_account_exist($_POST['save_account']);
        if (!empty($acc)) {
            ?><script>alert('The account is already in use, please use another account');</script><?php
        } else {
            $obj->new_account($acc_type, $acc_class, $name, $DrCrSide, $acc_code, $acc_desc, $is_cash, $is_contra_acc, $is_row_version);
            $m = new multi_values();
            $last_acc = $m->get_last_account();
//      $obj->new_account($acc_type, $acc_class, $name, $DrCrSide, $acc_code, $acc_desc, $is_cash, $is_contra_acc, $is_row_version);

            if (!empty($_POST['txt_if_save_Journal'])) {//if it is not income or expense category
                $amount = ($_POST['txt_end_balance_id'] > 0) ? $_POST['txt_end_balance_id'] : 0;
                $obj->new_journal_entry_line($last_acc, 'debit', $amount, '', 0);
                if (isset($_POST['sub_acc'])) {//sub account checkbox is selected
                    $sub_name = $_POST['acc_name_combo'];
                    $obj->new_main_contra_account($sub_name, $last_acc);
                }
            } else {
                if (isset($_POST['sub_acc'])) {//sub account checkbox is selected
                    $sub_name = $_POST['acc_name_combo'];
                    $obj->new_main_contra_account($sub_name, $last_acc);
                }
            }
            echo $_POST['end_balance'] . ' and ' . $_POST['end_balance'];
        }
    }
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="--- The combobox  refill on the fly">
    if (isset($_POST['on_from_p_type_project'])) {
        $_SESSION['key_next_p_type_project'] = $_POST['on_from_p_type_project'];
    }
    if (isset($_POST['on_from_p_fiscal_year'])) {
        $_SESSION['key_next_p_fiscal_year'] = $_POST['on_from_p_fiscal_year'];
    }
    if (isset($_POST['on_from_p_budget_items'])) {
        $_SESSION['key_next_p_budget_items'] = $_POST['on_from_p_budget_items'];
    }
    if (isset($_POST['on_from_account'])) {
        $_SESSION['key_next_account'] = $_POST['on_from_account'];
    }
    if (isset($_POST['on_from_supplier'])) {
        $_SESSION['key_next_supplier'] = $_POST['on_from_supplier'];
    }
    if (isset($_POST['on_from_customer'])) {
        $_SESSION['key_next_customer'] = $_POST['on_from_customer'];
    }
    if (isset($_POST['onfly_saving_measurement'])) {
        require_once '../web_db/new_values.php';
        $n = new new_values();
        echo $n->new_measurement($_POST['onfly_txt_code'], $_POST['txt_onfly_description']);
    }
    if (isset($_POST['on_from_p_activity'])) {
        $_SESSION['key_next_p_activity'] = $_POST['on_from_p_activity'];
    }
    if (isset($_POST['on_from_staff_positions'])) {
        $_SESSION['key_next_staff_positions'] = $_POST['on_from_staff_positions'];
    }
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="-----Insert on the fly handler-----">

    if (filter_has_var(INPUT_POST, 'onfly_saving_p_type_project')) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $onfly_txt_name = $_POST['onfly_txt_name'];
        echo $obj->new_p_type_project($onfly_txt_name);
    }

    if (isset($_POST['onfly_saving_p_fiscal_year'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_fiscal_year_name = $_POST['onfly_txt_fiscal_year_name'];
        $onfly_txt_fiscal_year_name = $_POST['onfly_txt_fiscal_year_name'];
        $onfly_txt_start_date = $_POST['onfly_txt_start_date'];
        $onfly_txt_end_date = $_POST['onfly_txt_end_date'];
        $onfly_txt_entry_date = $_POST['onfly_txt_entry_date'];
        $onfly_txt_account = $_POST['onfly_txt_account'];
        echo $obj->new_p_fiscal_year($onfly_txt_fiscal_year_name, $onfly_txt_fiscal_year_name, $onfly_txt_start_date, $onfly_txt_end_date, $onfly_txt_entry_date, $onfly_txt_account);
    }

    if (isset($_POST['onfly_saving_p_budget_items'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_item_name = $_POST['onfly_txt_item_name'];
        $onfly_txt_description = $_POST['onfly_txt_description'];
        $onfly_txt_created_by = $_POST['onfly_txt_created_by'];
        $onfly_txt_entry_date = $_POST['onfly_txt_entry_date'];
        $onfly_txt_chart_account = $_POST['onfly_txt_chart_account'];
        echo $obj->new_p_budget_items($onfly_txt_item_name, $onfly_txt_description, $onfly_txt_created_by, $onfly_txt_entry_date, $onfly_txt_chart_account);
    }

    if (isset($_POST['onfly_saving_account'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_acc_type = $_POST['onfly_txt_acc_type'];
        $onfly_txt_acc_class = $_POST['onfly_txt_acc_class'];
        $onfly_txt_name = $_POST['onfly_txt_name'];
        $onfly_txt_DrCrSide = $_POST['onfly_txt_DrCrSide'];
        $onfly_txt_acc_code = $_POST['onfly_txt_acc_code'];
        $onfly_txt_acc_desc = $_POST['onfly_txt_acc_desc'];
        $onfly_txt_is_cash = $_POST['onfly_txt_is_cash'];
        $onfly_txt_is_contra_acc = $_POST['onfly_txt_is_contra_acc'];
        $onfly_txt_is_row_version = $_POST['onfly_txt_is_row_version'];
        echo $obj->new_account($onfly_txt_acc_type, $onfly_txt_acc_class, $onfly_txt_name, $onfly_txt_DrCrSide, $onfly_txt_acc_code, $onfly_txt_acc_desc, $onfly_txt_is_cash, $onfly_txt_is_contra_acc, $onfly_txt_is_row_version);
    }

    if (isset($_POST['onfly_saving_supplier'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_party = $_POST['onfly_txt_party'];
        echo $obj->new_supplier($onfly_txt_party);
    }

    if (isset($_POST['onfly_saving_customer'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_party_id = $_POST['onfly_txt_party_id'];
        $onfly_txt_contact = $_POST['onfly_txt_contact'];
        $onfly_txt_number = $_POST['onfly_txt_number'];
        $onfly_txt_tax_group = $_POST['onfly_txt_tax_group'];
        $onfly_txt_payment_term = $_POST['onfly_txt_payment_term'];
        $onfly_txt_sales_accid = $_POST['onfly_txt_sales_accid'];
        $onfly_txt_acc_rec_accid = $_POST['onfly_txt_acc_rec_accid'];
        $onfly_txt_promp_pyt_disc_accid = $_POST['onfly_txt_promp_pyt_disc_accid'];
        echo $obj->new_customer($onfly_txt_party_id, $onfly_txt_contact, $onfly_txt_number, $onfly_txt_tax_group, $onfly_txt_payment_term, $onfly_txt_sales_accid, $onfly_txt_acc_rec_accid, $onfly_txt_promp_pyt_disc_accid);
    }

    if (isset($_POST['onfly_saving_measurement'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_code = $_POST['onfly_txt_code'];
        $onfly_txt_description = $_POST['onfly_txt_description'];
        echo $obj->new_measurement($onfly_txt_code, $onfly_txt_description);
    }

    if (isset($_POST['onfly_saving_p_activity'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();
        $onfly_txt_project = $_POST['onfly_txt_project'];
        $onfly_txt_name = $_POST['onfly_txt_name'];
        $onfly_txt_fisc_year = $_POST['onfly_txt_fisc_year'];
        echo $obj->new_p_activity($onfly_txt_project, $onfly_txt_name, $onfly_txt_fisc_year);
    }

    if (isset($_POST['onfly_saving_staff_positions'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_name = $_POST['onfly_txt_name'];
        echo $obj->new_staff_positions($onfly_txt_name);
    }

    if (isset($_POST['onfly_saving_p_project'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_name = $_POST['onfly_txt_name'];
        echo $obj->new_p_project($onfly_txt_name);
    }

    if (isset($_POST['onfly_saving_p_budget_items'])) {
        require_once '../web_db/new_values.php';
        $obj = new new_values();

        $onfly_txt_item_name = $_POST['onfly_txt_item_name'];
        $onfly_txt_description = $_POST['onfly_txt_description'];
        $onfly_txt_created_by = $_POST['onfly_txt_created_by'];
        $onfly_txt_entry_date = $_POST['onfly_txt_entry_date'];
        $onfly_txt_chart_account = $_POST['onfly_txt_chart_account'];
        echo $obj->new_p_budget_items($onfly_txt_item_name, $onfly_txt_description, $onfly_txt_created_by, $onfly_txt_entry_date, $onfly_txt_chart_account);
    }

    // <editor-fold defaultstate="collapsed" desc="-----Refill on the fly-----">
    //REfill Handler
    //--------------- 
    if (isset($_POST['refill_cbo_p_type_project'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_p_type_project();
        echo $res;
    }
    if (isset($_POST['refill_cbo_p_fiscal_year'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_p_fiscal_year();
        echo $res;
    }
    if (isset($_POST['refill_cbo_p_budget_items'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_p_budget_items();
        echo $res;
    }
    if (isset($_POST['refill_cbo_account'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_account();
        echo $res;
    }
    if (isset($_POST['refill_cbo_supplier'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_supplier();
        echo $res;
    }
    if (isset($_POST['refill_cbo_customer'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_customer();
        echo $res;
    }
    if (isset($_POST['refill_cbo_measurement'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_measurement();
        echo $res;
    }
    if (isset($_POST['refill_cbo_p_activity'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_p_activity();
        echo $res;
    }
    if (isset($_POST['refill_cbo_staff_positions'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_staff_positions();
        echo $res;
    }
    if (isset($_POST['refill_cbo_p_budget_prep'])) {
        require_once '../web_db/other_fx.php';
        $obj = new other_fx();
        $res = $obj->get_cbo_refilled_p_budget_prep();
        echo $res;
    }


// </editor-fold>
    if (isset($_POST['menu_index'])) {
        $_SESSION['menu_index'] = $_POST['menu_index'];
    }
    if (isset($_POST['get_menu_index'])) {
        echo $_SESSION['menu_index'];
    }

    // <editor-fold defaultstate="collapsed" desc="----- Continuos form ----">

    if (filter_has_var(INPUT_POST, 'get_on_salesorder_from_quototion')) {
        require_once '../web_db/Continuos_form.php';
        $other = new Continuos_form();
        $id = filter_input(INPUT_POST, 'get_on_salesorder_from_quototion');
        $other->get_on_salesorder_from_quototion($id);
    }
    if (filter_has_var(INPUT_POST, 'get_on_salesinvoice_from_saleorder')) {
        require_once '../web_db/Continuos_form.php';
        $other = new Continuos_form();
        $saleorder = filter_input(INPUT_POST, 'get_on_salesinvoice_from_saleorder');
        $other->get_on_salesinvoice_from_saleorder($saleorder);
    }
    if (filter_has_var(INPUT_POST, 'get_on_salesreceit_fromsaleinvoice')) {
        require_once '../web_db/Continuos_form.php';
        $other = new Continuos_form();
        $invoice = filter_input(INPUT_POST, 'get_on_salesreceit_fromsaleinvoice');
        $other->get_on_salesreceit_fromsaleinvoice($invoice);
    }
    if (filter_has_var(INPUT_POST, 'get_on_purchaseorder_from_request')) {
        require_once '../web_db/Continuos_form.php';
        $other = new Continuos_form();
        $request = filter_input(INPUT_POST, 'get_on_purchaseorder_from_request');
        $other->get_on_purchaseorder_from_request($request);
    }
    if (filter_has_var(INPUT_POST, 'get_on_purchaseinvpoice_from_purchaseorder')) {
        require_once '../web_db/Continuos_form.php';
        $other = new Continuos_form();
        $porder = filter_input(INPUT_POST, 'get_on_purchaseinvpoice_from_purchaseorder');
        $other->get_on_purchaseinvpoice_from_purchaseorder($porder);
    }
    if (filter_has_var(INPUT_POST, 'get_on_purchasereceit_from_p_invoice')) {
        require_once '../web_db/Continuos_form.php';
        $other = new Continuos_form();
        $invoice = filter_input(INPUT_POST, 'get_on_purchasereceit_from_p_invoice');
        $other->get_on_purchasereceit_from_p_invoice($invoice);
    }

// </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="---- Details by click ------">
    if (filter_has_var(INPUT_POST, 'p_type_project_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_type_project($id);
    }
    if (filter_has_var(INPUT_POST, 'account_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_account($id);
    }
    if (filter_has_var(INPUT_POST, 'account_type_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_account_type($id);
    }
    if (filter_has_var(INPUT_POST, 'ledger_settings_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_ledger_settings($id);
    }
    if (filter_has_var(INPUT_POST, 'bank_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_bank($id);
    }
    if (filter_has_var(INPUT_POST, 'account_class_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_account_class($id);
    }
    if (filter_has_var(INPUT_POST, 'general_ledger_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_general_ledger_line($id);
    }
    if (filter_has_var(INPUT_POST, 'main_contra_account_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_main_contra_account($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_receit_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_receit_header($id);
    }
    if (filter_has_var(INPUT_POST, 'measurement_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_measurement($id);
    }
    if (filter_has_var(INPUT_POST, 'journal_entry_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_journal_entry_line($id);
    }
    if (filter_has_var(INPUT_POST, 'tax_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_tax($id);
    }
    if (filter_has_var(INPUT_POST, 'vendor_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_vendor($id);
    }
    if (filter_has_var(INPUT_POST, 'general_ledger_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_general_ledger_header($id);
    }
    if (filter_has_var(INPUT_POST, 'party_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_party($id);
    }
    if (filter_has_var(INPUT_POST, 'contact_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_contact($id);
    }
    if (filter_has_var(INPUT_POST, 'customer_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_customer($id);
    }
    if (filter_has_var(INPUT_POST, 'taxgroup_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_taxgroup($id);
    }
    if (filter_has_var(INPUT_POST, 'journal_entry_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_journal_entry_header($id);
    }
    if (filter_has_var(INPUT_POST, 'Payment_term_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_Payment_term($id);
    }
    if (filter_has_var(INPUT_POST, 'item_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_item($id);
    }
    if (filter_has_var(INPUT_POST, 'item_group_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_item_group($id);
    }
    if (filter_has_var(INPUT_POST, 'item_category_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_item_category($id);
    }
    if (filter_has_var(INPUT_POST, 'vendor_payment_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_vendor_payment($id);
    }
    if (filter_has_var(INPUT_POST, 'sale_delivery_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sale_delivery_line($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_invoice_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_invoice_line($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_invoice_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_invoice_header($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_order_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_order_line($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_order_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_order_header($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_quote_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_quote_line($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_quote_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_quote_header($id);
    }
    if (filter_has_var(INPUT_POST, 'sales_receit_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_sales_receit_header($id);
    }
    if (filter_has_var(INPUT_POST, 'purchase_invoice_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_purchase_invoice_header($id);
    }
    if (filter_has_var(INPUT_POST, 'purchase_invoice_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_purchase_invoice_line($id);
    }
    if (filter_has_var(INPUT_POST, 'purchase_order_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_purchase_order_header($id);
    }
    if (filter_has_var(INPUT_POST, 'purchase_order_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_purchase_order_line($id);
    }
    if (filter_has_var(INPUT_POST, 'purchase_receit_header_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_purchase_receit_header($id);
    }
    if (filter_has_var(INPUT_POST, 'purchase_receit_line_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_purchase_receit_line($id);
    }
    if (filter_has_var(INPUT_POST, 'Inventory_control_journal_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_Inventory_control_journal($id);
    }
    if (filter_has_var(INPUT_POST, 'user_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_user($id);
    }
    if (filter_has_var(INPUT_POST, 'role_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_role($id);
    }
    if (filter_has_var(INPUT_POST, 'staff_positions_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_staff_positions($id);
    }
    if (filter_has_var(INPUT_POST, 'request_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_request($id);
    }
    if (filter_has_var(INPUT_POST, 'supplier_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_supplier($id);
    }
    if (filter_has_var(INPUT_POST, 'client_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_client($id);
    }
    if (filter_has_var(INPUT_POST, 'p_budget_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_p_budget($id);
    }
    if (filter_has_var(INPUT_POST, 'p_activity_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_p_activity($id);
    }
    if (filter_has_var(INPUT_POST, 'Main_Request_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_Main_Request($id);
    }
    if (filter_has_var(INPUT_POST, 'p_budget_prep_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_p_budget_prep($id);
    }
    if (filter_has_var(INPUT_POST, 'payment_voucher_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_payment_voucher($id);
    }
    if (filter_has_var(INPUT_POST, 'delete_update_permission_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_delete_update_permission($id);
    }
    if (filter_has_var(INPUT_POST, 'stock_taking_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_stock_taking($id);
    }
    if (filter_has_var(INPUT_POST, 'p_budget_items_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_p_budget_items($id);
    }
    if (filter_has_var(INPUT_POST, 'p_request_details_click')) {
        require_once '../web_db/Details_by_click.php';
        $obj = new Details_by_click();
        $id = filter_input(INPUT_POST, 'id');
        echo $obj->det_by_click_p_request($id);
    }
// </editor-fold>

    if (filter_has_var(INPUT_POST, 'save_formular')) {
        require_once '../web_db/new_values.php';
        require_once '../web_db/other_fx.php';
        $m = new other_fx();
        $new = new new_values();

        $current_formula = filter_input(INPUT_POST, 'current_formula');
        $found_tax = $m->get_tax_formula_exits($current_formula);
        $self = filter_input(INPUT_POST, 'self');
        $sign = filter_input(INPUT_POST, 'sign');
        $left_val = filter_input(INPUT_POST, 'left_val');
        $right_val = filter_input(INPUT_POST, 'right_val');
        $selfid = ($self == 'yes' && !empty($found_tax)) ? $current_formula : '0';

//        $self = (filter_input(INPUT_POST, 'selfid') == 'yes') ? filter_input(INPUT_POST, 'selfid') : '';
        $new->new_tax_calculations($selfid, $left_val, $right_val, $sign, $selfid, $group_type, $current_formula, $valued);
    }
    if (filter_has_var(INPUT_POST, 'tax_exstis')) {
        require_once '../web_db/other_fx.php';
        $m = new other_fx();
        return $found_tax = $m->get_tax_formula_exits($current_formula);
    }