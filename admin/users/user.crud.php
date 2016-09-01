<?php 
	include_once $_SERVER ['DOCUMENT_ROOT'].'/admin_php/config/dbconnect.php';

	class CRUDUser {
 public function __construct()
 {
  $db = new DB_con();
 }
 
 public function create($name,$email,$password,$username)
 {
  mysql_query("INSERT INTO users(name,email,password,username) VALUES('$name','$email','$password','$username')");
 }

 public function userExists($username,$password) {
 	return mysql_query("SELECT * from users WHERE username='$username' AND password='$password'");
 }
 
 public function read()
 {
  return mysql_query("SELECT * FROM users");
 }

 public function readSingle($id)
 {
  return mysql_query("SELECT * FROM users WHERE user_id=".$id);
 }
 
 public function delete($id)
 {
  mysql_query("DELETE FROM users WHERE user_id=".$id);
 }
 
 public function update($name,$email,$password,$username)
 {
  mysql_query("UPDATE users SET name='$name', email='$email', password='$password',username=$username  WHERE user_id=".$id);
 }
}
?>