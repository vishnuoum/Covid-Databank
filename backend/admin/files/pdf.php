<?php
require 'pdfcrowd.php';

try
{
    // create the API client instance
    $client = new \Pdfcrowd\HtmlToPdfClient("TeamUEC", "57ff63aead3c4b9e5fe485779ae2243f");

    // run the conversion and write the result to a file
    if(strpos($_GET["url"], "?") !== false){
        $url=$_GET["url"]."&printpdfff";
    } else{
        $url=$_GET["url"]."?printpdfff";
    }
    $client->convertUrlToFile($url, "report.pdf");
    header("refresh:3;url=https://zateart.com/covidchart/admin/files/report.pdf"); 
    echo 'You\'ll be redirected in about 3 secs. If not, click <a href="https://zateart.com/covidchart/admin/files/report.pdf">here</a>.';
    // echo $url;
}
catch(\Pdfcrowd\Error $why)
{
    // report the error
    error_log("Pdfcrowd Error: {$why}\n");
    echo $url;

    // rethrow or handle the exception
    throw $why;
}


?>