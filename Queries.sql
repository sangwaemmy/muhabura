

select * from sales_receit_header
join sales_invoice_line on sales_receit_header.sales_invoice=sales_invoice_line.sales_invoice_line_id
join sales_order_line on sales_invoice_line.sales_order= sales_order_line.sales_order_line_id
join sales_quote_line on sales_order_line.quotationid=sales_quote_line.sales_quote_line_id 
join p_budget_items on sales_quote_line.item=p_budget_items.p_budget_items_id           

join p_activity on sales_invoice_line.budget_prep_id=p_activity.p_activity_id
join p_budget_prep on p_activity.project=p_budget_prep.p_budget_prep_id

join p_type_project on p_budget_prep.project_type=p_type_project.p_type_project_id;







select * from sales_invoice_line
join sales_order_line on sales_invoice_line.sales_order= sales_order_line.sales_order_line_id
join p_activity on sales_invoice_line.budget_prep_id=p_activity.p_activity_id;

select * from sales_order_line
join sales_quote_line on sales_order_line.quotationid=sales_quote_line.sales_quote_line_id ;


select * from sales_quote_line
join p_budget_items on sales_quote_line.item=p_budget_items.p_budget_items_id;


select * from p_budget_items;



select * from p_budget_prep
join p_type_project on p_budget_prep.project_type=p_type_project.p_type_project_id;


select *from p_type_project;


select * from p_activity
join p_budget_prep on p_activity.project=p_budget_prep.p_budget_prep_id
join p_field on p_field.p_field_id=p_activity.field;




-- this is about the pruchase. The purchase and the sales intersect on the a(activity - purchase invoice)
select * from purchase_receit_line
join purchase_invoice_line on purchase_invoice_line.purchase_invoice_line_id=purchase_receit_line.purchase_invoice
join p_activity on p_activity.p_activity_id=purchase_invoice_line.activity
join p_budget_prep on p_activity.project=p_budget_prep.p_budget_prep_id
join p_type_project on p_budget_prep.project_type=p_type_project.p_type_project_id 

join purchase_order_line on purchase_order_line.purchase_order_line_id=purchase_invoice_line.purchase_order 
join p_request on  purchase_order_line.request=p_request.p_request_id

;

-----------

select *from purchase_order_line
join p_request on p_request.p_request_id=purchase_order_line.request;

select * from purchase_invoice_line
join purchase_order_line on purchase_order_line.purchase_order_line_id=purchase_invoice_line.purchase_order
join p_request on p_request.p_request_id=purchase_order_line.request
join p_activity on p_activity.p_activity_id=purchase_invoice_line.activity

join p_request on p_request.p_request_id=purchase_order_line.request
join p_budget_items on p_request.item=p_budget_items.p_budget_items_id;



select * from purchase_receit_line;

select * from main_request 
join p_request on p_request.main_req=main_request.Main_Request_id;

select * from p_request
join p_budget_items on p_request.item=p_budget_items.p_budget_items_id;

select * from p_budget_items;




 

-- non finished process request to purchase order
select p_request.p_request_id from p_request where p_request_id not in (select request from purchase_order_line);
-- non finished process order to invoice
select purchase_order_line_id from purchase_order_line where purchase_order_line.purchase_order_line_id not in (select purchase_order from purchase_invoice_line);
-- non finished process purchase invoice to receit
select  purchase_invoice_line_id from purchase_invoice_line where purchase_invoice_line_id not in (select purchase_invoice from purchase_receit_line);


-- non finished provess quotation to sales order
select sales_quote_line_id from sales_quote_line where sales_quote_line_id not in (select quotationid from sales_order_line);
-- non finished process sales order to sales invoice
select sales_order_line_id from sales_order_line where sales_order_line_id not in (select sales_order from sales_invoice_line);
-- non finished process sales invoice to sales receit
select sales_receit_header_id from sales_receit_header where sales_invoice not in(select sales_invoice from sales_receit_header);
 



select * from account
join account_type on account_type.account_type_id=account.acc_type;
 
 
 
 -- Get the item by type (Agriculture, Construction, etc)
  select * from main_stock 
 join p_budget_items on p_budget_items.p_budget_items_id=main_stock.item
 join p_type_project on p_type_project.p_type_project_id=p_budget_items.type
 where p_type_project.name='';
 
 
