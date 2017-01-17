<?php

require_once __DIR__ . '/../init.php';
$client = new OpenBibIdApi\BibConsumer(CONSUMER_KEY, CONSUMER_SECRET, CURRENT_ENV);
if (!isset($_GET['account_id'])) {
  $list = $client->user()->getUserLibraryAccounts();
  $form = '<form method="GET" action="/pages/' . basename(__FILE__) . '?' . http_build_query($_GET) . '">';
  $form .= '<select name="account_id">';
  foreach ($list->getElementsByTagName('libraryAccount') as $acc) {
    $form .= '<option value="' . $acc->getElementsByTagName('id')->item(0)->nodeValue . '">' . trim($acc->getElementsByTagName('firstName')->item(0)->nodeValue . ' ' . $acc->getElementsByTagName('lastName')->item(0)->nodeValue)  . '</option>';
  }
  $form .= '</select>';
  foreach ($_GET as $key => $val) {
    $form .= '<input type="hidden" name="' . $key . '" value="' . $val . '" />';
  }
  $form .= '<input type="submit" value="Submit"/>';
  $form .= '</form>';
  print $form;
  exit;
}
print luminous::head_html();
print luminous::highlight('xml', $client->user()->getUserActivities($_GET['account_id'])->saveXML(), FALSE);
