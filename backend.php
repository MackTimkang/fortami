<?php
    class Backend{
        private $con;
        public function dbcon(){
            $host="localhost";
            $user="Mack24";
            $pass="Mack.24";
            $dbname="fortami";

            $this->con = mysqli_connect($host,$user,$pass,$dbname);
            if($this->con){
                echo "Connected Successfully!";
            }
            else {
                echo "ERROR";
            }
        }
    }
?>