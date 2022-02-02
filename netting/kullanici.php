<?php
ob_start();
session_start();
include 'baglan.php';
include '../production/fonksiyon.php';

if (isset($_POST['Kullanicikaydet'])) {
	
		echo $tmu_ad=htmlspecialchars($_POST['name']); echo "<br>";
		echo $tmu_soyad=htmlspecialchars($_POST['surname']); echo "<br>";
		echo $tmu_mail=htmlspecialchars($_POST['tmu_mail']); echo "<br>";
		echo $tmu_passwordone=trim($_POST['passwordone']); echo "<br>";
		echo $tmu_passwordtwo=trim($_POST['passwordtwo']); echo "<br>";

	  if ($tmu_passwordone==$tmu_passwordtwo) {
		if (strlen($tmu_passwordone)>=6) {
		    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_mail=:tmu_mail");
			$kullanicisor->execute(array(
			 'tmu_mail' => $tmu_mail
			));
			//dönen satır sayısını belirtir
		$say=$kullanicisor->rowCount();	
			if ($say==0) {
    			//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$paswordd=md5($tmu_passwordone);
				$tmu_type=$_POST['tmu_type']; 	 
				$kullanicikaydet=$db->prepare("INSERT INTO tmp_me_users SET	
				         name=:name,
				         surname=:surname,
						 tmu_mail=:tmu_mail,
					     password=:password,
					     tmu_type=:tmu_type
					");
				$insert=$kullanicikaydet->execute(array(
						'name' => $tmu_ad,
						'surname' => $tmu_soyad,
						'tmu_mail' => $tmu_mail,
						'password' => $paswordd,
						'tmu_type' => $tmu_type
				));
				if ($insert) {
					header("Location:../production/index.php?durum=loginbasarili");
				      //Header("Location:../production/genel-ayarlar.php?durum=ok");
				} else {
					header("Location:../production/index.php?durum=loginbasarısız");
				} 
			} else {
				header("Location:../production/index.php?durum=mukerrerkayit");
			}
		// Bitiş
   	} else {
		
			header("Location:../production/index.php?durum=eksiksifre");
		}
	} else {
		
		header("Location:../production/index.php?durum=farklısifre");
	}
}

//Login Gİril

if (isset($_POST['admingiris'])) {	
	 $tmu_mail=htmlspecialchars($_POST['tmu_mail']); 
	 $passwordd=md5($_POST['password']); 
	 $tmu_type=$_POST['tmu_type']; 
	 $tmu_status=$_POST['tmu_status'];
	 $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_mail=:tmu_mail and tmu_type=:tmu_type and password=:password and tmu_status=:tmu_status");
	 $kullanicisor->execute(array(
		'tmu_mail' => $tmu_mail,
		'tmu_type' => $tmu_type,
		'password' => $passwordd,
		'tmu_status' =>$tmu_status
	));
	echo $say=$kullanicisor->rowCount();

	if ($say==0) {
	$_SESSION['tmu_mail']=$tmu_mail;

		header("Location:../production/index.php");
		exit;

	} else {
		header("Location../index?durum=basarisizgiris");

	}
}

//Kullanıcı Ekleme
if (isset($_POST['kullaniciekle'])) {	
	echo $tmu_mail=htmlspecialchars($_POST['tmu_mail']); echo "<br>";
	echo $tmu_username=htmlspecialchars($_POST['tmu_name']); echo "<br>";
	echo $tmu_ad=htmlspecialchars($_POST['name']); echo "<br>";
	echo $tmu_soyad=htmlspecialchars($_POST['surname']); echo "<br>";
	echo $password=trim($_POST['password']); echo "<br>";
	echo $tmu_type=htmlspecialchars($_POST['tmu_type']); echo "<br>";
 	if (strlen($password)>=6) {
		$kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_mail=:tmu_mail");
		$kullanicisor->execute(array(
		 'tmu_mail' => $tmu_mail
		));
		//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();	
		if ($say==0) {
			$tmu_type=$_POST['tmu_type']; 
			//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
			$paswordd=md5($tmu_passwordone);
					 
			$kullanicikaydet=$db->prepare("INSERT INTO tmp_me_users SET	
					 name=:name,
					 surname=:surname,
					 tmu_mail=:tmu_mail,
					 tmu_name=:tmu_name,
					 password=:password,
					 tmu_type=:tmu_type
				");
			$insert=$kullanicikaydet->execute(array(
					'name' => $tmu_ad,
					'surname' => $tmu_soyad,
					'tmu_mail' => $tmu_mail,
					'tmu_name' =>$tmu_username,
					'password' => $paswordd,
					'tmu_type' => $tmu_type
			));
			if ($insert) {
				header("Location:../production/kullanici.php?durum=kayitBasarili");
				  //Header("Location:../production/genel-ayarlar.php?durum=ok");
				  
			} else {
				header("Location:../production/Kullanici-ekle.php?durum=KayitBasarisiz");
			} 
		} 
	} 
}
//Kulanıcı Düzenlme
if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id=$_POST['tmu_id'];

	$kullanicikaydet=$db->prepare("UPDATE tmp_me_users SET
		tmu_name=:tmu_name,
		tmu_mail=:tmu_mail,
		name=:name,
		surname=:surname,
        password=:password,
		tmu_type=:tmu_type
		WHERE tmu_id={$_POST['tmu_id']}");

	$update=$kullanicikaydet->execute(array(
		'tmu_name' => $_POST['tmu_name'],
		'tmu_mail' => $_POST['tmu_mail'],
		'name' => $_POST['name'],
		'surname' => $_POST['surname'],
     	'password' => $_POST['password'],
		'tmu_type'=>$_POST['tmu_tye']
	));


	if ($update) {

		Header("Location:../production/kullanici.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}

}


//Kullanici Silme İlemi



if ($_GET['kullanicisil']=="ok") {

	$sil=$db->prepare("DELETE from tmp_me_users where tmu_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['tmu_id']
	));
	if ($kontrol) {
		header("location:../production/kullanici.php?sil=ok");

	} else {

		header("location:../production/kullanici.php?sil=no");

	}


}






//Hizmet Ekleme
if (isset($_POST['hizmetekle'])) {

	$hizmetkaydet=$db->prepare("INSERT INTO tmp_me_services SET
		servic_name=:servic_name,
		servic_type=:servic_type,
		servic_satatus=:servic_satatus	
		");
	$insert=$hizmetkaydet->execute(array(
		'servic_name' => $_POST['servic_name'],
		'servic_type' => $_POST['servic_type'],
		'servic_satatus' => $_POST['servic_satatus']
		));

	if ($insert) {
		Header("Location:../production/hizmetler.php?durum=ok");
	} else {
		Header("Location:../production/hizmetler.php?durum=no");
	}

}
 //Hizmet Düzenleme
   
if (isset($_POST['hizmetduzenle'])) {

	$tms_id=$_POST['tms_id'];

	$kaydet=$db->prepare("UPDATE tmp_me_services SET

        servic_name=:servic_name,
		servic_type=:servic_type,
		servic_satatus=:servic_satatus	
		WHERE tms_id={$_POST['tms_id']}");
	$update=$kaydet->execute(array(
		'servic_name' => $_POST['servic_name'],
		'servic_type' => $_POST['servic_type'],
		'servic_satatus' => $_POST['servic_satatus']
				
	));

	if ($update) {

		Header("Location:../production/hizmet-duzenle.php?tms_id=$tms_id&durum=ok");

	} else {

		Header("Location:../production/hizmet-duzenle.php?tms_id=$tms_id&durum=no");
	}
	
}

//Hizmet Silme İşlemleri
  
if ($_GET['hizmetsil']=="ok") {

	$sil=$db->prepare("DELETE from tmp_me_services where tms_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['tms_id']
	));
	if ($kontrol) {
		header("location:../production/hizmetler.php?sil=ok");

	} else {

		header("location:../production/hizmetler.php?sil=no");

	}


}
// Kurum Ekle
if (isset($_POST['kurumekle'])) {

	$hizmetkaydet=$db->prepare("INSERT INTO tmp_me_organisation SET
		org_name=:org_name,
		org_satatus=:org_satatus
		
		");
	$insert=$hizmetkaydet->execute(array(
		'org_name' => $_POST['org_name'],
		'org_satatus' => $_POST['org_satatus']
		));

	if ($insert) {
		Header("Location:../production/kurumlar.php?durum=ok");
	} else {
		Header("Location:../production/kurum-ekle.php?durum=no");
	}

}


// Kurum Düzenleme İşlemi
if (isset($_POST['kurumduzenle'])) {

	$tmo_id=$_POST['tmo_id'];

	$kaydet=$db->prepare("UPDATE tmp_me_organisation SET

        org_name=:org_name,
		org_satatus=:org_satatus
		WHERE tmo_id={$_POST['tmo_id']}");
	$update=$kaydet->execute(array(
		'org_name' => $_POST['org_name'],
		'org_satatus' => $_POST['org_satatus']
	
				
	));

	if ($update) {

		Header("Location:../production/kurumlar.php?tms_id=$tmo_id&durum=ok");

	} else {

		Header("Location:../production/kurum-duzenle.php?tms_id=$tmo_id&durum=no");
	}
	
}
// Kurum Silme İşlemi
if ($_GET['kurumsil']=="ok") {

	$sil=$db->prepare("DELETE from tmp_me_organisation where tmo_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['tmo_id']
	));
	if ($kontrol) {
		header("location:../production/kurumlar.php?sil=ok");

	} else {

		header("location:../production/kurumlar.php?sil=no");

	}


}
// Bölüm Ekleme İşlemi

if (isset($_POST['bolumekle'])) {

	$hizmetkaydet=$db->prepare("INSERT INTO tmp_me_dept SET
		dept_type=:dept_type,
		dept_name=:dept_name,
		dept_status=:dept_status
		
		");
	$insert=$hizmetkaydet->execute(array(
		'dept_type' => $_POST['dept_type'],
		'dept_name' => $_POST['dept_name'],
		'dept_status' => $_POST['dept_status']
		));

	if ($insert) {
		Header("Location:../production/bolumler.php?durum=ok");
	} else {
		Header("Location:../production/bolum-ekle.php?durum=no");
	}

}

//Bölüm Düzenleme İşlemi

if (isset($_POST['bolumduzenle'])) {

	$tmd_id=$_POST['tmd_id'];

	$kaydet=$db->prepare("UPDATE tmp_me_dept SET
        dept_type=:dept_type,
		dept_name=:dept_name,
		dept_status=:dept_status
		WHERE tmd_id={$_POST['tmd_id']}");
	$update=$kaydet->execute(array(
		'dept_type'=>$_POST['dept_type'],
		'dept_name' => $_POST['dept_name'],
		'dept_status' => $_POST['dept_status']				
	));

	if ($update) {

		Header("Location:../production/bolumler.php?tmd_id=$tmd_id&durum=ok");

	} else {

		Header("Location:../production/bolum-duzenle.php?tmd_id=$tmd_id&durum=no");
	}
	
}

// Bölüm Sime İşlemi  
if ($_GET['bolumsil']=="ok") {

	$sil=$db->prepare("DELETE from tmp_me_dept where tmd_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['tmd_id']
	));
	if ($kontrol) {
		header("location:../production/bolumler.php?sil=ok");
	} else {

		header("location:../production/bolumler.php?sil=no");
	}
}

//Doktor Ekleme İşlemi
  
if (isset($_POST['DoktorEkle'])) {

	$kaydet=$db->prepare("INSERT INTO tmp_me_doctors SET
		tmu_id=:tmu_id,
		dr_name=:dr_name,
		dr_surname=:dr_surname,
		dr_identity=:dr_identity,
		dr_iphone=:dr_iphone,
		dr_mail=:dr_mail,
		dr_birth=:dr_birth,
		dr_status=:dr_status
			
		");
	$insert=$kaydet->execute(array(
		'tmu_id' => $_POST['tmu_id'],
		'dr_name' => $_POST['dr_name'],
		'dr_surname' => $_POST['dr_surname'],
		'dr_identity' => $_POST['dr_identity'],
		'dr_iphone' => $_POST['dr_iphone'],
		'dr_mail' => $_POST['dr_mail'],
		'dr_birth' => $_POST['dr_birth'],
		'dr_status' => $_POST['dr_status']



	));

	if ($insert) {

		Header("Location:../production/doktorlar.php?durum=ok");

	} else {

		Header("Location:../production/doktor-ekle.php?durum=no");
	}

}

//Dokto Düzenleme

if (isset($_POST['doktorduzenle'])) {

	$tmdr_id=$_POST['tmdr_id'];
	$kaydet=$db->prepare("UPDATE tmp_me_doctors SET
	    tmu_id=:tmu_id,
		dr_name=:dr_name,
		dr_surname=:dr_surname,
		dr_identity=:dr_identity,
		dr_iphone=:dr_iphone,
		dr_mail=:dr_mail,
		dr_birth=:dr_birth,
		dr_status=:dr_status

		WHERE tmdr_id={$_POST['tmdr_id']}");
	$update=$kaydet->execute(array(
		'tmu_id' => $_POST['tmu_id'],
		'dr_name' => $_POST['dr_name'],
		'dr_surname' => $_POST['dr_surname'],
		'dr_identity' => $_POST['dr_identity'],
		'dr_iphone' => $_POST['dr_iphone'],
		'dr_mail' => $_POST['dr_mail'],
		'dr_birth' => $_POST['dr_birth'],
	    'dr_status' => $_POST['dr_status']

	));

	if ($update) {

		Header("Location:../production/doktorlar.php?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../production/doktor-duzenle.php?durum=no&urun_id=$urun_id");
	}

}
// Dokto Silme İşlemi

if ($_GET['doktorsil']=="ok") {
	
	$sil=$db->prepare("DELETE from tmp_me_doctors where tmdr_id=:tmdr_id");
	$kontrol=$sil->execute(array(
		'tmdr_id' => $_GET['tmdr_id']
	));

	if ($kontrol) {

		Header("Location:../production/doktorlar.php?durum=ok");

	} else {

		Header("Location:../production/doktorlar.php?durum=no");
	}

}


//Hizmet Fiyatları İşlemleri

if (isset($_POST['HizmetFiyatekle'])) {

	$kaydet=$db->prepare("INSERT INTO tmp_me_servic_price SET
		tms_id=:tms_id,
		tmo_id=:tmo_id,
		price=:price
	");
	$insert=$kaydet->execute(array(
		'tms_id' => $_POST['tms_id'],
		'tmo_id' => $_POST['tmo_id'],
		'price' => $_POST['price']
	
	));

	if ($insert) {

		Header("Location:../production/HizmetFiyatları.php?durum=ok");

	} else {

		Header("Location:../production/hizmetFiyat-ekle.php?durum=no");
	}

}

//Hizmet Fiyatı Düzenleme İşlemleri



if (isset($_POST['HizmetFiyatDuzenle'])) {

	$tmps_id=$_POST['tmps_id'];
	$kaydet=$db->prepare("UPDATE tmp_me_servic_price SET
	    tms_id=:tms_id,
		tmo_id=:tmo_id,
		price=:price,
		ctime=:ctime
		WHERE tmps_id={$_POST['tmps_id']}");
	$update=$kaydet->execute(array(
		'tms_id' => $_POST['tms_id'],
		'tmo_id' => $_POST['tmo_id'],
		'price' => $_POST['price'],
		'ctime' => $_POST['ctime']

	));

	if ($update) {

		Header("Location:../production/hizmetFiyatları.php?durum=ok&tmps_id=$tmps_id");

	} else {

		Header("Location:../production/HizmetFiyat-duzenle.php?durum=no&tmps_id=$tmps_id");
	}

}



//Hizmet Fiyatı Sİlme 
if ($_GET['HizmetFiyatSil']=="ok") {
	islemkontrol();
	$sil=$db->prepare("DELETE from tmp_me_servic_price where tmps_id=:tmps_id");
	$kontrol=$sil->execute(array(
		'tmps_id' => $_GET['tmps_id']
		
	));

	if ($kontrol) {

		Header("Location:../production/hizmetFiyatları.php?durum=ok");

	} else {

		Header("Location:../production/hizmetFiyatları.php?durum=no");
	}

}


//Bölüm doktoru Ekle

if (isset($_POST['BolumDoktorEkle'])) {

	$kaydet=$db->prepare("INSERT INTO tmp_me_dep_doc SET
		tmd_id=:tmd_id,
		tmu_id=:tmu_id
	
	");
	$insert=$kaydet->execute(array(
		'tmd_id' => $_POST['tmd_id'],
		'tmu_id' => $_POST['tmu_id']
		
	
	));

	if ($insert) {

		Header("Location:../production/BolumDoktorları.php?durum=ok");

	} else {

		Header("Location:../production/BolumDoktorEkle.php?durum=no");
	}

}
//Bölüm Doktoru Düzenle
if (isset($_POST['BolumDoktorDuzenle'])) {

	$tmdd_id=$_POST['tmdd_id'];
	$kaydet=$db->prepare("UPDATE tmp_me_dep_doc SET
	    tmd_id=:tmd_id,
		tmu_id=:tmu_id
		WHERE tmdd_id={$_POST['tmdd_id']}");
	$update=$kaydet->execute(array(
		'tmd_id' => $_POST['tmd_id'],
		'tmu_id' => $_POST['tmu_id'],
	

	));

	if ($update) {

		Header("Location:../production/BolumDoktorları.php?durum=ok&tmdd_id=$tmdd_id");

	} else {

		Header("Location:../production/BolumDoktorDuzenle.php?durum=no&tmdd_id=$tmdd_id");
	}

}
// Bölüm Doktoru Silme İşlemi

if ($_GET['BolumDoktorSil']=="ok") {
	islemkontrol();
	$sil=$db->prepare("DELETE from tmp_me_dep_doc where tmdd_id=:tmdd_id");
	$kontrol=$sil->execute(array(
		'tmdd_id' => $_GET['tmdd_id']
		
	));

	if ($kontrol) {

		Header("Location:../production/BolumDoktorları.php?durum=ok");

	} else {

		Header("Location:../production/BolumDoktorları.php?durum=no");
	}

}

//Yeni Hasta Ekleme 

if (isset($_POST['HastaEkle'])) {

	$kaydet=$db->prepare("INSERT INTO tmp_me_patient SET
		tmo_id=:tmo_id,
		pat_name=:pat_name,
		pat_surname=:pat_surname,
		pat_identity=:pat_identity,
		pat_passport=:pat_passport,
		pat_birthday=:pat_birthday,
		pat_gender=:pat_gender
			
		");
	$insert=$kaydet->execute(array(
		'tmo_id' => $_POST['tmo_id'],
		'pat_name' => $_POST['pat_name'],
		'pat_surname' => $_POST['pat_surname'],
		'pat_identity' => $_POST['pat_identity'],
		'pat_passport' => $_POST['pat_passport'],
		'pat_birthday' => $_POST['pat_birthday'],
		'pat_gender' => $_POST['pat_gender']
	
	));

	if ($insert) {

		Header("Location:../production/Hastalar.php?durum=ok");

	} else {

		Header("Location:../production/hasta-ekle.php?durum=no");
	}

}

//Hasta Düzenleme Formu

if (isset($_POST['HastaDuzenle'])) {

	$tmp_id=$_POST['tmp_id'];
	$kaydet=$db->prepare("UPDATE tmp_me_patient SET
	    tmo_id=:tmo_id,
		pat_name=:pat_name,
		pat_surname=:pat_surname,
		pat_identity=:pat_identity,
		pat_passport=:pat_passport,
		pat_birthday=:pat_birthday,
		pat_gender=:pat_gender
		WHERE tmp_id={$_POST['tmp_id']}");
	$update=$kaydet->execute(array(
		'tmo_id' => $_POST['tmo_id'],
		'pat_name' => $_POST['pat_name'],
		'pat_surname' => $_POST['pat_surname'],
		'pat_identity' => $_POST['pat_identity'],
		'pat_passport' => $_POST['pat_passport'],
		'pat_birthday' => $_POST['pat_birthday'],
		'pat_gender' => $_POST['pat_gender']
	

	));

	if ($update) {

		Header("Location:../production/Hastalar.php?durum=ok&tmp_id=$tmp_id");

	} else {

		Header("Location:../production/hasta-duzenle.php?durum=no&tmp_id=$tmp_id");
	}

}

//Hasta Silme İşlemi
if ($_GET['Hastasil']=="ok") {
	islemkontrol();
	$sil=$db->prepare("DELETE from tmp_me_patient where tmp_id=:tmp_id");
	$kontrol=$sil->execute(array(
		'tmp_id' => $_GET['tmp_id']
		
	));

	if ($kontrol) {

		Header("Location:../production/Hastalar.php?durum=ok");

	} else {

		Header("Location:../production/Hastalar.php?durum=no");
	}

}


//Hasta Geliş Kayıt Açma

if (isset($_POST['HastaGelisKayitAcmaKaydet'])) {

	$kaydet=$db->prepare("INSERT INTO tmp_me_patient_register SET
	   
		tmp_id=:tmp_id,
		tmo_id=:tmo_id,
		tmu_id=:tmu_id,
		tmd_id=:tmd_id
		
		");
	$insert=$kaydet->execute(array(	
		
		'tmp_id' => $_POST['tmp_id'],
		'tmo_id' => $_POST['tmo_id'],
		'tmu_id' => $_POST['tmu_id'],
		'tmd_id' => $_POST['tmd_id']
	
			
	));

	if ($insert) {

		Header("Location:../production/HastaGelisListesi.php?durum=ok");

	} else {

		Header("Location:../production/HastaGelisKayıtAcma.php?durum=no");
	}

}

//Hasta Geliş  Kaydına Hizmet Ekleme
 
if (isset($_POST['HastaGelisHizmetEkleme'])) {

	$kaydet=$db->prepare("INSERT INTO tmp_me_patient_reggister_servic SET   
		tmp_id=:tmp_id,
	    tmpr_id=:tmpr_id,
		tms_id=:tms_id				
		");
	
       $insert=$kaydet->execute(array(			
		'tmp_id' => $_POST['tmp_id'],
		'tmpr_id' => $_POST['tmpr_id'],
		'tms_id' => $_POST['tms_id']
	));

	if ($insert) {
		Header("Location:../production/HastaGelisListesi.php?durum=ok");
	} else {
	
  
	//Header("Location:../production/HastaGelisKayıtAcma.php?durum=no");
	}

}

?>