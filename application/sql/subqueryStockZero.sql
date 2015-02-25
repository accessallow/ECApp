select 
    p.product_name,
    count(sli.id) as 'entries'
    from 
    products p,
    shopping_list_items sli
    where
 /*   p.stock = 0 and */
    sli.product_id = p.id and 
 /*   p.id = 1 and */
    sli.tag = 1;
