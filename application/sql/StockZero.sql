/*
This query extracts out all the product whose stock is zero but they have
been added to any shopping list
*/



select
p.product_name,
(
    select 
    count(sli.id)
    from 
    products p,
    shopping_list_items sli
    where
    p.stock = 0 and
    sli.product_id = p.id and
    sli.tag = 1
) as 'query_id'
from products p
where p.stock = 0
and p.tag = 1; 