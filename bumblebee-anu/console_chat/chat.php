<?php
/*
 * Allow remote domain support
 */
header('Access-Control-Allow-Origin: *'); // 
/*
 * Options
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 'on');
$options = array('oneChatOfSite' => 1, // One chat on site or unique chat on all page
                 'history'       => 3, //20 messages in autoload history
                 'adminPassword'  => 'chocolate'
                );


/*
 * If you need get auth from your site, replace $_POST['username'] username from your script and disallow name changing in script.js (this.alloChangeName = 1; line 18)
 */





if ($options['oneChatOfSite']) {
    $data = unserialize(@file_get_contents('history/all'));
} else {
    $data = unserialize(@file_get_contents('history/' . md5($_POST['url'])));
}
if (!$data) {
    $data= array();
}
$now = str_replace('.', '', microtime(1));
if (strlen($now) < 14) {
    $len = 14-strlen($now);
    for ($a=0;$a<$len;$a++) {
        $now.=0;
    }
}
if (isset($_GET['full'])) { // first resive history
    $_COOKIE['chat_last_resive'] = 0;
}
$isAdmin = isAdmin();
if (isset($_POST['msg']) && trim($_POST['msg']) && $_POST['username']) { // Add message
    addMessage($now,$options,$data,(isset($_POST['type'])?$_POST['type']:''));
} elseif (isset($_POST['admin']) && $_POST['admin']) { // Loginin as admin
    adminLogin($options,$now,$data);
} elseif (isset($_POST['admin-command'])) {
    if (!$isAdmin) {
        die('<p>You are not admin</p>');
    }
    switch ($_POST['admin-command']) {
        case 'banName':{ 
            if($_POST['name'] == 'Guest') {
                die('<p>' . $_POST['name'] . ' can\'t be banned<p>');
            }
            $exists = findInFile('cache/ban.name.data', $_POST['name']); 
            if (!$exists) {
                $f=fopen('cache/ban.name.data','a+');
                fputs($f,$_POST['name'] . "\r\n");
                fclose($f);
            }
            die('<p>' . $_POST['name'] . ' banned<p>');
        }
        case 'banIp': { 
            $exists = findInFile('cache/ban.ip.data', $_POST['ip']); 
            if (!$exists) {
                $f=fopen('cache/ban.ip.data','a+');
                fputs($f,$_POST['ip'] . "\r\n");
                fclose($f);
            }
            die('<p>' . $_POST['ip'] . ' banned<p>');
        }case 'unban': { 
            deleteInFile('cache/ban.ip.data', $_POST['name']); 
            deleteInFile('cache/ban.name.data', $_POST['name']); 
            die('<p>' . $_POST['ip'] . ' unbanned<p>');
        }case 'unbanall': { 
            @unlink('cache/ban.ip.data'); 
            @unlink('cache/ban.name.data'); 
            die('<p>All unbanned<p>');
        } case 'bannedips': {
            $ar = explode("\r",  @file_get_contents('cache/ban.ip.data'));
            foreach ($ar as $el) {
                print '<p>' . $el . '</p>';
            }
            die;
        } case 'bannednames': {
            $ar = explode("\r",  @file_get_contents('cache/ban.name.data')); 
            foreach ($ar as $el) {
                print '<p>' . $el . '</p>';
            }
            die;
        }
    }
}
$html = '';  

for ($a=0,$count=count($data);$count>$a;$count--) {
    if (isset($_COOKIE['chat_last_resive']) && $_COOKIE['chat_last_resive'] >= $data[$count-1]['mtime']) {
        continue;
    }
    if (isset($data[$count-1]['type']) && $data[$count-1]['type'] == 'private') {
        if ($_POST['username'] != $data[$count-1]['username'] && $_POST['username'] != $data[$count-1]['to_username']) {
            continue;
        }
        $html .= "<p>[" . date('H:i',$data[$count-1]['time']) . "]<strong>" . $data[$count-1]['username'] . ":</strong> " . $data[$count-1]['msg'] . "</p>";
    } elseif (isset($data[$count-1]['is_admin']) && $data[$count-1]['is_admin'] == 1) {
        $html .= "<p>[" . date('H:i',$data[$count-1]['time']) . "]<strong>" . $data[$count-1]['username'] . ":</strong> <b class='admin'>" . $data[$count-1]['msg'] . "</b></p>";
    } else {
        if ($isAdmin) {
            $html .= "<p id='" . $data[$count-1]['mtime'] . "'>[" . date('H:i',$data[$count-1]['time']) . "]<strong class='admin' data-user='" . json_encode($data[$count-1]) . "'>" . $data[$count-1]['username'] . ":</strong> " . $data[$count-1]['msg'] . "</p>";
        } else {
            $html .= "<p>[" . date('H:i',$data[$count-1]['time']) . "]<strong>" . $data[$count-1]['username'] . ":</strong> " . $data[$count-1]['msg'] . "</p>";
        }
    }
}

