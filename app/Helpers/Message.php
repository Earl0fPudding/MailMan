<?php

function get_message($short){
	switch($short){
		case 'succ-login': return "Logged in successfully!";
                case 'succ-logout': return "Logged out successfully!";
                case 'succ-signup': return "Signed up successfully!";
                case 'succ-create': return "Successfully created!";
                case 'succ-delete': return "Successfully deleted!";
                case 'succ-update': return "Successfully updated!";

		case 'err-login': return "Wrong username or password!";
	}
}

?>
