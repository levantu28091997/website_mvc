<?php
	require_once "../lib/database.php";
	require_once "../lib/session.php";
	Session::checkLogin();
	require_once "../helpers/format.php";
?>
<?php
	/**
	 * 
	 */
	class Adminlogin
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format(); 	
		}

		public function login_admin($username, $password){
			// $username = $this->fm->validate($username);
			// $password = $this->fm->validate($password);

			$username = mysqli_real_escape_string($this->db->link, $username);
			$password = mysqli_real_escape_string($this->db->link, $password);

			if (empty($username) || empty($password)) {
				$alert = "user and password not empty";
				return $alert;
			}else{
				$qr = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password' ";
				$result =  $this->db->select($qr);

				if ($result != false) {
					// $value = mysql_fetch_assoc($result);
					Session::set('login', true);
					header('Location:index.php');
				}else{
					$alert = "user and password error";
					return $alert;
				}
			}
		}
	}
?>