<?php
class User {
	private $database;
	public $id, $username, $password, $usergroup, $created, $profileid, $mission, $country;

	public function __construct() {
		$this->database = new Connection();
		$this->database = $this->database->connect();
	}

	// Create record in database table
	public function createUser() {
		$statement = $this->database->prepare("INSERT INTO users (username, password, usergroup, profileid, mission, country) VALUES (?, ?, ?, ?, ?, ?)");
		// Bind all values to the placeholders
        $statement->bindParam(1, $this->username);
		$statement->bindParam(2, $this->password);
		$statement->bindParam(3, $this->usergroup);
		$statement->bindParam(4, $this->profileid);
		$statement->bindParam(5, $this->mission);
		$statement->bindParam(6, $this->country);

		// Execute the query
		$result = $statement->execute();

		return $result ? true : false;
	}
	public function updateUser() {
	    $statement->$this->database->prepare("UPDATE `users` SET `username`= :username,`password`= :password WHERE id = :id");

	    $statement->bindParam(':username', $username, PDO::PARAM_STR);
	    $statement->bindParam(':password', $password, PDO::PARAM_STR);

	    $statement->execute();
    }

	// Read row(s) from the database table
	public function getUser() {
		$statement = $this->database->prepare("SELECT * FROM users");
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $results ? $results : false;
	}

	public function userProfile() {
		$query = "SELECT users.*, profile.* FROM users JOIN profile ON users.profileid = profile.id ORDER BY users.created DESC";
		$statement = $this->database->prepare($query);
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $results ? $results : false;
	}

	public function countAll() {
		$statement = $this->database->prepare("SELECT COUNT(*) AS count FROM users");
		$statement->execute();
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}

	public function countAttache($mission) {
		$statement = $this->database->prepare("SELECT COUNT(mission) AS count FROM users WHERE mission = :id");
		$statement->execute(array("id"=> $mission));
		$result = $statement->fetch();

		return !empty($result['count']) ? $result['count'] : false;
	}

	public function login($username, $password) {
		$statement = $this->database->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
		$statement->execute(array("username"=>$username, "password"=>$password));

		$result = $statement->fetch(

        );

		// Create SESSION variables for logged in user
		if ($result) {
			$_SESSION['us3rid'] = $result['id'];
			$_SESSION['us3rgr0up'] = $result['usergroup'];
			$_SESSION['profile'] = $result['profileid'];
			$_SESSION['mission'] = $result['mission'];
			$_SESSION['country'] = $result['country'];
			$_SESSION['continent'] = $result['continentid'];
            $_SESSION['loggedin_time'] = $result['loggedin_time'];
			$_SESSION['1s@dmin'] = ($result['usergroup'] == 118) ? true : false;
		}

		return $result ? true : false;
	}

	public function logout() {
		if (isset($_SESSION['us3rid'])){
			unset($_SESSION['us3rid']);
			session_destroy();

			return true;
		}
		return false;
	}
}
