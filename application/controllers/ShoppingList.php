<?php

class ShoppingList extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //we will deliver here the main page of shopping lists
    }

    public function shopping_list($list_id) {
        // here we will see items who are under shopping list $list_id
    }

    /*
     * JSON SPITTING FUNCTIONS   
     */
    public function get_all_lists(){
        //this functions returns all Lists::alive once
    }
    public function get_items_of_list($list_id){
        //this function spits all items that fall under List::$list_id
        
    }
    public function get_one_list_details($list_id){
        //this function spits details of a list::$list_id
    }
    public function get_one_item_from_list($list_id,$item_id){
        // this function spits one item::$item_id who is 
        //under List::$list_id
        
    }


    /*
      LIST DEALING FUNCTIONS
     */

    public function add_shopping_list_item() {
        // accept one new shpping list entry as POST,
        //otherwise send an add new shopping list form
    }

    public function edit_shopping_list_item($list_id) {
        //accept an shopping list item with an id
        //if post if there then update existing entry
        //else fetch and show in edit form
    }

    public function delete_shopping_list($list_id) {
        // if only $delete id is set and no POST then only show delete warning
        //else if POST is sent then delete a shopping list entry
    }

    /*
     * ITEM DEALING FUNCTIONS
     */

    public function delete_item_from_shopping_list($list_id, $sitem_id) {
        //this will be redirecting to a warning based page 
        //in case of post it will be deleting in real and
        // loading again that perticular shopping list items
        // this function should be called while viewing items of
        // a shopping list
    }

    public function add_item_to_shopping_list($list_id) {
        //on not getting POST it will show an ADD ITEM form
        // on getting POST it will save the sent item and render
        // item list of List::$list_id
    }

    public function edit_item_of_shopping_list($list_id, $sitem_id) {
        // on getting post it will update the item details sent under
        //post and on getting just a call,it will show the edoit form with
        // correctly loaded details
    }

}
