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





$result = $client->listFunctions([            
    'FunctionVersion' => 'ALL' 
]); 

// print_r($result);

$functionArray=[]; 
foreach ($result['Functions'] as $row) 
{      
	$myArray['FunctionName']=$row['FunctionName'];
	$myArray['Timeout']=$row['Timeout'];
	
	array_push($functionArray, $myArray); 

} 
echo json_encode($functionArray);     


/*$result = $client->invoke(array(  
    // FunctionName is required
    'FunctionName' => 'jobsbucket-co-uk-sqs-to-mysql'
));*/
//$result = $client->listFunctions(['FunctionVersion' => 'ALL']);  
 //print_r($result);