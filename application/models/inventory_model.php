<?php

// ye inventory k tags hain....0 matlab deleted hai and 1 matlab abhi zinda h
class InventoryTags {

    public static $deleted = 0; // dead record..ghost record
    public static $available = 1; // live record

}

class Inventory_model extends CI_Model {

    var $product_id = "";
    var $quantity = "";
    var $payment = "";
    var $seller_id = "";
    var $rate = null;
    var $date = "";
    var $description = "";
    var $tag = NULL;

    public function __construct() {
        // arre chacha...database to load kar lo..db bin sab soon
        $this->load->database();
    }

    function insert($product_id, $quantity, $payment, $seller_id, $rate, $date, $description) {
        // ye aa gyi saari ki saari values insert hone k liye...bhai dalo inko
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->payment = $payment;
        $this->seller_id = $seller_id;
        $this->rate = $rate;
        $this->date = $date;
        $this->description = $description;
        // we are setting tag to "available" means this record is live
        $this->tag = InventoryTags::$available;

        // Ja pagle..jee le apni zindgi..likh di mene teri kismat!!! :P
        $this->db->insert("inventory", $this);
    }

    function edit($id, $product_id, $quantity, $payment, $seller_id, $rate, $date, $description) {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->payment = $payment;
        $this->seller_id = $seller_id;
        $this->rate = $rate;
        $this->date = $date;
        $this->description = $description;
        $this->tag = InventoryTags::$available;

        // chal tujhe update kiya..aage se dhyaan rakhna
        $this->db->update('inventory', $this, array('id' => $id));
    }

    function delete($id) {
//        we do not delete anything here, we just set the tag to deleted

        $data = array('tag' => InventoryTags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('inventory', $data);
        // kasam se kya dimag lagaya hai
    }

    //////////////////////////////////////////
    /////////////GET ALL INVENTORIES///////////
    //////////////////////////////////////////

    function get_all_entries() {
        // selecting records whose tag is set to available
        // those will be our active records
        $query = $this->db->get_where('inventory', array('tag' => InventoryTags::$available));
        return $query->result();
    }

    function get_all_entries_no_matter_what() {
        // selecting records whose tag is set to available
        // those will be our active records
        $query = $this->db->get_where('inventory');
        return $query->result();
    }

    function get_all_entries_joined() {

        // returns with column naming
        $queryString = "select i.id,p.product_name,i.rate,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where ( i.tag = " . InventoryTags::$available . " and 
            i.product_id = p.id and 
        i.seller_id = s.id
        ) order by i.date desc,i.id desc; ";

        // echo $queryString; // ye testing k liye tha...bura mat maan-na bhai

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_all_entries_joined_no_matter_what() {

        // returns with column naming
        $queryString = "select i.id,p.product_name,i.rate,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where ( 
            i.product_id = p.id and 
        i.seller_id = s.id
        ) order by i.date desc,i.id desc; ";

        // echo $queryString;

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_all_entries_joined_extended($product_id, $seller_id) {

        // returns with column naming

        $queryString = NULL;

        if ($product_id) {
            $queryString = "select i.id,i.rate,p.id as 'product_id',s.id as 'seller_id',p.product_name,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where ( i.tag = " . InventoryTags::$available . " and 
            i.product_id = p.id and 
            i.seller_id = s.id and
            i.product_id = $product_id
        ) order by i.date desc,i.id desc; ";
        } elseif ($seller_id) {
            $queryString = "select i.id,i.rate,p.id as 'product_id',s.id as 'seller_id',p.product_name,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where ( i.tag = " . InventoryTags::$available . " and 
            i.product_id = p.id and 
            i.seller_id = s.id and
            i.seller_id = $seller_id
        ) order by i.date desc,i.id desc; ";
        } else {
            $queryString = "select i.id,i.rate,p.id as 'product_id',s.id as 'seller_id',p.product_name,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where ( i.tag = " . InventoryTags::$available . " and 
            i.product_id = p.id and 
            i.seller_id = s.id
            
        ) order by i.date desc,i.id desc; ";
        }


        // echo $queryString; // ye testing k liye tha...bura mat maan-na bhai

        $query = $this->db->query($queryString);
        return $query->result();
    }

    /////////////////////////////////////////////////
    ////////////GET ONE INVENTORY///////////////////
    /////////////////////////////////////////////////

    function get_one_inventory($id) {
        // jiski zinda record ki id $id ho vo uthke aa jaye 
        $query = $this->db->get_where('inventory', array(
            'id' => $id, 'tag' => InventoryTags::$available
                )
        );
        return $query->result();
    }

    function get_one_inventory_no_matter_what($id) {
        // if there is an id..there is hope :)
        // you can see dead records using this spell
        // this is f*king witchcraft 
        $query = $this->db->get_where('inventory', array('id' => $id));
        return $query->result();
    }

    function get_one_inventory_joined($id) {
        // this fetches on inventory with Product_name and seller name in
        // place of product_id and seller_id

        $fetchString = "select i.id,i.rate,p.product_name,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where (i.product_id = p.id and 
        i.seller_id = s.id
        and i.id = $id
        and i.tag = " . InventoryTags::$available . ");";

        $query = $this->db->query($fetchString);
        return $query->result();
    }

    function get_one_inventory_joined_no_matter_what($id) {

        // this fetches on inventory with Product_name and seller name in
        // place of product_id and seller_id
        //this function is dealing with ghost enries...use with caution,supernatural

        $fetchString = "select i.id,i.rate,p.product_name,i.quantity,i.payment,s.seller_name,i.date,i.description
        from inventory i,products p,seller s
        where (i.product_id = p.id and 
        i.seller_id = s.id
        and i.id = $id );";

        $query = $this->db->query($fetchString);
        return $query->result();
    }

    /////////////////////////////////////////////////////
    //////////////Metadata query functions////////////////
    /////////////////////////////////////////////////////

    function get_sum_of_payments($product_id = null, $seller_id = null) {
        if ($product_id) {
            $this->db->select_sum('payment');
            $q = $this->db->get_where('inventory', array('product_id' => $product_id));
            return $q->result();
        } elseif ($seller_id) {
            $this->db->select_sum('payment');
            $q = $this->db->get_where('inventory', array('seller_id' => $seller_id));
            return $q->result();
        } else {
            $this->db->select_sum('payment');
            $q = $this->db->get_where('inventory');
            return $q->result();
        }
    }

}
