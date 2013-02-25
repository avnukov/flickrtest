<?php
namespace Libs;

class Flickr implements Flickr\FlickrInterface {
    private $apiKey = 'a84ac19fa8cec67ac25da03d7feab130';
    private $parser = null;
    private $method = null;
    private $params = array();
    private $defaultAdditionalParams = array();
    private $defaultGate = 'http://api.flickr.com/services/rest/?';

    public function __construct(ParserInterface $parser = null) {
        if ($parser !== null) {
            $this->setParser($parser);
        }

        $this->defaultAdditionalParams = array(
            'format' => 'json'
        );

        return $this;
    }

    public function addParam($name, $value) {
        $this->params[$name] = $value;
    }

    public function setMethod($methodName) {
        $this->method = $methodName;
    }

    public function getResponse(Array $params) {
        if ($this->parser === null) {
            return false;
        }

        if (count($this->defaultAdditionalParams) > 0) {
            foreach ($this->defaultAdditionalParams as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        // format=json
        $requestUrl = $this->defaultGate . $this->createRequestUrl($params);

        echo $requestUrl;
        $rawResponse = file_get_contents($requestUrl);

        return $this->parser->parse($rawResponse);
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setParser($parser) {
        $this->parser = $parser;
    }

    public function doRequestTest($fullPath = '') {
        return $this->parser->parse('jsonFlickrApi({"photos":{"page":1, "pages":6438, "perpage":30, "total":"193127", "photo":[{"id":"8506860143", "owner":"65279902@N08", "secret":"a813672f72", "server":"8387", "farm":9, "title":"The Beauty of the Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507249378", "owner":"73213751@N00", "secret":"f515458101", "server":"8368", "farm":9, "title":"Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507247050", "owner":"73213751@N00", "secret":"d1770d00bc", "server":"8234", "farm":9, "title":"Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507153850", "owner":"91015851@N06", "secret":"9ff6d3ef2a", "server":"8510", "farm":9, "title":"Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507131504", "owner":"41287315@N06", "secret":"e38e2224e3", "server":"8246", "farm":9, "title":"4378-2 Circular Quay - Sydney, Australia", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8506022451", "owner":"41287315@N06", "secret":"1b33ae99aa", "server":"8233", "farm":9, "title":"4384 Circular Quay - Sydney, Australia", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507132322", "owner":"41287315@N06", "secret":"97292648a6", "server":"8385", "farm":9, "title":"4381 Circular Quay - Sydney, Australia", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507104380", "owner":"99838397@N00", "secret":"89a0a83c7a", "server":"8514", "farm":9, "title":"sydney-opera-house", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8507032088", "owner":"93536780@N06", "secret":"9dd2cae7d1", "server":"8245", "farm":9, "title":"Sydney CBD & Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8505837793", "owner":"15587816@N00", "secret":"a1e378eaa1", "server":"8372", "farm":9, "title":"Nuclear sunset", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8505724589", "owner":"98911185@N00", "secret":"3b9a58b41d", "server":"8530", "farm":9, "title":"Australia - Sydney - Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8505827194", "owner":"32786279@N02", "secret":"599558b056", "server":"8250", "farm":9, "title":"Dawn, Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8504716785", "owner":"32786279@N02", "secret":"30a14122c7", "server":"8523", "farm":9, "title":"Dawn, Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8504636881", "owner":"59318094@N06", "secret":"77718056a0", "server":"8237", "farm":9, "title":"cbd", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8504638199", "owner":"59318094@N06", "secret":"d61d88d3f6", "server":"8386", "farm":9, "title":"view from blues point", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8505750980", "owner":"59318094@N06", "secret":"9f40bdd5c9", "server":"8226", "farm":9, "title":"view from mrs macquarie\'s chair", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8504637525", "owner":"59318094@N06", "secret":"9c79665865", "server":"8225", "farm":9, "title":"cbd", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8504618000", "owner":"90919081@N06", "secret":"a65b0063d3", "server":"8528", "farm":9, "title":"Sydney 360", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8504430722", "owner":"42932938@N06", "secret":"812a92c9fa", "server":"8226", "farm":9, "title":"Ganz wichtiges Touribild", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8503220359", "owner":"92742470@N00", "secret":"515cd171d3", "server":"8366", "farm":9, "title":"Opera House, Sydney", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8503940186", "owner":"41287315@N06", "secret":"c4bd87e77f", "server":"8525", "farm":9, "title":"4367 Circular Quay - Sydney, Australia", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8502810719", "owner":"38067796@N02", "secret":"a0db05634e", "server":"8376", "farm":9, "title":"SYDNEY OPERA HOUSE", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8503942120", "owner":"41287315@N06", "secret":"b9182bd6d7", "server":"8391", "farm":9, "title":"4371 Circular Quay - Sydney, Australia", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8503698394", "owner":"30931271@N02", "secret":"97d551142f", "server":"8243", "farm":9, "title":"sydney-opera-house-during-the-day", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8503501920", "owner":"60864687@N05", "secret":"ebe88e2db8", "server":"8111", "farm":9, "title":"Opera House & Harbour Bridge", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8502383001", "owner":"79566000@N02", "secret":"e58845a14a", "server":"8229", "farm":9, "title":"Evening Lighting", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8502176239", "owner":"90451570@N07", "secret":"bd6821ed1e", "server":"8532", "farm":9, "title":"Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8502171585", "owner":"90451570@N07", "secret":"b2798a8397", "server":"8383", "farm":9, "title":"Sydney Opera House back towards Circular Quay", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8503509967", "owner":"93566797@N08", "secret":"31ed822b39", "server":"8096", "farm":9, "title":"Sydney", "ispublic":1, "isfriend":0, "isfamily":0}, {"id":"8502493963", "owner":"93465055@N04", "secret":"1b27c9b6d7", "server":"8368", "farm":9, "title":"Sydney Opera House", "ispublic":1, "isfriend":0, "isfamily":0}]}, "stat":"ok"})');
    }

    private function createRequestUrl(Array $additionalParams = array()) {
        $params = $this->params;

        if (count($additionalParams) > 0) {
            foreach ($additionalParams as $key => $value) {
                $params[$key] = $value;
            }
        }

        $params['method'] = $this->method;
        $params['api_key'] = $this->apiKey;

        return http_build_query($params);
    }
}