select * from p_budget_items
join p_type_project on p_type_project.p_type_project_id=p_budget_items.type;
 
 
 
 
 
 
 
 
 
 
 -- COST OF GOOD SOLD
 -- -------------------------
 -- --------------------------
  select * from main_stock;
  
 -- Beginning inventory
 select total_amount from main_stock where entry_date>='2017-07-01' and entry_date<='2018-05-05' order by main_stock_id asc limit 1;
 select total_amount from main_stock where entry_date>='2017-07-01' and entry_date<='2018-05-05' and main_stock.item='' order by main_stock_id asc limit 1;
 
 
 select * from main_stock
 join p_budget_items on p_budget_items.p_budget_items_id=main_stock.item
 join p_type_project on p_type_project.p_type_project_id=p_budget_items.type
 where p_type_project.name='construction' and main_stock.entry_date>='2017-07-01' and main_stock.entry_date<='2018-05-05' order by main_stock_id asc limit 1;
  
 select * from main_stock
 join p_budget_items on p_budget_items.p_budget_items_id=main_stock.item
 join p_type_project on p_type_project.p_type_project_id=p_budget_items.type
 where p_type_project.name='construction' and main_stock.entry_date>='2017-07-01' and main_stock.entry_date<='2018-05-05' order by main_stock_id desc limit 1;
  
  
  

  select * from main_stock
 join p_budget_items on p_budget_items.p_budget_items_id=main_stock.item
 join p_type_project on p_type_project.p_type_project_id=p_budget_items.type
 where p_type_project.name='construction' and main_stock.entry_date>='2017-07-01' and main_stock.entry_date<='2018-05-05' and main_stock.item='' order by main_stock_id asc limit 1;
 
 
 
 
 -- Ending inventory
 select total_amount from main_stock where entry_date='2018-07-01' order by main_stock_id desc limit 1;
 select total_amount from main_stock where entry_date>='2017-07-01' and entry_date<='2018-05-05' and main_stock.item='' order by main_stock_id desc limit 1;


 -- Purchases (during the period)
 select * from purchase_receit_line;
 select amount from purchase_receit_line where entry_date>='' and entry_date<='';
 
 
 
-- General journal

select  journal_entry_line.journal_entry_line_id,  journal_entry_line.accountid,  journal_entry_line.dr_cr,  sum(journal_entry_line.amount),  journal_entry_line.memo,  journal_entry_line.journal_entry_header,  journal_entry_line.entry_date,
 account.account_id,  account.acc_type,  account.acc_class,  account.name,  account.DrCrSide,  account.acc_code,  account.acc_desc,  account.is_cash,  account.is_contra_acc,  account.is_row_version
 from journal_entry_line  
join account on account.account_id=journal_entry_line.accountid
group by account.account_id;



-- Tax on both sales and purchases by date


select * from tax_percentage;
select sum(tax_percentage.amount) from tax_percentage
join purchase_invoice_line on purchase_invoice_line.purchase_invoice_line_id=tax_percentage.purid_saleid
where tax_percentage.pur_sale='purchase' and purchase_invoice_line.entry_date>='' and purchase_invoice_line.entry_date<='';


select * from purchase_order_line;


select * from journal_entry_line
join account on account.account_id=journal_entry_line.accountid
join account_type on account_type.account_type_id=account.acc_type
where account_type.name='';


-- CASH FLOW

select amount from purchase_receit_line
where purchase_receit_line.entry_date>= '' and purchase_receit_line<=;



-- INVENTORY


select * from distriibution;

select stock_into_main.item, sum(stock_into_main.quantity)-sum(distriibution.taken_qty) as quantity_out,
sum(purchase_invoice_line.amount * purchase_invoice_line.unit_cost) as amount, purchase_invoice_line.unit_cost from stock_into_main 
join purchase_invoice_line on purchase_invoice_line.purchase_invoice_line_id=stock_into_main.purchaseid
join distriibution on distriibution.item=stock_into_main.item
where stock_into_main.entry_date>= and stock_into_main.entry_date<=
group by stock_into_main.item;





select *from purchase_invoice_line;



































