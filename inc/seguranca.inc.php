<?
$block_list = array("&","%","'","--",";","\""); 
foreach($_POST as $valor) {     foreach($block_list as $bloc_list_2) {
                if(substr_count(strtolower($valor), strtolower($bloc_list_2)) > 0) {
                  die ("<script>alert('Alguns caracteres inválidos foram detectados!');
                  history.go(-1);</script>");
                }
        }
        }
foreach($_GET as $valor) {      foreach($block_list as $bloc_list_2) {
                if(substr_count(strtolower($valor), strtolower($bloc_list_2)) > 0) {
                  die ("<script>alert('Alguns caracteres inválidos foram detectados!');
                  history.go(-1);</script>");
                }
        }
}
foreach($_COOKIE as $valor) {   foreach($block_list as $bloc_list_2) {
                if(substr_count(strtolower($valor), strtolower($bloc_list_2)) > 0) {
                  die ("<script>alert('Alguns caracteres inválidos foram detectados!');
                  history.go(-1);</script>");
                }
        }
        }
?>