<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MikroBillApi extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'host',
        'login',
        'password',
        'key1',
        'key2',
        'port',
    ];
    const TIMEOUT = 5;
    private $Stream;
	private $errno=-1;
	private $errstr='';   
    public function Process($Path, $Value = NULL){
			
        if ($this->CheckConnection()){
            return $this->Send($Path,$Value);
        } else {
            $ret = json_encode(array('result' => $this->errstr,
                                     'code' => $this->errno));
            $this->errstr='Unknown';
            $this->errno=0;
            return $ret;
        }
    }
    
    function Send($Path,$Value=NULL){
        $ret = array('path' => $Path, 
                     'value' => $Value);
        $ret = $this->Encrypt(json_encode($ret));
        fwrite($this->Stream, pack('I',strlen($ret)));
        fwrite($this->Stream, $ret);	
        
        return $this->Read();
    }
    
    function Read(){
        $l=fread($this->Stream,4);
        
        if (!$l===FALSE){
            $l=unpack('I',$l);
            $Received = 0;
            $ret='';
            $Started=time();
            while (($Received<$l[1])&&((time()-$Started)<self::TIMEOUT)){
                $Add=fread($this->Stream,$l[1]-$Received);
                $AL=strlen($Add);
                if ($AL>0){
                    $ret .= $Add;
                    $Received += $AL;
                    $Started=time();
                }
            }
            return $this->Decrypt($ret);
        } else {return NULL;}
    }
    public function getStatusAttribute()
    {
       return $this->CheckConnection()? "Online":"Offline";
    }
    function CheckConnection(){
        
        if ((is_null($this->key1))||(is_null($this->key2))){return false;}
        
        $this->errstr='Unknown';$this->errno=2;
        if (is_null($this->Stream)){
            $MT=microtime();
            $this->Stream = fsockopen($this->host, 
                                      $this->port, 
                                      $this->errno, 
                                      $this->errstr, 
                                      self::TIMEOUT);

            if ($this->Stream) {
                socket_set_timeout($this->Stream, self::TIMEOUT);	
                
                $MT=microtime();
                $ret = array('auth'=>array('login' => $this->login,
                                           'password' => sha1($this->password.$MT), 
                                           'sign'=>$MT
                                           )
                            );
                $ret = $this->Encrypt(json_encode($ret));
                fwrite($this->Stream, pack('I',strlen($ret)));
                fwrite($this->Stream, $ret);	
                
                $Auth = $this->Read();
                
                if (strlen($Auth)>0){
                    
                    $Auth = json_decode($Auth);
                    
                    if ($Auth->code==0){
                        return true;
                    } else {
                        $this->errno=$Auth->code;
                        $this->errstr=$Auth->return;
                        fclose($this->Stream);		
                        $this->Stream = NULL;
                        return false;
                    }
                } else {
                    $this->errno=6;
                    $this->errstr='Null response! Probably incorrect encryption keys!';
                    return false;
                }
                
            } else {
                $this->Close();
                $this->errstr='Can`t connect!';
                return false;
            }
        } 
        return true;
    }
    
    function Close(){
        if (!is_null($this->Stream)){
            $this->Send('DISCONNECT');
            fclose($this->Stream);		
            $this->Stream = NULL;
        }
    }
    
    function Encrypt($txt) {
      //  $enc_data = openssl_encrypt($txt,"aes-128-cbc", $this->CRYPTO_KEY_1,$options=OPENSSL_RAW_DATA,base64_decode($this->CRYPTO_KEY_2));
         $ret = mcrypt_encrypt ( MCRYPT_RIJNDAEL_128,
          base64_decode($this->key1),
         $txt,
         MCRYPT_MODE_CBC,
         base64_decode($this->key2));
        return $ret;
    }
    
    function Decrypt($txt) {
        
      //  $ret_data = openssl_decrypt($txt, "aes-128-cbc", base64_decode($this->CRYPTO_KEY_1), $options=OPENSSL_RAW_DATA, base64_decode($this->CRYPTO_KEY_2));

         return trim(mcrypt_decrypt(
           MCRYPT_RIJNDAEL_128,
           base64_decode($this->key1),
           $txt,
           MCRYPT_MODE_CBC,
           base64_decode($this->key2)),
           "\x00"
         );
       // return trim($ret_data,"\x00");
    }
    public function AccountInetService()
    {
        return $this->hasMany(AccountInetService::class);
    }
    public function AccountCatvService()
    {
        return $this->hasMany(AccountCatvService::class);
    }
    public function ServiceCompanies()
    {
        return $this->belongsTo(ServiceCompanies::class);
    }

}
