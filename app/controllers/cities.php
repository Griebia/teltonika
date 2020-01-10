<?php

    class Cities extends Controller{

        public function index($country,$page = '1')
        {
            require_once '../app/core/Model.php';
            require_once '../app/models/City.php';
            $perPage = 10;
            $search = "";
            $start = "0000-01-01T00:00";
            $end = "9999-12-30T00:00";

            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }
            if(isset($_GET['start']) && isset($_GET['end'])){
                $start = $_GET['start'];
                $end = $_GET['end'];
            }

            $data['cities'] = City::getPageByCountry($perPage, $page , $country,$search,$start,$end);

            $data['country_id'] = $country;

            $data['numberOfPages'] =  ceil((City::getCountByCountry($country,$search,$start,$end)[0]/10));

            $data['page'] = $page;

            $this->view('city/index',$data);
        }

        //saves country in database
        public function save() {
            require_once '../app/core/Model.php';
            require_once '../app/models/City.php';
            //creates new object with data about country
            
            $countryToSave = new City(null, $_GET['name'], $_GET['size'], $_GET['population'], $_GET['postCode'],$_GET['country_fk'], null);

            $location = "/public/cities/index/".$_GET['country_fk'];
            
            $response = City::save($countryToSave);   //saves country in data base


            header("LOCATION: ".$location);      //sets location to main page and loads it
        }

        //updates country in database
        public function edit() {
            require_once '../app/core/Model.php';
            require_once '../app/models/City.php';
            //creates new object with data about country
            $countryToEdit = new City( $_GET["id"], $_GET['name'], $_GET['size'], $_GET['population'], $_GET['code'],$_GET['country_fk'], null);

            $response = City::update($countryToEdit);   //updates country in data base


            //location to page where object was being edited
            // $location = sizeof(func_get_arg(0)) == 2 ? "/countries/index/".$currentPage."/".func_get_arg(0)[1] : "/countries/index/".$currentPage;
            $location = "/public/cities/index/".$_GET['country_fk'];
            header("LOCATION: ".$location);      //sets location and loads page
        }
    }

?>