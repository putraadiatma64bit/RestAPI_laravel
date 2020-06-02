<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Welcome extends Controller
{
    private $url_auth = "http://www.inspibook.com/wam/admin/auth/index";    
    private $key_auth = "b0652a54d94e01721c2241b29b8c4d5c"; 

    private $username = "asdi";
    private $password = "L&W%*&@AXEX9WO*C";

    private $key_client = "123";

    public function __construct()
    {       
        $data = $this->request_key(getallheaders(),$this->username,$this->password,$this->key_client);
        $auth = json_decode($data);
        if(($auth->auth_server != $this->key_auth)||($auth->auth_client != sha1($this->key_client))) exit; 
    }
    //----------------------------------------- 
    private function postdata($url_auth,$key_server,$key_client)
    {
        $postdata = http_build_query(
            array(
                'key_server' => $key_server,
                'key_client' => $key_client                 
            )
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context  = stream_context_create($opts);

        $result = file_get_contents($url_auth, false, $context);

        return $result;
    }
    
    private function request_key($data,$username,$password,$key_client)
    {       
        $auth = explode('-',$data['auth']);
        if(($auth[0] == $username)&&($auth[1] == $password))
        {
            return $this->postdata($this->url_auth,$auth[2],$key_client);
        }
    }
    //-------------------------------------------------------
    public function index()
    {    	
    }     
    public function get(Request $request,$param)
    {

    	if($param == "auth")
    	{	    					
    		echo 'id : '.$request->input('id');    		
    	}
    }
    public function post(Request $request,$param)
    {
    	if($param == "auth")
    	{    						
    		echo 'username : '.$request->input('username').',';
    		echo 'password : '.$request->input('password');    		
    	}    	
    }
    public function put(Request $request,$param)
    {
    	if($param == "auth")
    	{    						
    		echo 'username : '.$request->input('username').',';
    		echo 'password : '.$request->input('password');    	
    	}    
    }
    public function delete(Request $request,$param)
    {
    	if($param == "auth")
    	{    						
    		echo 'id : '.$request->input('id');    	
    	}
    }
    public function raw(Request $request,$param)
    {
    	if($param == "auth")
    	{    						
    		$json = file_get_contents("php://input");	
			echo $json;	    	
    	}
    }    
}
