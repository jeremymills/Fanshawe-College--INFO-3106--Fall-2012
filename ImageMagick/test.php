<?php
ini_set('display_errors','on');
error_reporting(E_ALL | E_STRICT);

/*
function alist ($array) { 
  $alist = "<ul>";
  for ($i = 0; $i < sizeof($array); $i++) {
    $alist .= "<li>$array[$i]";
  }
  $alist .= "</ul>";
  return $alist;
}
exec("convert -version", $out, $rcode);
print "Version return code is $rcode <br>";
print alist($out);
*/



try {
$im = new Imagick( 'a.jpg' );
//$im->thumbnailImage( 200, 0);
//$im->writeImage( 'a_thumbnail.jpg' );
} catch (ImagickException $e) {
echo $e->getMessage();
}


?>