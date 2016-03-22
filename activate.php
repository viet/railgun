<pre>
<?php
require_once "RailAPI.php";
$api = new RailAPI("YOUR_CLOUDFLARE_PARTNER_API_KEY");
var_dump($api->set("YOUR_DOMAIN_NAME", "YOUR_DOMAIN_KEY"));
