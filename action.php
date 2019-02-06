<?php
header('Content-Type:text/html; charset=UTF-8');
	include ('./class.php');
	$action = $_GET['action'];

	switch ($action) {
		case 'login':
			$login_action = $class->fnc_curl("login","POST")->jsondecode();
			if($login_action['cevap'] == "Tamam"){
				$_SESSION['oturum_kontrol'] = "giris_yapildi";
				$_SESSION['kullanici_bilgileri'] =$login_action['kullanici_bilgisi'];
				$_SESSION['kullanici'] =$login_action['kullanici']; 
				echo "Tamam";
			} else
			{
				echo "Bilgiler Hatalı";
			}

			break;
			case 'kayit':
				$kayit_action = $class->fnc_curl("kayit","POST")->jsondecode();
				echo $kayit_action['cevap'];
				break;

			case 'guncelle':
			$id=$_POST['id'];
			$onay=$_POST['onay'];
			$yetki=$_POST['yetki'];
			$postfields="id=".$id."&onay=".$onay."&yetki=".$yetki;
			$guncelleme_action = $class->fnc_curl("guncelle","POST",$postfields)->jsondecode();
			echo $guncelleme_action["cevap"];
			break;

			

			case 'statudegis':
				$id=$_GET['id'];
				$postfields="id=".$id;
				$statu_action = $class->fnc_curl("statu_action","POST",$postfields)->jsondecode();
			break;

			case 'projeyeekle':
				$id=$_GET['id'];
				$projeid=$_GET['projeid'];
				$postfields="id=".$id."&projeid=".$projeid;
				$statu_action = $class->fnc_curl("projeyeekle","POST",$postfields)->jsondecode();

				print_r($statu_action);
			break;


			case 'projeekle':

				$proje_action = $class->fnc_curl("projeekle","POST")->jsondecode();
				echo $proje_action["cevap"];
				break;

			case 'get_projects':
				$getprojects_action = $class->fnc_curl("get_projects","GET")->jsondecode();
				//$_SESSION['kullanici_tablo']=$getusers_action;
			break;

		default:
			# code...
			break;
	}
 ?>