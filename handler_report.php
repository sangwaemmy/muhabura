<?php
    session_start();
    /**
     * Description of handler_report
     *
     * SANGWA 
     */

 if (filter_has_var(INPUT_POST, 'rep_date_cbo')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $min_date = date("Y-m-d");
        $max_date =  date("Y-m-d");;
        $_SESSION['min_date'] = $min_date;
        $_SESSION['max_date'] = $max_date;
          echo $_SESSION['min_date'].'   '.$_SESSION['max_date'];

   }


    if (filter_has_var(INPUT_POST, 'report_item_stock')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $report_item_stock = filter_input(INPUT_POST, 'report_item_stock');
        echo $obj->search_item_main_stock($report_item_stock);
    }
    if (filter_has_var(INPUT_POST, 'report_budget_lines')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $min_date = filter_input(INPUT_POST, 'min_date');
        $max_date = filter_input(INPUT_POST, 'max_date');
        $_SESSION['min_date'] = $min_date;
        $_SESSION['max_date'] = $max_date;
        $report_budget_lines = filter_input(INPUT_POST, 'report_budget_lines');
        echo $obj->list_p_budget_prep_by_2_dates($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'report_income_statement')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $min_date = filter_input(INPUT_POST, 'min_date');
        $max_date = filter_input(INPUT_POST, 'max_date');
        $_SESSION['min_date'] = $min_date;
        $_SESSION['max_date'] = $max_date;
        $report_budget_lines = filter_input(INPUT_POST, 'report_budget_lines');
        echo $obj->list_journal_entry_line_by_2_dates('Income', $min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'report_balance')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $min_date = filter_input(INPUT_POST, 'min_date');
        $max_date = filter_input(INPUT_POST, 'max_date');
        $_SESSION['min_date'] = $min_date;
        $_SESSION['max_date'] = $max_date;
        $report_balance = filter_input(INPUT_POST, 'report_balance');
        echo $obj->list_assets_by_2_dates($min_date, $max_date);
    } else if (filter_has_var(INPUT_POST, 'report_purchases')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $min_date = filter_input(INPUT_POST, 'min_date');
        $max_date = filter_input(INPUT_POST, 'max_date');
        $_SESSION['min_date'] = $min_date;
        $_SESSION['max_date'] = $max_date;
        echo $obj->list_purchase_receit_line_by_2_dates($min_date, $max_date);
    } else if (filter_has_var(INPUT_POST, 'report_sales')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $min_date = filter_input(INPUT_POST, 'min_date');
        $max_date = filter_input(INPUT_POST, 'max_date');
        $_SESSION['min_date'] = $min_date;
        $_SESSION['max_date'] = $max_date;
        echo $obj->list_sales_receit_header($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'get_locations_by_budgetid')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $type = filter_input(INPUT_POST, 'get_locations_by_budgetid');
        $_SESSION['report_budgetid'] = $type; //this is the id
        $_SESSION['proj_name'] = $name = filter_input(INPUT_POST, 'name');
        echo $obj->det_by_click_type_project_admin($type);
    }
    if (filter_has_var(INPUT_POST, 'get_budgets_by_location_id')) {
        require_once '../web_db/Reports.php';
        $obj = new Reports();
        $budgets_by_location = filter_input(INPUT_POST, 'get_budgets_by_location_id');
        $_SESSION['report_locationid'] = $budgets_by_location;
        $loc_name = filter_input(INPUT_POST, 'loc_name');
        $_SESSION['field_name'] = $loc_name;
        $obj->det_by_click_type_project_admin($budgets_by_location);
    }

    if (filter_has_var(INPUT_POST, 'the_rep_dates')) {
        $the_rep_dates = filter_input(INPUT_POST, 'the_rep_dates');
        $_SESSION['rep_min_date'] = filter_input(INPUT_POST, 'date1');
        $_SESSION['rep_max_date'] = filter_input(INPUT_POST, 'date2');

        //Lest us just verigy of the dates are well received
        echo 'The date 1 is ' . $_SESSION['rep_min_date'] . '  and the date 2 is: ' . $_SESSION['rep_max_date'];



        if ($the_rep_dates == 'income') {
            
        } else if ($the_rep_dates == 'balance') {
            
        } else if ($the_rep_dates == 'cash') {
            
        }
    }

    //Financial reports details. These are the dtails that come once clicked the balance sheet, income statement and cash flow
    //The balance sheet
    if (filter_has_var(INPUT_POST, 'inc_cash')) {//inc meand income
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        echo $other->list_fixed_assets_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_acc_rec')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        echo $other->list_acc_rec_by_date($min_date, $max_date);
//        echo $other->
    }
    if (filter_has_var(INPUT_POST, 'inc_acc_pay')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();

        echo $other->list_acc_pay_by_date($min_date, $max_date);
//        echo $other->
    }
    if (filter_has_var(INPUT_POST, 'inc_accrued_expe')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_acrued_exp_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_income_tx')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_acrued_exp_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_current_portion')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_currentportion_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_longterm_debt')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_longterm_debt_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_capital_stock')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_capital_stock_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_inventory')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        echo $other->list_inventory_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_prep_expense')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        echo $other->list_prep_exp_by_date($min_date, $max_date);
    }


    if (filter_has_var(INPUT_POST, 'inc_other_c_assets')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        echo $other->list_other_current_asset_by_date($min_date, $max_date);
    }

    if (filter_has_var(INPUT_POST, 'inc_fixed_assets')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        echo $other->list_fixed_assets_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'inc_accumulated_deprec')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_acc_depreciation_by_date($min_date, $max_date);
    }

    //The cash flow

    if (filter_has_var(INPUT_POST, 'ch_fl_cash')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_cash_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'ch_fl_cash_receit')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_cash_receipt_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'ch_fl_disbursemt')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_disbursement_receipt_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'ch_fl_fixed_asst')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
