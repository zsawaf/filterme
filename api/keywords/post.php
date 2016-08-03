<?php
	require '../db-connect.php';
	$feed_title = $_POST['feed_title'];
	$feed_keyword = $_POST['feed_keyword'];

	// first we need to split the feed title into an array, and strip it from any punctuation

	// lower case input
	$feed_title = strtolower($feed_title);
	$feed_keyword = strtolower($feed_keyword);

	$stripped_title = preg_replace("#[[:punct:]]#", "", $feed_title);
	$title_arr = explode(" ", $stripped_title);
	
	// check if keyword is already in database. Process
	$keyword = $mysqli->query("SELECT * FROM keyword WHERE keyword='$feed_keyword'");
	$keyword_id = -1;
	if ($keyword) 
	{
		if ($keyword->num_rows == 0)
		{
			// we need to insert it into database. 
			$mysqli->query("INSERT INTO keyword (keyword) VALUES ('$feed_keyword')");
			$keyword_id = $mysqli->insert_id;
		}
		else 
		{
			// get existing keyword id
			$keyword_id = $keyword->fetch_object()->id;
		}
	}

	// now iterate through each word in the title, and insert it to its corresponding keyword. 
	foreach($title_arr as $str) 
	{
		// check if it already exists. 
		$word = $mysqli->query("SELECT * FROM word WHERE word='$str' AND keyword_id='$keyword_id'");
		if ($word)
		{
			if ($word->num_rows == 0)
			{
				$mysqli->query("INSERT INTO word (word, keyword_id) VALUES('$str', '$keyword_id')");
			}
			else
			{
				// incremenet frequency.
				$word_id = $word->fetch_object()->id;
				$mysqli->query("UPDATE word SET frequency=frequency+1 WHERE id='$word_id'");
			}
		}
	}
?>