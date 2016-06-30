<?php
class Product
{
    //public properties for smarty
    public $mProduct;
    public $mLocations;
    public $mProductLocations;
    public $mLinkTocontinueShopping;

    //private properties
    private $_mProductId;

    public function __construct()
    {
        //get product id from query string
        if(isset($_GET['ProductId']))
        {
            $this->_mProductId = (int)$_GET['ProductId'];
        }
        else
        {
            trigger_error('No product id found');
        }
    }

    public function init()
    {
        $this->mProduct = Catalog::GetProductDetails($this->_mProductId);

        if(isset($_SESSION['link_to_continue_shopping']))
        {
            $continue_shopping = Link::QueryStringToArray($_SESSION['link_to_continue_shopping']);
            $page = 1;
            if(isset($continue_shopping['Page']))
            {
                $page = (int)$continue_shopping['Page'];
            }
            if(isset($continue_shopping['CategoryId']))
            {
                $this->mLinkTocontinueShopping = Link::ToCategory((int)$continue_shopping['DepartmentId'], (int)$continue_shopping['CategoryId'], $page);
            }
            elseif(isset($continue_shopping['DepartmentId']))
            {
                $this->mLinkTocontinueShopping = Link::ToDepartment((int)$continue_shopping['DepartmentId'], $page);
            }
            else{
                $this->mLinkTocontinueShopping = Link::ToIndex($page);
            }
        }

        if(isset($this->mProduct['image']))
        {
            $this->mProduct['image'] = Link::Build('images/product_images/' . $this->mProduct['image']);
        }
        if(($this->mProduct['image_2']))
        {
            $this->mProduct['image_2'] = Link::Build('images/product_images/' . $this->mProduct['image_2']);
        }
        $this->mLocations = Catalog::GetProductLocations($this->_mProductId);

        //build links for product departments and category pages for mLocations array
        for($i=0; $i < count($this->mLocations); $i++)
        {
            $this->mLocations[$i]['link_to_department'] =
                Link::ToDepartment($this->mLocations[$i]['department_id']);
            $this->mLocations[$i]['link_to_category'] =
                Link::ToCategory($this->mLocations[$i]['department_id'],
                    $this->mLocations[$i]['category_id']);
        }




    }


}