//        $other->list_fixed_assets_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'ch_fl_net_borow')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_sum_net_borrowing_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'ch_fl_incom_tx')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        //this involves tax that will be calculated by accountant
        $other->list_fixed_assets_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'ch_fl_sale_stock')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_sales_stock_by_date($min_date, $max_date);
    }

    //Income statement
    if (filter_has_var(INPUT_POST, 'balnc_sales_revenue')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_sum_income_or_expenses('income');
    }
    if (filter_has_var(INPUT_POST, 'balnc_cogs')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        require_once '../web_db/Reports.php';
        $rep = new Reports();
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        //Here we calculate the opening stock + purchases-ending stock;
        ////
        //This is opening stock 
//        echo $rep->list_openingstock_by_date($min_date, $max_date);
        //This is the closing stock
        //
//      echo $rep->list_closingstock_by_date($min_date, $max_date);
        //This is the ending stock;
        echo $other->list_cogs_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'balnc_research')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_research_dev_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'balnc_gen_exp')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_gen_expe_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'balnc_income_op')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_sales_stock_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'balnc_interest_income')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
    }
    if (filter_has_var(INPUT_POST, 'balnc_income_tx')) {
        require_once '../web_db/multi_values.php';
        require_once '../web_db/other_fx.php';
        $obj = new multi_values();
        $other = new other_fx();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $other->list_sales_stock_by_date($min_date, $max_date);
    }

    if (filter_has_var(INPUT_POST, 'full_book_income_statement')) {
        require_once '../web_db/Reports.php';
        require_once '../web_db/other_fx.php';

        $other = new other_fx();
        $rep = new Reports();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $rep->list_full_income_stmt_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'full_book_balance_sheet')) {
        require_once '../web_db/Reports.php';
        require_once '../web_db/other_fx.php';
        $other = new other_fx();
        $rep = new Reports();
        $min_date = $other->get_this_year_start_date();
        $max_date = $other->get_this_year_end_date();
        $rep->list_full_balancesheet_by_date($min_date, $max_date);
    }
    if (filter_has_var(INPUT_POST, 'full_book_cashflow')) {
        
    }
