<?php
    defined("BASEPATH") OR exit("No direct script access allowed");

    class Home extends CI_Controller{
        //ctor
        public function __construct(){
            parent:: __construct();

            //load model
            $this->load->model("HomeModel");
            
            //form validation init
            $this->form_validation->set_rules("nim", "NIM", "required|is_natural|exact_length[11]");
            $this->form_validation->set_rules("fname", "First Name", "required");
            $this->form_validation->set_rules("lname", "Last Name", "required");
            $this->form_validation->set_rules("desc", "Description", "required");
            $this->form_validation->set_rules("addr", "Address", "required");
            $this->form_validation->set_message("required", "{field} is required.");
            $this->form_validation->set_message("is_natural", "{field} can only consist of numbers (0-9).");
            $this->form_validation->set_message("exact_length", "{field} characters must be {param}.");
        }
        
        //index
        public function Index(){
            $data["cssjs"] = $this->load->view("include/cssjs.html", null, true);
            $data["header"] = $this->load->view("include/header.php", null, true);
            $data["footer"] = $this->load->view("include/footer.php", null, true);
            $this->load->view("Home/Index.php", $data);
        }

        //index table
        public function GetAllData(){
            echo json_encode($this->HomeModel->GetAllData());
        }

        //create
        //form
        public function CreateGet(){
            $this->load->view("Home/StudentCreate.php", null);
        }
        //submit
        public function Create(){
            //get all data
            $data = [
                "nim" => $this->input->post("nim"),
                "fname" => $this->input->post("fname"),
                "lname" => $this->input->post("lname"),
                "desc" => $this->input->post("desc"),
                "addr" => $this->input->post("addr")
            ];

            //validation success
            if ($this->form_validation->run() == true) {
                $success = $this->HomeModel->Create($data);
                if($success) {
                    $rs = true;
                    $rt = "Create student success.";
                }
                else{
                    $rs = false;
                    $rt = "Create student failed.";
                }
            }
            //validation failed
            else {
                $rs = false;
                $rt = "Please check your input again.";
                $rv = $this->load->view("Home/StudentCreate.php", $data, true);
            }
            
            echo json_encode([
                "rs" => $rs,
                "rt" => $rt,
                "rv" => isset($rv) ? $rv : null
            ]);
        }
        
        //edit
        //form
        public function EditGet(){
            $data = $this->HomeModel->GetData($this->input->get("id"));
            $this->load->view("Home/StudentEdit.php", $data);
        }
        //submit
        public function Edit(){
            $id = $this->input->post("id");
            $data = [
                "nim" => $this->input->post("nim"),
                "fname" => $this->input->post("fname"),
                "lname" => $this->input->post("lname"),
                "desc" => $this->input->post("desc"),
                "addr" => $this->input->post("addr")
            ];

            //validation success
            if ($this->form_validation->run() == true) {
                $success = $this->HomeModel->Edit($id, $data);
                if($success) {
                    $rs = true;
                    $rt = "Edit student success.";
                }
                else{
                    $rs = false;
                    $rt = "Edit student failed.";
                }
            }
            //validation failed
            else {
                $data["id"] = $id;
                $rs = false;
                $rt = "Please check your input again.";
                $rv = $this->load->view("Home/StudentEdit.php", $data, true);
            }
            
            echo json_encode([
                "rs" => $rs,
                "rt" => $rt,
                "rv" => isset($rv) ? $rv : null
            ]);
        }

        //detail
        public function DetailGet(){
            $data = $this->HomeModel->GetData($this->input->get("id"));
            $this->load->view("Home/StudentDetail.php", $data);
        }

        //delete
        public function Delete(){
            $success = $this->HomeModel->Delete($this->input->post("id"));

            if($success) {
                $rs = true;
                $rt = "Delete student success.";
            }
            else{
                $rs = false;
                $rt = "Delete student failed.";
            }

            echo json_encode([
                "rs" => $rs,
                "rt" => $rt
            ]);
        }
    }
?>