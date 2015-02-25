/*
product_id will be given
*/
select
s.id,
s.seller_name
from 
seller s,
product_seller_mapping psm
where
(
s.id = psm.seller_id and
psm.product_id = /*product_id*/ and
s.tag = 1 and
psm.tag = 1
);
