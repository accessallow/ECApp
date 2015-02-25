/*
product_id will be given
*/

select
* 
from
seller
where
id not in(select distinct seller_id
	from product_seller_mapping
	where product_id = /*product_id*/
	)
and tag = 1;
