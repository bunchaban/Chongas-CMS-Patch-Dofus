<?php
$RECALL = $_GET["codes"];

  if( trim($RECALL) == "" OR $_GET['trxid'] == $_SESSION['alloLastCode'] )
  {
    // La variable RECALL est vide, renvoi de l'internaute

    // vers une page d'erreur
    header( "Location: ./pages/erreur.html" );
    exit(1);
  }
  // $RECALL contient le code d'accès
  $RECALL = urlencode( $RECALL );

  // $AUTH doit contenir l'identifiant de VOTRE document

  $AUTH = urlencode( "".$alloIdentifiant."" );
  /**
   * enviar a solicita��o para o servidor Allopass
   * dans la variable $r[0] on aura la réponse du serveur
   * dans la variable $r[1] on aura le code du pays d'appel de l'internaute
   * (FR,BE,UK,DE,CH,CA,LU,IT,ES,AT,...)
   * Dans le cas du multicode, on aura également $r[2],$r[3] etc...
   * contenant à chaque fois le résultat et le code pays.
   */
  $r = @file( "http://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=$AUTH" );

  // on teste la réponse du serveur

  if( substr( $r[0],0,2 ) != "OK" ) 
  {
    // Le serveur a répondu ERR ou NOK : l'accès est donc refusé

    header( "Location: ./pages/erreur.html" );
    exit(1);
  }
  $pointActuel = getinfo($_SESSION['login'],"point");
  mysql_query("UPDATE accounts SET point=".($pointActuel+$alloPoint)." WHERE account='".$_SESSION['login']."'");
  $_SESSION['alloLastCode'] = $_GET['trxid'];	//Le numéro de transaction est stocker dans une variable session pour éviter le bug du refresh de la page qui fait que l'on peut réutiliser le code un certain laps de temps


?>