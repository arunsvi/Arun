<?php
class cURL { 
     var $headers;    
     var $user_agent;    
     var $compression;   
     var $cookie_file;    
     var $proxy;
   
     function cURL($cookies=TRUE,$cookie='',$compression='gzip',$proxy='') {
		$this->headers[] = "Accept: application/x-jsonlines";
        //$this->headers[] = "x-requested-with: XMLHttpRequest";
        $this->user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.2) Gecko/20100316 Firefox/3.6.2";
        $this->compression=$compression;
        $this->proxy=$proxy;
		$this->cookies=$cookies;
		if($this->cookies ==''){
			$this->cookies='cookies.txt';
		}
           
        if ($this->cookies == TRUE) $this->cookie($cookie); 
     }
    
     function cookie($cookie_file) {
          if (file_exists($cookie_file)) {
                $this->cookie_file=$cookie_file;
          } else { 
                @fopen($cookie_file,'w') or $this->error("The cookie file could not be opened. Make sure this directory has the correct permissions");
                $this->cookie_file=$cookie_file;
                fclose($cookie_file);
          }
     }
    
     function get($url,$refer='',$host='') {
		$process = curl_init();
		curl_setopt($process, CURLOPT_URL, $url);
		curl_setopt($process, CURLOPT_REFERER, $refer);
		curl_setopt($process, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEFILE, $this->cookie_file);
		if ($this->cookies == TRUE) curl_setopt($process, CURLOPT_COOKIEJAR, $this->cookie_file);
		curl_setopt($process,CURLOPT_ENCODING , $this->compression);
		curl_setopt($process, CURLOPT_TIMEOUT, 200);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
		//if ($this->proxy) curl_setopt($cUrl, CURLOPT_PROXY, '205.164.9.46:50079');
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
     }    
     function error($error) {
          echo "<center><div style='width:500px;border: 3px solid #FFEEFF; padding: 3px; background-color: #FFDDFF;font-family: verdana; font-size: 10px'><b>cURL Error</b><br>$error</div></center>";
          die;
     }
}


?>