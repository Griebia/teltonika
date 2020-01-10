<?php
    class City extends Model {

        protected static $tableName = 'City';
        
        public $id;             
        public $name;           
        public $size;           
        public $population;     
        public $post_code;    
        public $country_fk;    
        public $created_at;  


        //Constructor of object
        public function __construct($id = '', $name = '', $size = '', $population = '', $post_code = '', $country_fk = '', $created_at = '')
        {
            $this->id = $id;
            $this->name = $name;
            $this->size = $size;
            $this->population = $population;
            $this->post_code = $post_code;
            $this->country_fk = $country_fk;
            $this->created_at = $created_at;
        }

        //Gets all of the cities form MySql database
        public static function getAll(){
            $cities = [];

            $response = self::query("SELECT * FROM ".self::$tableName);
            print_r($response);

            if(is_array($response)){
                foreach($response as $city){
                    $cities[] = new City($city['id'],$city['name'],$city['size'],$city['population'],$city['post_code'],$city['country_fk'],$city['created_at']);
                }
            }

            return $cities;
        }

        //Gets a page from  all of the MySql database
        public static function getPage($pageLimit, $page){
            $cities = [];

            $response = self::query("SELECT * FROM ".self::$tableName . " LIMIT " . $pageLimit . " OFFSET " . ($page - 1) * $pageLimit);

            if(is_array($response)){
                foreach($response as $city){
                    $cities[] = new City($city['id'],$city['name'],$city['size'],$city['population'],$city['post_code'],$city['country_fk'],$city['created_at']);
                }
            }

            return $cities;
        }

        //Gets a page by country and all other criteria
        public static function getPageByCountry($pageLimit, $page,$country_id,$search,$start,$end){
            $cities = [];
            $response = self::query("SELECT * FROM ".self::$tableName ." WHERE country_fk = ". $country_id ." AND name LIKE '". $search. "%' AND created_at > '".$start. "' AND created_at < '".$end. "' ORDER BY name " . self::getSortingType() ." LIMIT " . $pageLimit . " OFFSET " . (($page - 1) * $pageLimit));

            if(is_array($response)){
                foreach($response as $city){
                    $cities[] = new City($city['id'],$city['name'],$city['size'],$city['population'],$city['post_code'],$city['country_fk'],$city['created_at']);
                }
            }

            return $cities;
        }

        //Gets all of the count form database of elements in it 
        public static function getCount(){
            $response = self::query("SELECT COUNT(*) FROM ".self::$tableName);
            
            return $response[0];
        }

        //Gets count by country and other criteria
        public static function getCountByCountry($country_id, $search,$start,$end){
            $response = self::query("SELECT COUNT(*) FROM ".self::$tableName . " WHERE country_fk = ". $country_id ." AND name LIKE '". $search. "%' AND created_at > '".$start. "' AND created_at < '".$end."'");
            
            return $response[0];
        }

        

    }
?>