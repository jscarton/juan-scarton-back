<?php

namespace App\Http\Controllers;

use App\Cube;
use App\Exceptions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
*   ChallengeController: controls the execution of a challenge
*/
class ChallengeController extends Controller
{
    /**
    * prints the form
    */
    public function index(){
        return view('hackerrank/index');
    }
    /**
    *   executes a challenge
    *   @params $request Request receives the request facade
    */
    public function api(Request $request)
    {
        if ($request->has("user_input"))
        {
            $return=[];
            $input_lines=explode("\n",$request->input("user_input"));
            // the first input lines is the numer of test cases
            $number_of_tests=trim($input_lines[0]);
            if (is_numeric($number_of_tests) && $number_of_tests>=1 && $number_of_tests<=50)
            {
                $j=1; //current input line
                for ($i=0; $i <$number_of_tests; $i++) { 
                    //reads the next line to get the N and M values
                    list($N,$M)=explode(" ",trim($input_lines[$j++]));
                    //init cube object
                    $testCube=new Cube(intval($N));
                    //now exec the test cases
                    for ($k=0; $k<intval($M);$k++){
                        $order_data=explode(" ",$input_lines[$j++]);

                        if ($order_data[0]==="UPDATE")
                            $testCube->updateValueOnCube($order_data[1],$order_data[2],$order_data[3],$order_data[4]);
                        else{
                            $return[]=$testCube->queryTheCube($order_data[1],$order_data[2],$order_data[3],$order_data[4],$order_data[5],$order_data[6]);                            
                        }
                    }

                }
            }
            else
                $return=["error"=>"bad number of test cases definition"];
        }
        else
            $return=["error"=>"bad request"];
        return new JsonResponse($return);
    }
}
