<?php
require_once( 'lib/woocommerce-api.php' );
require_once( 'dbconnect.php' );
$db = DBConnection::getInstance();

print_r($db->select('SELECT * FROM users WHERE id = ?', array(1), array('%d')));exit;

class testAPIClient
{
    public $request;
    public $response;
    protected $requestMethod;
    protected $uri;
    protected $args;
    protected $endpoint;
    protected $class;

    private $users;
    private $courses;
    private $teachers;
    private $fees;

    private $initClassResources = array('products'=>'Products','users'=>'users','courses'=>'courses','teachers'=>'teachers','fees'=>'fees');

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->requestMethod = $request->getRequestMethod();
        $this->uri = $request->getRequestURI();
        $this->resolveURI(); 
        $this->initResources();
    }

    private function resolveURI()
    {
        $this->args = explode("/", ltrim($this->uri, "/"));

        $this->class = array_shift($this->args);
        
        $this->endpoint = array_shift($this->args);
    }

    private function initResources()
    {
        if (isset($this->args) && count($this->args) > 0) {
            $this->request->setRequestParams('query_string', $this->args);
        }

        foreach ($this->initClassResources as $key => $value)
        {
            if (class_exists($value) && $this->class === $value) {
                $this->$key = new $value($this);
            }
        }
    }

    public function makeAPICall()
    {
        if (class_exists($this->class) && method_exists($this->class, $this->endpoint)) {
            $this->{$this->class}->{$this->endpoint}($this->args);
        } else {
            throw new \Exception("Endpoint not found !");
        }
    }
}

class resourceClient
{
    protected $client;
    protected $request; 
    protected $response;
    protected $dbConn;
    private $sanitizeValues = array(
        'email'=>FILTER_SANITIZE_EMAIL,
        'encode'=>FILTER_SANITIZE_ENCODED,
        'magic_quotes' => FILTER_SANITIZE_MAGIC_QUOTES,
        'float' => FILTER_SANITIZE_NUMBER_FLOAT,
        'int' => FILTER_SANITIZE_NUMBER_INT,
        'specialchars' => FILTER_SANITIZE_SPECIAL_CHARS,
        'string' => FILTER_SANITIZE_STRING,
        'stripped' =>FILTER_SANITIZE_STRIPPED,
        'url' => FILTER_SANITIZE_URL,
        'unsafe_raw' => FILTER_UNSAFE_RAW,
        'ip '=>FILTER_VALIDATE_IP
    );

    public function __construct($client)
    {
        $this->client = $client;
        $this->request = $client->request;
        $this->response = $client->response;
        $this->dbConn = DBConnect::getInstance();
    }

    protected function _cleanInputs($input, $filter = null)
    {
        $output = '';
        if (!empty($input) && is_array($input) && count($input) > 0) {
            if (array_key_exists('filters', $input)) {
                $inputFilter = $input['filters'];
            }
            foreach($input as $var => $val) {
                if ($var !== 'filters' && $var !== 'path') {
                    if (is_array($inputFilter) && array_key_exists($var, $inputFilter)) {
                        $filter =  $inputFilter[$var];
                    } else {
                        $filter = null;
                    }
                    $output[$var] = $this->_cleanInputs($val, $filter);
                }
            }
 
        }
        else {
            $output  = $this->sanitize($input, $filter);
        }
        return $output;
    }

    private function sanitize($input, $filter)
    {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }

        if (isset($filter)) {
            if (array_key_exists($filter, $this->sanitizeValues)) {
                $input = filter_var($input, $this->sanitizeValues[$filter], FILTER_FLAG_STRIP_HIGH);
            }
        }
            
        $input = trim(strip_tags($input));
        
        return $input;
    }
}


class Products extends resourceClient
{
	public function __construct($client)
    {
        parent::__construct($client);
    }

	public function create(ProductsModel $model)
    {
		$filters = array();
        try {
            $params = $this->request->getRequestParams();
            print_r($params);

            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    /*if (array_key_exists($key, $this->filters)) {
                        $params['filters'] = array($key => $this->filters[$key]);
                    }*/
					if (property_exists($model, $key))
					{
						//$params['filters'] = array($key => $this->filters[$key]);
						
					}
                }
                
                $params = $this->_cleanInputs($params);
                
                print_r($params);
            } else {
                throw new \Exception("Please provide parameters to service!");
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit($args)
    {
        
    }
}

class users extends resourceClient
{
    private $filters = array('firstName'=>'string','lastName'=>'string','email'=>'email');

    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function create()
    {
        try {
            $params = $this->request->getRequestParams();
            print_r($params);

            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    if (array_key_exists($key, $this->filters)) {
                        $params['filters'] = array($key => $this->filters[$key]);
                    }
                }
                
                $params = $this->_cleanInputs($params);
                
                print_r($params);
            } else {
                throw new \Exception("Please provide parameters to service!");
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function edit($args)
    {
        
    }
}


$api = new testAPIClient(new Request(), new Response());
$api->makeAPICall();

class Request
{
    private $headers = array(
        'Content-Type' => 'application/json',
    );
    private $params = array();
    private $contentType = array(
        'file'=>'application/x-www-form-urlencoded'
    ); 

    public function __construct()
    {
        switch ($this->getRequestMethod()) {
           case 'POST':
             $this->params = $_POST;
            break;
            case 'GET':
             $this->params = $_GET;
            break;
        }

        echo "<pre>";
        $script = "'<script>alert('XSS');</script>'";
        $value = htmlentities($script, ENT_QUOTES, 'UTF-8');
        var_dump($value);
        $check = false;
        var_dump(empty($check));

        exit;
       //var_dump(get_html_translation_table());
       //print_r(apache_request_headers());
       //print_r($_SERVER);
       //print_r($_REQUEST);
       // exit;
    }

    public function getRequestParams()
    {
        return $this->params;
    }

    public function setRequestParams($key, $value)
    {
        $this->params[$key] = $value;
    }
    
    public function getRequestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }
   
    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders($key, $value)
    {
        $this->headers[$key] =  $value;
    }

    public function getRequestHeaders()
    {
        return getallheaders();
    }

    public function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getRequestContentType()
    {
        if (array_key_exists('CONTENT_TYPE', $_SERVER)) {
            $contentType = explode(';', $_SERVER['CONTENT_TYPE']);
            return $contentType[0];
        }
    }

}

class Response
{
   public function asJson($data)
   {
      if (isset($data)) {
          return json_encode($data);
      }
   }

   public function asXml($data)
   {
       $responseXML = new SimpleXMLElement("<response></response>");
       foreach ($data as $key => $value)
       {
           $responseXML->appendChild($key, $value);
       }
      
       return $xml->asXML();
   }
}
