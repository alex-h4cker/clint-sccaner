<?php



function cls()                                                                                                             
{
    print("\033[2J\033[;H");
}

start:

cls();


echo"=========================================\n";
echo"||                                     ||\n";
echo"||           _ _                       ||\n";                     
echo"||          | | |__         _          ||\n";                   
echo"||       ___| |_|  |_______| |__       ||\n";
echo"||      / __| | |  ___  |__   __|      ||\n";
echo"||     | (__| | | |   | |  | |         ||\n";
echo"||      \___|_|_|_|   |_|  |_|         ||\n";
echo"||                                     ||\n";
echo"=========================================\n";

echo "1.requests\n";
echo "2.xss scan\n";
echo "3.cors scan\n";
echo "4.crlf scan\n";
echo "5.exit\n";

$sel = readline("select: ");

switch($sel) {

    case 1: goto req; break;
    case 2: goto xss; break;
    case 3: goto cors; break;
    case 4: goto crlf; break;
    case 5: return 0; break;

}

req:

cls();

echo "1.request\n";
echo "2.back\n";

$rq = readline("Select: ");
cls();

switch($rq) {

    case 1:

        function request() {


            echo "==================\n";
            echo "|                |\n";
            echo "|    request     |\n";
            echo "|                |\n";
            echo "==================\n";
            echo "Method Request\n";
            echo "1.GET\n";
            echo "2.POST\n";
            echo "3.Exit\n";
            $mt = readline("Select: ");

            if($mt == 1) {

                $g = readline("Enter url: ");
                
                $ch = curl_init($g); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $header = substr($response, 0, $header_size); 
                $body = substr($response, $header_size); 
                curl_close($ch); 
                echo "Status Code: " . $status_code . "\n";
                echo "Response Header: \n" . $header . "\n";
                echo "Source Code: \n" . $body;


            }

            elseif($mt == 2) {


                $url = readline("Enter url: "); 
                $dataone = readline("Enter Data: "); 
                $datatwo  = readline("Enter Data: ");
                $data = array($dataone => $datatwo); 
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);

                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
                $response_headers = curl_getinfo($ch); 

                echo "Status Code: " . $status_code . "\n";
                echo "Response Headers: \n";
                print_r($response_headers);
                echo "Source Code: \n";
                echo $response;

                curl_close($ch);

            }

            elseif($mt == 3) {

                return 0;

            }
            else {

                return 0;

            }
        } 
        request();

        break;
    case 2: goto start; break;
}

$siii = readline("Do you want to continue: (y | n): ");

if($siii == 'y') { 
        
goto start;

} elseif($siii == 'n') {
        
return 0;

}




xss:

cls();

echo "==================\n";
echo "|                |\n";
echo "|      XSS       |\n";
echo "|                |\n";
echo "==================\n";

echo "1.xss scan\n";
echo "2.back\n";

$s = readline("Select: ");

switch($s) {

    case 1: 
        
        
        $defaultValues = '">XSS';

        $u = readline("Enter URL: ");
        $ch = curl_init();
        $url = $u . $defaultValues;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);


        $file = fopen("response.txt", "w");
        fwrite($file, $response);
        fclose($file);
  
           echo "=========================\n";
           echo "|                       |\n";
           echo "|        request        |\n";
           echo "|                       |\n";
           echo "=========================\n";
           echo "\n";

        $fileContent = file_get_contents("response.txt");
        if (strpos($fileContent, $defaultValues) !== false) {

            echo 'vulnerable payload = ">XSS   ';

        } else {

            echo 'not vulnerable payload = ">XSS   ';
        }

       unlink("response.txt");

       $defaultValues2 = '/>XSS';

    
       $ch = curl_init();
       $url = $u . $defaultValues2;
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       $response = curl_exec($ch);
       curl_close($ch);


       $file = fopen("response2.txt", "w");
       fwrite($file, $response);
       fclose($file);




       $fileContent = file_get_contents("response2.txt");
       if (strpos($fileContent, $defaultValues) !== false) {

           echo "vulnerable payload = />XSS\n";

       } else {

           echo "not vulnrable payload = />XSS \n";

       }

       unlink("response2.txt");
   

        
        
    break;

    case 2: goto start; break;
}

