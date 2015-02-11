select 
sli.id,
sli.product_id,
p.product_name,
sli.seller_id,
s.seller_name,
sli.rate,
sli.quantity,
sli.total_price,
sli.description
from 
shopping_list_items sli,
products p,
seller s 
where 
sli.product_id = p.id and
sli.seller_id = s.id and
sli.id = 1 and
sli.tag = 1;
