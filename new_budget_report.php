<?php
    session_start();
    require_once '../web_db/multi_values.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="web_style/styles.css" rel="stylesheet" type="text/css"/>
        <link href="web_style/StylesAddon.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/>
        <link href="admin_style.css" rel="stylesheet" type="text/css"/> 
        <style>
            .main_data_txt td{
                text-align: center;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <?php
            include 'admin_header.php';
        ?>
        <div class="parts eighty_centered datalist_box" >
            <div class="parts no_shade_noBorder xx_titles no_bg whilte_text dataList_title">Budgets report</div>
            <div class="parts no_paddin_shade_no_Border page_search link_cursor">Search</div>
            <?php
                require_once '../web_db/other_fx.php';
                $obj = new other_fx();

                $obj->list_p_project();
            ?>
        </div>  
        <!--Start of Type Details-->
        <div class="parts p_project_type_details data_details_pane abs_full margin_free white_bg">

        </div>
        <!--End Tuype Details-->
        <div class="parts eighty_centered  no_paddin_shade_no_Border no_shade_noBorder check_loaded" >

            <?php require_once './navigation/add_nav.php'; ?>
        </div>
        <div class="parts  eighty_centered no_paddin_shade_no_Border no_bg margin_free export_btn_box">
            <table class="margin_free">
                <td>
                    <form action="../web_exports/excel_export.php" method="post">
                        <input type="hidden" name="budget_report" value="a"/>
                        <input type="submit" name="export" class="btn_export btn_export_excel" value="Export"/>
                    </form>
                </td>
                <td>
                    <form action="../prints/print_budget_report.php" method="post">
                        <input type="submit" name="export" class="btn_export btn_export_pdf" value="Export"/>
                    </form>
                </td>
            </table>
        </div>
        <script src="../web_scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="admin_script.js" type="text/javascript"></script>
        <script src="../web_scripts/web_scripts.js" type="text/javascript"></script>
    </body>
</html>
