<?php    
    class Country extends Model{
        
        protected static $tableName = 'Country';

        public $id;             
        public $name;           
        public $size;           
        public $population;     
        public $phone_code;     
        public $created_at;   

        //Constructs an object
        public function __construct($id = '', $name = '', $size = '' , $population = '', $phone_code = '', $created_at = '')
        {
            $this->id = $id;
            $this->name = $name;
            $this->size = $size;
            $this->population = $population;
            $this->phone_code = $phone_code;
            $this->created_at = $created_at;
        }


        //Gets all of the country objects form the MySql database
        public static function getAll(){
            $countries = [];

            $response = self::query("SELECT * FROM ".self::$tableName);

            if(is_array($response)){
                foreach($response as $country){
                    $countries[] = new Country($country['id'],$country['name'],$country['size'],$country['population'],$country['phone_code'],$country['created_at']);
                }   
            }

            return $countries;
        }

        //Gets the specific page from the MySql database
        public static function getPage($pageLimit, $page, $search, $start, $end){
            $countries = [];
            $response = self::query("SELECT * FROM ".self::$tableName ." WHERE name LIKE '". $search. "%' AND created_at > '".$start. "' AND created_at < '".$end. "' ORDER BY name " . self::getSortingType() ." LIMIT " . $pageLimit . " OFFSET " . (($page - 1) * $pageLimit));

            if(is_array($response)){
                foreach($response as $country){
                    $countries[] = new Country($country['id'],$country['name'],$country['size'],$country['population'],$country['phone_code'],$country['created_at']);
                }   
            }

            return $countries;
        }

        //Gets the count of countries in the database 
        public static function getCount($search = '', $start,$end){

            $response = self::query("SELECT COUNT(*) FROM ".self::$tableName." WHERE name LIKE '". $search. "%' AND created_at > '".$start. "' AND created_at < '".$end."'");
            
            return $response[0];
        }
        
    }
?>