<?php
    class Controller{
        // Creates a view and passes data to it
        public function view($view,$data = []){
            require_once '../app/views/' . $view . '.php';
        }

        //Deletes an object
        public function delete($id,$table){
            require_once 'Model.php';
            Model::delete($id,$table);
            header("LOCATION: /");
        }
    }    
?>