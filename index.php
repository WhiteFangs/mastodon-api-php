<?php
ini_set('display_errors', 1);
require_once('MastodonAPIExchange.php');
$instanceURL = 'your.instance.social';

/** Set access tokens here - see [your.instance.social]/settings/applications **/
$settings = array(
    'oauth_access_token' => ""
);

/** URL for REST request, see: https://docs.joinmastodon.org/methods/statuses/#create **/
$url = $instanceURL . '/api/v1/statuses';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'status' => 'this is a test'
);

/** Perform a POST request and echo the response **/
$mastodon = new MastodonAPIExchange($settings);
echo $mastodon->buildOauth($url, $requestMethod)
             ->setPostfields($postfields)
             ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$accountId = '1';
$url = $instanceURL . '/api/v1/accounts/'. $accountId . '/followers';
$getfield = '?limit=80';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
