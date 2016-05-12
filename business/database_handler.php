<?php
class DatabaseHandler{
    /** @var  $_mHandler private static, holds an instance of the PDO class  */
    private static $_mHandler;

    /** private constructor so direct creation is prevented */
    private function __construct(){

    }

    /** Returns an initialised database handler */
    private static function GetHandler(){
        /** create a db handler if one does not already exist */
        if(!isset(self::$_mHandler)) {
            try {
                self::$_mHandler = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_PERSISTENT => DB_PERSISTANCY));

                //configure PDO to throw exception
                self::$_mHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e){
                //close the db handler and force the error
                self::Close();
                trigger_error($e->getMessage(), E_USER_ERROR);
            }
        }
        return self::$_mHandler;
    }

    /** close the PDO class instance */
    public static function Close(){
        self::$_mHandler = null;
    }

    /** wrapper method for PDO execute() */
    public static function Execute($sqlQuery, $params = null){

        /** try to execute sql query */
        try{
            /**get the db handler*/
            $database_handler = self::GetHandler();

            /** prepare the query for execution */
            $statement_handler = $database_handler->prepare($sqlQuery);

            /** execute the query */
            $statement_handler->execute();
        }
        /** trigger an error if exception was thrown */
        catch(PDOException $e){
            /** close the PDO object */
            self::Close();
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
    }

    /** wrapper method for get all query */
    public static function GetAll($sqlQuery, $params = null, $fetchStyle = PDO::FETCH_ASSOC){

        /** initialize the return value to null */
        $result = null;
        try{
            $database_handler = self::GetHandler();

            $statement_handler = $database_handler->prepare($sqlQuery);

            $statement_handler->execute($params);

            $result = $statement_handler->fetchAll($fetchStyle);
        }
        catch(PDOException $e){
            self::Close();
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
        return $result;
    }

    /** wrapper method for fetch pdo statement */
    public static function GetRow($sqlQuery, $params = null, $fetchStyle = PDO::FETCH_ASSOC){
        $result = null;

        try{
            $database_handler = self::GetHandler();
            $statement_handler = $database_handler->prepare($sqlQuery);
            $statement_handler->execute($params);

            $result = $statement_handler->fetch($fetchStyle);
        }
        catch(PDOException $e){
            self::Close();
            trigger_error($e->getMessage(), E_USER_ERROR);
        }
        return $result;
    }


}