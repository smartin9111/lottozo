<?php



$objClient = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL", array('trace' => true));
$currrates = $objClient->GetExchangeRates(array('startDate' => "2021-10-01", 'endDate' => "2021-10-31", 'currencyNames' => "EUR,USD,CHF"))->GetExchangeRatesResult;
$dom_root = new DOMDocument();
$dom_root->loadXML($currrates);
$xpath = new DOMXpath($dom_root);

$searchNode = $dom_root->getElementsByTagName("Day");
foreach ($searchNode as $searchNode) {
    $date = $searchNode->getAttribute('date');
    print $date . "\n";
    $rates = $searchNode->getElementsByTagName("Rate");
    print "<br />\n" . "</table>";
    foreach ($rates as $rate) {
        print "\t" . $rate->getAttribute('unit') . " ";
        print $rate->getAttribute('curr');
        print "  =  ";
        print $rate->nodeValue;
        print " HUF\n";
        print "<br />\n" . "</table>";
    }
}