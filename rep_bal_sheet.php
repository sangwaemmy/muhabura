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
            $this->Cell(170, 7, 'BALANCE SHEET  REPORT FROM ' . $min_date . '  TO ' . $max_date, 0, 0, 'C');


 $this->SetFont("Arial", 'B', 20);
            $this->Ln();
            $this->cell(50, 7, "ASSETS ", 0, 0, 'L');
            //$this->cell(10, 7, 5, 0, 0, 'L');

            $this->SetFont("Arial", 'B', 11);
            $this->Ln();
            $this->Ln();
            $this->Cell(50, 7, 'Cash', 0, 0, 'L');
            $this->cell(10, 7, 1, 0, 0, 'L');
            $this->SetFont("Arial", '', 10);
            $this->Ln();
            //sales revenues
            //
         // <editor-fold defaultstate="collapsed" desc="-----------revenues-----------">
            $rev_sql = "select account.name as account,journal_entry_line.memo,journal_entry_line.entry_date,  sum(journal_entry_line.amount) as amount from account               
                                join journal_entry_line on journal_entry_line.accountid=account.account_id
                                join account_type on account.acc_type=account_type.account_type_id   
                                where account_type.name<>'Bank'   
                                group by account_type.account_type_id";


            foreach ($db->query($rev_sql) as $row) {
                $this->cell(30, 7, $row['account'], 0, 0, 'L');

                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
// </editor-fold>
            //Cost of good sold
            // <editor-fold defaultstate="collapsed" desc="-----------Cost of good sold">
            $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Accounts receivable'";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, "Acount Receivable", 0, 0, 'L');
            $this->cell(10, 7, 2, 0, 0, 'L');
            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($cogs_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }

              $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Other Current Asset' and  account.name='Inventory' ";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, "Iventory", 0, 0, 'L');
            $this->cell(10, 7, 3, 0, 0, 'L');
            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($cogs_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }



            $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account.name='Prepaid expenses' and account_type.name='Other Expense'";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, "Prepaid expenses", 0, 0, 'L');
            $this->cell(10, 7, 4, 0, 0, 'L');
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
            $other = new other_fx();
                    $min_date = $other->get_this_year_start_date();
                    $max_date = $other->get_this_year_end_date();
                    $tot_inc_exp = new other_fx();
                    $sum_assets = $tot_inc_exp->get_sum_assets(); // other than the fixed assets

                    $sum_liability = $tot_inc_exp->get_sum_liability_by_date($min_date, $max_date);
                    $equity = $sum_assets - $sum_liability;
                    $obj = new multi_values();

                    $sum_fixed_asst = ( $other->get_sum_fixed_assets_by_date($min_date, $max_date) > 0) ? $other->get_sum_fixed_assets_by_date($min_date, $max_date) : '';
                    $sum_current_asset = $other->get_sum_current_assets_by_date($min_date, $max_date);
                    $sum_tot_liab = $other->get_sum_liability();
                    $sum_cash_by_date = $other->get_sum_cash_by_date($min_date, $max_date);
                    $sum_acc_rec = $other->get_sum_acc_rec_by_date($min_date, $max_date);
                    $sum_inventory_bydate = $other->get_sum_inventory_by_date($min_date, $max_date);
                    $sum_prepaid_exp = $other->get_sum_prep_exp_by_date($min_date, $max_date);

                    $tot_current_asset = $sum_cash_by_date + $sum_acc_rec + $sum_inventory_bydate + $sum_prepaid_exp;
                    $tot_net_assets = $sum_fixed_asst + $sum_current_asset;
                    $tot_assets = $tot_net_assets + $tot_current_asset;

                    $sum_account_pay = $other->get_sum_acc_pay_by_date($min_date, $max_date);
                    $sum_acrud_exp = $other->get_sum_acrud_exp_by_date($min_date, $max_date);
                    $sum_current_debt = $other->get_sum_current_debt_by_date($min_date, $max_date);
                    $tot_liability = $sum_account_pay + $sum_acrud_exp + $sum_current_debt;

                    $sum_long_term_debt = $other->get_sum_longterm_debt_by_date($min_date, $max_date);
                    $sum_retained_earnings = $other->get_sum_retained_earn_by_date($min_date, $max_date);
                    $tot_equity = $sum_long_term_debt + $sum_retained_earnings + $tot_liability;
                    $tot_liab_equity = $tot_equity + $tot_liability;
            $this->Ln();
            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "CURRENT ASSETS", 0, 0, 'L');

            $this->Cell(60, 7,number_format($tot_current_asset), 0, 0, 'R');
