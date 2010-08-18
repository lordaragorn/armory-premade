<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

if(isset($_GET['clearLog'])) {
    @file_put_contents('tmp.dbg', null);
    header('Location: index.php');
}
echo '<html><head><title>Debug Log</title></head><body><a href="?clearLog">Clear log</a><br /><hr />';
@include('tmp.dbg');
echo '</body></html>';
?>