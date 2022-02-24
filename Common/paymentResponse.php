<?php
//This file retrieves the payment response and displays it

//Ce fichier récupère la réponse de paiement et l'affiche

session_start();

// $_SESSION['merchantId'] and $_SESSION['secretKey'] must be known in this PHP.
// In this example, we initialize this from parameters.php
// You can change these values in parameters.php according to your needs.

// $_SESSION['merchantId'] et $_SESSION['secretKey'] doivent être connus dans ce PHP.
// Dans cet exemple, nous initialisons ceci à partir de parameters.php
// Vous pouvez modifier ces valeurs dans parameters.php selon vos besoins.

include('../parameters.php');

include('sealCalculationPaypageJson.php');

//RECOVERY OF MANUAL RESPONSE - RÉCUPÉRATION DE LA RÉPONSE MANUELLE

if(isset($_POST['Data'])){
   $data = $_POST['Data'];
}
if(isset($_POST['Encode'])){
   $encode = $_POST['Encode'];
}
if(isset($_POST['Seal'])){
   $seal = $_POST['Seal'];
}
if(isset($_POST['InterfaceVersion'])){
   $interfaceVersion = $_POST['InterfaceVersion'];
}

//RECALCULATION OF SEAL - RECALCUL DU SCEAU

$computedResponseSeal = compute_payment_response_seal($_SESSION['sealAlgorithm'], $data, $_SESSION['secretKey']);


//RESPONSE DECODING - DÉCODAGE DE LA RÉPONSE

if(strcmp($computedResponseSeal, $seal) == 0){
   if(strcmp($encode, "base64") == 0){
      $dataDecode = base64_decode($data);
      $responseData = extract_data_from_the_payment_response($dataDecode);
   }else{
      $responseData = extract_data_from_the_payment_response($data);
   }
   //Display of the data extracted from the payment reply

   //Affichage des données extraites de la réponse de paiement
   echo '<style>
   table{
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 75%;
   }
   td, th{
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
   }
   tr:nth-child(even){
      background-color: #dddddd;
   }
   </style>
   <table>
   <tr>
      <th><h3>Field Name</h3></th>
      <th><h3>Value</h3></th>
   </tr>';
   foreach($responseData as $key => $value){
      echo '<tr>
      <td>'.$key.'</td>
      <td>'.$value.'</td>
      </tr>';
   }
   echo '</table>';
}else{
   echo "Error : Seals are not equal";
}

function extract_data_from_the_payment_response($data)
{
   $singleDimArray = explode("|", $data);
   
   foreach($singleDimArray as $value)
   {
      $fieldTable = explode("=", $value);
      $key = $fieldTable[0];
      $value = $fieldTable[1];
      $responseData[$key] = $value;
      unset($fieldTable);
   }
   return $responseData;
}

?>
