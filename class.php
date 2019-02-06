<?php
session_start();
class SAO{
    private $server;
    private $action;
    private $response;
    private $jsn;
    private $err;
    private $postvalues;
    public function __construct(){
        $this->server="http://localhost/projetakibi/class/service.php?key=";
      // echo "HELLO WORD";
    }
/*****************************************************/
    function ipNo() {
        $ip = '';
        if (@$_SERVER['HTTP_CLIENT_IP'])
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if(@$_SERVER['HTTP_X_FORWARDED_FOR'])
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(@$_SERVER['HTTP_X_FORWARDED'])
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if(@$_SERVER['HTTP_FORWARDED_FOR'])
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(@$_SERVER['HTTP_FORWARDED'])
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if(@$_SERVER['REMOTE_ADDR'])
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = 'bulunamadı';

        return $ip;
    }
/*****************************************************/
    function uzanti($dosya) {
        $uzanti = pathinfo($dosya);
        $uzanti = $uzanti["extension"];
        return $uzanti;
    }
/*****************************************************/
    function err(){
        return $this->err;
    }
/*****************************************************/
    function jsondecode(){
        $y= json_decode($this->response,true);
        $this->jsn=$y;
        return $this->jsn;
    }
/*****************************************************/
    function clear($x,$y,$q,$z=false,$bs=false){
        $temi = str_replace( $x, $y, $q );
        $result=trim($temi);
        if($z==true){
            $tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','ç','Ç');
            $en = array('s','S','i','I','g','G','u','U','o','O','c','C');
            $result = str_replace($tr,$en,$result);
        }
        if($bs=true){
            $result = strtolower($result);
        }

        return $result;
    }
/*****************************************************/
    function fnc_curl($action,$y="GET",$z=null){
        $pv="";
        $curl = curl_init();
        if($y=="POST" and $z==null){
            self::post_array();
            $pv=$this->postvalues;
        }elseif($y=="POST" and $z!=null){
            $pv=$z;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->server.$action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 600,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $y,
            CURLOPT_POSTFIELDS => $pv
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $this->response=$response;
        $this->err=$err;
        return $this;
        
    }
/*****************************************************/
    function post_array(){
        $postData='';
        foreach($_POST as $k => $v){
            $postData .= $k . '='.$v.'&';
        }
        $this->postvalues=$postData;
        return $this;
    }
/*****************************************************/

/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/
/*****************************************************/

}
$class=new SAO();
?>

