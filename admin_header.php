<?php
    require_once '../web_db/other_fx.php';
    $obj = new other_fx();
?>
<div class="parts pre_alert no_paddin_shade_no_Border link_cursor">
    <div class="pre_alert_box">
    </div>
</div>

<div class="parts  alert_pane details_box margin_free off">
    <div class="parts no_paddin_shade_no_Border no_shade_noBorder push_right data_details_pane_close_btn"></div>
    <div class="parts seventy_centered">
        <div class="parts full_center_two_h xxx_titles heit_free no_shade_noBorder no_paddin_shade_no_Border">
            <div class="parts icon_info no_paddin_shade_no_Border"></div>
            There are unfinished processes 
        </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border ">
            <div class="parts alert no_paddin_shade_no_Border margin_free">  </div>
            <div class="parts  margin_free issue_title">  
                Non reached sales quotations (<?php echo $obj->sale_ntfinished_quote_salesorder(); ?>)
            </div>
        </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border ">
            <div class="parts alert no_paddin_shade_no_Border margin_free">  </div>
            <div class="parts  margin_free issue_title">  
                Non reached sales order (<?php echo $obj->sale_ntfinished_salesorder_salesinvoice(); ?>)
            </div>
        </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border ">
            <div class="parts alert no_paddin_shade_no_Border margin_free">  </div>
            <div class="parts  margin_free issue_title">  
                Non reached sales invoices (<?php echo $obj->sale_ntfinished_salesinvoice_salesreceipt(); ?>)
            </div>
        </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border ">
            <div class="parts alert no_paddin_shade_no_Border margin_free">  </div>
            <div class="parts  margin_free issue_title">  
                Non reached Purchase request  (<?php echo $obj->pur_ntfinished_request_p_order(); ?>)
            </div>
        </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border ">
            <div class="parts alert no_paddin_shade_no_Border margin_free">  </div>
            <div class="parts  margin_free issue_title">  
                Non reached purchase  order  (<?php echo $obj->pur_ntfinished_p_order_p_invoice() ?>)
            </div>
        </div>
        <div class="parts full_center_two_h heit_free no_paddin_shade_no_Border">
            <div class="parts alert no_paddin_shade_no_Border margin_free">  </div>
            <div class="parts  margin_free issue_title">  
                Non reached purchase  invoices  (<?php echo $obj->pur_ntfinished_p_invoice_p_receit() ?>)
            </div>
        </div>
        <?php
            $p_req = $obj->pur_ntfinished_request_p_order();
            $p_order = $obj->pur_ntfinished_p_order_p_invoice();
            $p_invoice = $obj->pur_ntfinished_p_invoice_p_receit();

            $s_quote = $obj->sale_ntfinished_quote_salesorder();
            $s_order = $obj->sale_ntfinished_salesorder_salesinvoice();
            $s_invoice = $obj->sale_ntfinished_salesinvoice_salesreceipt();
            if (!empty($p_req) || !empty($p_order) || !empty($p_invoice) || !empty($s_quote) || !empty($s_order) || !empty($s_invoice)) {
                ?><script>
                            var startup = 0;
                            alert_it();
                            function alert_it() {
                                try {
                                    setTimeout(function () {
                                        startup += 1;
                                        if (startup > 5) {
                                            //    $('.alert').fadeIn().delay(500).fadeOut();
                                            $('.pre_alert').fadeIn().delay(500).fadeOut();

                                        }
                                        alert_it();
                                    }, 1000);
                                } catch (err) {
                                    alert(err.message);
                                }
                            }
                </script>
                <?php
            }

            show_alet_pane();

            function show_alet_pane() {
                $obj = new other_fx();
                $p_req = $obj->pur_ntfinished_request_p_order();
                $p_order = $obj->pur_ntfinished_p_order_p_invoice();
                $p_invoice = $obj->pur_ntfinished_p_invoice_p_receit();

                $s_quote = $obj->sale_ntfinished_quote_salesorder();
                $s_order = $obj->sale_ntfinished_salesorder_salesinvoice();
                $s_invoice = $obj->sale_ntfinished_salesinvoice_salesreceipt();
                return (!empty($p_req) || !empty($p_order) || !empty($p_invoice) || !empty($s_quote) || !empty($s_order) || !empty($s_invoice)) ? '' : 'off';
            }
        ?>
    </div>
