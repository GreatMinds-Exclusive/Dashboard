<?php require_once 'core/init1.php'; ?>


    <?php if (isset($_POST['register'])) {
	  $required = array('dob', 'email', 'password', 'firstname', 'lastname', 'rank', 'phone1', 'nisno', 'posted');

	  foreach($_POST as $key=>$value) {
	    if (empty($value) && in_array($key, $required)) {
	      $errors[] = "Fill out all required fields please";
	      break;
	    }
	  }

	  // If no error
	  if (empty($errors)) {
	    // Get form values
	    $user->username = sanitize('username');
	    $user->password = trim($_POST['password']);
	    $confirm = trim($_POST['confirm']);
	    $user->usergroup = 329; // Admin usergroup - 118; Member - 329

	    $profile->firstname = sanitize('firstname');
        $profile->email = sanitize('email');
	    $profile->middlename = sanitize('middlename');
	    $profile->lastname = sanitize('lastname');
	    $profile->gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
	    $profile->phone1 = sanitize('phone1');
        $profile->phone2 = sanitize('phone2');
	    $profile->address = sanitize('address');
	    $profile->city = sanitize('city');
        $profile->state = sanitize('state');
	    $profile->mission = sanitize('missionid');
	    $profile->country = sanitize('countryid');
        $profile->dob = sanitize('dob');
        $profile->rank = sanitize('rank');
        $profile->nisno = sanitize('nisno');
        $profile->dofa = sanitize('dofa');
        $profile->dopa = sanitize('dopa');
        $profile->posted = sanitize('posted');

	    // Check for more errors
	    if (!filter_var($profile->email, FILTER_VALIDATE_EMAIL)) {
	      $errors[] = "Email is invalid.";
	    }
	    if (strlen($user->password) < 6) {
	      $errors[] = "Password must be at least 6 characters.";
	    }
	    if ($user->password !== $confirm) {
	      $errors[] = "Passwords do not match.";
	    }
	    if (!is_numeric($profile->phone1)) {
	      $errors[] = "Phone must be numeric values only.";
	    }
	    if (strlen($profile->phone1) < 10) {
	      $errors[] = "Phone number must be more than 10 digits.";
	    }

	    // If there are no errors, attempt to create record in database
	    if (empty($errors)) {

            // Create Profile record
	      if ($profile->createProfile()) {
	        // Get the profileid from Profile class
	        $user->profileid = $profile->id;

	        // Get values from profile to user table
              $user->mission = $profile->mission;
              $user->country = $profile->country;

	        // Hash the password with MD5 hash algorithm
	        $user->password = md5($user->password);

	        if ($user->createUser()) {
	          $session->message("Attache Profile created successfully.");
	          redirectTo('index.php');
	        }
	      }
	    }
	  }
	}
?>

