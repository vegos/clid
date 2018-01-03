<?php
// CLID.php -- 11888.gr reverse phone lookup
function get_contents($url) 
{
  $ch = curl_init();
  $timeout = 5; // Zero (0) for no timeout
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $file_contents = curl_exec($ch);
  curl_close($ch);
  return $file_contents;
}
     
if (isset($argv[1]))
{
  $phone = substr($argv[1],0,10);
  $url = "https://www.11888.gr/search/?mode=ts&phone=".$phone;
  $text = get_contents($url) ;
  preg_match("'class=\"btn-line-right\">(.*?)</a>'",$text,$temp);
  if (isset($temp[1]))
  {
    echo ltrim($temp[1]);
    // ----- START of address information -----
    preg_match("'<p class=\"loc\">(.*?)</p>'s",$text,$temp2); // get address
    if (isset($temp2[1]))
    {    
      echo "\n".rtrim(ltrim($temp2[1]));
    }
    // ----- END of address information -----
  }
  else
  {
    echo "Unknown\n";
  }
}
else
  echo "No number given\n";
?>
