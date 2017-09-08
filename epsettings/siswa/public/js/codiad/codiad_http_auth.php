<?php
    if (!isset($_SESSION['user'])) {
    
        require_once( COMPONENTS . "/user/class.user.php" );

        $_SESSION['user'] = $_GET['user'];
        $_SESSION['lang'] = 'en';
        $_SESSION['theme'] = 'default';
        $_SESSION['project'] = $_GET['user'];
        
        $User = new User();
        $User->username = $_GET['user'];
        if ($User->CheckDuplicate()) {
            // confusingly, this means the user must be created
            $User->users[] = array( 'username' => $User->username, 'password' => null, 'project' => $User->username );
            saveJSON( "users.php", $User->users );
        }
    }

?>
