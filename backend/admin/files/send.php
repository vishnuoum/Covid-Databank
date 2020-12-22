<?PHP
$title=$_POST["title"];
$con=$_POST["content"];
function sendMessage() {
    $title=$GLOBALS['title'];
    $con=$GLOBALS['con'];
    $content      = array(
        "en" => "$con"

    );
    $heading=array("en"=>"$title");

    $fields = array(
        'app_id' => "7461f631-eb5a-41b2-b830-5c05892320c0",
        'included_segments' => array(
            'All'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content
        , 'headings'=>$heading
    );

    $fields = json_encode($fields);

    //print("JSON sent:");
    //print($fields);
    //print("\n");


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MWVkY2M3ZTgtNDJmMC00YTFjLThiMTYtNjRhMGQyYmE2NWUz'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);

print("success");
?>