$this->Ln();
$this->Ln();
            //Research and research
            //  $this->SetFont("Arial", 'B', 11);

               $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Other Current Assets'  and  account.name !='Inventory'";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, "Other current Asset ", 0, 0, 'L');
            $this->cell(10, 7, 5, 0, 0, 'L');
            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($cogs_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
            $this->Ln();
             

            

               $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Other Current Assets'  and  account.name !='Inventory'";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, " Fxed Asset at Cost ? ", 0, 0, 'L');
            $this->cell(10, 7, 6, 0, 0, 'L');
            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($cogs_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }

            $this->Ln();
             

            

               $cogs_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Other Current Assets'  and  account.name !='Inventory'";
            $this->SetFont("Arial", 'B', 11);
            $this->cell(50, 7, " Accumulated Depreciation  ? ", 0, 0, 'L');
            $this->cell(10, 7, 7, 0, 0, 'L');
            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($cogs_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
             $this->Ln();
            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "NET FIXED ASSETS", 0, 0, 'L');

            $this->Cell(60, 7,number_format($tot_net_assets), 0, 0, 'R');
$this->Ln();

            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "TOTAL  ASSETS", 0, 0, 'L');

            $this->Cell(60, 7,number_format($tot_assets), 0, 0, 'R');
$this->Ln();
$this->Ln();

//General administrative
            $this->SetFont("Arial", 'B', 20);
            $this->Ln();
            $this->cell(50, 7, "Liabilities and Equity ", 0, 0, 'L');
            //$this->cell(10, 7, 5, 0, 0, 'L');
$this->Ln();

            //Account Payables
            $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Accounts Payables", 0, 0, 'L');
            $this->cell(10, 7, 8, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql =  "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Accounts payable'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
            $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Acrued Expenses", 0, 0, 'L');
            $this->cell(10, 7, 9, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account.name<>'Prepaid expenses' and account_type.name='Other Expense'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
            $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Income taxes Payables", 0, 0, 'L');
            $this->cell(10, 7, 10, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account.name<>'Prepaid expenses' and account_type.name='Other Expense'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
            $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Current Portion of Debt", 0, 0, 'L');
            $this->cell(10, 7, 11, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account.name<>'Prepaid expenses' and account_type.name='Other Expense'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
            $this->Ln();
            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "CURRENT LIABILITIES", 0, 0, 'L');

            $this->Cell(60, 7,number_format($tot_liability), 0, 0, 'R');
$this->Ln();

                $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Long Term Debt", 0, 0, 'L');
            $this->cell(10, 7, 12, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Long Term Liability'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }


                $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Capital Stock ", 0, 0, 'L');
            $this->cell(10, 7, 13, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Equity' and account.name='Capital Stock'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }


                $this->SetFont("Arial", 'B', 10);
            $this->Ln();
            $this->cell(50, 7, "Retained Earnings ", 0, 0, 'L');
            $this->cell(10, 7, 14, 0, 0, 'L');
            //OPERATING EXPENSES

                $research_sql = "select account.name,    journal_entry_line.amount   from account
                            join journal_entry_line on journal_entry_line.accountid=account.account_id
                            join account_type on account.acc_type=account_type.account_type_id 
                            where account_type.name='Equity' and account.name='Retained earnings'";
            $this->SetFont("Arial", 'B', 11);

            $this->Ln();
            $this->SetFont("Arial", '', 10);
            foreach ($db->query($research_sql) as $row) {
                $this->cell(30, 7, $row['name'], 0, 0, 'L');
                $this->cell(60, 7, number_format($row['amount']), 0, 0, 'R');
                $this->Ln();
            }
            $this->Ln();
            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "SHAREHOLDER'S EQUITY", 0, 0, 'L');

            $this->Cell(60, 7,number_format($tot_equity), 0, 0, 'R');
$this->Ln();

            $this->SetFont("Arial", 'B', 11);
            $this->cell(30, 7, "TOT. LIABILITIES & EQUITY", 0, 0, 'L');

            $this->Cell(60, 7,number_format($tot_liab_equity), 0, 0, 'R');
$this->Ln();
$this->Ln();



        }

    }

//    parent::__construct('L', 'mm', 'A2', true, 'UTF-8', $use_cache, false);
    $pdf = new PDF();

    $pdf->SetFont('Arial', '', 11);
    $pdf->AddPage();
    $pdf->LoadData();
    $pdf->Output();
    