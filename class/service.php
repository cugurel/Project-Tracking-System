<?php 
header('Content-Type: application/json; charset=utf-8');
header('Content-Type:text/html; charset=UTF-8');
	$db_name = "proje_takibi";
	$db_location = "localhost";
	$db_password ="";
	$db_user="root";
	$conn = mysqli_connect($db_location, $db_user, $db_password, $db_name);
		mysqli_set_charset($conn, 'utf8');
		mysqli_query($conn, "SET NAMES 'utf8'");
		mysqli_query($conn, "SET CHARACTER SET 'utf8'");
		mysqli_query($conn, "SET COLLATION_CONNECTION = 'utf8_turkish_ci'");
	if(isset($_GET['key'])){
		$anahtar=$_GET['key'];
	}else{
	$anahtar="";
	}

	switch ($anahtar)
	 {
			case 'login':
			$login_sonuc = array();
			$login_eposta = $_POST['eposta'];
			$login_sifre = md5($_POST['sifre']);
			$qry =mysqli_query($conn,"SELECT * FROM `kullanicilar` WHERE `eposta` = '".$login_eposta."' AND `sifre` = '".$login_sifre."' AND `onay` = '1'") ;
			$kac=mysqli_num_rows($qry);
			if($kac==1)
			{
				$login_sonuc['cevap']='Tamam';
				$sonuc1=mysqli_fetch_array($qry);
				$login_sonuc['kullanici']=$sonuc1;
				$sonuc2 = mysqli_query($conn, "SELECT * FROM `kullanici_bilgisi` WHERE `user_id` = '".$sonuc1['id']."' AND `onay` = '1' ");
				$kullanici_bilgileri = mysqli_fetch_assoc($sonuc2);
				$login_sonuc['kullanici_bilgisi']=$kullanici_bilgileri;
			}else{
				$login_sonuc['cevap']='Error';
			}
			echo json_encode($login_sonuc);
			break;

			case 'kayit':
				$kayit_sonuc= array();
				$kayit_isim = $_POST['isim'];
				$kayit_soyisim = $_POST['soyisim'];
				$kayit_eposta = $_POST['eposta'];
				$kayit_yetki = $_POST['yetki'];
				$kayit_sifre = md5($_POST['sifre']);
				$kayit_varmi = mysqli_query($conn,"SELECT * FROM `kullanicilar` WHERE `eposta` = '{$kayit_eposta}'");
				$kayit_varmi_kac = mysqli_num_rows($kayit_varmi);
				if($kayit_varmi_kac == 1)
				{
					$kayit_sonuc['cevap'] = 'Error_eposta';
					$kayit_sonuc['cevap_kod'] = 'Bu eposta daha önce kayıt edildi.';
				}elseif ($kayit_varmi_kac == 0) {
					$kayıt_sonuc[1]="bir";
					$kayit_qry = mysqli_query($conn,"INSERT INTO `kullanicilar` (`id`, `eposta`, `sifre`, `yetki`, `tarih`, `onay`) VALUES (NULL, '{$kayit_eposta}', '{$kayit_sifre}', '{$kayit_yetki}', NOW(), '0' )");
					if($kayit_qry)
					{
						$kayıt_sonuc[2]="iki";
						$kayit_sorgula = mysqli_query($conn,"SELECT * FROM `kullanicilar` WHERE `eposta` = '{$kayit_eposta}'");
						$kayit_dizisi=mysqli_fetch_array($kayit_sorgula);
						$kayittaki_id=$kayit_dizisi['id'];
						$kayit_qry2 = mysqli_query($conn,"INSERT INTO `kullanici_bilgisi` (`id`, `user_id`, `ad`, `soyad`, `dogum_tarihi`, `telefon`, `adres`, `kan_grubu`, `sirket_pozisyon`, `onay`, `tarih`) VALUES (NULL, '{$kayittaki_id}', '{$kayit_isim} ', '{$kayit_soyisim}', 'null', 'null', 'null', 'null', 'null', '1', NOW());");
						$kayıt_sonuc[3]="uc";
						if($kayit_qry2)
						{
							$kayit_sonuc['cevap'] = "Tamam";
						}
						else
						{
							$kayit_sonuc['cevap'] = 'Error_kayit';
						}
					}
					else
					{
						$kayit_sonuc['cevap'] = 'Error';

					}
				}
				echo json_encode($kayit_sonuc);
				break;

				case 'get_users':
					$kullanicilari_al="SELECT
						kullanici_bilgisi.ad,
						kullanici_bilgisi.soyad,
						kullanicilar.eposta,
						kullanicilar.onay,
						kullanicilar.id,
						kullanicilar.yetki
						FROM
						kullanici_bilgisi
						LEFT JOIN kullanicilar ON kullanici_bilgisi.user_id = kullanicilar.id ORDER BY `kullanici_bilgisi`.`id` DESC";
						$tum_kullanicilar =mysqli_query($conn, $kullanicilari_al);
						$all_users=array();
						while($sonx1= mysqli_fetch_assoc($tum_kullanicilar)){
								$all_users[]=$sonx1;	
						}
						$bitir=['gelir'=>$all_users];
						echo json_encode($bitir);
					break;

					case 'statu_action':
						$statu_sonuc= array();
						$statuid=$_POST['id'];

						$statuquery=mysqli_query($conn,"UPDATE `kullanicilar` SET `onay` = '1' WHERE `kullanicilar`.`id` = {$statuid}");
						echo json_encode($statuquery);

						if($statuquery)
						{
							$statu_sonuc["cevap"]="Basarili";
						}else
						{
							$statu_sonuc["cevap"]="Basarisiz";
							$statu_sonuc["cevap_kodu"]="Basarisiz_Onay_Guncellenmesi";
						}
					break;



					case 'get_user':
						$user_id=$_POST['id'];
						$kullanici_bilgileri="SELECT
						kullanici_bilgisi.ad,
						kullanici_bilgisi.soyad,
						kullanici_bilgisi.kan_grubu,
						kullanici_bilgisi.adres,
						kullanici_bilgisi.telefon,
						kullanici_bilgisi.dogum_tarihi,
						kullanicilar.eposta,
						kullanicilar.onay,
						kullanicilar.id,
						kullanicilar.yetki
						FROM
						kullanici_bilgisi
						LEFT JOIN kullanicilar ON kullanici_bilgisi.user_id = {$user_id}";
						$tumbilgiler =mysqli_query($conn, $kullanici_bilgileri);
						$kullanici= mysqli_fetch_array($tumbilgiler);
						echo json_encode($kullanici);
					break;

					case 'get_project':

						$project_id = $_POST['id'];

						$proje_bilgileri ="SELECT * FROM `projeler` WHERE `id` = {$project_id} ";
						$tumprojebilgileri = mysqli_query($conn, $proje_bilgileri);
						$proje = mysqli_fetch_array($tumprojebilgileri);
						echo json_encode($proje);


					break;

					case 'guncelle':
						$guncelle=array();
						$kullanici_id= $_POST['id'];
						$kullanici_onay = $_POST['onay'];
						$kullanici_yetki = $_POST['yetki'];
						$onay_guncelle = mysqli_query($conn, "UPDATE kullanici_bilgisi SET onay = '{$kullanici_onay}' WHERE user_id = {$kullanici_id}");

						$yetki_guncelle = mysqli_query($conn, "UPDATE `kullanicilar` SET `yetki` = '{$kullanici_yetki}' WHERE `id` = {$kullanici_id}");
						$guncelle["cevap"]="Guncelleme_Basarili";

						if($onay_guncelle && $yetki_guncelle)
						{
							$guncelle["cevap"]="Guncelleme_Basarili";
						}else
						{
							$guncelle["cevap"]="Guncelleme_Basarisiz";
							$guncelle["cevap_kodu"] ="Deger_Hatasi";
						}

						echo json_encode($guncelle);
						break;

					case 'projeekle':

						$projeekle=array();
						$id              = $_POST['kullanici_id'];
						$projeisim       = $_POST['proje_ismi'];
						$projeamac       = $_POST['proje_amaci'];
						$onay            = $_POST['onay'];
						$yayin           = $_POST['yayinla'];
						$olusum          = $_POST['olusum_tarihi'];
						$planbaslangic   = $_POST['planlanan_baslangic'];
						$baslangictarih  = $_POST['baslangic_tarih'];
						$bitistarih      = $_POST['bitis_tarihi'];
						$guncelletarih   = $_POST['guncelle_tarih'];


						/*$pro_ekle = mysqli_query($conn,"INSERT INTO `projeler` (`id`, `kullanici_id`, `proje_ismi`, `proje_amaci`, `onay`, `yayinla`, `olusum_tarihi`, `planlanan_baslangic`, `baslangic_tarih`, `bitis_tarihi`, `guncelle_tarih`,) VALUES (NULL, '{$id}', '{$projeisim}', '{$projeamac}','0', '0', NOW(), '{$planbaslangic}','{$baslangictarih}','{$bitistarih}','{$guncelletarih}' )");*/
						$proje_ekle= mysqli_query($conn,"INSERT INTO `projeler` (`id`, `kullanici_id`, `proje_ismi`, `proje_amaci`, `onay`, `yayinla`, `olusum_tarihi`, `planlanan_baslangic`, `baslangic_tarih`, `bitis_tarihi`, `guncelle_tarih`) VALUES (NULL, '{$id}', '{$projeisim}', '{$projeamac}', '{$onay}', '{$yayin}', '{$olusum}', '{$planbaslangic}', '{$baslangictarih}', '{$bitistarih}', '{$guncelletarih}')");

						if($proje_ekle)
						{
							$projeekle["cevap"]="Tamam";
						}else
						{
							$projeekle["cevap"]="Ekleme_Basarisiz";
						}
						echo json_encode($projeekle);
					break;

					case 'get_projects':
						$tum_projeler=mysqli_query($conn, "SELECT `proje_ismi`,`id`, `proje_amaci`, `olusum_tarihi`, `bitis_tarihi` FROM `projeler` ");
						$all_project = array();
						while($sonuclar= mysqli_fetch_assoc($tum_projeler)){
								$all_project[]=$sonuclar;	
						}

						$hepsi=['getir'=>$all_project];
						echo json_encode($hepsi);
					break;

					case 'projeyeekle':

						$projeyeekle=array();
						$id=$_POST['id'];
						$projeid= $_POST['projeid'];
						
						$projeuesivarmi= mysqli_query($conn,"SELECT * FROM `proje_yetkilileri` WHERE `proje_id` = {$projeid} AND `user_id` = {$id}");
						$yetkili_varmi=mysqli_num_rows($projeuesivarmi);
						if($yetkili_varmi == 1)
						{
							$projeyeekle["cevap"]="Kullanici_daha_once_eklendi";
						}else{
							$yetkiquery = mysqli_query($conn,"INSERT INTO `proje_yetkilileri` (`user_id`,`proje_id`,`eklenme_tarihi`) VALUES ('{$id}','{$projeid}',NOW())");
							if($yetkiquery){
								$projeyeekle["cevap"]="Basarili";
							}else{
								$projeyeekle["cevap"]="Basarisiz_Ekleme_Islemi";
							}
						}
						echo json_encode($projeyeekle);
					break;

					case 'yetkiligetir':
						$projeid=$_POST['id'];
						$projeyetkilileri = "SELECT
							proje_yetkilileri.yetkisi,
							proje_yetkilileri.eklenme_tarihi,
							proje_yetkilileri.proje_id,
							proje_yetkilileri.user_id,
							kullanici_bilgisi.user_id,
							kullanici_bilgisi.ad,
							kullanici_bilgisi.soyad
							FROM
							proje_yetkilileri
							INNER JOIN kullanici_bilgisi ON proje_yetkilileri.user_id = kullanici_bilgisi.user_id
							WHERE
							proje_yetkilileri.proje_id = {$projeid} ";

							$tumyetkililer=mysqli_query($conn,$projeyetkilileri);

							$tum_yetkili=array();
							while($yetkili_sonuclar = mysqli_fetch_assoc($tumyetkililer))
							{
								$tum_yetkili[] = $yetkili_sonuclar;
							}
							$yetkililer =['yetkili_getir'=>$tum_yetkili];
							echo json_encode($yetkililer);


					break;

		default:
			$default_sonuc = array();
			$default_sonuc['cevap'] = 'Error';
			$default_sonuc['error_kod'] = 'Yetkisiz İşlem Denemesi.';
			echo json_encode($default_sonuc);
			break;
	}

 ?>