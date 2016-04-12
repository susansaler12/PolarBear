<?php
class WishList extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }
    /**
     * Show our wish list items
     *
     * URL = /forms/wishlist
     */
    function index() {
        $this->load->model('forms/WishList_model', 'wishlist');

        // TODO: add code here

        $data['title'] = 'My Wish List';

        $this->template->load('template', 'forms/wishlist_show', $data);
    }
    /**
     * Edit a wish list item
     *
     * URL = /forms/wishlist/edit
     */
    function edit() {
        $this->load->helper('form');
        $this->load->model('forms/WishList_model', 'wishlist');

        // TODO: add code here

        $data['title'] = 'Edit Wish List Item';

        $this->template->load('template', 'forms/wishlist_edit', $data);
    }
    /**
     * Add a new wish list item
     *
     * URL = /forms/wishlist/add
     */
    function add() {
        $this->load->helper('form');
        $this->load->model('forms/WishList_model', 'wishlist');

        // TODO: add code here

        $data['title'] = 'Add Wish List Item';

        $this->template->load('template', 'forms/wishlist_add', $data);
    }
    /**
     * Delete a wish list item
     *
     * URL = /forms/wishlist/delete
     */
    function delete() {
        $this->load->helper('form');
        $this->load->model('forms/WishList_model', 'wishlist');

        // TODO: add code here

        $data['title'] = 'Delete Wish List Item';

        $this->template->load('template', 'forms/wishlist_delete', $data);
    }
}