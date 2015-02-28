<?php

class ShoppingList extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->helper('url');
    }

    public function index() {
        //we will deliver here the main page of shopping lists
        $this->load->view('template/header',$this->activation_model->get_activation_data());
        $this->load->view('shoppingList/dashboard');
        $this->load->view('template/footer');
    }

    public function shopping_list($list_id) {
        // here we will see items who are under shopping list $list_id
    }

    public function add_new_shopping_list() {
        if ($this->input->post('ListName')) {
            $this->load->model('shopping_list_model');

            $date = new DateTime($this->input->post('DateCreated'));

            $this->shopping_list_model->add_entry(array(
                'list_name' => $this->input->post('ListName'),
                'date_created' => date_format($date, 'Y-m-d'),
                'date_modified' => date_format($date, 'Y-m-d')
            ));

            $this->index();
        } else {
            $data['form_submit_url'] = site_url('ShoppingList/add_new_shopping_list');
            $data['back_url'] = site_url('ShoppingList');

            $this->load->view('template/header',$this->activation_model->get_activation_data());
            $this->load->view('shoppingList/add_new_shopping_list', $data);
            $this->load->view('template/footer');
        }
    }

    /*
     * JSON SPITTING FUNCTIONS   
     */

    public function get_all_lists() {
        //this functions returns all Lists::alive once
        $this->load->model('shopping_list_model');
        $r = $this->shopping_list_model->get_all_entries();
        if (!$r) {
            echo "Problem";
        } else {
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($r));
        }
    }

    public function get_items_of_list($list_id, $seller_id = null) {
        //this function spits all items that fall under List::$list_id

        $this->load->model('shopping_list_model');
        $r = null;
        if ($seller_id) {
            $r = $this->shopping_list_model->get_all_items_of_a_seller_from_list($list_id, $seller_id);
        } else {
            $r = $this->shopping_list_model->get_all_items_from_list($list_id);
        }


        $this->output->set_content_type('application/json')
                ->set_output(json_encode($r));
    }

    public function get_one_list_details($list_id) {
        //this function spits details of a list::$list_id
    }

    public function get_one_item_from_list($list_id, $item_id) {
        // this function spits one item::$item_id who is 
        //under List::$list_id
    }

    /*
      LIST DEALING FUNCTIONS
     */

    

    public function edit_shopping_list($list_id) {
        //accept an shopping list item with an id
        //if post if there then update existing entry
        //else fetch and show in edit form

        $this->load->model('shopping_list_model');

        $date = new DateTime($this->input->post('DateCreated'));

        if ($this->input->post('list_id')) {
            $p_list_id = $this->input->post('list_id');

            $this->shopping_list_model->edit_entry($p_list_id, array(
                'list_name' => $this->input->post('ListName'),
                'date_created' => date_format($date, 'Y-m-d'),
                'date_modified' => date_format($date, 'Y-m-d')
                    )
            );
            redirect('ShoppingList');
        } else {
            $l = $this->shopping_list_model->get_one_entry($list_id);
            $l = $l[0];

            $data['edit'] = true;
            $data['ListName'] = $l->list_name;
            $data['DateCreated'] = $l->date_created;
            $data['list_id'] = $l->id;
            $data['form_submit_url'] = site_url('ShoppingList/edit_shopping_list/' . $list_id);
            $data['back_url'] = site_url('ShoppingList');


            $this->load->view('template/header',$this->activation_model->get_activation_data());
            $this->load->view('shoppingList/add_new_shopping_list', $data);
            $this->load->view('template/footer');
        }
    }

    public function delete_shopping_list($list_id) {
        // if only $delete id is set and no POST then only show delete warning
        //else if POST is sent then delete a shopping list entry
        $this->load->model('shopping_list_model');
        if ($this->input->post('id')) {
            $this->shopping_list_model->delete_entry(
                    $this->input->post('id')
            );
            redirect('ShoppingList');
        } else {
            // I am gonna deliver the item to be deleted!!!
            $l = $this->shopping_list_model->get_one_entry($list_id);
            $l = $l[0];




            $data['confirmation_line'] = "Are you sure want to delete list: <strong>" .
                    $l->list_name . "</strong>?";
            $data['item_id'] = $l->id;
            $data['delete_form_url'] = site_url('ShoppingList/delete_shopping_list/' . $list_id);
            $data['back_url'] = site_url('ShoppingList');

            $this->load->view('template/header',$this->activation_model->get_activation_data());
            $this->load->view('shoppingList/delete', $data);
            $this->load->view('template/footer');
        }
    }

    /*
     * ITEM DEALING FUNCTIONS
     */

    public function delete_item_from_shopping_list($list_id, $item_id) {
        //this will be redirecting to a warning based page 
        //in case of post it will be deleting in real and
        // loading again that perticular shopping list items
        // this function should be called while viewing items of
        // a shopping list

        $this->load->model('shopping_list_model');
        if ($this->input->post('id')) {
            $this->shopping_list_model->delete_one_item(
                    $this->input->post('id')
            );
            redirect('ShoppingList');
        } else {
            // I am gonna deliver the item to be deleted!!!
            $list = $this->shopping_list_model->get_one_entry($list_id);
            $list = $list[0];
            $item = $this->shopping_list_model->get_one_item($item_id);
            $item = $item[0];

            $this->load->model('product_model');
            $p = $this->product_model->get_one_product($item->product_id);
            $p = $p[0];


            $data['confirmation_line'] = "Are you sure want to delete item: <strong>" .
                    $p->product_name . "</strong> from list: <strong>" . $list->list_name . "</strong>?";
            $data['item_id'] = $item->id;

            $data['delete_form_url'] = site_url('ShoppingList/delete_item_from_shopping_list/' . $list_id . '/' . $item_id);
            $data['back_url'] = site_url('ShoppingList');

            $this->load->view('template/header',$this->activation_model->get_activation_data());
            $this->load->view('shoppingList/delete', $data);
            $this->load->view('template/footer');
        }
    }

    public function add_item_to_shopping_list($list_id=null) {
        //on not getting POST it will show an ADD ITEM form
        // on getting POST it will save the sent item and render
        // item list of List::$list_id

        if ($this->input->post('list_id')) {
            //inserting on getting a post
            $item = array(
                'list_id' => $this->input->post('list_id'),
                'product_id' => $this->input->post('product_id'),
                'seller_id' => $this->input->post('seller_id'),
                'quantity' => $this->input->post('quantity'),
                'rate' => $this->input->post('rate'),
                'total_price' => $this->input->post('total_price'),
                'description' => $this->input->post('description'),
            );
            $this->load->model('shopping_list_model');
            $this->shopping_list_model->add_an_item_to_list($item);

            redirect('ShoppingList');
        } else {
            //sending form to fill 
            $data['products_fetch_url'] = site_url('Product/index_json');
            $data['sellers_fetch_url'] = site_url('Seller/index_json');
            $data['shopping_lists_fetch_url'] = site_url('ShoppingList/get_all_lists');

            $data['products_refresh_url'] = site_url('Product/get_products_from_this_seller?seller_id=');
            $data['sellers_refresh_url'] = site_url('Product/get_sellers_for_this_product?product_id=');

            $data['form_submit_url'] = site_url('ShoppingList/add_item_to_shopping_list');
            $data['back_url'] = site_url('ShoppingList');
            
            $data['list_id'] = $list_id;
            
            if($this->input->get('product_id')){
                $data['product_id'] = $this->input->get('product_id');
            }
            if($this->input->get('seller_id')){
                $data['seller_id'] = $this->input->get('seller_id');
            }
            if($this->input->get('seller_id')&&$this->input->get('product_id')){
                $this->load->model('product_seller_mapping_model');
                $v = $this->product_seller_mapping_model->give_me_price(
                        $this->input->get('product_id'),
                        $this->input->get('seller_id')
                        );
                $v = $v[0];
                $data['rate'] = $v->product_price;
            }

            $this->load->view('template/header',$this->activation_model->get_activation_data());
            $this->load->view('shoppingList/add_new_shopping_item', $data);
            $this->load->view('template/footer');
        }
    }

    public function edit_item_of_shopping_list($list_id, $item_id) {
        // on getting post it will update the item details sent under
        //post and on getting just a call,it will show the edoit form with
        // correctly loaded details
        $this->load->model('shopping_list_model');

        if ($this->input->post('id')) {
            $item = array(
                'list_id' => $this->input->post('list_id'),
                'product_id' => $this->input->post('product_id'),
                'seller_id' => $this->input->post('seller_id'),
                'quantity' => $this->input->post('quantity'),
                'rate' => $this->input->post('rate'),
                'total_price' => $this->input->post('total_price'),
                'description' => $this->input->post('description'),
            );
            $this->shopping_list_model->update_one_item($this->input->post('id'), $item);

            redirect('ShoppingList');
        } else {
            $data['products_fetch_url'] = site_url('Product/index_json');
            $data['sellers_fetch_url'] = site_url('Seller/index_json');
            $data['shopping_lists_fetch_url'] = site_url('ShoppingList/get_all_lists');

            $data['products_refresh_url'] = site_url('Product/get_products_from_this_seller?seller_id=');
            $data['sellers_refresh_url'] = site_url('Product/get_sellers_for_this_product?product_id=');

            $data['form_submit_url'] = site_url('ShoppingList/edit_item_of_shopping_list/' . $list_id . '/' . $item_id);
            $data['back_url'] = site_url('ShoppingList');
            $data['list_id'] = $list_id;

            $item = $this->shopping_list_model->get_one_item($item_id);
            $item = $item[0];

            $data['edit'] = true;
            $data['id'] = $item->id;
            $data['list_id'] = $item->list_id;
            $data['product_id'] = $item->product_id;
            $data['seller_id'] = $item->seller_id;
            $data['quantity'] = $item->quantity;
            $data['rate'] = $item->rate;
            $data['total_price'] = $item->total_price;
            $data['description'] = $item->description;

            $this->load->view('template/header',$this->activation_model->get_activation_data());
            $this->load->view('shoppingList/add_new_shopping_item', $data);
            $this->load->view('template/footer');
        }
    }

}
