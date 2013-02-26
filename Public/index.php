<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

define('PROJECT_PATH', dirname(dirname(__FILE__)));
define('APP_PATH', PROJECT_PATH . DIRECTORY_SEPARATOR . 'App');
require PROJECT_PATH . '/Libs/Autoloader.php';

spl_autoload_register('Libs\\Autoloader::load');

$front = new Libs\Front();
$request = new Libs\Request();
$front->setRequest(new Libs\Request());

$config = new Libs\Config();
$flickrConfig = $config->get('flickr');
echo $flickrConfig['apiKey'];

$config = [
    'apiKey' => 'a84ac19fa8cec67ac25da03d7feab130',
    'perPage' => 30,
    'pagerCycle' => 5
];

$front->addAction('/', function() use ($front){
    $view = new Libs\View('index');

    echo $view->render();
});

$front->addAction('/search', function() use ($front, $config){
    $view = new Libs\View('search');
    $searchText = $front->getRequest()->get('text');

    if ($searchText !== null) {
        $view->assign('text', $searchText);

        $currentPage = $front->getRequest()->get('page');
        if ($currentPage === null) {
            $currentPage = 1;
        }

        $flickr = new Libs\Flickr();
        $flickr->setParser(new Libs\Flickr\FlickrParserJson());
        $flickr->setApiKey($config['apiKey']);

        $flickr->setMethod('flickr.photos.search');

        $params = [
            'text' => $searchText,
            'per_page' => $config['perPage'],
            'page' => $currentPage
        ];

        $result = $flickr->getResponse($params);

        $view->assign('searchResults', $result);

        $view->assign('pagerCycle', $config['pagerCycle']);
    }

    echo $view->render();
});

$front->run();