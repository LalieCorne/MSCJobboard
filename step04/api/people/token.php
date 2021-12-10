<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/People.class.php';

    
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'J0Uhxx0144TLbOwCAphd7YIJVy6frpcV'; // user define private key
    $secret_iv = 'SXvLnx8wxNu68jnfr42HFdew70q0ByyW'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo



    $database = Database::getInstance();
    $db = $database->getConnection();

    $item = new People($db);

    // $item->email = isset($_GET['email']) ? $_GET['email'] : '';
    // $item->mdp = isset($_GET['mdp']) ? $_GET['mdp'] : '';
    // $action = isset($_GET['action']) ? $_GET['action'] : 'encrypt';

    $data = json_decode(file_get_contents("php://input"));

    $item->email = $data->email;
    $item->password = $data->password;
    $action = isset($data->action)? $data->action : 'encrypt';
    $token = $data->token;
  
    $returnLog = $item->userLogin($item->email, $item->password);

    if ($action == 'encrypt') {
        if($returnLog == true){
            
            $output = openssl_encrypt($item->id_people, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
            // create array
            $emp_arr = array(
                "token" => $output
            );
        
            http_response_code(200);
            echo json_encode($emp_arr);
        }else{
            http_response_code(200);
            echo json_encode("false mdp");
        }
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($token), $encrypt_method, $key, 0, $iv);
        $item->id_people = $output;
        $item->getSingle();
        $emp_arr = array(
            "id_people" => $item->id_people,
            "first_name" => $item->first_name,
            "last_name" => $item->last_name,
            "email" => $item->email,
            "password" => $item->password
        );
        http_response_code(200);
            echo json_encode($emp_arr);
    }
    
?>