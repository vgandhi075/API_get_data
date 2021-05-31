<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use App\Page;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getAllData(){
        $response = HTTP::get("http://jsonplaceholder.typicode.com/posts");
        return $response->json();
    }

    public function getSingleData($id){
        $response = HTTP::get("http://jsonplaceholder.typicode.com/posts/".$id);
        return $response->json();
    }

    public function postData(){
        $post = HTTP::post("http://jsonplaceholder.typicode.com/posts",[
            'title'=>"1st title",
            'description'=>"dis is ma fisrt description"
        ]);

        return $post->json();
    }

    public function updateData(){
        $post = HTTP::put("http://jsonplaceholder.typicode.com/posts/1",[
            'title'=>"1st title updated",
            'description'=>"dis is ma fisrt description updated ver"
        ]);

        return $post->json();
    }

    public function deleteData($id){
        $post = HTTP::delete("http://jsonplaceholder.typicode.com/posts/".$id);
        return $post->json();
    }

    public function getUsers(){
        $collection = HTTP::get("http://jsonplaceholder.typicode.com/posts/")->json();

        // return $collection;
        return view('home', ['collection'=>$collection]);
    }

    public function insertUsers(){
        $collection = HTTP::get("http://jsonplaceholder.typicode.com/posts/")->json();

        foreach ($collection as $item) {
            DB::table('user')->insert([
                'userId' => $item['userId'],
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body']
            ]);
        }

        echo("Insert Data Berhasil");
    }

    private $session;
    private $ibtoken;

    public function getSession2(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://10.20.212.156:8088/deviceManager/rest/2102350BSG10F5000019/sessions',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "username": "admin",
            "password": "P@ssw0rd",
            "scope": "0"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8',
                'Cookie: session=ismsession=15108533087089479351131930982144114180308357813770508272438'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function getSession(){

        header('Content-Type: text/plain; charset=utf-8');

        $ch = curl_init();
        $url = "https://10.20.212.156:8088/deviceManager/rest/2102350BSG10F5000019/sessions";
        $data = array("username"=> "admin","password"=> "P@ssw0rd","scope"=> "0");
        $data_string = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch , CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8","Connection: keep-alive","Content-Type: text/plain"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $out = curl_exec($ch);
        $respondata=substr($out, 620);
        $dcdjs = json_decode($respondata, true);
        print_r($dcdjs);

        $out1 = preg_split('/(\r?\n){2}/', $out, 2);
        $headers = $out1[0];
        $headersArray = preg_split('/\r?\n/', $headers);
        $headersArray = array_map(function($h) {
            return preg_split('/:\s{1,}/', $h, 2);
        }, $headersArray);

        $tmp = [];
        foreach($headersArray as $h) {
            $tmp[$h[0]] = isset($h[1]) ? $h[1] : $h[0];
        }
        $headersArray = $tmp; $tmp = null;
        print_r($headersArray);

        //var session & ibtoken
       print_r("\nSession : ".$this->session=substr($headersArray['Set-Cookie'],0,(strlen($headersArray['Set-Cookie'])-24)));
	   print_r("\nIbToken : ".$this->ibtoken= $dcdjs['data']['iBaseToken']);
    }

    public function getHuaweiCapacity(){
        $this->getSession();

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://10.20.212.156:8088/deviceManager/rest/2102350BSG10F5000019/storagepool/2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_POSTFIELDS =>'{
            "username": "admin",
            "password": "P@ssw0rd",
            "scope": "0"
        } ',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json; charset=utf-8',
            'iBaseToken: '.$this->ibtoken ,
            'Cookie: session=ismsession='.$this->session
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    // public function index(){
    //     return view('home');
    // }

}
