/*
seller_id will be given
fetch all the products sold by this seller
*/
select 
p.id,
p.product_name,
p.product_brand,
psm.product_price,
(select product_category_name from product_category where product_category.id=p.product_category) as 'product_category',
p.product_category as 'product_category_id',
p.product_description
from
products p,
product_seller_mapping psm
where
(
p.id = psm.product_id and
psm.seller_id = /*seller_id*/ and
p.tag=1 and
psm.tag=1
)
order by 
p.product_name asc;
