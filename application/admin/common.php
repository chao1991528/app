<?php
	function md5password($password){
		return md5( $password . config('password.admin_password_salt') );
	}
