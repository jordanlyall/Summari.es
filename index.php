<?php ini_set('display_errors', 0);

$fallbackURL = ""; // insert url to default to when file is accessed directly
$TopicMarksAPIEmail = ""; // insert topicmarks api email address
$TopicMarksAPIPass = ""; // insert topicmarks api passwork
$bitlyUserName = ""; // insert bitly api user name
$bitlyAPIKey = ""; // insert bitly api key



$p = $_GET["p"];

if (empty($p)) {

include $fallbackURL;

} else { 
    

$url = 'https://' . $TopicMarksAPIEmail . ':' . $TopicMarksAPIPass . '@topicmarks.com/rest/textAnalyze?url=' . $p . '&maxKeywords=0&maxSummary=3';
$xml =simplexml_load_file($url); 


$longurl = 'http://summari.es/?p=' . $p;
$bitly = file_get_contents ('http://api.bit.ly/v3/shorten?login=' . $bitlyUserName . '&apiKey=' . $bitlyAPIKey . '&longUrl=' . $longurl . '&format=txt');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head> 
    <title>[Summari.es] <?=$xml->name;?></title> 
    <meta name="Description" content=""> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" type="text/css" href="style.css"/> 
    <link href="images/favicon.ico" rel="shortcut icon"/> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script> 
    <script type="text/javascript"> 
    
      //function to fix height of iframe!
      var calcHeight = function() {
        var headerDimensions = $('#header-bar').height();
        $('#preview-frame').height($(window).height() - headerDimensions);
      }
      
      $(document).ready(function() {
        calcHeight();
        $('#header-bar a.close').mouseover(function() {
          $('#header-bar a.close').addClass('activated');
        }).mouseout(function() {
          $('#header-bar a.close').removeClass('activated');
        });
      });
      
      $(window).resize(function() {
        calcHeight();
      }).load(function() {
        calcHeight();
      });
    </script> 
    <!-- END JAVASCRIPT --> 
  </head> 
  <body> 
   <div id="header-bar"> 
  

 <p class="summary" > 



<span style="float:left;"><a href="http://summari.es"><strong>Summari.es</strong></a> | <?=$xml->name;?></span></span>

<span style="float:right;"><a href="<?=$p;?>">close</a> </span>

<span style="float:right; padding-right:10px; margin-top:-2px">
<iframe src="http://www.facebook.com/plugins/like.php?href=http://summari.es/?p=<?=$p;?>&amp;layout=button_count&amp;show_faces=false&amp;width=85&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:85px; height:21px;" allowTransparency="true"></iframe>
</span>

<span style="float:right; padding-right:10px; margin-top:-2px">
<a href="http://twitter.com/share" class="twitter-share-button" data-count="none"  data-via="Summari_es" data-related="JordanLyall:The creator of Summari.es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</span>


<span style="float:right; padding-right:10px;">share: <a href="<?=$bitly;?>"><?=$bitly;?> </a> </span>

<textarea  style="width:99%;" readonly="true" rows="3"><? foreach ($xml->sentences->sentence as $sentence) {
echo $sentence->text;
echo '&nbsp;';
}
?></textarea>
	

	

	 </p>	 
     
        
     
   
   </div> 
   <iframe id="preview-frame" src="<?=$p;?>" name="preview-frame" frameborder="0" noresize="noresize"> 
   </iframe> 
   
 
 
  </body> 
</html> 


<?
} 
?>
