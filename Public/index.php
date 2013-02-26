<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);


define('PROJECT_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', PROJECT_PATH . DIRECTORY_SEPARATOR . 'App');

require PROJECT_PATH . '/Libs/Autoloader.php';
spl_autoload_register('Libs\\Autoloader::load');

$request = new Libs\Request();

$front = new Libs\Front();
$front->setRequest(new Libs\Request());

$config = new Libs\Config();
$flickrConfig = $config->get('flickr');

// add action for index page
$front->addAction('/', function() use ($front){
    // load required view
    $view = new Libs\View('index');

    // send output - generated content
    echo $view->render();
});

$front->addAction('/search', function() use ($front, $flickrConfig){
    $view = new Libs\View('search');

    // get current search phrase
    $searchText = $front->getRequest()->get('text');

    // assign current (even empty) search phrase to view
    $view->assign('text', $searchText);

    // if search text exists then process search
    if ($searchText !== null) {
        // define current page
        $currentPage = $front->getRequest()->get('page');
        if ($currentPage === null) {
            $currentPage = 1;
        }

        $flickr = new Libs\Flickr();
        $flickr->setParser(new Libs\Flickr\FlickrParserJson());
        $flickr->setApiKey($flickrConfig['apiKey']);
        $flickr->setMethod('flickr.photos.search');

        // set flickr method params
        $params = [
            'text' => $searchText,
            'per_page' => $flickrConfig['perPage'],
            'page' => $currentPage
        ];

        $result = $flickr->getResponse($params);

        $view->assign('searchResults', $result);
        $view->assign('pagerCycle', $flickrConfig['pagerCycle']);
    }

    echo $view->render();
});

$front->setNotFoundAction(function() use ($front){
    $view = new Libs\View('notfound');

    echo $view->render();
});

// run front controller
$front->run();