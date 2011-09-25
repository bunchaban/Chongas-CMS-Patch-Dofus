<?php 
require_once('config.inc.php');
echo '<?xml version="1.1" encoding="utf-8"?>' ?>
<rss version="2.0">
    <channel>
        <title><?php echo $wTITRE; ?></title>
        <link></link>
        <description></description>
<?php
mysql_query("SET NAMES UTF8"); 
    $sql="SELECT * FROM live_news ORDER BY id DESC LIMIT 0, 6";
    $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br />'.mysql_error());
    while($data=mysql_fetch_assoc($req)){
        echo "<item>\n";
        echo "<guid>".$data["id"]."</guid>";
        echo "<title>".$data["titre"]."</title>\n";
        echo "<link>".$link."index.php?com=".$data["id"]."</link>\n";
        echo "<icon>".$data["icon"]."</icon>\n";
        echo "<pubDate>".date("D, d M Y H:i:s",strtotime($data["date"]))." +0200</pubDate>\n";
        echo "</item>\n";
    }
?>
    </channel>
</rss> 