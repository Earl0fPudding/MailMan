<?php

function get_message($short){
	switch($short){
		case 'succ-login': return "Logged in successfully!";
                case 'succ-logout': return "Logged out successfully!";
                case 'succ-signup': return "Signed up successfully!";
                case 'succ-create': return "Successfully created!";
                case 'succ-delete': return "Successfully deleted!";
                case 'succ-update': return "Successfully updated!";
		case 'succ-pw-change': return "Password successfully changed!";

		case 'err-login': return "Wrong username or password!";
		case 'err-forbidden-username': return "Username not appropriate!";
		case 'err-domain-registerable': return "Selected domain is not registerable!";
		case 'err-pw-change-old': return "Old password is wrong!";
		case 'err-unknown': return "Unknown error!";
		case 'err-username-exists': return "Username already exists!";
		case 'err-domainname-exists': return "Domain name already exists!";
		case 'err-invite-expired': return "Invite link expired!";
		case 'err-invite-invalid': return "Invite Link invalid!";
	}
}

?>
