<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include_once("connection.php");
include_once("gestions.php");

$connection = new Connection('localhost', 'pfe', 'root', '');
$pdo = $connection->connect();
$gestion = new Gestion($pdo);


function getNearDate() : String{

    $mounth = date("m");
    $day = date('d');
    $year = "20".date("y");

    if($mounth < 2 ||($day <=24 && $mounth ==2)){
        return $year ."-02-24";
    }else if($mounth >2 && $mounth <5 || ($day <=1 && $mounth ==5)){
        return $year ."-05-01";
    }else if($mounth >5 && $mounth <7 || ($day <=5 && $mounth ==7)){
        return $year ."-07-05";
    }else if($mounth >7 && $mounth <11 || ($day <=1 && $mounth ==11)){
        return $year ."-11-01";
    }else{
        return $year ."-12-31";
    }
}


function Send($emails,$medaille){

    $subject = "Sonatrach";
    $body = "Salut  monsieur / madame, je tiens à vous dire que vous avez reçu la médaille $medaille, félicitations et bonne continuation ";

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'berredjem.oussama.mi@gmail.com';          // SMTP username
        $mail->Password   = '';                    // SMTP password (use an app-specific password if 2FA is enabled)
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('sonatrach@service.dz', 'Sonatrach'); // Use your Gmail address as the sender
        
        foreach ($emails as $key => $email) {
            $mail->addAddress($email['email']);
        }

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function gerer($gestion){
    $result = $gestion->togetEmail(getNearDate());
    echo json_encode($result);

    $bronze = array();
    $argent = array();
    $or = array();
    $vermeil = array();
    $platine = array();
    $couronne = array();

    foreach($result as $key=>$value){
        switch ($value["type"]) {
            case 'bronze':
                array_push($bronze,$value);
                break;
            case 'argent':
                array_push($argent,$value);
                break;
            case 'or':
                    array_push($or,$value);
                break;
            case "vermeil":
                array_push($vermeil,$value);
                break;
            case "platine":
                array_push($platine,$value);
                break;
            default:
            array_push($couronne,$value);
                break;
        }
    }

    if(sizeof($bronze)>0){
        Send($bronze,"Bronze");
    }
    if(sizeof($argent)>0){
        Send($argent,"Argent");
    }
    if(sizeof($or)>0){
        Send($or,"Or");

    }
    if(sizeof($vermeil)>0){
        Send($vermeil,"Vermeil");

    }
    if(sizeof($platine)>0){
        Send($platine,"Platine");
    }
    if(sizeof($couronne)>0){
        Send($couronne,"Corounne");

    }
    
    

    //Send($result,)

}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

   gerer($gestion);
}


