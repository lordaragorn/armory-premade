<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 * @revision 3
 */

define('__MANGOS__', true);
if(!@include('includes/loader.php')) {
    die('Unable to load main files!');
}
if(!isset($_GET['action']) || !isset($_POST['cn'])) {
    echo '<html>
    <head><title>World of Warcraft Armory</title>
    </head>
    <body>
    <div>
    <form action="?action" method="post">
    Zone: <select name="zone">
    <option name="US" value="us">US</option>
    <option name="EU" value="eu" selected="selected"/>EU</option>
    </select>
    <br />
    Realm: <input type="text" name="r" value=""/>
    <br />
    Name: <input type="text" name="cn" value=""/>
    <br />
    <label for="rewrite">Rewrite existed character</label> <input type="checkbox" name="rewrite" id="rewrite" value="1" checked="checked"/><br />
    AccountID: <input type="text" name="account" value="1"/><br/>
    <input type="submit" value="Copy!"/>
    </form>
    </div>
    </html>';
    exit;
}

$name = $_POST['cn'];
$realm = $_POST['r'];
$zone = $_POST['zone'];
$account = $_POST['account'];
$rewrite = ($_POST['rewrite'] == 1) ? true : false;
if(!$name || !$realm || !$zone || !$account) {
    die('Wrong data!<br /><a href="?action">Please, try again!</a>');
}
$character = new Character($name, $realm, $zone, 'en', $account, $rewrite);
if(!$character) {
    die('Unable to get character data');
}
echo sprintf('Character info:<br/>
Name: %s, Realm: %s, Link: <a href="http://%s.wowarmory.com/character-sheet.xml?r=%s&cn=%s&rhtml=n" target="_blank">WoWArmory</a><br /><pre>', $name, $realm, $zone, urlencode($realm) , urlencode($name) );
//print_r($character->GetAchievementsData());
echo sprintf('</pre><br/>Character %s was successfully added to DB. GUID: %d, accountID: %d', $name, $character->GetGUID(), $character->GetAccountID());
?>