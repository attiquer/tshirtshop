<?php
class StoreFront
{
  public $mSiteUrl;

  //Define the template file for the page contents
  public $mContentsCell = 'first_page_contents.tpl';

  //Define the template file for category cell
  public $mCategoriesCell = 'blank.tpl';

  //Define template for products cell
  public $mProductsCell = 'blank.tpl';

  // Class constructor
  public function __construct()
  {
    $this->mSiteUrl = Link::Build('');
  }

  //initialize presentation object
  public function init(){
    //load department template if visiting department
    if(isset($_GET['DepartmentId'])){
      $this->mContentsCell = 'department.tpl';
      $this->mCategoriesCell = 'categories_list.tpl';
    }
    elseif (isset($_GET['ProductId']) && isset($_SESSION['link_to_continue_shopping']) &&
        strpos($_SESSION['link_to_continue_shopping'], 'DepartmentId', 0) !==FALSE)
    {
      $this->mContentsCell = 'categories_list.tpl';
    }
      //load product details page if visisting a product
      if(isset($_GET['ProductId']))
      {
          $this->mContentsCell = 'product.tpl';
      }
  }
}
