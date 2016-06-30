<?php
// Business tier class for reading product catalog information

class Catalog
{
  // Retrieves all departments
  public static function GetDepartments()
  {
    // Build SQL query
    $sql = 'CALL catalog_get_departments_list()';

    // Execute the query and return the results
    return DatabaseHandler::GetAll($sql);
  }

  public static function  GetDepartmentDetails($departmentId){
    $sql = 'CALL catalog_get_department_details(:departmentId)';

    //build the parameters array
    $params = array(':departmentId' =>$departmentId);

    //Execute the query and return the results
    return DatabaseHandler::GetRow($sql, $params);

  }

    public static function GetCategoriesInDepartment($departmentId)
    {
        $sql = 'CALL  catalog_get_categories_list (:departmentId)';

        //build the parameters array
        $params = array(':departmentId' => $departmentId);

        //Execute the query
        return DatabaseHandler::GetAll($sql, $params);
    }

    public static function GetCategoryDetails($catId)
    {
        $sql = 'CALL catalog_get_category_details(:categoryId)';

        //build parameters array
        $params = array(':categoryId' => $catId);

        //execute the query
        return DatabaseHandler::GetRow($sql, $params);
    }

    /**
     * Calculates number of pages
     */

    private static function HowManyPages($countSql, $countSqlParams){
        //create a hash for the sql query
        $queryHashCode = md5($countSql . var_export($countSqlParams, true));

        //verify if we have query results in the cache
        if(isset($_SESSION['last_count_hash']) && isset($_SESSION['how_many_pages']) &&
        $_SESSION['last_count_hash'] == $queryHashCode)
        {
            //retrieve the cache values
            $how_many_pages = $_SESSION['how_many_pages'];
        }
        else{
            //execute the query to retrieve number of pages from db
            $items_count = DatabaseHandler::GetOne($countSql, $countSqlParams);

            //calculate the number of pages
            $how_many_pages = ceil($items_count / PRODUCTS_PER_PAGE);

            //save the query and its count in session
            $_SESSION['how_many_pages'] = $how_many_pages;
            $_SESSION['last_count_hash'] = $queryHashCode;
        }
        //return the number of pages
        return $how_many_pages;

    }

    public static function GetProductsInCategory($categoryId, $pageNo, &$rHowManyPages){

        //sql query that returns number of products in category
        $sql = 'CALL catalog_count_products_in_category(:categoryId)';

        //prepare parameters array
        $params = array(':categoryId' => $categoryId);

        //calculate the number of pages required to show products
        $rHowManyPages = Catalog::HowManyPages($sql, $params);

        //calculate the start item
        $start_item = ($pageNo - 1) * PRODUCTS_PER_PAGE;

        //retrieve the list of products
        $sql = 'CALL catalog_get_products_in_category(:categoryId, :shortDescLength, :prodsPerPage, :startItem)';

        //build the parameters array
        $params = array(':categoryId' =>$categoryId, ':shortDescLength' =>SHORT_PRODUCT_DESCRIPTION_LENGTH, ':prodsPerPage' => PRODUCTS_PER_PAGE, ':startItem' =>$start_item);

        //execute the query and return results
        return DatabaseHandler::GetAll($sql, $params);
    }

    public static function GetProductsOnDepartment($departmentId, $pageNo, &$rHowManyPages){
        //sql query that returns number of products in department
        $sql = 'CALL catalog_count_products_on_department(:departmentId)';

        //prepare parameters
        $params = array(':departmentId' => $departmentId);

        $rHowManyPages = Catalog::HowManyPages($sql, $params);

        //calculate start tiem
        $startItem = ($pageNo - 1) * PRODUCTS_PER_PAGE;

        //retrieve the list of products
        $sql = 'CALL catalog_get_products_on_department(:department_id, :shortDescLength, :prodsPerPage, :startItem)';

        //preparte parameters
        $params = array(':department_id' => $departmentId, ':shortDescLength' =>SHORT_PRODUCT_DESCRIPTION_LENGTH, ':prodsPerPage' =>PRODUCTS_PER_PAGE, ':startItem' => $startItem);

        //execute the query
        return DatabaseHandler::GetAll($sql, $params);

    }

    public static function GetProductsOnCatalog($pageNo, &$rHowManyPages)
    {

        //build sql query
        $sql = 'CALL catalog_count_products_on_catalog()';

        //calculate number of pages
        $rHowManyPages = self::HowManyPages($sql, null);

        //calculate start item
        $startItem = ($pageNo - 1) * PRODUCTS_PER_PAGE;

        //retrieve list of items
        $sql = 'CALL catalog_get_products_on_catalog(:shortDescLength, :prodsPerPage, :startItem)';

        //build parameters
        $params = array(':shortDescLength' => SHORT_PRODUCT_DESCRIPTION_LENGTH, ':prodsPerPage' => PRODUCTS_PER_PAGE, ':startItem' => $startItem);

        //execute and return the query resutls
        return DatabaseHandler::GetAll($sql, $params);
    }

    public static function GetProductDetails($productId){
        //build sql query
        $sql = 'CALL catalog_get_product_details(:productId)';

        //build parameters
        $params = array(':productId' => $productId);

        //execute query and return results
        return DatabaseHandler::GetRow($sql, $params);
    }

    public static function GetProductLocations($productId){
        //build sql query
        $sql = 'CALL catalog_get_product_locations(:productId)';

        //build parameters
        $params = array('productId' => $productId);

        //execute query and return results
        return DatabaseHandler::GetAll($sql, $params);
    }


}
