

create table sales (
sales_id int not null primary key,
sales_name varchar(20),
sales_phone varchar(12));

create table buyer (
buyer_id int not null primary key,
buyer_name varchar(20),
buyer_phone varchar(12),
buyer_status varchar(10));

create table item (
item_id int not null primary key,
item_name varchar(20),
item_type varchar(20),
item_price decimal (7,2),
item_bal int,
item_details varchar (50));

create table invoice (
invoice_id int not null primary key,
invoice_date date,
buyer_id int references buyer,
invoice_quantity int,
item_id int references item,
sales_id int references sales);

insert into item values
(1, 'LCD Monitor', 'Computer', 900.99, 50, '24 inch Samsung'),
(2, 'Pen', 'Stationary', 1.64, 3, 'Red ink'),
(3, 'Printer', 'Computer', 300.55, 1, 'Epson Super Jet'),
(4, 'Fan', 'Electrical', 86.11, 4, 'Hitachi'),
(5, 'Rubber', 'Stationary', '0.63', 98, 'Faber 3cm'),
(6, 'Harddisc', 'Computer', 250.81, 2, 'Maxtor 500GB'),
(7, 'Pen Drive', 'Computer', 98.65, 78, 'MyDrive 16GB mini version'),
(8, 'Nokia Phone', 'Electrical', 980.21, 100, 'N85 super series'),
(9, 'Camera', 'Electrical', 1230.36, 8, 'Sony 15 Megapixel');

insert into sales values
(1, 'Florence', '60135698231'),
(2, 'Zelda', '60125479563'),
(3, 'Clarry', '60148597965'),
(4, 'Nasri', '60195624664'),
(5, 'Arshavin', '60168462649');

insert into buyer values
(1, 'Jeremy', '60125568976', 'Active'),
(2, 'Cech', '60135695469', 'Not Active'),
(3, 'Meluda', '60191346876', 'Active'),
(4, 'Jessica', '60168954616', 'Active'),
(5, 'Toure', '60136546586', 'Not Active'),
(6, 'Jesmon', '60145226569', 'Active'),
(7, 'Torres', '60125469788', 'Active'),
(8, 'Martin', '60135468789', 'Not Active'),
(9, 'Taylor', '60124659789', 'Active');

insert into invoice values
(10010, '2008-12-15', 1, 2, 1, 5),
(10011, '2006-01-13', 3, 26, 7, 1),
(10012, '2008-03-06', 4, 8, 8, 2),
(10013, '2007-10-28', 1, 10, 2, 4),
(10014, '2008-05-16', 7, 6, 9, 3),
(10015, '2008-12-01', 6, 1, 5, 4),
(10016, '2008-12-13', 3, 7, 1, 3);

/* ========================================================== */
/* Q3 */

select buyer_name, buyer_phone from buyer order by buyer_name asc;

/* ========================================================== */
/* Q4 */

select sales_name from sales where sales_id in 
(select sales_id from invoice where buyer_id =
(select buyer_id from buyer where buyer_name = 'Jeremy')
);

select sales_name from sales where sales_id in 
(select sales_id from invoice
inner join
buyer on invoice.buyer_id = buyer.buyer_id
where buyer_name = 'Jeremy'
);

select sales_name from sales
inner join 
(select sales_id from invoice
inner join
buyer on invoice.buyer_id = buyer.buyer_id
where buyer_name = 'Jeremy'
) as t
on sales.sales_id = t.sales_id
;

select sales_name from sales
inner join
invoice on sales.sales_id = invoice.sales_id
inner join
buyer on invoice.buyer_id = buyer.buyer_id
where buyer_name = 'Jeremy';

select sales_name from sales, invoice, buyer
where sales.sales_id = invoice.sales_id
and invoice.buyer_id = buyer.buyer_id
and buyer_name = 'Jeremy';

/* ========================================================== */
/* Q5 */

select sales_name, sales_phone from sales where sales_id in
(select sales_id from invoice where invoice_date like '%-12-%' and item_id in 
(select item_id from item where item_type = 'Computer'));

select sales_name, sales_phone from sales where sales_id in
(select sales_id from invoice
inner join 
item on invoice.item_id = item.item_id 
where invoice_date like '%-12-%' and item_type = 'Computer');

select sales_name, sales_phone from sales 
inner join
(select sales_id from invoice
inner join 
item on invoice.item_id = item.item_id 
where invoice_date like '%-12-%' and item_type = 'Computer') as t
on sales.sales_id = t.sales_id;

select sales_name, sales_phone from sales
inner join
invoice on sales.sales_id = invoice.sales_id
inner join
item on invoice.item_id = item.item_id
where invoice_date like '2008-12-%' and item_type = 'Computer';

select sales_name, sales_phone from sales, invoice, item
where sales.sales_id = invoice.sales_id
and invoice.item_id = item.item_id
and invoice_date between '2008-12-01' and '2008-12-31'
and item_type = 'Computer';

/* ========================================================== */
/* Q6 */

select item_name, item_price, item_bal, (item_price*item_bal) as total_value
from item where item_type != 'Computer';

/* ========================================================== */
/* Q7 */

select item_name, item_price from item order by item_price asc limit 1; 

/* ========================================================== */

select invoice_id, invoice_quantity, item_name from invoice
inner join item
on invoice.item_id = item.item_id and item_type = 'Computer';
