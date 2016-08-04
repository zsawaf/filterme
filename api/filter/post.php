<?php
	require '../db-connect.php';
	require '../helper.php';

	$keyword = $_POST['filter'];
	$feed_titles = json_decode($_POST['feed_title']);

	$keyword = strtolower($keyword);

	foreach($feed_titles as $feed_title) {
		$lower_feed_title = strtolower($feed_title);
		$stripped_title = preg_replace("#[[:punct:]]#", "", $lower_feed_title);
		$stripped_title = removeCommonWords($stripped_title);
		$title_arr = explode(" ", $stripped_title);
		// now we have to iterate through each word in the title_array and apply bayes theorem to it. 
		// quick run through of algorithm:
		// - computing probability that a feed is filtered given a word: 
		// 		-- P(F|W) = P(W|F) / P(W|F) + P(W|NF) where F denotes Filtered, W denotes Word, and NF denotes Not Filtered. 
		//		-- P(W) = word*frequency / all words * their frequencies
		//		-- P(W|F) = Probability Filitered given the Word. Select the number of the word when it's filtered, and divide it by all occurences of the word. 
		//		-- P(W|NF) = Select number of the word when it's not filtered, divide it by total occurences of the word. 

		// First, get P(W|F)
		$product_probabilities = 0;
		$word_count = 1;
		foreach($title_arr as $word) {
			$pw = $mysqli->query("SELECT * FROM word WHERE word='$word'");

			// calculate total word occurences
			$total_aggregate = 0;
			while($row = $pw->fetch_assoc()) {
				$total_aggregate += $row['frequency'];
			}

			// calculate filtered occurences for that word
			$pfw = $mysqli->query("SELECT * FROM keyword LEFT JOIN word ON keyword.id = word.keyword_id WHERE keyword.keyword='$keyword' AND word.word = '$word'");
			$f_aggregate = 0;
			while($row = $pfw->fetch_assoc()) {
				$f_aggregate += $row['frequency'];
			}
			$prob_wf = $f_aggregate / $total_aggregate; 

			// break if not enough stats
			if ($prob_wf == 0 || $prob_wf == NAN) {
				continue;
			}

			// now get P(W)
			$pw = $mysqli->query("SELECT * FROM word");
			// calculate total word occurences
			$word_aggregate = 0;
			while($row = $pw->fetch_assoc()) {
				$word_aggregate += $row['frequency'];
			}

			// calculate word occurences of filtered words
			$pwf = $mysqli->query("SELECT * FROM keyword LEFT JOIN word ON keyword.id = word.keyword_id WHERE word.word = '$word'");
			// calculate total word occurences
			$pwf_aggregate = 0;
			while($row = $pwf->fetch_assoc()) {
				$pwf_aggregate += $row['frequency'];
			}

			$prob_w = $pwf_aggregate / $word_aggregate;
			// break if not enough stats
			if ($prob_w == 0 || $prob_w == NAN) {
				continue;
			}

			// now we get P(F)
			$pf = $mysqli->query("SELECT * FROM keyword LEFT JOIN word ON keyword.id = word.keyword_id WHERE keyword.keyword='$keyword'");
			$filtered_word_aggregate = 0;
			while($row = $pf->fetch_assoc()) {
				$filtered_word_aggregate += $row['frequency'];
			}
			$prob_pf = $filtered_word_aggregate / $word_aggregate;

			// now we are ready to calculate the total probability for the word
			$p = $prob_wf;
			//echo "$word : $p = $prob_wf / ($prob_w + $prob_nf) || ";
			$product_probabilities += $p;
			$word_count += 1;
		}

		$final_probability = $product_probabilities / $word_count;
		
		if ($final_probability > 0.5) {
			echo '<div class="red circle"></div>, ';
		}
		else {
			echo '<div class="blue circle"></div>, ';
		}
	}
?>