<?php
class My_Email
{
	private $email;
	private $_user;
	private $host;
	protected $baseUrl;
	public function __construct($user)
	{
		$this->email = new Zend_Mail("utf-8");
		$this->host = Zend_Registry::get("host_mail");
		$this->baseUrl = Zend_Registry::get("baseUrl");
		$transport = new Zend_Mail_Transport_Smtp($this->host['smtp']['server'], $this->host['config']);
		$this->email->setDefaultTransport($transport);	
		$this->_user = $user;
	}
	
	public function setUser($user)
	{
		$this->_user = $user;
	}
	public function getEmail()
	{
		return $this->email;	
	}
	
	public function sendActivityEmail()
	{
		
		$user_id= $this->_user['user_id'];
		$user_email = md5($this->_user['email']);
		$message = "<html>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>	
					</heade>
					<body>
					 
					<a href='".$this->baseUrl."/user/register/activity?code=".$user_id."&codevalue=".$user_email."'>
						点击该链接，激活您的账户
					</a>
					</body>
					</html>";
		$this->email->setBodyHtml($message);
		$this->email->setFrom($this->host['personal']['mail'],$this->host['personal']['nickname']);
		//$mail->addTo("fancy2110@gmail.com","收件人");
		$this->email->addTo($this->_user['email'],"收件人");
		//$this->logger->info($this->host['personal']['mail'].'|'.$this->session->user['email'].'|'.$this->session->user['user_name']);
		$this->email->setSubject("=?UTF-8?B?".base64_encode('Twindow')."?=");
		return $this->email->send();
	}
	
	public function getEmailAddress(){
		$email = $this->_user['email'];
		$pos = strpos($email,"@");
		$tail = substr($email,$pos+1);
		$url = "http://www.".$tail;
		return $url;
	}
	
	
	public function sendEmails($emails,$content)
	{
		$count = 0;
		foreach($emails as $email)
		{
			$message = "<html>
					<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>	
					</heade>
					<body><h3>Twindow欢迎您！</h3><br>
						<a href='".$this->baseUrl."/invite/accept/inviter/".$this->_user->user_id."'>您的好友".$this->_user->user_name."邀请你加入Twindow</a><hr>"
					.$content.
					"</body></html>";
			$this->email->setBodyHtml($message);
			$this->email->setFrom($this->host['personal']['mail'],$this->host['personal']['nickname']);
			$this->email->addTo($this->_user['email'],"收件人");
			$this->email->setSubject("=?UTF-8?B?".base64_encode('Twindow')."?=");
			if($this->email->send())
			{
				$count++;
			}
		}
		return $count;
	}
}