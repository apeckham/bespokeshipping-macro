<?php
/* This macro will be parsed as PHP code (see http://www.php.net)

   The calculateshipping function is called every time a shipping calculation request is made by Shopify.

   The function must return an array of available shipping options, otherwise no shipping options will be returned to your customers.
 */
function calculateshipping($DATA) {

  /* do not edit above this line */

  $zones = [["005", "3"], ["006---009", "8"], ["010---012", "3"], ["013---053", "4"], ["054", "3"], ["055", "4"], ["056", "3"], ["057---059", "4"], ["060---098", "3"], ["100---129", "3"], ["130---139", "2"], ["140---149", "1"], ["150---166", "3"], ["167", "1"], ["168---212", "3"], ["214---223", "3"], ["224---225", "4"], ["226---227", "3"], ["228---253", "4"], ["254", "3"], ["255---259", "4"], ["260", "3"], ["261---264", "4"], ["265", "3"], ["266", "4"], ["267---268", "3"], ["270---289", "4"], ["290---292", "5"], ["293", "4"], ["294---295", "5"], ["296---297", "4"], ["298---329", "5"], ["330---342", "6"], ["344", "5"], ["346", "6"], ["347", "5"], ["349", "6"], ["350---352", "5"], ["354---369", "5"], ["370---372", "4"], ["373---375", "5"], ["376---379", "4"], ["380---383", "5"], ["384---385", "4"], ["386---394", "5"], ["395", "6"], ["396---399", "5"], ["400---418", "4"], ["420---427", "4"], ["430---449", "3"], ["450---455", "4"], ["456---458", "3"], ["459---479", "4"], ["480---489", "3"], ["490---491", "4"], ["492", "3"], ["493---499", "4"], ["500---516", "5"], ["520---528", "5"], ["530---532", "4"], ["534---535", "4"], ["537---539", "4"], ["540", "5"], ["541---545", "4"], ["546---548", "5"], ["549", "4"], ["550---551", "5"], ["553---567", "5"], ["570---575", "5"], ["576---577", "6"], ["580---584", "5"], ["585---588", "6"], ["590---599", "7"], ["600---611", "4"], ["612", "5"], ["613---619", "4"], ["620", "5"], ["622", "5"], ["623---627", "4"], ["628---631", "5"], ["633---641", "5"], ["644---658", "5"], ["660---662", "5"], ["664---668", "5"], ["669---679", "6"], ["680---681", "5"], ["683---689", "5"], ["690---693", "6"], ["700---701", "6"], ["703---708", "6"], ["710---714", "6"], ["716---717", "5"], ["718", "6"], ["719---729", "5"], ["730---731", "6"], ["733---739", "6"], ["740---741", "5"], ["743---747", "5"], ["748", "6"], ["749", "5"], ["750---770", "6"], ["772---778", "6"], ["779---785", "7"], ["786---787", "6"], ["788", "7"], ["789---796", "6"], ["797---799", "7"], ["800---812", "6"], ["813---816", "7"], ["820", "6"], ["821", "7"], ["822---828", "6"], ["829---832", "7"], ["833", "8"], ["834", "7"], ["835---838", "8"], ["840---847", "7"], ["850---853", "8"], ["855---857", "8"], ["859---860", "8"], ["863---864", "8"], ["865", "7"], ["870---871", "7"], ["873---880", "7"], ["881---882", "6"], ["883---885", "7"], ["889---891", "8"], ["893---895", "8"], ["897", "8"], ["898", "7"], ["900---908", "8"], ["910---928", "8"], ["930---968", "8"], ["96900---96938", "8"], ["96945---96959", "8"], ["96961---96969", "8"], ["96971---96999", "8"], ["969", "9"], ["970---986", "8"], ["988---999", "8"]];
  $prices = [
    "1" => ["532", "616", "727", "802"],
    "2" => ["532", "616", "727", "802"],
    "3" => ["544", "725", "775", "845"],
    "4" => ["584", "810", "905", "942"],
    "5" => ["755", "1066", "1299", "1442"],
    "6" => ["826", "1337", "1891", "2261"],
    "7" => ["997", "1628", "2427", "3030"],
    "8" => ["997", "1628", "2427", "3030"]
      ];

  $items_count = count($DATA['items']);
  
  if ($DATA['destination']['country'] == 'US' && $items_count <= count($prices["1"])) {
    foreach ($zones as list($range_string, $zone)) {
      $range = array();
      preg_match_all("/\d+/", $range_string, $range);

      $length = preg_match_all("/./", $range[0][0]);
      $start_of_postal_code = substr($DATA['destination']['postal_code'], 0, $length);

      if (count($range[0]) == 1) {
        $matched = $range[0][0] == $start_of_postal_code;
      } else {
        $matched = $range[0][0] <= $start_of_postal_code && $start_of_postal_code <= $range[0][1];
      }

      if ($matched && isset($prices[$zone])) {
        return [array(
            "service_name" => "USPS Priority Mail",
            "service_code" => "USPS-ZONE-" . $zone,
            "total_price" => $prices[$zone][$items_count - 1],
            "currency" => "USD"
            )];
      }
    }
  }

  return [];

  /* do not edit below this line */

}
