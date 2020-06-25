<?php


	if(!isset($Autentica)){
		$Autentica = 0;
	}

	function google_captcha($response){ 
		$data = http_build_query(
	    array(
	        'secret' => '6LfIXxEUAAAAAL6chopHTcl6UXjVer9_1wh9y9L3',  
	        'response' => $response,
	        'remoteip' => $_SERVER['REMOTE_ADDR']
	    	)  
		);   
        
		$stream = array('http' => 
	    	array(
	        	'method'  => 'POST',
	        	'header'  => 'Content-type: application/x-www-form-urlencoded',
	        	'content' => $data
	    	)
		);             

		$context  = stream_context_create($stream);
		$result = file_get_contents('https://www.google.com/recaptcha/api/siteverify',false,$context);

		return json_decode($result);
	}
	

	function get_situacao($id){     
		if($id==0){
			return 'fechada';
		}else if($id==1){
			return 'em aberto';
		}else if($id==2){
			return 'suspensa';
		}
	}   

	function get($table,$id){     
		$resp = Query('SELECT Titulo FROM '.$table.' WHERE '.ucfirst($table).' = '.$id.'',1);   
		return $resp['Titulo']; 
	}

	function get_url($table,$id){     
		$resp = Query('SELECT Url FROM '.$table.' WHERE '.ucfirst($table).' = '.$id.'',1);   
		return $resp['Url']; 
	}

	function get_table_attr($table,$attr,$id){ 
		$resp = Query('SELECT '.$attr.' as Atributo FROM '.$table.' WHERE '.ucfirst($table).' = '.$id.'',1);   
		return $resp['Atributo']; 
	}

	function prepara_label($label){   
		$labels = explode('_',$label); 
		$rotulo = '';

		foreach ($labels as $key => $value) {
			$rotulo .= ' <b>'.ucfirst($value).'</b>';
		}

		return $rotulo;
	}


	function get_client_ip() {   
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
    }


	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){     
          $lmin = 'abcdefghijklmnopqrstuvwxyz';
          $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $num = '1234567890';
          $simb = '!@#$%*-';
          $retorno = '';
          $caracteres = '';
          $caracteres .= $lmin;
          if ($maiusculas) $caracteres .= $lmai;
          if ($numeros) $caracteres .= $num;
          if ($simbolos) $caracteres .= $simb;
          $len = strlen($caracteres);
          for ($n = 1; $n <= $tamanho; $n++) {
          $rand = mt_rand(1, $len);
          $retorno .= $caracteres[$rand-1];
          }
          return $retorno;
	}

	function goHome(){ 
		global $Config;
		echo '<script>document.location = "'.$Config['UrlSite'].'";</script>';
		exit; 
	}

	function get_data($url) {   
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	} 
	
	function data_americana($data){ 
		$d = explode('/',$data);
		return $d[2].'-'.$d[1].'-'.$d[0];
	}


	function clean($str) {         
		global $Config;
		global $DEBUG;
		global $SQLDEBUG;

		$Conexao = Conectar($Config["Banco"][0],$Config["Banco"][1],$Config["Banco"][2],$Config["Banco"][3]);



    	if(!is_numeric($str)) {  
    		$str = strip_tags($str);    
        	$str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
        	$str = function_exists('mysqli_real_escape_string') ? mysqli_real_escape_string($Conexao,$str) : mysqli_escape_string($Conexao,$str);
    	}  

    	Desconectar($Conexao);
		unset($Dados);   
    	return $str;
	}
	
	//EstaLogado();
	
	function formata_data($d){   
		$d = explode('-',$d);
		return $d[2].'/'.$d[1].'/'.$d[0];
	}

		function formata_data_hora($data){
		$d_aux = explode(' ',$data);
		$d = formata_data($d_aux[0]);
		return $d.' - '.$d_aux[1];
	}  

	function getAno($id){
		$r = Query('SELECT * from ano where Ano = '.$id.'',1);
		return $r['Titulo'];   
	}

	function Insert($Sql){  
		global $Config;
		global $DEBUG;
		global $SQLDEBUG;

		$Conexao = Conectar($Config["Banco"][0],$Config["Banco"][1],$Config["Banco"][2],$Config["Banco"][3]);
		mysqli_query($Conexao,$Sql);
		$lastId = mysqli_insert_id($Conexao);
		return $lastId;
	}

	function Conectar($Servidor, $Usuario, $Senha, $Banco) {
		$Conexao = mysqli_connect($Servidor,$Usuario,$Senha,$Banco) or die("ERRO: Configura��o inv�lida de banco de dados.");
		//mysql_select_db($Banco, $Conexao) or die("ERRO: Banco n�o encontrado");
		mysqli_set_charset($Conexao,"utf8");
		return $Conexao;
	}   
	
	function Desconectar($Conexao) {
		$Conexao = "";
		unset($Conexao);
	}
	
	function Query($Sql, $Fetch = 0) {
		
		global $Config;
		global $DEBUG;
		global $SQLDEBUG;
		
		$Conexao = Conectar($Config["Banco"][0],$Config["Banco"][1],$Config["Banco"][2],$Config["Banco"][3]);
		$Dados = mysqli_query($Conexao,$Sql);
		
		if(isset($DEBUG) && $DEBUG == 1) {
			$SQLDEBUG[] = $Sql;
		}
		
		if($Fetch == 1) {
			$Retorno = @mysqli_fetch_assoc($Dados);
		} else {
			$Retorno = $Dados;
		}
		
		Desconectar($Conexao);
		unset($Dados);
		return $Retorno;
	}

	
	function ErroMsg($Msg) {
		?>
        <div class="message message-error">
        <span class="close"></span>
        <?php echo $Msg; ?>
        </div>
        <?php
	}
	
	function SucessoMsg($Msg) {
		?>
        <div class="message message-success">
        <span class="close"></span>
        <?php echo $Msg; ?>
        </div>
        <?php
	}
	
	
	function Texto($Texto, $Acao = 'Ler') {
		if($Acao == 'Gravar') {
			return htmlspecialchars($Texto, ENT_QUOTES);
		} else {
			return htmlspecialchars_decode($Texto, ENT_QUOTES);	
		}
	}
		
	 function cria_pasta($caminho) {
        foreach ($caminho as $value => $key) {
            if (!file_exists($caminho[$value])) {
                mkdir($caminho[$value], 0777);
            }
        }
    }

    function apaga_arquivo($caminho, $arquivo) {
        foreach ($caminho as $value) {
            if (file_exists($caminho[$value] . $arquivo[$value])) {
                unlink($caminho[$value] . $arquivo[$value]);
            }
        }
    }
	
	function upload_arquivo($nome_arquivo, $tmp, $caminho) {
        $caminho_final = $caminho . $nome_arquivo;
        if (move_uploaded_file($tmp, $caminho_final))
            return true;
    }
	
     function upload_altura($file, $path, $alt, $maxsize = 900720000) {
        if (is_uploaded_file($file['tmp_name'])) {
            $mime = $file['type'];
            if (($mime != "")) {
                if ($file['size'] < $maxsize) {
                    list($larg_orig, $alt_orig) = getimagesize($file['tmp_name']);
                    $razao_orig = $alt_orig / $larg_orig;
                    $larg = $alt / $razao_orig;
                    $imagem_nova = imagecreatetruecolor($larg, $alt);
                    if ($file['type'] == 'image/png') {
                        $imagem = imagecreatefrompng($file['tmp_name']);
                    } elseif ($file['type'] == 'image/gif' || $_FILES['arquivo']['type'] == 'image/gif') {
                        $imagem = imagecreatefromgif($file['tmp_name']);
                    } else {
                        $imagem = imagecreatefromjpeg($file['tmp_name']);
                    } imagecopyresampled($imagem_nova, $imagem, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);
                    return (imagejpeg($imagem_nova, $path, 100)) ? 1 : 5;
                }
            }
        }
    }

	function upload_largura($file, $path, $larg, $maxsize = 900720000) {
        if (is_uploaded_file($file['tmp_name'])) {
            $mime = $file['type'];
            if (($mime != "")) {
                if ($file['size'] < $maxsize) {
                    list($larg_orig, $alt_orig) = getimagesize($file['tmp_name']);
                    $razao_orig = $larg_orig / $alt_orig;
                    $larg = $larg;
                    $alt = $larg / $razao_orig;
                    $imagem_nova = imagecreatetruecolor($larg, $alt);
                    if ($file['type'] == 'image/png') {
                        $imagem = imagecreatefrompng($file['tmp_name']);
                    } elseif ($file['type'] == 'image/gif' || $_FILES['arquivo']['type'] == 'image/gif') {
                        $imagem = imagecreatefromgif($file['tmp_name']);
                    } else {
                        $imagem = imagecreatefromjpeg($file['tmp_name']);
                    } imagecopyresampled($imagem_nova, $imagem, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);
                    return (imagejpeg($imagem_nova, $path, 100)) ? 1 : 5;
                }
            }
        }
    }
	
	 function upload_larg_alt($file, $path, $larg, $alt, $maxsize = 900720000) {
        if (is_uploaded_file($file['tmp_name'])) {
            $mime = $file['type'];
            if (($mime != "")) {
                if ($file['size'] < $maxsize) {
                    list($larg_orig, $alt_orig) = getimagesize($file['tmp_name']);
                    $imagem_nova = imagecreatetruecolor($larg, $alt);
                    if ($file['type'] == 'image/png') {
                        $imagem = imagecreatefrompng($file['tmp_name']);
                    } elseif ($file['type'] == 'image/gif' || $_FILES['arquivo']['type'] == 'image/gif') {
                        $imagem = imagecreatefromgif($file['tmp_name']);
                    } else {
                        $imagem = imagecreatefromjpeg($file['tmp_name']);
                    } imagecopyresampled($imagem_nova, $imagem, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);
                    return (imagejpeg($imagem_nova, $path, 100)) ? 1 : 5;
                }
            }
        }
    }

    function read($param){             
		$id = 0;

		if(isset($_GET[$param]) && $_GET[$param]!=''){
			$aux = explode('-',$_GET[$param]);
			$l = end($aux);

			if(is_numeric($l)){
				$id = clean($l);
			}else{
				return $id;
			}
			return $id;
		}else{
			return $id;
		}
	}



     function upload_largura_varias($path, $larg, $indice, $nome) {
        $file = $_FILES[$nome]['name'][$indice];
        $tamanho = $_FILES[$nome]['size'][$indice];
        $file_tmp_name = $_FILES[$nome]['tmp_name'][$indice];
        if (is_uploaded_file($file_tmp_name)) {
            $mime = $_FILES[$nome]['type'][$indice];
            if (($mime != "")) {
                list($larg_orig, $alt_orig) = getimagesize($file_tmp_name);
                $razao_orig = $larg_orig / $alt_orig;
                $larg = $larg;
                $alt = $larg / $razao_orig;
                $imagem_nova = imagecreatetruecolor($larg, $alt);
                if ($_FILES[$nome]['type'][$indice] == 'image/png') {
                    $imagem = imagecreatefrompng($file_tmp_name);
                } elseif ($_FILES[$nome]['type'][$indice] == 'image/gif' || $_FILES[$nome]['type'][$indice] == 'image/gif') {
                    $imagem = imagecreatefromgif($file_tmp_name);
                } else {
                    $imagem = imagecreatefromjpeg($file_tmp_name);
                } imagecopyresampled($imagem_nova, $imagem, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);
                return (imagejpeg($imagem_nova, $path, 100)) ? 1 : 5;
            }
        }
    }

     function upload_tudo_varias($path, $larg, $alt, $indice, $nome) {
        $file = $_FILES[$nome]['name'][$indice];
        $tamanho = $_FILES[$nome]['size'][$indice];
        $file_tmp_name = $_FILES[$nome]['tmp_name'][$indice];
        if (is_uploaded_file($file_tmp_name)) {
            $mime = $_FILES[$nome]['type'][$indice];
            if (($mime != "")) {
                list($larg_orig, $alt_orig) = getimagesize($file_tmp_name);
                $imagem_nova = imagecreatetruecolor($larg, $alt);
                if ($_FILES[$nome]['type'][$indice] == 'image/png') {
                    $imagem = imagecreatefrompng($file_tmp_name);
                } elseif ($_FILES[$nome]['type'][$indice] == 'image/gif' || $_FILES[$nome]['type'][$indice] == 'image/gif') {
                    $imagem = imagecreatefromgif($file_tmp_name);
                } else {
                    $imagem = imagecreatefromjpeg($file_tmp_name);
                } imagecopyresampled($imagem_nova, $imagem, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);
                return (imagejpeg($imagem_nova, $path, 100)) ? 1 : 5;
            }
        }
    }
    
     function recorta_imagem($pasta) {
        define('UPLOAD_DIR', '../../imagem/'.$pasta);
        $img = $_POST['image'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.jpg';
        $success = file_put_contents($file, $data);
        return $success;
	}
	

?>