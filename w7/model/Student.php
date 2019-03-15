<?php
    class Student{
        private $id;
        private $nim;
        private $fname;
        private $lname;
        private $desc;
        private $addr;

        public function set_id($id){$this->id = $id;}
        public function set_nim($nim){$this->nim = $nim;}
        public function set_fname($fname){$this->fname = $fname;}
        public function set_lname($lname){$this->lname = $lname;}
        public function set_desc($desc){$this->desc = $desc;}
        public function set_addr($addr){$this->addr = $addr;}

        public function get_id(){return $this->id;}
        public function get_nim(){return $this->nim;}
        public function get_fname(){return $this->fname;}
        public function get_lname(){return $this->lname;}
        public function get_desc(){return $this->desc;}
        public function get_addr(){return $this->addr;}

        function __construct(){

        }

        //AMBIL 1
        public function Get($id, $db){
            $dbr = $db->prepare("SELECT * FROM student WHERE id = " . $id . " LIMIT 1");
            $dbr->execute();
            $res = $dbr->fetch();

            $stdnt = new Student();
            $stdnt->set_id($res["id"]);
            $stdnt->set_nim($res["nim"]);
            $stdnt->set_fname($res["fname"]);
            $stdnt->set_lname($res["lname"]);
            $stdnt->set_desc($res["desc"]);
            $stdnt->set_addr($res["addr"]);

            return $stdnt;
        }

        //AMBIL SEMUA
        public function GetAll($db){
            $res = $db->query("SELECT * FROM student");
            $data = [];
        
            foreach($res as $r){
                $stdnt = new Student();
                $stdnt->set_id($r["id"]);
                $stdnt->set_nim($r["nim"]);
                $stdnt->set_fname($r["fname"]);
                $stdnt->set_lname($r["lname"]);
                $stdnt->set_desc($r["desc"]);
                $stdnt->set_addr($r["addr"]);

                $data[] = [
                    "id" => $stdnt->get_id(),
                    "nim" => $stdnt->get_nim(),
                    "fname" => $stdnt->get_fname(),
                    "lname" => $stdnt->get_lname(),
                    "desc" => $stdnt->get_desc(),
                    "addr" => $stdnt->get_addr()
                ];
            }

            return $data;
        }

        //EDIT
        public function edit($id, $fname, $lname, $desc, $addr, $db){
            try{
                $db->prepare("UPDATE student SET fname=?, lname=?, `desc`=?, addr=? WHERE id=?")->execute([$fname, $lname, $desc, $addr, $id]);
                $scs = true;
            }
            catch(Exception $e){
                $scs = false;
            }

            return $scs;
        }

        //CREATE
        public function create($nim, $fname, $lname, $desc, $addr, $db){
            try{
                $db->prepare("INSERT INTO student (nim, fname, lname, `desc`, addr) VALUES (?, ?, ?, ?, ?)")->execute([$nim, $fname, $lname, $desc, $addr]);
                $scs = true;
            }
            catch(Exception $e){
                $scs = false;
            }

            return $scs;
        }
        
        //DELETE
        public function delete($id, $db){
            try{
                $db->exec("DELETE FROM student WHERE id = " . $id);
                $scs = true;
            }
            catch(Exception $e){
                $scs = false;
            }

            return $scs;
        }
        
    }
?>