<?php include_once 'inc/head.php'; ?>
    <div class="container-fluid pt-8">
        <div class="page-header mt-0 shadow p-3">
            <ol class="breadcrumb mb-sm-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">NEW STAFF ENTRY</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-md-12">
         <h2>STAFF INFORMATION</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<div class="card shadow">
                            <?php error($errors); ?>
										<div class="card-body">
											<div class="row">
												<div class="col-md-6">
                                                    <div class="card-header">
											             <h2 class="mb-0"><i class="fas fa-user"></i> Bio Data</h2>
										              </div> 
													<div class="form-group">
														<label class="form-label">First Name</label>
														<input type="text" class="form-control" name="firstname" placeholder="firstname" value="<?php echo stickyForm('firstname'); ?>" autofocus required />
													</div>
													<div class="form-group">
														<label class="form-label">Middle Name</label>
														<input type="text" class="form-control" name="middlename" placeholder="middlename" value="<?php echo stickyForm('middlename'); ?>" />
													</div>
													<div class="form-group">
														<label class="form-label">Last Name</label>
														<input type="text" class="form-control" name="lastname" placeholder="lastname" value="<?php echo stickyForm('lastname'); ?>" required />
													</div>
                                                    <div class="form-group">
                                                        <label class="form-label">Date of birth</label>
                                                        <input type="date" name="dob" placeholder="Date of Birth" class="form-control" value="<?php echo stickyForm('dob'); ?>" required />
                                                    </div>
                                        <div class="form-group">
												<label for="gender">Gender: </label>
                                        <input type="radio" name="gender" value="male" <?php echo stickyRadio('gender', 'male') ?>> Male
                                        <input type="radio" name="gender" value="female" <?php echo stickyRadio('gender', 'female') ?>> Female
                                    </div>
                                <div class="form-group">
                                <label class="form-label">Phone 1</label>
                         <input type="number" name="phone1" placeholder="Whatsapp Line" class="form-control" value="<?php echo stickyForm('phone1'); ?>" required maxlength="14" required/></div>
                                <div class="form-group">
                                <label class="form-label">Phone 2</label>
                         <input type="number" name="phone2" placeholder="Alternate Line" class="form-control" value="<?php echo stickyForm('phone2'); ?>" maxlength="14" /></div>
                                <div class="form-group">
							<label class="form-label">Email</label>
							<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo stickyForm('email'); ?>" required />
				</div>
				                <div class="form-group mb-0">
									<label class="form-label">Address</label>
										<textarea class="form-control" name="address" rows="2" placeholder="Residential address" value="<?php echo stickyForm('address') ?>"></textarea>
													</div>
                                <div class="form-group">
                                <label class="form-label">City</label>
                         <input type="text" name="city" placeholder="City" class="form-control" value="<?php echo stickyForm('city'); ?>" required/>
                      </div>
                      <div class="form-group">
                          <label class="form-label">State of Origin</label>
	                       <select class="form-control state" name="state" value="<?php echo stickyForm('state'); ?>" required>
		                      <option value="">-- Choose State --</option>
		                      <?php
		                          $states = $state->getStates();
                                    foreach($states as $state) {
		                              echo "<option value='".$state['statename']."'";
		                              echo stickySelect('statename', $state['statename']);
		                              echo ">".$state['statename']."</option>";
	                               }
		                      ?>
	                       </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-header"><h2 class="mb-0"><i class="fas fa-briefcase"></i> Work Information</h2></div>                            
                           <div class="form-group">
												<label class="form-label">Service Number</label>
												<div class="input-group">
                                                    <span class="input-group-append">
														<button class="btn btn-disabled">NIS</button>
													</span>
													<input type="number" name="nisno" class="form-control" placeholder=" Service Number" value="<?php echo stickyForm('nisno'); ?>" required />
												</div>
											</div>
                            <div class="form-group">
								<label class="form-label">Present Rank</label>
									<select class="form-control rank" name="rank" value="<?php echo stickyForm('rank'); ?>" required>
										<option value="">--Select rank--</option>
                                        <option>CIS</option>
                                        <option>DCI</option>
                                        <option>ACI</option>
                                        <option>CSI</option>
                                        <option>SI</option>
                                        <option>DSI</option>
                                        <option>ASI1</option>
                                        <option>ASI2</option>
                                        <option>CII(TECH)</option>
                                        <option>CII</option>
                                        <option>DCII</option>
                                        <option>ACII</option>
                                        <option>PII</option>
                                        <option>SII</option>
                                        <option>II</option>
                                        <option>AII</option>
									</select>
				            </div>
                        <div class="form-group">
                           <label class="form-label">Date of First Appointment</label>
                            <input type="date" name="dofa" placeholder="" class="form-control" value="<?php echo stickyForm('dofa'); ?>" required/>
                        </div>
                        <div class="form-group">
                           <label class="form-label">Date of Present Appointment</label>
                            <input type="date" name="dopa" placeholder="" class="form-control" value="<?php echo stickyForm('dopa'); ?>" required/>
                        </div>
                        <div class="form-group">
                           <label class="form-label">Date Posted to Mission</label>
                            <input type="date" name="posted" placeholder="" class="form-control" value="<?php echo stickyForm('posted'); ?>" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Country of Posting</label>
	                           <select class="form-control country" name="countryid" value="<?php echo stickyForm('countryid'); ?>" required />
		                          <option value="">-- Choose Country --</option>
                                   <?php
                                   $countries = $country->getCountry();
                                   foreach($countries as $ctry) {
                                       echo "<option value='".$ctry['country']."'";
                                       echo stickySelect('mission', $ctry['country']);
                                       echo ">".$ctry['country']."</option>";
                                   }
                                   ?>
	                           </select>
                        </div>
                     						<div class="form-group">
                                                <label class="form-label">Mission</label>
												<select class="form-control mission" name="missionid" value="<?php echo stickyForm('missionid'); ?>" required />
													<option value="">-- Choose Mission --</option>
                                                    <?php
                                                    $missions = $mission->getMissions();
                                                    foreach($missions as $msn) {
                                                        echo "<option value='".$msn['mission']."'";
                                                        echo stickySelect('mission', $msn['mission']);
                                                        echo ">".$msn['mission']."</option>";
                                                    }
                                                    ?>
                                                </select>
											</div>
                                        </div>			
                    
                    <div class="col-md-12">
						<legend><i class="fa fa-lock"></i> User Account</legend>
						<div class="form-group">
                         <input type="text" name="username" placeholder="Username" class="form-control" value="<?php echo stickyForm ('username'); ?>" required/>
                            </div>

						<div class="form-group">
                         <input type="password" name="password" placeholder="Password" class="form-control" required/>
                        </div>

						<div class="form-group">
                         <input type="password" name="confirm" placeholder="Confirm Password" class="form-control" required />
                      </div>
				        <hr />
                        <div class="col-md-12" align="center">
                     <div class="form-group">
                         <button type="submit" class="btn btn-success">
                        	<i class="fas fa-user"></i> Submit
                        </button>
                     </div>
                        </div>
                     <input type="hidden" name="register" value="registeruser">
                	</form>
                    </div>
                </div>
		      </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'inc/foot.php'; ?>