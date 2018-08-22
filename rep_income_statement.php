<?php

    require_once 'Fpdf/fpdf.php';
    require_once '../web_db/multi_values.php';
    require_once '../web_db/connection.php';
    require_once '../web_db/other_fx.php';
    require_once '../web_db/Reports.php';
    class PDF extends FPDF {

// Load data
        function LoadData() {
            // Read file lines

            $date_obj = new other_fx();
            $min_date = $date_obj->get_this_year_start_date();
            $max_date = $date_obj->get_this_year_end_date();


            $database = new dbconnection();
            $db = $database->openconnection();
            $this->Image('../web_images/report_header.png');
            $this->Ln();
            $this->Ln();
            $this->SetFont("Arial", 'B', 11);
            $this->Cell(170, 7, 'INCOME STATEMENT REPORT FROM ' . $min_date . '  TO ' . $max_date, 0, 0, 'C');

            $this->SetFont("Arial", 'B', 11);
            $this->Ln();
            $this->Ln();
            $this->Cell(50, 7, 'Sales revenues ', 0, 0, 'L');
            $this->cell(10, 7, 1, 0, 0, 'L');
            $this->SetFont("Arial", '', 10);
            $this->Ln();
            //sales revenues
            //
         // <editor-fold defaultstate="collapsed" desc="-----------revenues-----------">
            $rev_sql = "select account.name, journal_entry_line.amount  from account
                        join journal_entry_line on journal_entry_line.accountid=account.account_id
                        join account_type on account.acc_type=account_type.account_type_id 
                        
                        where account_type.name='income'";


            foreach ($db->query($rev_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');

                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
// </editor-fold>
            //Cost of good sold
            // <editor-fold defaultstate="collapsed" desc="-----------Cost of good sold">
            $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Cost Of Good Sold'";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, "Cost Of Good Sold", 0, 0, 'L');
            $this->cell(10, 7, 2, 0, 0, 'L');
            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($cogs_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
// </editor-fold>
            //
            //GROSS MARGIN
            //
            require_once '../web_db/other_fx.php';
            $ob = new other_fx();
            $gross_m_sql = $ob->get_sum_income_or_expenses('income') - $ob->get_sum_cogs_by_date($min_date, $max_date);
            $this->Ln();
            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "GROSS MARGIN", 0, 0, 'L');

            $this->Cell(60, 7, $gross_m_sql, 0, 0, 'R');

            //Research and research
            //  $this->SetFont("Arial", 'B', 11);
            $this->Ln();
            $this->Ln();
            $this->cell(50, 7, "Research and Develpment", 0, 0, 'L');

            $this->cell(10, 7, 4, 0, 0, 'L');

            $research_sql = "   select account.name  ,  journal_entry_line.amount , journal_entry_line.memo, journal_entry_line.entry_date from account               
                                join journal_entry_line on journal_entry_line.accountid=account.account_id
                                join account_type on account.acc_type=account_type.account_type_id   
                                where account_type.name='Other Expense' 
                                -- and journal_entry_line.entry_date>=:min_date and journal_entry_line.entry_date<=:max_date";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }

            //General administrative
            $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "General and administrative", 0, 0, 'L');
            $this->cell(10, 7, 5, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "   select account.name  ,  journal_entry_line.amount , journal_entry_line.memo, journal_entry_line.entry_date from account               
                                join journal_entry_line on journal_entry_line.accountid=account.account_id
                                join account_type on account.acc_type=account_type.account_type_id   
                                where account_type.name='Expense' 
                                -- and journal_entry_line.entry_date>=:min_date and journal_entry_line.entry_date<=:max_date";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }


            $this->Ln();
            $this->Ln();
            $this->SetFont("Arial", 'B', 10);
            $this->cell(30, 7, "OPERATING EXPENSES", 0, 0, 'L');
            // update from bojos 
            //Interest income
            $this->Ln();
            $this->Ln();
            $this->cell(50, 7, "Interest income", 0, 0, 'L');
            $this->cell(10, 7, 6, 0, 0, 'L');
              $research_sql = "   select account.name  ,  journal_entry_line.amount , journal_entry_line.memo, journal_entry_line.entry_date from account               
                                join journal_entry_line on journal_entry_line.accountid=account.account_id
                                join account_type on account.acc_type=account_type.account_type_id   
                                where account.name='Interest Income' 
                                -- and journal_entry_line.entry_date>=:min_date and journal_entry_line.entry_date<=:max_date";
            //$this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
// update from bojos 
            //Income tax
            $this->Ln();
            $this->SetFont("Arial", 'B', 10);
            $this->cell(50, 7, "Income Tax", 0, 0, 'L');
            $this->cell(10, 7, 7, 0, 0, 'L');
  $research_sql = "   select account.name  ,  journal_entry_line.amount , journal_entry_line.memo, journal_entry_line.entry_date from account               
                                join journal_entry_line on journal_entry_line.accountid=account.account_id
                                join account_type on account.acc_type=account_type.account_type_id   
                                where account.name='Income Tax' 
                                -- and journal_entry_line.entry_date>=:min_date and journal_entry_line.entry_date<=:max_date";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }

            //net income
            $this->Ln();
            $this->cell(30, 7, "NET INCOME", 0, 0, 'L');

            $tot_inc_exp = new other_fx();
            $stock = new Reports();
            $sum_income = $tot_inc_exp->get_sum_income_or_expenses('income');
            $sum_expense = $tot_inc_exp->get_sum_income_or_expenses('expense');
            $net = $sum_income - $sum_expense;
            $obj = new multi_values();
            $other = new other_fx();
            $first = $obj->get_first_journal_entry_line();

            $start_date = $other->get_this_year_start_date();
            $end_date = $other->get_this_year_end_date();
            $opening_stock = $stock->get_opening_stock($start_date, $end_date);
            $closing_stock = $stock->get_closing_stock($start_date, $end_date);
            $purchase_ofperiod = $stock->get_purchases_ofPeriod($start_date, $end_date);

            $gen_expenses = $other->get_sum_gen_expe_by_date($start_date, $end_date);
            $sum_research_dev = $other->get_research_dev_by_date($start_date, $end_date);
//            $tot_cogs = $opening_stock + $purchase_ofperiod - $closing_stock; //This is wrong
            $tot_cogs = $other->get_sum_cogs_by_date($start_date, $end_date);
            $sum_gross_margin = $sum_income - $tot_cogs;

            $gross_profit = $sum_income + $tot_cogs;
            $tot_op_expense = $sum_gross_margin - $tot_cogs;// these are the operating exp.
            $sum_income_ope = $gross_profit - $tot_op_expense;
            $sum_interest_income = 0; //This is calculated by accountant manually
            $sum_income_tax = 0; //This is what calculated by accountant manually

            $tot_net_income = $sum_income_ope + $sum_interest_income - $sum_income_tax; //
             $this->cell(30, 7, number_format($net), 0, 0, 'L');
//            $sql = "select * from  ";
            // <editor-fold defaultstate="collapsed" desc="----text Above (header = company addresses) ------">
// </editor-fold>
        }

    }

//    parent::__construct('L', 'mm', 'A2', true, 'UTF-8', $use_cache, false);
    $pdf = new PDF();

    $pdf->SetFont('Arial', '', 11);
    $pdf->AddPage();
    $pdf->LoadData();
    $pdf->Output();
    