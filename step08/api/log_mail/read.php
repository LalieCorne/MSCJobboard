<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/LogMail.class.php';
    include_once '../../class/People.class.php';

    $database = Database::getInstance();
    $db = $database->getConnection();

    


    $data = json_decode(file_get_contents("php://input"));

    if($data->token){

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'J0Uhxx0144TLbOwCAphd7YIJVy6frpcV'; // user define private key
        $secret_iv = 'SXvLnx8wxNu68jnfr42HFdew70q0ByyW'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        
        $itemPeaople = new People($db);

        $output = openssl_decrypt(base64_decode($data->token), $encrypt_method, $key, 0, $iv);
        $itemPeaople->id_people = $output;
        $itemPeaople->getSingle();
        if ($itemPeaople->id_companies){

            $items = new LogMail($db);
            $stmt = $items->getAll($itemPeaople->id_companies);
            $itemCount = $stmt->rowCount();

            //echo json_encode($itemCount);

            if($itemCount > 0){
                
                $returnArr = array();
                $returnArr["body"] = array();
                $returnArr["itemCount"] = $itemCount;

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $e = array(
                        "id_log_mail" => $id_log_mail,
                        "id_recipient" => $id_recipient,
                        "date" => $date,
                        "first_name_sender" => $first_name_sender,
                        "last_name_sender" => $last_name_sender,
                        "email_sender" => $email_sender,
                        "tel_sender" => $tel_sender,
                        "obj" => $obj,
                        "content" => $content
                    );

                    array_push($returnArr["body"], $e);
                }
                http_response_code(200);
                echo json_encode($returnArr);
            }

            else{
                http_response_code(404);
                echo json_encode(
                    array("message" => "No record found.")
                );
            }





        }

    }

    
?>