<?php
    defined("BASEPATH") OR exit("No direct script access allowed");

    class HomeModel extends CI_Model{
        public $id;
        public $nim;
        public $fname;
        public $lname;
        public $desc;
        public $addr;

        function __construct(){
            parent::__construct();

        }

        //GET ALL STUDENT DATA
        function GetAllData(){
            return $this->db->get("student")->result();
        }

        //GET 1 STUDENT DATA
        function GetData($id){
            return $this->db->get_where("student", array("id" => $id))->row();
        }

        //CREATE STUDENT
        function Create($data){
            try{
                $this->db->insert("student", $data);
                return true;
            }
            catch(Exception $e){
                return false;
            }
        }

        //EDIT STUDENT
        function Edit($id, $data){
            try{
                $this->db->where("id", $id)
                    ->update("student", $data);
                return true;
            }
            catch(Exception $e){
                return false;
            }
        }

        //DELETE STUDENT
        function Delete($id){
            try{
                $this->db->where("id", $id)
                    ->delete("student");
                return true;
            }
            catch(Exception $e){
                return false;
            }
        }
    }
?>