</div>
<input type="hidden"  id="navigated_menu" class="push_right navigated_menu" style="float: right" value="<?php echo $res = (isset($_SESSION['menu_index'])) ? $_SESSION['menu_index'] : ''; ?>"/>
<div class=" parts margin_free no_paddin_shade_no_Border reverse_border left_drawer">
    <div class="parts abs_child close_lock off">
        Close
    </div>
    <a href="admin_dashboard.php">
        <div class="parts margin_free  no_paddin_shade_no_Border my_logo" > 
        </div>
    </a>

    <?php

        function without_admin() {
            return($_SESSION['cat'] != 'admin') ? '' : 'off';
        }

        function only_admin() {
            return ($_SESSION['cat'] == 'admin' || $_SESSION['cat'] == 'mates') ? '' : 'off';
        }

        function only_accountant() {
            return ($_SESSION['cat'] == 'accountant' || $_SESSION['cat'] == 'admin' || $_SESSION['cat'] == 'mates') ? '' : 'off';
        }

        function link_only_accountant() {
            return ($_SESSION['cat'] == 'accountant' || $_SESSION['cat'] == 'mates') ? '' : 'style="display:none;"';
        }

        function only_logistics() {
            return ( $_SESSION['cat'] == 'logistics' || $_SESSION['cat'] == 'mates') ? '' : 'off';
        }

        function link_only_logistics() {
            return ($_SESSION['cat'] == 'logistics' || $_SESSION['cat'] == 'mates') ? '' : 'style="display:none;';
        }

        function path_only_admin_report() {
            return ($_SESSION['cat'] == 'admin') ? 'admin_reports.php' : 'More_reports.php';
        }

        function path_only_admin_income() {
            return ($_SESSION['cat'] == 'admin') ? 'admin_report_inc_statemnt.php' : 'report_journal_entry.php';
        }
    ?>

    <!--start BUdget mgt-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_budgt <?php echo only_admin(); ?>" style="background-color: #1b0077;">
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_budgt">
            Budget Management
        </div>
        <span class="parts margin_free side_links_box off" id="span1">
            <a href="new_p_type_project.php">Budget Lines</a>
            <a href="new_p_budget_prep.php"> Budget Preparation</a>
            <a href="new_p_activity.php">Budget Activities</a>
        </span>
    </div>

    <!--start implimentation-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_implmnt <?php echo only_admin(); ?>" style="display: none;  background-color: #1b0077;">
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_prjct">
            Project Implementation
        </div>
        <span class="parts margin_free side_links_box off" id="span1">
            <a style="display: none;" href="new_p_project.php">Project</a> 
            <a href="new_p_request.php" style="display: none;">Requests</a>
            <a style="display: none;" href="new_bank.php">bank</a>
        </span>
    </div>

    <!--start finance-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_financ <?php echo only_accountant(); ?>" >
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_finace">
            Finance Books
        </div>
        <span class="parts margin_free side_links_box off">
            <a href="new_account.php">Chart of accounts</a>
            <a href="new_journal_entry_line.php">journal entry line</a>
            <a href="new_general_ledger_line.php">General Ledger  </a>
            <a href="report_cash_flow.php">Cash flow  </a>
            <a href="new_vat_calculation.php">VAT </a>
            <a href="report_acc_rec.php">Accounts Receivable</a>
            <a href="new_cheque.php">Cheques </a>
            <a href="rep_acc_pay.php">Accounts payable</a>
            <a href="report_journal_entry.php">Income Statement</a>
            <a style="display:none" href="new_contact.php">contact</a>
            <a style="display:none" href="new_account_class.php">account class</a>
            <a style="display:none" href="new_general_ledger_header.php" >general ledger header</a>
            <a style="display:none" href="new_journal_entry_header.php" >journal entry header</a>
            <a style="display:none" href="new_Payment_term.php">Payment term</a>
            <a style="display:none" href="new_item.php">Activity</a>
            <a style="display:none" href="new_item_group.php">Activities group</a>
            <a style="display:none" href="new_main_contra_account.php">main contra account</a>
        </span>
    </div>

    <!--start sales-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_sales">
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_sales">
            Sales
        </div>
        <span class="parts margin_free side_links_box off" id="span3">
            <a href="new_customer.php">Client</a>
            <a style="display: none;" href="new_sales_delivery_header.php">sales delivery header</a>
            <a style="display: none;" href="new_sales_invoice_header.php">sales invoice header</a>
            <a style="display: none;" href="new_sales_order_header.php">sales order header</a>
            <a href="new_sales_quote_line.php">quotation</a>
            <a href="new_sales_order_line.php"<?php echo link_only_accountant(); ?>>sales order  </a>
            <a style="display: none;" href="new_sale_delivery_line.php">sale delivery  </a>
            <a href="new_sales_invoice_line.php"<?php echo link_only_accountant(); ?>>sales invoice  </a>
            <a href="new_sales_receit_header.php"<?php echo link_only_accountant(); ?>>sales receipt  (Revenue)</a>
            <a style="display:none;" href="new_sales_quote_header.php">sales quote header</a>
            <a style="display:none;" href="new_sales_receit_header.php">sales receit header</a>
        </span>
    </div>


    <!--start purchases-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_purhcase" >
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_purchase ">
            Purchases
        </div>
        <span class="parts margin_free off" id="span4">
            <a href="new_vendor.php">Supplier</a>
            <a href="new_p_budget_items.php">Items</a>
            <a href="new_p_request.php" <?php echo link_only_logistics(); ?>>Request</a>
            <a  style="display: none;"href="new_purchase_invoice_header.php">purchase invoice header</a> 
            <a  style="display: none;"href="new_purchase_order_header.php">purchase order header</a> 
            <a  style="display: none;"href="new_purchase_receit_header.php">purchase receipt header</a>
            <a href="new_purchase_order_line.php" <?php echo link_only_accountant(); ?>>Purchase order  </a>   
            <a href="new_purchase_invoice_line.php" <?php echo link_only_accountant(); ?>>Purchase invoice  </a>
            <a href="new_purchase_receit_line.php" <?php echo link_only_accountant(); ?>>Purchase receipt   </a>
            <a href="new_payment_voucher.php" <?php echo link_only_accountant(); ?>>Payment Voucher   </a>

        </span>
    </div>  

    <!--start menu stock-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_stock <?php echo only_logistics(); ?>">
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_stock">
            Inventory Management
        </div>
        <span class="parts margin_free side_links_box off" id="span4">
            <a href="inventory_control/stock/new_p_budget_items.php">Items</a>

            <a href="inventory_control/stock/new_stock_into_main.php">(Main stock) Stock In</a>
            <a href="inventory_control/stock/new_stock_taking.php">Stock Movement</a>
            <a href="inventory_control/stock/new_small_stock.php">Small stock</a>
            <a href="inventory_control/stock/new_distriibution.php">Distribution</a>
            <a href="inventory_control/stock/new_main_stock.php">Main Stock status</a>
            <a href="inventory_control/stock/new_returns.php">Returns</a>
            <a href="inventory_control/stock/new_ditribution_small_stock.php">Small Stock Distributions</a>
            <a href="inventory_control/stock/new_p_request.php">Requests</a>
        </span>
    </div>


    <!--reporting-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_reporting" >
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_reporting">
            Reporting
        </div>
        <span class="parts margin_free side_links_box off">
            <a href="new_p_report_budg_prep.php" >Budget Preparation</a>
            <a href="new_budget_report.php">Budget Implementation</a>
            <a href="report_journal_entry.php">Income Statement</a>
            <a href="report_balanceshett.php">Balance sheet </a>
            <a href="report_acc_rec.php">Accounts Receivable</a>
            <a href="<?php echo path_only_admin_report(); ?>">Report Center</a>
        </span>
    </div>    

    <!--start setting-->
    <div class="parts margin_free main_link no_paddin_shade_no_Border main_link_settings <?php echo only_admin(); ?>" >
        <div class="parts full_center_two_h margin_free heit_free link_cursor link_tittle link_title_settings">
            Settings
        </div>
        <span class="parts margin_free side_links_box off" id="span4">
            <a href="new_role.php">Roles</a>
            <a href="new_user.php">User</a>
            <a href="new_p_field.php">Field</a>
            <a href="new_p_fiscal_year.php"> Fiscal Year</a>
            <a href="More_Settings.php"> More Settings</a>
        </span>
    </div>



    <div class="parts two_fifty_right heit_free no_paddin_shade_no_Border ">
        <a href="login.php">Login</a>
    </div>
