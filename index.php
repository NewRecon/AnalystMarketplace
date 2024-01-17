<?php

require "settings.php";
require "ozonApi.php";
require "db.php";
require "../func.php";

$ozon = new OzonApi(CLIENT_ID, API_KEY);

$getOrders = $ozon->getOrder();

_p($getOrders);