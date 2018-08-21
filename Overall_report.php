<?php
    session_start();
    require_once '../web_db/multi_values.php';
    if (!isset($_SESSION)) {
        session_start();
    }if (!isset($_SESSION['login_token'])) {
        header('location:../index.php');
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>
            Report center
        </title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial scale=1.0"/>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link href="../web_scripts/date_picker/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.css" rel="stylesheet" type="text/css"/>
        <link href="../web_scripts/date_picker/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="../web_images/tab_icon.png" type="image/x-icon">

        <style>
            .accounts_expln{
                width: 250px;
            }
            .dataList_table{
                width: 100%;
            } 
        </style>
    </head>
    <body> 

        <?php
            include 'admin_header.php';
        ?>

        <div class="part eighty_centered ">
            <div class="parts xx_titles no_paddin_shade_no_Border">Sales Receipt</div>
            <?php
                require_once '../web_db/Reports.php';
                $rep = new Reports();
                $rep->rprt_general_report();
            ?>
        </div>
        <div class="parts eighty_centered more_settings">
            <?php
                $connect = mysqli_connect("localhost", "sangwa", "A.manigu125", "accounting_db");
                $query = "select p_budget_prep.p_budget_prep_id,  p_budget_prep.project_type,  p_budget_prep.user, 
                    p_budget_prep.entry_date,  p_budget_prep.budget_type as type,  p_activity.amount,  p_type_project.name as proj,
                    p_budget_prep.name as activity   from p_budget_prep 
                   join p_type_project on p_type_project.p_type_project_id=p_budget_prep.project_type
                   join p_activity on p_activity.project=p_budget_prep.p_budget_prep_id 
                   group by project_type";
                $result = mysqli_query($connect, $query);
            ?>
            <div style="width: 900px;">
                <div id="piechart" style="width:900px; height: 500px;">

                </div>
            </div>
        </div>
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >
            <?php require_once './navigation/add_nav.php'; ?> 
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.js" type="text/javascript"></script>
        <script src="../web_scripts/date_picker/jquery-ui.min.js" type="text/javascript"></script>
        <script>
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Budget', 'Project'],
<?php
    while ($row = mysqli_fetch_array($result)) {
        echo "['" . $row["proj"] . "'," . $row["amount"] . "],";
    }
?>
                ]);
                var options = {
                    title: 'Percentage of Budget preparation'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script> 
        <script>
            $('#ending_date').datepicker({
                dataFormat: 'yy-mm-dd'
            });
        </script>
        <div class="parts eighty_centered footer"> Copyrights <?php echo date("Y") ?></div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>

    </body>
</hmtl>
<?php

    function get_acc_combo() {
        $obj = new multi_values();
        $obj->get_account_in_combo();
    }

    function get_acc_type_combo() {
        $obj = new multi_values();
        $obj->get_acc_type_in_combo();
    }

    function get_acc_class_combo() {
        $obj = new multi_values();
        $obj->get_acc_class_in_combo();
    }

    function chosen_acc_type_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $acc_type = new multi_values();
                return $acc_type->get_chosen_account_acc_type($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_acc_class_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $acc_class = new multi_values();
                return $acc_class->get_chosen_account_acc_class($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    function chosen_name_upd() {
        if (!empty($_SESSION['table_to_update'])) {
            if ($_SESSION['table_to_update'] == 'account') {
                $id = $_SESSION['id_upd'];
                $name = new multi_values();
                return $name->get_chosen_account_name($id);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }
    