<?php
/*
	NCTU ITSC連接資料庫用

	需套用PHP cURL套件
*/


class Dalbase
{
	protected $userId;
	
	protected $userPw;
	
	protected $apiKey;
	
	protected $cipherKey = "5EC8270DE3A145D2826AFF725073C419059813EB0F954D05917001F2086BF717";
	
	public $errno;
	
	public $curlInfo = array();
	/*
		資料來源
	*/
	public static $DOMAIN_MAP = array(
		'dbapi'         => 'https://nctuapi.nctu.edu.tw/base/'
	);
		
	/*
		cURL預設設定
	*/
	public static $CURL_OPTS = array(
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT        => 60,
		CURLOPT_USERAGENT      => 'nctu-php-0.1',
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0
	);
	
	public function __construct($config = array()){
		$this->userId = isset($config['userId'])?$config['userId']:'';
		$this->userPw = isset($config['userPw'])?$config['userPw']:'';
		$this->apiKey = isset($config['apiKey'])?$config['apiKey']:'';
	}
	
	/*
		設定使用者ID
		
		@return Dalbase
	*/
	public function setUserId($userId){
		$this->userId = $userId;
		return $this;
	}
	
	public function getUserId(){
		return $this->userId;
	}
	
	/*
		設定使用者Password
		
		@return Dalbase
	*/
	public function setUserPw($userPw){
		$this->userPw = $userPw;
		return $this;
	}
	
	public function getUserPw(){
		return $this->userPw;
	}
	
	/*
		設定使用者取用資料key
	*/
	public function setApiKey($apiKey){
		$this->apiKey = $apiKey;
		return $this;
	}
	
	public function getApiKey(){
		return $this->apiKey;
	}
	
	/*
		取得資料來源網址
		
		@return url
	*/
	protected function getUrl($name, $path=''){
		$url = self::$DOMAIN_MAP[$name];
		if ($path) {
			if ($path[0] === '/') {
				$path = substr($path, 1);
			}
			$url .= $path;
		}
		
		return $url;
	}
	
	/*
		發出Request
		
		@return  $result 資料回傳 json格式
	*/
	protected function makeRequest($url, $params, $ch=null){
		if(!$ch){
			$ch = curl_init();
		}
		
		$opts = self::$CURL_OPTS;
		$opts[CURLOPT_POSTFIELDS] = http_build_query($params, null, '&');
		$opts[CURLOPT_URL] = $url;
		$opts[CURLOPT_CUSTOMREQUEST] = $params['method'];
		
		if (isset($opts[CURLOPT_HTTPHEADER])) {
			$existing_headers = $opts[CURLOPT_HTTPHEADER];
			$existing_headers[] = 'Expect:';
			$opts[CURLOPT_HTTPHEADER] = $existing_headers;
		} else {
			$opts[CURLOPT_HTTPHEADER] = array('Expect:');
		}
		
		curl_setopt_array($ch, $opts);
		
		$result = curl_exec($ch);
		
		$this->errno = curl_error($ch);
		
		$this->curlInfo = curl_getinfo($ch);
		
		curl_close($ch);
		
		if($result === false){
			print "error";
		}
		
		return $result;
	}
	
	/*
		產生資料連結
		
		@return 解密資訊
	*/
	public function api(){
		$args = func_get_args();
		return call_user_func_array(array($this, '_getData'), $args);
	}
	
	/*
		啟動資料Request
		
		@return $result
	*/
	protected function _getData($path, $method = 'GET', $params = array()){
		if (is_array($method) && empty($params)) {
			$params = $method;
			$method = 'GET';
		}
		$params['method'] = $method;
		
		$domainKey = 'dbapi';
		
		$result = json_decode($this->_authRequest(
			$this->getUrl($domainKey, $path),
			$params
		), true);
		
		if (is_array($result) && isset($result['error'])) 
		{
			//throw exception
			$result['result'] = 'error';
		}
		else
		{
			//資料解密
			if(isset($result['result']))
			{
				$result['result'] = json_decode($this->decrypt($result['result'],$this->getApiKey()), true);
			}
		}
		return $result;
	}
	
	/*
		授權資訊
		
		@return makeRequest結果
	*/
	protected function _authRequest($url, $params){
		
		//帳號
		$uid = $this->getUserId();
		//DATA MD5
		$data = md5(json_encode($params));
		//時間
		$now = date("Y-m-d H:i:s");
		//簽名
		$hmac = hash_hmac("md5", $uid.$data.$now, $this->getApiKey());
		
		//參數加密
		$httpQuery['p'] = $this->encrypt(json_encode($params), $this->getApiKey());
		//簽名
		$httpQuery['s'] = $hmac;
		//時間加密
		$httpQuery['t'] = $this->encrypt($now, $this->getApiKey());
		//密碼加密 應該使用apikey就好了，密碼暫時先不用
		//$httpQuery['w'] = encrypt($this->getUserPw(), $this->getApiKey());
		//帳號加密
		$httpQuery['a'] = $this->encrypt($uid, $this->cipherKey);
		
		$httpQuery['method'] = $params['method'];
		
		//print_r($httpQuery);
		
		return $this->makeRequest($url, $httpQuery);
	}
	
	/*
		加密用
		input:
		@plainText string 欲加密文字
		@cipherKey string 密鑰
		
		ouput:
		加密後文字
	*/
	protected static function encrypt($plainText, $cipherKey='') { 
		if(empty($plainText))
		return '';
		$cipherText = '';
		for($i=0; $i<strlen($plainText); $i++) {
			$char = substr($plainText, $i, 1);
			$keychar = substr($cipherKey, ($i+1) % strlen($cipherKey), 1);
			//echo $keychar.'<br/>';
			$char = dechex(ord($char)+ord($keychar)); 
			$char = substr($char, 1, 1).substr($char, 0, 1); 
			$cipherText.=$char;
		}
		return base64_encode($cipherText);
	}
	
	/*
		解密用
		input:
		@cipherText string 已加密文字
		@cipherKey string 密鑰
		
		ouput:
		解密後文字
	*/
	protected static function decrypt($cipherText, $cipherKey='') { 
		if(empty($cipherText))
		return '';
		$plainText = '';
		$cipherText = base64_decode($cipherText);
		for($i=0,$j=0; $i<strlen($cipherText); $i+=2,$j++) {
			$keychar = substr($cipherKey, ($j+1) % strlen($cipherKey), 1);
			$char = substr($cipherText, $i, 2);
			$char = substr($char, 1, 1).substr($char, 0, 1); 
			$char = chr(hexdec($char)-ord($keychar)); 
			$plainText.=$char;
		}
		return $plainText;
	}

}
