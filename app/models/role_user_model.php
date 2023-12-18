<?php

class Role_user_model {
	private $table = 'user';
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function cekAdmin() {

		if (isset($_SESSION['username'], $_SESSION['username'], $_SESSION['auth'])) {
			$this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
			$this->db->bind('username', $_SESSION['username']);
			$data = $this->db->single();

			if ( $_SESSION['username'] == $data['username'] ) {
				if ( $_SESSION['level'] == 1 ) {
					if ( $_SESSION['auth'] == $data['cookie'] ) {
	
						return 1;
					}
				}elseif ( $_SESSION['level'] == 2 ) {
					if ( $_SESSION['auth'] == $data['cookie'] ) {
	
						return 2;
					}
				}elseif ( $_SESSION['level'] == 3 ) {
					if ( $_SESSION['auth'] == $data['cookie'] ) {
	
						return 3;
					}
				}
			}else {
				return 0;
			}	
		}else {
			return 0;
		}
		
	}


}