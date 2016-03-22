<pre>
<?php
require_once "RailAPI.php";
$api = new RailAPI("YOUR_CLOUDFLARE_PARTNER_API_KEY");
var_dump($api->create());
