<?php
header('Content-type: application/json');

// Check if user provided a search term
if (!isset($_GET['term'])) {
  echo 'Please provide a search term';
} else {
  $term = urlencode($_GET['term']);

  // Get google images search result
  $url = 'https://www.google.com/search?tbm=isch&q='.$term;
  $response = file_get_contents($url);

  // Get search result from image tag
  $img_pos = strpos($response, '<img');
  $img_tag = substr($response, $img_pos);

  // Get search result from source attribute of image tag
  $src_pos = strpos($img_tag, 'src=');
  $src_attr = substr($img_tag, $src_pos + 5);

  // Cur string off at end of source url
  $arr = explode("\"", $src_attr, 2);
  $first = $arr[0];

  // Return image url
  echo '{ "url":"'.$first.'" }';
}
?>
