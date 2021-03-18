<?php


namespace App\Http\Controllers; 
use Illuminate\Http\Request;

class AwsLambdaController extends Controller
{ 
   

    public function viewFeedLambda()
    { 
             

        $curl = curl_init();

        curl_setopt_array($curl, array( 
          CURLOPT_URL => 'http://dev.perimattic.com/namrata/oauth/public/amazon-lamda/test-aws-lambda.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl); 
        $result=json_decode($response);


      


    	/*$result = $client->listFunctions([           
        'FunctionVersion' => 'ALL' ]);
*/
   
     
 
        return view('viewFeed',["students"=>$result]);
    }

}
