<?php

$dir = "./*.html";  

// Open a known directory, and proceed to read its contents  
foreach(glob($dir) as $file)  
{  
    $html = file_get_contents($file);

    // Install Google Tag Manager
    echo "Installing Google Tag Manager...\n";
	if (strpos($html,'<!-- Google Tag Manager -->') !== false) {
	    echo "Skipping ".$file." tag code already exists\n";
	} else {
	    echo "Adding tag to  ".$file."\n";
		$html = str_replace("<body>","<body><!-- Google Tag Manager --><noscript><iframe src='//www.googletagmanager.com/ns.html?id=GTM-NLMDT7' height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-NLMDT7');</script><!-- End Google Tag Manager -->",$html);
	}

	// Adjust <title> Tags to Match Our Format
	echo "Adjusting title tags...\n";
	
	// Extract the tag from html body
	$regex = '#<span class="swipeColor">(.*?)</span>#';
	preg_match_all($regex, $html, $matches);
	$title = strip_tags($matches[1][0]);
	echo $title."\n\n";

	// Replace default title with new title
	$html = str_replace("<title>Mount Vernon | Virtual Tour</title>","<title>".$title." - Virtual Tour - George Washington's Mount Vernon</title>",$html);

	// Save final file
	file_put_contents($file, $html);

}  

?>