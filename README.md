mastodon-api-php
===============

Simple PHP Wrapper for Mastodon API calls based on [Twitter-API-PHP by J7mbo](https://github.com/J7mbo/twitter-api-php)

The aim of this class is simple. You need to:

- Include the class in your PHP code
- Create a Mastodon app on your instance: Settings > Development
- Enable read/write access for your Mastodon app
- Grab your access token from your instance
- [Choose a Mastodon API URL to make the request to](https://docs.joinmastodon.org/methods/)
- Choose either GET / POST (depending on the request) 
- Choose the fields you want to send with the request (example: `array('status' => 'this is a test')`)

You really can't get much simpler than that. The above bullet points are an example of how to use the class for a POST request to block a user, and at the bottom is an example of a GET request.

Installation
------------

Just include MastodonAPIExchange.php in your application.

```php
require_once('MastodonAPIExchange.php');
```

How To Use
----------

#### Set access tokens ####

```php
$settings = array(
    'oauth_access_token' => "YOUR_OAUTH_ACCESS_TOKEN"
);
```

#### Choose URL and Request Method ####

```php
$instanceURL = 'your.instance.social';
$url = $instanceURL . '/api/v1/statuses';
$requestMethod = 'POST';
```

#### Choose POST fields (or PUT fields if you're using PUT) ####

```php
$postfields = array(
    'status' => 'this is a test', 
);
```

#### Perform the request! ####

```php
$mastodon = new MastodonAPIExchange($settings);
echo $mastodon->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();
```

Media Upload Example
-------------------

Set the file object in the post fields and everything else is the same:

```php
$imageContent = file_get_contents($uri);
$postfields = array(
    'file' => $imageContent,
    'description' => 'a nice picture'
);
$instanceURL = 'your.instance.social';
$url = $instanceURL . '/api/v2/media';
$requestMethod = 'POST';

$mastodon = new MastodonAPIExchange($settings);
echo $mastodon->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();
```


GET Request Example
-------------------

Set the GET field BEFORE calling buildOauth(); and everything else is the same:

```php
$accountId = '1';
$url = $instanceURL . '/api/v1/accounts/'. $accountId . '/followers';
$getfield = '?limit=80';
$requestMethod = 'GET';

$mastodon = new MastodonAPIExchange($settings);
echo $mastodon->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
```

That is it! Really simple, works great with the API. Thanks to j7mbo for the original code!
