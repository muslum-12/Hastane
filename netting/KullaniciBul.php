<?php 

include 'baglan.php';
include '../production/fonksiyon.php';
$sonuc=array();

    $kullaniciara=$_POST['kullaniciara'];
    $kullanicisor=$db->prepare("SELECT * FROM tmp_me_users WHERE tmu_mail LIKE '%$kullaniciara%'");
	 $kullanicisor->execute();
     while ($row = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {
         $adi=$row['name'];
         $soyadi=$row['surname'];
         if ($row['tmu_type']==0) {
            $type='<button class="btn btn-success btn-xs">Doktor</button>';
         }
         elseif ($row['tmu_type']==1) { 
            $type='<button class="btn btn-danger btn-xs">Vezne </button>';
         }
            elseif ($row['tmu_type']==2) { 
                $type='<button class="btn btn-warning btn-xs"> Yönetici</button>';
            }   
         $deger[]='
         
         <tr>
         <td>'.$row["ctime"].'</td>
         <td>'.$row["name"].' </td>
         <td>'.$row["surname"].' </td>
         <td>'.$row["tmu_mail"].' </td>
         <td>'.$row["tmu_name"].' </td>
         <td>'.$row["password"].'</td>
         <td><center>
            '.$type.'
           </center></td>
         <td><center><a href="kullanici-duzenle.php?tmu_id='.$row['tmu_id'].'"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
         <td><center><a href="../netting/kullanici.php?tmu_id='.$row['tmu_id'].'&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
       
       </tr>';

      
     }


     $sonuc['deger']=$deger;
     echo json_encode($sonuc);
?>