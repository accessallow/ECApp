select
f.id as 'id',
f.shop_name,f.address,f.tin_number,f.invoice_number,
f.`date`,f.total_value,f.total_quantity,f.dispatch_location,f.destination,
f.category as 'product_category_id',
c.product_category_name as 'category',
f.product as 'product_id',
p.product_name as 'product',
f.description,f.transport_value,f.billty_number,f.vehicle_number,f.form_c 
from
form49 f,products p,product_category c
where
f.product = p.id and
f.category = c.id and
f.tag = 1;
