 <?php 




    $header = "Testing Line Notify";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $message = $header.
                "\n". "npe: " . $firstname .
                "\n". "xeem: " . $lastname .
                "\n". "xovtooj: " . $phone .
                "\n". "email: " . $email;

    if (isset($_POST["submit"])) {
        if ( $firstname <> "" ||  $lastname <> "" ||  $phone <> "" ||  $email <> "" ) {
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            echo "<script>alert('rau npe lawm');</script>";
            header("location: index.php");
        } else {
            echo "<script>alert('tsis tau rau npe');</script>";
            header("location: index.php");
        }
    }

    function sendlinemesg() {
        //  kuv lis Line notify: EJ9Fpq92LJvjRrqwz47eQanouasR3IWwPGVlyJ60tok
        //api ntawm line: https://notify-api.line.me/api/notify
        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',"EJ9Fpq92LJvjRrqwz47eQanouasR3IWwPGVlyJ60tok");

        function notify_message($message) {
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData,'','&');
            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                                ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                ."Content-Length: ".strlen($queryData)."\r\n",
                    'content' => $queryData
                )
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents(LINE_API, FALSE, $context);
            $res = json_decode($result);
            return $res;
        }
    }


?>