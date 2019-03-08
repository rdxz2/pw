<?php
    class User implements \JsonSerializable{
        private $id;
        private $usn;
        private $pwd;

        public function set_id($id){$this->id = $id;}
        public function set_usn($usn){$this->usn = $usn;}
        public function set_pwd($pwd){$this->pwd = $pwd;}

        public function get_id(){return $this->id;}
        public function get_usn(){return $this->usn;}
        public function get_pwd(){return $this->pwd;}

        function __construct(){

        }

        //LOGIN
        public function Login($usn, $pwd, $db){
            $dbr = $db->prepare("SELECT * FROM users WHERE usn=? AND pwd=? LIMIT 1");
            $dbr->execute([$usn, md5($pwd)]);

            $res = $dbr->fetch();
            
            //KETEMU ATO KAGAK
            if($dbr->rowCount()>0){
                $usr = new User();
                $usr->set_id($res["id"]);
                $usr->set_usn($res["usn"]);
                // $usr->set_pwd($res["pwd"]);
                
                return $usr;
            }

            return false;
        }

        //AMBIL 1
        public function Get($id, $db){
            $res = $db->prepare("SELECT * FROM user WHERE id = " . $id . " LIMIT 1")->execute()->fetch();

            $usr = new User();
            $usr->set_id($res["id"]);
            $usr->set_usn($res["usn"]);
            $usr->set_pwd($res["pwd"]);

            return $usr;
        }
        
        //JSON SERIALIZABLE
        public function jsonSerialize()
        {
            $vars = get_object_vars($this);
    
            return $vars;
        }
    }
?>