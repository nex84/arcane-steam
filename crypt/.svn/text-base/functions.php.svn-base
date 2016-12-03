<?php

// -----------------------------------------------
// Cryptographp v1.3
// (c) 2006 Sylvain BRISON 
//
// www.cryptographp.com 
// cryptographp@alphpa.com 
//
// Licence CeCILL (Voir Licence_CeCILL_V2-fr.txt)
// -----------------------------------------------

 if(session_id() == "") @session_start();
 
 //$_SESSION['cryptdir'] =  str_replace ($_SERVER['DOCUMENT_ROOT'],'',str_replace('\\','/',dirname(__FILE__)))."/";
$_SESSION['cryptdir'] =  "https://arcane-steam.com/crypt/";
 //$_SESSION['cryptdir'] =  "http://kerosene.kicks-ass.org/dev/trunk/crypt/";
 
 function dsp_crypt($cfg=0,$reload=1) {
 // Affiche le cryptogramme
 echo "<table bgcolor='#FFFFFF'><tr><td><img id='cryptogram' img src='".$_SESSION['cryptdir']."cryptographp.php?cfg=".$cfg."&".SID."'></td>";
 if ($reload) echo "<td><a title='".($reload==1?'':$reload)."' style=\"cursor:pointer\" onclick=\"javascript:document.images.cryptogram.src='".$_SESSION['cryptdir']."cryptographp.php?cfg=".$cfg."&".SID."&'+Math.round(Math.random(0)*1000)+1\"><img src=\"".$_SESSION['cryptdir']."images/reload.png\"></a></td>";
 echo "</tr></table>";
 }


 function chk_crypt($code) {
 // Vérifie si le code est correct
 include ($_SESSION['configfile']);
 $code = addslashes ($code);
 $code = ($difuplow?$code:strtoupper($code));
 switch (strtoupper($cryptsecure)) {    
        case "MD5"  : $code = md5($code); break;
        case "SHA1" : $code = sha1($code); break;
        }
 if ($_SESSION['cryptcode'] and ($_SESSION['cryptcode'] == $code))
    {
    unset($_SESSION['cryptreload']);
    return true;
    }
    else {
         $_SESSION['cryptreload']= true;
         return false;
         }
 }

?>
