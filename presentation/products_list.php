<?php
class ProductsList{
    //public variables to be read from smarty template

    public $mPage = 1;
    public $mrTotalPages;
    public $mProducts;
    public $mLinkToPreviousPage;
    public $mLinkToNextPage;

    //private members
    private $_mDepartmentId;
    private $_mCategoryId;

    //constructor

    public function __construct()
    {
        //Get department id from query string casting it to integer
        if(isset($_GET['DepartmentId'])){
            $this->_mDepartmentId = (int)$_GET['DepartmentId'];
        }
        //Get category id from query string casting it to integer
        if(isset($_GET['CategoryId'])){
            $this->_mCategoryId = (int)$_GET['CategoryId'];
        }
        //Get the page no from query string casting it to int
        if(isset($_GET['Page'])){
            $this->mPage = (int)$_GET['Page'];
            if($this->mPage < 1){
                trigger_error('Invalid page number');
            }
        }

        //save page request for continue shopping functionality
        $_SESSION['link_to_continue_shopping'] = $_SERVER['QUERY_STRING'];
    }

    public function init()
    {
        //if browsing a category get products from category
        if(isset($this->_mCategoryId)) {
            $this->mProducts = Catalog::GetProductsInCategory($this->_mCategoryId, $this->mPage, $this->mrTotalPages);
        }

        //if browsing a department, get products from department
        elseif(isset($this->_mDepartmentId)){
            $this->mProducts = Catalog::GetProductsOnDepartment($this->_mDepartmentId, $this->mPage, $this->mrTotalPages);
        }

        //if browsing the homepage, show relevant products
        else {
            $this->mProducts = Catalog::GetProductsOnCatalog($this->mPage, $this->mrTotalPages);
        }
        //if subpages are available show navigation controls
        if($this->mrTotalPages > 1) {
            //build the next link
            if($this->mPage < $this->mrTotalPages)
            {
                //if visiting category
                if(isset($this->_mCategoryId))
                {
                    $this->mLinkToNextPage = Link::ToCategory($this->_mDepartmentId, $this->_mCategoryId, $this->mPage + 1);
                }
                elseif (isset($this->_mDepartmentId))
                {
                    $this->mLinkToNextPage = Link::ToDepartment($this->_mDepartmentId, $this->mPage +1);
                }
                else{
                    $this->mLinkToNextPage = Link::ToIndex($this->mPage + 1);
                }
            }
            //Build previous link
            if($this->mPage > 1)
            {
                if(isset($this->_mCategoryId))
                {
                    $this->mLinkToPreviousPage = Link::ToCategory($this->_mDepartmentId, $this->_mCategoryId, $this->mPage - 1);
                }
                elseif (isset($this->_mDepartmentId))
                {
                    $this->mLinkToPreviousPage = Link::ToDepartment($this->_mDepartmentId, $this->mPage -1);
                }
                else{
                    $this->mLinkToPreviousPage = Link::ToIndex($this->mPage -1);
                }
            }
        }

        //Build links for product detail pages
        for($i = 0; $i <count($this->mProducts); $i++)
        {
            $this->mProducts[$i]['link_to_product'] = Link::ToProduct($this->mProducts[$i]['product_id']);

            if($this->mProducts[$i]['thumbnail'])
            {
                $this->mProducts[$i]['thumbnail']  = Link::Build('images/product_images/' . $this->mProducts[$i]['thumbnail']);
            }
        }
    }
}