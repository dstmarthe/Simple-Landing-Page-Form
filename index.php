<?php
session_start();
require_once "pdo.php";
require_once "util.php";
if ( isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) 
     && isset($_POST['industry'])) 
     {
		//  Validate if all fields are populated
         if (strlen($_POST['name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['phone']) < 1 ||  strlen($_POST['industry']) < 1)
         {	//If not return to index with error message
            $_SESSION['error'] = "All fields are required";
            header("Location: index.php");
        return;
         }
         
         else {
            $stmt = $pdo->prepare('INSERT INTO List
            ( name, email, phone, industry)
            VALUES ( :nme, :em, :ph, :ind)');
          
          $stmt->execute(array(
            ':nme' => $_POST['name'],
            ':em' => $_POST['email'],
            ':ph' => $_POST['phone'],
            ':ind' => $_POST['industry'])
          );
      $_SESSION['success'] = "Form successfully submitted";
		header("Location: index.php");
		return;
    }
    
}
?>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="style.css" />

		<title>Bayard</title>
	</head>
	<body>
		<main>
			<div id="hero">
				<header>
					<img src="bayard_logo.svg" alt="Bayard Logo" id="logo" /><p id="headerMsg"
			> TRANSFORMING TALENT</p
				>
				</header>
			<h1 id="heroTxt">
				Geofencing:<br />
				Location-based<br />
				Technology for<br />
				Recruitment<br />
				Strategies.
            </h1>
		</div>
		<form method="POST" id="signUpForm" >
                <h2 id="formHead">Connect with one of our <br/> experts to learn more!</h2>
                <label for="nm">NAME *</label><br/>
                <input type="text" name="name" id="nm"/></label><br/>
                <label for="em">EMAIL *</label><br/>   
                <input type="email" name="email" id="em"/><br/>
                <label for="ph">PHONE NUMBER *</label><br/>
                <input type="tel" name="phone" id="ph"/><br/>
                <label for="ind">INDUSTRY *</label><br/>
                <input type="text" name="industry" id="ind"/><br/>
                <input type="submit" name="send" value="SEND AWAY!" id="snd"/>
				<?php
        flashMessages();
        ?>
         </form>
		</main>
		<footer>&copy; BAYARD ADVERTISING.<wbr> ALL RIGHTS RESERVED.</footer>
	</body>
</html>
