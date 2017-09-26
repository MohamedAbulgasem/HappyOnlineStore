<?php
	//clear() function to clear user input from any undesired characters
	function clear($input)
	{
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}
?>