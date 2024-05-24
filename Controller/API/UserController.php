<?php
    class UserController extends BaseController
    {
        public function listAction()
        {
            $erroDescreption = '';
            $requestMethod   = $_SERVER['REQUEST_METHOD'];
            $stringParamsArray = $this->getStringParams();

            if(strtoupper($requestMethod) == 'GET'){
                  
                try{
                    $userModel = new UserModel();
                  
                    print_r($userModel);
                    exit;                   $intLimit = 10;
                    if(isset($stringParamsArray['limit']) && $stringParamsArray['limit']){
                        $intLimit = $stringParamsArray['limit'];
                        
                    }

                    $usersArray = $userModel -> getUsers($intLimit);
                    
                    $responseData = json_encode($usersArray);

                }catch(Error $e){
                    $erroDescreption = $e->getMenssage().'Something went wrong! Please contact suport.';
                    $errorHeader     = 'HTTP/1.1 500 Internal Server Error';
                }
            }else{
                $erroDescreption = 'Method not supported';
                $errorHeader     = 'HTTP/1.1 422 Unprocessable Entity';
            }

            //sed output
            if(!$erroDescreption){
                $this->sendOutput($responseData, array('Content-Type: application/json', 'HTTP/1.1 200 OK'));

            }
            else{
                $this->sendOutput(json_encode(array('error'=>$erroDescreption)), array('Content-Type: application/json', $errorHeader));
            }
        }


    }
?>