</div>
<div class="parts  eighty_centered admin_header" id="my_header" style="margin-top: -10px;">    

</div>   
<div class="parts menu eighty_centered off">
    <a href="new_account.php">account</a>
    <a href="new_account_type.php">account_type</a>
    <a href="new_ledger_settings.php">ledger_settings</a>
    <a style="display: none;" href="new_bank.php">bank</a>
    <a href="new_account_class.php">account_class</a>
    <a href="new_general_ledger_line.php">general_ledger_line</a>
    <a href="new_main_contra_account.php">main_contra_account</a>
    <a href="new_sales_receit_header.php">sales_receit_header</a>
    <a href="new_measurement.php">measurement</a>
    <a href="new_journal_entry_line.php">journal_entry_line</a>
    <a href="new_tax.php">tax</a>
    <a href="new_vendor.php">vendor</a>
    <a href="new_general_ledger_header.php">general_ledger_header</a>
    <a href="new_party.php">party</a>
    <a href="new_contact.php">contact</a>
    <a href="new_customer.php">customer</a>
    <a href="new_taxgroup.php">taxgroup</a>
    <a href="new_journal_entry_header.php">journal_entry_header</a>
    <a href="new_Payment_term.php">Payment_term</a>
    <a href="new_item.php">item</a>
    <a href="new_item_group.php">item_group</a>
    <a href="new_item_category.php">item_category</a>
    <a href="new_vendor_payment.php">vendor_payment</a>
    <a href="new_sales_delivery_header.php">sales_delivery_header</a>
    <a href="new_sale_delivery_line.php">sale_delivery_line</a>
    <a href="new_sales_invoice_line.php">sales_invoice_line</a>
    <a href="new_sales_invoice_header.php">sales_invoice_header</a>
    <a href="new_sales_order_line.php">sales_order_line</a>
    <a href="new_sales_order_header.php">sales_order_header</a>
    <a href="new_sales_quote_line.php">sales_quote_line</a>
    <a href="new_sales_quote_header.php">sales_quote_header</a>
    <a href="new_sales_receit_header.php">sales_receit_header</a>
    <a href="new_purchase_invoice_header.php">purchase_invoice_header</a>
    <a href="new_purchase_invoice_line.php">purchase_invoice_line</a>
    <a href="new_purchase_order_header.php">purchase_order_header</a>
    <a href="new_purchase_order_line.php">purchase_order_line</a>
    <a href="new_purchase_receit_header.php">purchase_receit_header</a>
    <a href="new_purchase_receit_line.php">purchase_receit_line</a>
    <a href="new_Inventory_control_journal.php">Inventory_control_journal</a>
    <div class="parts two_fifty_right heit_free no_paddin_shade_no_Border">
        <a href="login.php">Login</a>
    </div>
