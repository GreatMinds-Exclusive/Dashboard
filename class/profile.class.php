<?php
class Profile {
	private $database;
	public $id, $nisno, $firstname, $middlename, $lastname, $gender, $rank, $email, $phone1, $address, $city, $state, $country, $mission, $phone2, $dofa, $dopa, $posted, $dob;

	public function __construct() {
		$this->database = new Connection();
		$this->database = $this->database->connect();
	}

	// Create record in database table
	public function createProfile() {
		$statement = $this->database->prepare("INSERT INTO profile (nisno, firstname, middlename, lastname, gender, rank, email, phone1, address, city, state, country, mission, phone2, dofa, dopa, posted, dob) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		// Bind all values to the placeholders
		$statement->bindParam(1, $this->nisno);
		$statement->bindParam(2, $this->firstname);
		$statement->bindParam(3, $this->middlename);
		$statement->bindParam(4, $this->lastname);
		$statement->bindParam(5, $this->gender);
		$statement->bindParam(6, $this->rank);
		$statement->bindParam(7, $this->email);
		$statement->bindParam(8, $this->phone1);
		$statement->bindParam(9, $this->address);
        $statement->bindParam(10, $this->city);
        $statement->bindParam(11, $this->state);
        $statement->bindParam(12, $this->country);
        $statement->bindParam(13, $this->mission);
        $statement->bindParam(14, $this->phone2);
        $statement->bindParam(15, $this->dofa);
        $statement->bindParam(16, $this->dopa);
        $statement->bindParam(17, $this->posted);
        $statement->bindParam(18, $this->dob);

		// Execute the query
		$result = $statement->execute();

		// Retrieve profileid and return value
		$this->id = $this->database->lastInsertId();

		return $result ? true : false;
	}
	public function updateProfile() {
	    $statement = $this->database->prepare("UPDATE `profile` SET `nisno`= :nisno,`firstname`= :firstname,`middlename`= :middlename,`lastname`= :lastname,`gender`= :gender,`rank`= :rank,`email`= :email,`phone1`= :phone1,`address`= :address,`city`= :city,`state`= :state,`country`= :countryid,`mission`= :missionid,`phone2`= :phone2,`dofa`= :dofa,`dopa`= :dopa,`posted`= :posted,`dob`= dob WHERE id = :id");

	    $statement->bindParam(':nisno', $nisno, PDO::PARAM_STR);
	    $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
	    $statement->bindParam(':middlename', $middlename, PDO::PARAM_STR);
	    $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
	    $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
	    $statement->bindParam(':rank', $rank, PDO::PARAM_STR);
	    $statement->bindParam(':email', $email, PDO::PARAM_STR);
	    $statement->bindParam(':phone1', $phone1, PDO::PARAM_STR);
	    $statement->bindParam(':address', $address, PDO::PARAM_STR);
	    $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':countryid', $country, PDO::PARAM_STR);
        $statement->bindParam(':missionid', $mission, PDO::PARAM_STR);
        $statement->bindParam(':phone2', $phone2, PDO::PARAM_STR);
	    $statement->bindParam(':dofa', $dofa, PDO::PARAM_STR);
	    $statement->bindParam(':dopa', $dopa, PDO::PARAM_STR);
	    $statement->bindParam(':posted', $posted, PDO::PARAM_STR);
	    $statement->bindParam(':dob', $dob, PDO::PARAM_STR);

	    $statement->execute();
    }

	// Read row(s) from the database table
    public function getProfile($id) {
        $statement = $this->database->prepare("SELECT * FROM profile WHERE id = :id");
        $statement->execute(array("id"=>$id));
        $result = $statement->fetch();

        return $result ? $result : false;
    }

	public function getName($profileid) {
		$statement = $this->database->prepare("SELECT firstname FROM profile WHERE id = :profileid");
		$statement->execute(array("profileid"=>$profileid));
		$result = $statement->fetch();

		return $result ? $result['firstname'] : '';
	}
    
    public function getMission($profileid) {
        $statement = $this->database->prepare("SELECT mission FROM profile WHERE id = :profileid");
        $statement->execute(array("profileid"=>$profileid));
        $result = $statement->fetch();
        
        return $result ? $result['mission'] : '';
    }
    
    public function getCountry($profileid) {
        $statement = $this->database->prepare("SELECT country FROM profile WHERE id = :profileid");
        $statement->execute(array("profileid"=>$profileid));
        $result = $statement->fetch();
        
        return $result ? $result['country'] : '';
    }

    public function getPic($profileimage) {
        $statement = $this->database->prepare("SELECT image FROM profile WHERE image = :profileimage" );
        $statement->execute(array("profileimage"=>$profileimage));
        $result = $statement->fetch(PDO::FETCH_BOUND);
        header("Content-Type: image");
        return $result ? $result['image'] : '';
    }

	// Update row in table

	// Delete record from table
}