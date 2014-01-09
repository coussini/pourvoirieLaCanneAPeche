<?php 

class ConnexionPDO 
{
	private  $sParam;
	private  $sHost;
	private  $sUser;
	private  $sPass;
	private  $sBase;
	private  $sCharset;
	private  $sDsn;
	public   $rConnexion;
	
	public function __construct($param,
								$charset)
	{
		
		$this->sParam = $param;

		include_once("c5#dDy09!-aQd9_/" . $this->sParam . ".inc.php");

		$this->sHost = HOST;
		$this->sUser = USER;
		$this->sPass = PASS;
		$this->sBase = BASE;
		$this->sCharset = $charset;

		$this->sDsn = "mysql:host=" . $this->sHost . ";dbname=" . $this->sBase;
		$this->rConnexion = new PDO($this->sDsn,$this->sUser,$this->sPass);

		$this->rConnexion->exec("SET NAMES" . $this->sCharset);
	}
}
?>