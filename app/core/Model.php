<?php
    class Model{
        public static $host = "127.0.0.1";
        public static $dbName = "teltonika";
        public static $username = "admin";
        public static $password = "admin";
        
        private static function connect() {
                $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8",self::$username, self::$password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
        }
        public static function query($query, $params = array()) {
                $statement = self::connect()->prepare($query);
                try {
                    $statement->execute($params);
                }
                catch (Exception $exception) {
                    return $exception->getMessage();
                }
                if (explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                return $data;
                }
        }


        //Saves data ($data) in database
        public static function save($data) {

            $arrayOfColumns = array();  
            $arrayOfValues = array(); 

            //Puts data to appropriate arrays from $data variable
            foreach ($data as $key => $value) {
                if ($key != "id" && $key != "created_at") {
                    array_push($arrayOfColumns, $key);
                    array_push($arrayOfValues, $value);
                }
            }

            $values = "VALUES ( '" . implode("', '", $arrayOfValues ) ."' )";
            echo "INSERT INTO ".$data::$tableName." (".implode(", ",$arrayOfColumns).") ".$values;
            $response = self::query("INSERT INTO ".$data::$tableName." (".implode(", ",$arrayOfColumns).") ".$values);

            return $response;
        }


            //Updates data ($data) in database
        public static function update($data) {

            //Builds string that holds columns and new values for them
            $update = " ";
            foreach ($data as $key => $value){
                if ($key != "id" && $key != "created_at") {
                    $update .= " $key = '$value',";
                }
            }

            //Removes the last '
            $update = rtrim($update, ",");
            $response = self::query("UPDATE ".$data::$tableName." SET ".$update." WHERE id = '$data->id'");
            echo "UPDATE ".$data::$tableName." SET ".$update." WHERE id = '$data->id'";
            return $response;
        }

                //Deletes record ($id) from database
        public static function delete($id, $table) {

            $response = self::query("DELETE FROM $table WHERE id = '$id'");  //query to delete data

            return $response;
        }

                    //Gets value of sorting session variable
            public static function getSortingType() {
                if (isset($_GET["sorting"])){
                    return $_GET["sorting"];
                }

                return "ASC";
            }
            
?>
