<style>
* {
    margin: 0; padding: 0;
}
ul.rel-me img {
    height: 16px;
    width: 16px;
    border: 0;
}
ul.rel-me {
    text-align: justify;
}
ul.rel-me li {
    display: inline-block;
    list-style: none;
    margin: 5px;
    padding: 0;
}
ul.rel-me a {
    padding: 10px;
    text-decoration: none;
}
ul.rel-me a img {
    margin-right: 5px;
}
ul.rel-me a:hover {
    background: #e7e7e7;
}
</style>
<h2>My Other Internet Things</h2>

<?php
require_once('spyc.php');
$sites = Spyc::YAMLLoad('sites.yaml');

foreach ($sites as $key => $site) {
    if (!is_array($site)) {
        $site = array("href" => $site);
    }
    unset($parsed);

    if (!isset($site['href'])) 
        die( "needs an 'href' attribute: " . print_r($site, TRUE));

    if (!isset($site['name'])) {
        $parsed = parse_url($site['href']);
        $site['name'] = $parsed['host'];
        $site['name'] = str_replace('www.', '', $site['name']);

        // Remove TLD
        $site['name'] = preg_replace('/[.][^.]*$/', '', $site['name']);
    }

    if (!isset($site['favicon'])) {
        if (!isset($parsed))
            $parsed = parse_url($site['href']);

        $site['favicon'] = "{$parsed['scheme']}://{$parsed['host']}/favicon.ico";
    }
    $parsed_favicon = parse_url($site['favicon']);
    $fname = str_replace(' ', '_', $site['name']).'.ico';
    if (file_exists('favicons/'.$fname)) {
        $site['favicon'] = '/favicons/'.$fname;
    }

    $sites[$key] = $site;
}

function compare($a, $b) {
    return $a['name'] > $b['name'];
}

usort($sites, 'compare');

?>
<ul class="rel-me">
<?php
foreach ($sites as $site) {
    print "
    <li>
        <a rel=\"me\" class=\"url\" href=\"{$site['href']}\">
            <img src=\"{$site['favicon']}\"/>{$site['name']}
        </a>
    </li>
    ";
}
?>
</ul>
