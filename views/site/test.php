<?php
/* @var $this yii\web\View */
?>
<h1>mail2/test</h1>
<?php
$host = "{imap.gmail.com:993/imap/ssl}INBOX";
$user = "elijah.owens1224@gmail.com";
$pass = "test_123";

if ($mbox = imap_open($host, $user, $pass)) {
    $imap_obj = imap_check($mbox);
    echo "<h1>CONNECTED TO IMAP HOST</h1><h2>$host (" . $imap_obj->Nmsgs . ")<h2>";
} else {
    echo "<h1>FAILED TO CONNECT TO IMAP HOST!</h1>\n";
    die;
}

echo "<h3>IMAP LIST OF FOLDERS</h3>";
$folders = imap_list($mbox, $host, "*");
echo "<ul>";
foreach ($folders as $folder) {
    echo '<li><a href="mail.php?folder=' . $folder . '&func=view">' . str_replace($host, '', imap_utf7_decode($folder)) . '</a></li>';
}
echo "</ul>";
//        $inbox_folder =$host . 'INBOX';
$emails = imap_search($mbox, 'ALL');

$output = '';
$counter = 0;
foreach ($emails as $mail) {

    $headerInfo = imap_headerinfo($mbox, $mail);

    $output .=  '<h2>Mail #' . $counter . '</h2>';
    $output .=  '<pre>';
    $output .=  print_r($headerInfo, true);
    $output .=  '</pre>';

//    $output .= $headerInfo->fromaddress . '<br/>';
//    $output .= imap_utf7_decode($headerInfo->subject) . '<br/>';
//    $output .= $headerInfo->toaddress . '<br/>';
//    $output .= $headerInfo->date . '<br/>';
//    $output .= $headerInfo->fromaddress . '<br/>';
//    $output .= $headerInfo->reply_toaddress . '<br/>';
//
//    $emailStructure = imap_fetchstructure($inbox,$mail);
//
//    if(!isset($emailStructure->parts)) {
//        $output .= imap_body($inbox, $mail, FT_PEEK);
//    } else {
//        //
//    }
    echo $output;
    $output = '';
    $counter++;
}


imap_close($mbox);
?>
