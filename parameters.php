<?php
/*
This file includes customized information shared accross PHP files
For more information on simulation environment and simulation merchant and keys, please refer to:
    https://documentation.mercanet.bnpparibas.net/index.php?title=Boutique_de_test

Ce fichier comprend des informations personnalisées partagées entre les fichiers PHP
Pour plus d'informations sur l'environnement de simulation et le marchand de simulation et les clés, veuillez vous référer à :
    https://documentation.mercanet.bnpparibas.net/index.php?title=Boutique_de_test
*/

//You can change the values in session according to your needs and architecture - Vous pouvez modifier les valeurs en session en fonction de vos besoins et de votre architecture
$_SESSION['merchantId'] = "002001000000001";
$_SESSION['secretKey'] = "002001000000001_KEY1";
$_SESSION['sealAlgorithm'] = "HMAC-SHA-256";

// following lines refer to your own servers
$_SESSION['normalReturnUrl'] = "http://localhost/mercanet-paypage-json-php/Common/paymentResponse.php";
$_SESSION["automaticResponseUrl"] = "http://localhost/mercanet-paypage-json-php/Common/automPaymentResponse.php";

// following line is the Mercanet server adress. The simulation is for test purpose only. - la ligne suivante est l'adresse du serveur Mercanet. La simulation est uniquement à des fins de test.
// you will use production url once you are ready to go live with your migration project. - vous utiliserez l'URL de production une fois que vous serez prêt à lancer votre projet de migration.
$_SESSION["urlForPaymentInitialisation"] = "https://payment-webinit.simu.mercanet.bnpparibas.net/rs-services/v2/paymentInit/";

?>
