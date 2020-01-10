<?php

    class Countries extends Controller{

        protected static $tableName = 'Country';


        public function index($page = '1'){
            require_once '../app/core/Model.php';
            require_once '../app/models/Country.php';
            //Number per page
            $perPage = 10;
            $search = "";
            $start = "2000-05-12T19:30";
            $end = "2022-05-12T19:30";

            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }
            if(isset($_GET['start']) && isset($_GET['end'])){
                $start = $_GET['start'];
                $end = $_GET['end'];
            }

            $data['countries'] = Country::getPage($perPage, $page, $search,$start,$end);

            $data['numberOfPages'] =  ceil((Country::getCount($search,$start,$end)[0]/10));

            $data['page'] = $page;

            $this->view('country/index',$data);
        }

        //Saves country in MySql database
        public function save() {
            require_once '../app/core/Model.php';
            require_once '../app/models/Country.php';
            //Creates new country object
            $country = new Country(null, $_GET['name'], $_GET['size'], $_GET['population'], $_GET['phoneCode'], null);

            Country::save($country);   //saves country in data base
            header("LOCATION: /public/");      //sets location to main page and loads it
        }

        //updates country in database
        public function edit() {
            require_once '../app/core/Model.php';
            require_once '../app/models/Country.php';
            ///Creates new country object
            $country = new Country( $_GET["id"], $_GET['name'], $_GET['size'], $_GET['population'], $_GET['code'], null);

            Country::update($country);   //Update the element

            //Location to page where object been eddited
            $location = "/public/countries/".$data['page']."/";
            header("LOCATION: ".$location);      //sets location and loads page
        }
    }
?>