setcookie('chat_last_resive', $now);
print $html; 
function adminLogin($options,$now,$data)
{
    if ($options['adminPassword'] == $_POST['admin']) {
        $hash = md5(rand(0,100000000));
        setcookie('admin', $hash);
        getAdmins();
        $adms[] = $hash;
        file_put_contents('cache/adm.data', serialize($adms));
        die('<p>You now admin</p>');
    } else { 
        print "<p>Invalid password</p>";
        die;
    }
}
function getAdmins()
{
    $adms = unserialize(@file_get_contents('cache/adm.data')); 
    if (!$adms) {
        $adms = array();
    }
    return $adms;
}
function isAdmin()
{
    if (isset($_COOKIE['admin'])) { // check admin
        $adms = getAdmins();
        foreach ($adms as $adm) {
            if ($_COOKIE['admin'] == $adm) {
                return true;
            }
        }
    }
}
function addMessage($now,$options,&$data,$type = '')
{
    if (!isset($_SERVER['HTTP_X_REAL_IP'])) {
        $_SERVER['HTTP_X_REAL_IP'] = @$_SERVER['REMOTE_ADDR'];
    } 
    $_POST['msg'] = str_replace('\\\'','\'',$_POST['msg']);
    if($type == 'private') {
        $ar = explode(' ',$_POST['msg']);
        $username = $ar[1]; 
        $last = array('mtime' => $now,'time' => time(),'type' => 'private','to_username' => $username, 'username' => strip_tags(mb_substr($_POST['username'],0,30)),'msg' => '<b class="private">' . strip_tags(mb_substr(implode(' ',$ar),0,300)) . '</b>','ip' => $_SERVER['HTTP_X_REAL_IP']);
    } else {
        if (isAdmin()) {
            $last = array('mtime' => $now,'time' => time(), 'username' => strip_tags(mb_substr($_POST['username'],0,30)),'msg' => mb_substr($_POST['msg'],0,300),'ip' => $_SERVER['HTTP_X_REAL_IP']);
        } else {
            $last = array('mtime' => $now,'time' => time(), 'username' => strip_tags(mb_substr($_POST['username'],0,30)),'msg' => strip_tags(mb_substr($_POST['msg'],0,300)),'ip' => $_SERVER['HTTP_X_REAL_IP']);
        }
    }
    if(findInFile('cache/ban.name.data', $last['username'])) {
        die ('<p>You are banned</p>');
        return;
    }
    if(findInFile('cache/ban.ip.data', $_SERVER['HTTP_X_REAL_IP'])) {
        die ('<p>You are banned</p>');
        return;
    }
    if (isAdmin()) {
        $last['is_admin'] = 1;
    }
    for($a=0;$a<$options['history'];$a++) {
        if (!isset($data[$a])) {
            if ($last) {
                $data[$a] = $last;
            }
            break;
        } 
        $tmp = $data[$a];
        $data[$a] = $last;
        $last = $tmp; 
    } 
    if ($options['oneChatOfSite']) {
        $file = 'history/all';
    } else {
        $file = 'history/' . md5($_POST['url']);
    } 
    file_put_contents($file,  serialize($data));
    $f = fopen($file . '_full_' . date('Y-m-d'),'a+');
    fputs($f,"$last[time]|$last[username]|$last[msg]|$last[ip]\r\n");
    fclose($f);
}
function findInFile($file, $text) {
    $f=@fopen($file,'r+');
    if(!$f) return;
    $exists = 0;
    $text = trim($text);
    while($str=str_replace(array("\r","\n"),'',trim(fgets($f)))) {
        if ($str == $text) {
            $exists = 1;
            break;
        }
    }
    fclose($f);
    return $exists;
}
function deleteInFile($file, $text)
{
    $ar = explode("\r",@file_get_contents($file));
    foreach ($ar as $i=>$el) {
        if ($el == $text) {
            unset($ar[$i]);
        }
    }
    file_put_contents($file, implode("\r", $ar));
}