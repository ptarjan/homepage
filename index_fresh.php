<!DOCTYPE html>
<html>
<head>
<title>Paul Tarjan</title>
<link rel="openid.server" href="http://www.myopenid.com/server" />
<link rel="openid.delegate" href="http://ptarjan.myopenid.com/" />
<link rel="openid2.local_id" href="http://ptarjan.myopenid.com" />
<link rel="openid2.provider" href="http://www.myopenid.com/server" />
<meta http-equiv="X-XRDS-Location" content="http://www.myopenid.com/xrds?username=ptarjan.myopenid.com" />
<meta property="og:image" content="http://paultarjan.com/paul.jpg" />
<link rel="stylesheet" href="style.css" />
<style>
.photo {
    width: 300px;
    height: 300px;
    float: left;
    margin-right: 30px;
    margin-bottom: 14px;
}
body {
    width: 960px;
    margin: 5px auto;
}
#menu {
    text-align: center;
}
#menu a {
    color: #000;
    padding: 10px;
    text-decoration: none;
}
#menu a:hover {
    background: #e7e7e7;
}
h1.fn {
    margin-top:0;
    border:0;
}
h2 {
    overflow: hidden;
}
</style>
<body class="vcard">
<div id="menu">
<a href="mailto:web@paultarjan.com" class="email">Contact</a>
<a href="resume">Resume</a>
<a href="http://paulisageek.com/ppp">Projects</a>
</div>

<h1 class="fn">Paul Tarjan</h1>

<img src="paul.jpg" class="photo" alt="Paul Tarjan" />

<div id="recent">

<h2 style="margin-top:0px"><a href="http://twitter.com/ptarjan">Tweet</a></h2>
<span id="last_tweet">
<?php
date_default_timezone_set('UTC');
$data = @json_decode(file_get_contents("http://twitter.com/statuses/user_timeline/ptarjan.json?count=20"), TRUE);
if (!$data) {
    $data = array(array('text' => "Twitter API is down..."));
}
$tweet = "";
foreach ($data as $entry) {
    if ($entry['text'][0] != '@') {
        $date = strtotime($entry['created_at']);
        $tweet = $entry['text'];
        break;
    }
}
$in=array(
'`((?:https?|ftp)://\S+)`si',
'`((?<!//)(www\.\S+))`si',
'`(^|\s)@(\w+)`si',
'`(^|\s)#(\w+)`si',
);
$out=array(
'<a href="$1">$1</a> ',
'<a href="http://$1">$1</a>',
'\1<a href="http://twitter.com/\2">@\2</a>',
'\1<a href="http://twitter.com/search?q=%23\2">#\2</a>',
);
$tweet = preg_replace($in,$out,$tweet);
print '[<a href="http://twitter.com/ptarjan/status/' . $entry['id'] . '">' . date('M j', $date) . '</a>] ' . $tweet;
?>
</span>

<h2><a rel="me" class="url" href="http://blog.paulisageek.com">Blog</a></h2>
<span id="last_blog">
<?php
$data = @simplexml_load_string(file_get_contents("http://feeds.feedburner.com/paulisageek"));
if (!$data) $data == "RSS is down...";

$post = $data->entry[0]->content;
$title = $data->entry[0]->title;
$date = strtotime($data->entry[0]->published);
$href = 'http://blog.paulisageek.com';
foreach ($data->entry[0]->link as $link) {
    if ($link['rel'] == 'alternate' && $link['type'] == 'text/html') {
        $href = $link['href'];
    }
}

function smart_substr($str, $start, $length = FALSE, $minword = 3) {
    $sub = '';
    $len = 0;
    if ($lenth === FALSE) $length = strlen($str);
   
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
       
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
   
    return $sub . (($len < strlen($str)) ? '...' : '');
}

$post = preg_replace('/<style>[^<]*<\/style>/', '', $post);
$post = smart_substr(strip_tags($post), 0, 140);
print '[<a href="' . $href  . '">' . date('M j', $date) . '</a>] '.$title.' : '.$post;
?>
</span> <a href="http://blog.paulisageek.com">Read More</a>

</div>

<div style="clear:left"></div>

<?php require "sites.php" ?>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
    var pageTracker = _gat._getTracker("UA-149816-13");
    pageTracker._trackPageview();
} catch(err) {}</script>
