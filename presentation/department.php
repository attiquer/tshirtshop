<?php
class Department{
    public $mName;
    public $mDescription;

    private $_mDepartmentId;
    private  $_mCategoryId;

    public function __construct()
    {
        //we need to have department id in query string
        if(isset($_GET['DepartmentId'])){
            $this->_mDepartmentId = (int)$_GET['DepartmentId'];
        }
        else {
            trigger_error('department id not set');
        }
            if(isset($_GET['CategoryId'])){
            $this->_mCategoryId = (int)$_GET['CategoryId'];
            }
    }

    public function init() {
        //if visting department
        $department_Details = Catalog::GetDepartmentDetails($this->_mDepartmentId);
        $this->mName = $department_Details['name'];
        $this->mDescription = $department_Details['description'];

        //if visiting category
        if (isset($_GET['CategoryId'])) {
            $category_details = Catalog::GetCategoryDetails($this->_mCategoryId);
            $this->mName = $category_details['name'];
            $this->mDescription = $category_details['description'];

        }
    }

}