<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Réseaux sociaux</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="index.html" class="brand-logo">MSF</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="#">réseaux sociaux</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="index.html">Index</a></li>
            <li><a href="#">réseaux sociaux</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">Réseaux sociaux</h1>
        <div class="row center">
            <h5 class="header col s12 light"></h5>
        </div>
        <br><br>

    </div>
</div>


<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row">


            <?php
            require_once('TwitterAPIExchange.php');

            /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
            $settings = array(
                'oauth_access_token' => "804466750775590912-bEK0KlOhKO8oqBjDQbO5XyXCXr6hra9",
                'oauth_access_token_secret' => "WqbdHyh3Mhq2NYuFguDAKdXoREHIOqmlXBr7zcL4VUGpk",
                'consumer_key' => "dA9VwuLOmH3mb8I1sItXmpeI0",
                'consumer_secret' => "hBCtJsDOwkBz3BnhULmVssrTBADsVQxUAIabvLcBGW1JsweXck"
            );
            //2 - Include @abraham's PHP twitteroauth Library
            require_once('twitteroauth/twitteroauth.php');
            //3 - Authentication
            /* Create a TwitterOauth object with consumer/user tokens. */
            $connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);

            $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
            $requestMethod = "GET";
            if (isset($_GET['user'])) {$user = $_GET['user'];} else {$user = "iagdotme";}
            if (isset($_GET['count'])) {$count = $_GET['count'];} else {$count = 20;}
            $getfield = "?screen_name=$user&count=$count";
            $twitter = new TwitterAPIExchange($settings);
            $string = json_decode($twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest(),$assoc = TRUE);
            if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}
            foreach($string as $items)
            {
                echo "Time and Date of Tweet: ".$items['created_at']."<br />";
                echo "Tweet: ". $items['text']."<br />";
                echo "Tweeted by: ". $items['user']['name']."<br />";
                echo "Screen name: ". $items['user']['screen_name']."<br />";
                echo "Followers: ". $items['user']['followers_count']."<br />";
                echo "Friends: ". $items['user']['friends_count']."<br />";
                echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
            }
            ?>


        </div>

    </div>
    <br><br>

    <div class="section">

    </div>
</div>

<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Nous</h5>
                <p class="grey-text text-lighten-4">Nous sommes l'équipe Dank Programming!</p>


            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

</body>
</html>
