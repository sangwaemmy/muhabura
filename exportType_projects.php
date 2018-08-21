<?php

//    require_once '../web_db/other_fx.php';
//    $m = new other_fx();
//    $m->list_p_type_project_excel();
    require_once '../web_db/connection.php';

    if (isset($_POST['sales_receit_header'])) {
        $database = new dbconnection();
        $db = $database->openConnection();
        $sql = "select * from sales_receit_header";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $output = '';
        $output .= '                    
            <table class="export_excel_table">
                <thead><tr>
               <td>Sales Invoice</td>
               <td>Entry Date</td>
               <td>User</td>
               <td>Amount</td>
               <td>Approved</td>
               <td>Sales Invoice</td>
               <td>Entry Date</td>
               <td>User</td>
               <td>Amount</td>
               <td>Approve</td>
                        </tr></thead>
               ';
        while ($row = $stmt->fetch()) {
            $output .= '<tr> 

                 <td>' . $row['sales_invoice'] . '</td>
                 <td>' . $row['entry_date'] . '</td>
                 <td>' . $row['User'] . '</td>
                 <td>' . $row['amount'] . '</td>
                 <td>' . $row['approve'] . '</td>
                 <td>' . $row['sales_invoice'] . '</td>
                 <td>' . $row['entry_date'] . '</td>
                 <td>' . $row['User'] . '</td>
                 <td>' . $row['amount'] . '</td>
                 <td>' . $row['approve'] . '</td>

                        </tr>';
        }
        $output .= '</table>';
        header("Content-Type: vnd.ms-excel");
        header("Content-Disposition:attachment; filename=sales_receit_header.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $output;
    }
    