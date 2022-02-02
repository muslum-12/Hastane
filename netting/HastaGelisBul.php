<?php 

include 'baglan.php';
include '../production/fonksiyon.php';
$sonuc=array();

    $HastaGelisAra=$_POST['HastaGelisAra'];
     $hastasor=$db->prepare("SELECT * FROM tmp_me_patient WHERE pat_identity LIKE '%$HastaGelisAra%'");
	 $hastasor->execute();
     while ($row = $hastasor->fetch(PDO::FETCH_ASSOC)) {
         $adi=$row['pat_name'];
         $soyadi=$row['pat_surname'];
         $dogumtarih=$row['pat_birthday'];
         $tmo_id=$row['tmo_id'];

         if ($row['pat_gender']==0) {
          $type='<button class="btn btn-success btn-xs">Erkek</button>';
       }
       else{ 
          $type='<button class="btn btn-danger btn-xs">Kadın </button>';
       }
          

         $hastasor2=$db->prepare("SELECT * FROM tmp_me_organisation WHERE tmo_id='$tmo_id'");
         $hastasor2->execute();
           while ($row2 = $hastasor2->fetch(PDO::FETCH_ASSOC)) {
              $kurum=$row2['org_name'];
           }
           
      

         
        
         $deger[]='
         
         <tr>
      
         <td>'.$row["ctime"].'</td>
         <td>'.$kurum.' </td>
         <td>'.$row["pat_name"].' '.$row["pat_surname"].' </td>
         <td>'.$row["pat_identity"].' </td>
         <td>'.$row["pat_passport"].' </td>
         <td>'.$row["pat_birthday"].'</td>
         <td><center>
         '.$type.'
        </center></td>
     
        
         <td><center><a href="HastaGelisListesi-Detay.php?tmp_id='.$row['tmp_id'].'"><button  class="btn btn-warning btn-xs">Detay</button></a></center>
        </td>

       </tr>';

      
     }


     $sonuc['deger']=$deger;
     echo json_encode($sonuc);
?>