</div>
<div class="parts eighty_centered bottom_bg margin_free no_paddin_shade_no_Border reverse_border control_menu">
    <a href="admin_dashboard.php">Home</a>
    <a href="#" class="hide_menu <?php echo only_accountant(); ?>">Hide/Show menu</a>
    <a href="new_p_request.php">Request</a>
    <a href="new_purchase_order_line.php">Purchase Order</a>
    <a href="new_sales_receit_header.php">Accounts Payable</a>
    <a href="new_purchase_receit_line.php">Accounts Receivable</a>
    <a href="../logout.php" style="float: right;margin-right: 50px;">Logout</a>
</div>
<div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder <?php echo only_accountant(); ?>" id="header2">
    <div class="parts two_fifty_left accept_abs link_cursor main_entry" id="pane_chart_acc">
        <div class="parts abs_child margin_free no_shade_noBorder r_icons" id="icon_acc">
        </div>
        Chart of account
    </div>
    <div class="parts two_fifty_left accept_abs link_cursor main_entry" id="pane_journal">
        <div class="parts abs_child margin_free no_shade_noBorder r_icons" id="icon_journal">
        </div>
        Journal
    </div>
    <div class="parts two_fifty_left accept_abs link_cursor main_entry off" id="pane_t_balance">
        <div class="parts abs_child margin_free no_shade_noBorder r_icons" id="icon_balance">
        </div>
        Trial Balance 
    </div>   <a href="report_journal_entry.php">
        <div class="parts two_fifty_left accept_abs link_cursor main_entry" id="pane_income_stmt">
            <div class="parts abs_child margin_free no_shade_noBorder r_icons" id="icon_income">
            </div>
            <!--This filed make the system know that the report of inco-->
            <input type="hidden" id="txt_admin_IS_rep" name="if_admin_incom_stmt" value="<?php echo path_only_admin_income(); ?>" />
            Income Statment
        </div></a>
    <div class="parts two_fifty_left accept_abs link_cursor main_entry" id="pane_b_sheet">
        <div class="parts abs_child margin_free no_shade_noBorder r_icons" id="icon_bs">
        </div>  Balance sheet
    </div><a href="report_cash_flow.php">
        <div class="parts two_fifty_left accept_abs link_cursor main_entry" id="pane_projects">
            <div class="parts abs_child margin_free no_shade_noBorder r_icons" id="icon_projects">
            </div>  Cash Flow  
        </div></a>
</div>