$s = readline("Do you want to continue: (y | n): ");

if($s == 'y') { 
        
goto start;

} elseif($s == 'n') {
        
return 0;

}

cors:


cls();

    echo "==================\n";
    echo "|                |\n";
    echo "|     CORS       |\n";
    echo "|                |\n";
    echo "==================\n";

echo "1.cors scan\n";
echo "2.back\n";

$s = readline("Select: ");

switch($s) {

    case 1: 

    $origin = "null";

    $url = readline("Enter URL: ");

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Origin: $origin"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch , CURLOPT_HEADER , true);


    $response = curl_exec($ch);

    $file = fopen("res.txt" , "w");
    fwrite($file , $response);
    fclose($file);

    echo "=========================\n";
    echo "|                       |\n";
    echo "|        request        |\n";
    echo "|                       |\n";
    echo "=========================\n";
    echo "\n";

    echo "null cors vulnerability:\n";

    $fileContent = file_get_contents("res.txt");
    if (strpos($fileContent, 'access-control-allow-origin: null') !== false) {
        
        echo "vulnerable null cors\n";

    } else {

        echo "not vulnerable\n";

    }
     
    curl_close($ch);

    unlink('res.txt');



   echo "\n";
   echo "===================================\n";

   $origin2 = "https://www.c.compuer";
   $ch = curl_init($url);

   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array("Origin: $origin2"));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch , CURLOPT_HEADER , true);


   $response = curl_exec($ch);

   $file = fopen("res.txt" , "w");
   fwrite($file , $response);
   fclose($file);

   echo "\n";

   echo "cors vulnerability:\n";

   $fileContent = file_get_contents("res.txt");
   if (strpos($fileContent, 'access-control-allow-origin: https://www.c.compuer') !== false || strpos($fileContent, 'access-control-allow-origin: *') !== false ) {

    echo "vulnerable cors\n";

    } else {
  
        echo "not vulnerable\n";

    }  

    curl_close($ch);


    unlink('res.txt');


    break;

    case 2: goto start; break;

}

    $ss = readline("Do you want to continue: (y | n): ");

    if($ss == 'y') {

        goto start;

    } elseif($ss == 'n') {

        return 0;

    }


crlf:

cls();

echo "================================\n";
echo "|                              |\n";
echo "|             CRLF             |\n";
echo "|                              |\n";
echo "================================\n";

echo "1.crlf scan\n";
echo "2.back\n";

$selc = readline("Select: ");

switch($selc) {

    case 1: 

        echo "========================\n";
        echo "|                      |\n";
        echo "|        request       |\n";
        echo "|                      |\n";
        echo "========================\n";

        function crlfsc() {

            $dv = "/%0aSet-Cookie:%20crlf=inject";

            $dv2 = "/%0d%0aSet-Cookie:%20crlf=inject";

            
            $u = readline("Enter URL: ");
            
            $ch = curl_init();
            $url = $u . $dv;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            $file = fopen("response.txt", "w");
            fwrite($file, $response);
            fclose($file);

            $fileContent = file_get_contents("response.txt");
            if (strpos($fileContent, $dv) !== false) {

            echo "vulnerable payload = /%0aSet-Cookie:%20crlf=inject\n";

            } else {

                echo "not vulnerable payload = /%0aSet-Cookie:%20crlf=inject\n";
            }

            
            $ch = curl_init();
            $url = $u . $dv2;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            $file = fopen("response.txt", "w");
            fwrite($file, $response);
            fclose($file);

            $fileContent = file_get_contents("response.txt");
            if (strpos($fileContent, $dv2) !== false) {

            echo "vulnerable payload = /%0d%0aSet-Cookie:%20crlf=inject\n";

            } else {

                echo "not vulnerable payload = /%0d%0aSet-Cookie:%20crlf=inject\n";
            }



        }

        crlfsc();

    unlink('response.txt');

    break;
    
    case 2: goto start; break;
}

$sss = readline("Do you want to continue: (y | n): ");
if($sss == 'y') {

    goto start;

} elseif($sss == 'n') {

    return 0;

}




                                    
?>
