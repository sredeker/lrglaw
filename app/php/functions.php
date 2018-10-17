<?php

$debug = true;


// if($debug) echo "functions.php loaded <br />";

function getContent($entryID) {
  $cfSpace = "vqey0myrs677";
  $cfToken = "0cf248aeac4a0a8960afdeb542151098f2d44565f292d41a5ecf86479ff2eec0";
  $url = 'https://cdn.contentful.com/spaces/' . $cfSpace . '/entries?sys.id=' . $entryID . '&access_token=' . $cfToken . '&include=5';
  $cURL = curl_init();
  curl_setopt($cURL, CURLOPT_URL, $url);
  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($cURL, CURLOPT_HTTPGET, true);
  curl_setopt($cURL, CURLOPT_HEADER, 0);
  curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
  // curl_setopt($cURL, CURLOPT_CAPATH, "/cacert.pem");
  curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Accept: application/json'
  ));

  $result = curl_exec($cURL);

  if($debug && curl_errno($cURL))
    echo '<br />Curl error: ' . curl_error($cURL) . "<br /><br />";

  curl_close ($cURL);

  $jResult = json_decode($result, true);

  if($debug){
    echo "space:" . $cfSpace . " <br /> token:" . $cfToken . " <br /> entry:" . $entryID . " <br />";
    echo "url:" . $url . " <br />";
    echo "result: " . $result;
  }

  return $jResult;
}


function getTeamMembers($content, $entries){
  $teamMembersEntries = array();
  $teamMembers = array();
  $teamMembersId = $content['items'][0]['fields']['teamMembers']['sys']['id'];
  if($teamMembersId){
    foreach ($entries as $entry) {
      if($teamMembersId == $entry['sys']['id']){
        $teamMembersEntries = $entry['fields']['teamMembers'];
      }
    }

    foreach ($teamMembersEntries as $key => $teamMember) {
      foreach ($entries as $entry) {
        if($teamMember['sys']['id'] == $entry['sys']['id']){
          $tag = explode(" ", $entry['fields']['name']);
          $entry['fields']['tag'] = strtolower($tag[0]) . "-" . strtolower(end($tag));
          array_push($teamMembers, $entry);
        }
      }
    }

  }
  return $teamMembers;
}



?>
