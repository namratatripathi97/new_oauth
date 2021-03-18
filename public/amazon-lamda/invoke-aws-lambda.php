<?php
require 'aws-autoloader.php';      

    
ini_set("display_errors","On");   

use Aws\Lambda\LambdaClient;
use Aws\Lambda\Exception; 


$client = new Aws\Lambda\LambdaClient([    
    'region' => 'eu-west-2',
    'version' => 'latest',    
    'credentials' => [         
        'key'      => 'AKIA2V4DBLWDQJOBC77J',
        'secret'   => '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'
    ],
]);



// $search_value =$_POST["search"];



if(isset($_GET['functionName']))
{   

    if(!empty($_GET['functionName']))
    {  

        $result = $client->invoke(array(   
            // FunctionName is required
            'FunctionName' => $_GET['functionName']
           
        ));

        if($result['StatusCode']==200)
        { 
            echo "Success";


        }
        
    }
}