<?php

class ShoppingList extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->helper('url');
    }

    public function index() {
        //we will deliver here the main page of shopping lists
        $this->load->view('template/header');
        $this->load->view('shoppingList/dashboard');
        $this->load->view('template/footer');
    }

    public function shopping_list($list_id) {
        // here we will see items who are under shopping list $list_id
    }

    public function add_new_shopping_list() {
        if ($this->input->post('ListName')) {
            $this->load->model('shopping_list_model');

            $this->shopping_list_model->add_entry(array(
                'list_name' => $this->input->post('ListName'),
                'date_created' => $this->input->post('DateCreated'),
                'date_modified' => $this->input->post('DateCreated')
            ));

            $this->index();
        } else {
            $data['form_submit_url'] = site_url('ShoppingList/add_new_shopping_list');
            $data['back_url'] = site_url('ShoppingList');

            $this->load->view('template/header');
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

    public function get_items_of_list($list_id) {
        //this function spits all items that fall under List::$list_id

        $this->load->model('shopping_list_model');
        $r = $this->shopping_list_model->get_all_items_from_list($list_id);

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

    public function add_shopping_list_item() {
        // accept one new shopping list entry as POST,
        //otherwise send an add new shopping list form
    }

    public function edit_shopping_list($list_id) {
        //accept an shopping list item with an id
        //if post if there then update existing entry
        //else fetch and show in edit form

        $this->load->model('shopping_list_model');


        if ($this->input->post('list_id')) {
            $p_list_id = $this->input->post('list_id');

            $this->shopping_list_model->edit_entry($p_list_id, array(
                'list_name' => $this->input->post('ListName'),
                'date_created' => $this->input->post('DateCreated'),
                'date_modified' => $this->input->post('DateCreated')
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


            $this->load->view('template/header');
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

            $this->load->view('template/header');
            $this->load->view('shoppingList/delete', $data);
            $this->load->view('template/footer');
        }
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
