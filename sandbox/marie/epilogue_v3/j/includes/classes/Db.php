<?php
/*
        class.sql.php
        
        author: Baldwin Chang (baldwin@baldwinc.com)

*/

class Db {

        private $_sql_db = '';
        private $_sql_user = '';
        private $_sql_pass = '';

        private $_sql = '';
        
        private $_queries = 0;

        function __construct($user, $pass, $db) {
                $this->_sql_db = $db;
                $this->_sql_user = $user;
                $this->_sql_pass = $pass;

                $this->_sql = mysql_connect("localhost", $this->_sql_user, $this->_sql_pass);

                mysql_select_db($this->_sql_db, $this->_sql);
        }

        public function raw_query($query) {
                $this->_queries++;
                return mysql_query($query, $this->_sql);
        }

        public function query($query) {
//                         echo $query;
                        return mysql_fetch_array($this->raw_query($query));
        }

        public function session_add($id, $key) {
                ##
                ## Since, the SQL table is set up such that only unique
                ##         users may be added... we must check for sessions
                ##        made for the current user first.
                ##
                global $config;
                $result = $this->query("SELECT COUNT( * ) AS TOTALFOUND FROM ".$config['session']['dbtable']." WHERE `user_id` = '". $id ."' LIMIT 1");

                
                if ($result['TOTALFOUND'] > 0) {
                        $this->raw_query("DELETE FROM `epi_sessions` WHERE `user_id` = '". $id ."'");
                }
                $this->raw_query("INSERT INTO  ".$config['session']['dbtable']." (
                                        `last_activity` ,
                                        `session_id` ,
                                        `login_key` ,
                                        `ip_address` ,
                                        `user_agent` ,
                                        `user_id`
                                )
                                VALUES (
                                        '". time() ."',  '". session_id() ."',  '". $key ."', '". $_SERVER['REMOTE_ADDR'] ."',  '". $_SERVER['HTTP_USER_AGENT'] ."',  '". $id ."'
                                );");
                
        }

        public function query_session_destroy() {
                return $this->raw_query("DELETE FROM `epi_sessions` WHERE `user_id` = '". $_SESSION['epi_id'] ."'");
        }

        function __destruct() {
                mysql_close($this->_sql);
                /*
                        echo 'queries: '. $this->_queries;
                        echo 'execution time: '. number_format((microtime(true)-$_SERVER["REQUEST_TIME_FLOAT"]), 5) .'s';
                */
        } 

}

?>