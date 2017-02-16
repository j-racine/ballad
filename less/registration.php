<?php
	// Login credentials
    $username = "balluwua_regUser"; 
    $password = "sing.the.song.reg"; 
    $host = "localhost"; 
    $dbname = "balluwua_registration";
	
	// Use PDO to specify the use of UTF-8 encoding
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
    
	// Try making a connection to the specified database with the given credentials
    try 
    { 
       $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
    } 
	// Set an error message on failure
    catch(PDOException $ex) 
    { 
        die("Failed to connect to the database: " . $ex->getMessage()); 
    } 
    
	// Have PDO throw an exception on database errors
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
	// Have PDO return database rows that it fetches
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    
	// If the PHP implementation uses magic quotes, undo them
    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
    { 
        function undo_magic_quotes_gpc(&$array) 
        { 
            foreach($array as &$value) 
            { 
                if(is_array($value)) 
                { 
                    undo_magic_quotes_gpc($value); 
                } 
                else 
                { 
                    $value = stripslashes($value); 
                } 
            } 
        } 
     
		// Undo magic quotes for POST, GET, and COOKIE
        undo_magic_quotes_gpc($_POST); 
        undo_magic_quotes_gpc($_GET); 
        undo_magic_quotes_gpc($_COOKIE); 
    }
	
	$lock_query = " 
		SELECT 
			locks 
		FROM regLock";
	
	if(!empty($_POST)) 
    {				
		try 
		{ 
			// Execute the query against the database 
			$stmt = $db->prepare($lock_query); 
			$result = $stmt->execute(); 
		} 
		catch(PDOException $ex) 
		{ 
			$error = "Someone done broke this.  Please contact the site administrator."; 
		}
		
		$lockArray = $stmt->fetch();
		$locks = $lockArray['locks'];
		
		if($_POST['firstPhrase'] == "Excalibur guard us" && $locks != "none" && $locks!="physical") {
			
			if($locks == "both") {
				$update_query = "
					UPDATE 
						regLock
					SET
						locks = 'physical'
				";
			}
			else {
				$update_query = "
					UPDATE 
						regLock
					SET
						locks = 'none'
				";
			}
			
			try 
			{ 
				$update_stmt = $db->prepare($update_query);
				$update_result = $update_stmt->execute();
			} 
			catch(PDOException $ex) 
			{ 
				die("This doesn't look good."); 
			}
		}
		elseif($_POST['secondPhrase'] == "Sangreal" && $locks != "none" && $locks!="logical") {
			
			if($locks == "both") {
				$update_query = "
					UPDATE 
						regLock
					SET
						locks = 'physical'
				";
			}
			else {
				$update_query = "
					UPDATE 
						regLock
					SET
						locks = 'none'
				";
			}
			
			try 
			{ 
				$update_stmt = $db->prepare($update_query);
				$update_result = $update_stmt->execute();
			} 
			catch(PDOException $ex) 
			{ 
				die("This doesn't look good."); 
			}
		} 
    }
	
	try 
	{ 
		// Execute the query against the database 
		$stmt = $db->prepare($lock_query); 
		$result = $stmt->execute(); 
	} 
	catch(PDOException $ex) 
	{ 
		$error = "Someone done broke this.  Please contact the site administrator."; 
	}
	
	$lockArray = $stmt->fetch();
	$locks = $lockArray['locks'];
?>
	
<html>
	
	<div class="container">
    <div class="page-title">
        <div>Registration</div>
    </div>
    <div class="content-box">
        <div>
			<form id="reglocks" class="reglocks" action="./registration.php" method="POST" autocomplete="off">
				<div class="left-lock">
					<fieldset>
						<?php
							if($locks == "both" || $locks == "logical") {
								echo("<img src='../images/locked.png' alt='Locked padlock' height='256px' width='256px'><br><br>");
							}
							else {
								echo("<img src='../images/unlocked.png' alt='Unlocked padlock' height='256px' width='256px'><br><br>");
							}
						?>
						<input name="firstPhrase" type="required text">
						<input type="submit" value="Remote user access">
					</fieldset>
				</div>
				<div class="right-lock">
					<fieldset>
						<?php
							if($locks == "both" || $locks == "physical") {
								echo("<img src='../images/locked.png' alt='Locked padlock' height='256px' width='256px'><br><br>");
							}
							else {
								echo("<img src='../images/unlocked.png' alt='Unlocked padlock' height='256px' width='256px'><br><br>");
							}
						?>
						<input name="secondPhrase" type="required text">
						<input type="submit" value="Device user access">
					</fieldset>
				</div>
        </div>
    </div>
</div>
<div>Icons made by <a href="http://www.flaticon.com/authors/madebyoliver" title="Madebyoliver">Madebyoliver</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>