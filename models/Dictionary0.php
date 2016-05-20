<?php
namespace app\models;
require "../vendor/autoload.php";

use Yii;
use Abraham\TwitterOAuth\TwitterOAuth;

//use TwitterAPIExchange;
use yii\base\Model;

// install Composer autoloader
require(__DIR__ . '/../vendor/wordnik/wordnik/Swagger.php');
require(__DIR__ . '/../vendor/wordnik/wordnik/WordApi.php');

/**
 * This is the model class for table "input_T".
 *
 * @property integer $id
 * @property string $input
 */
class Dictionary extends Model {

    public $input;
    private $WordApi;
    private $wordsAPI;

    /**
     * @inheritdoc
     */
    public function __construct($config = array()) {
        parent::__construct($config);
        $this->workink();
    }

    public function rules() {
        return [
            [['input'], 'string', 'max' => 30],
            [['input'], 'filter', 'filter' => 'trim']
        ];
    }

    public function twitter()
    {
        
        $connection = new TwitterOAuth('S39FcyhaRIzh7eKubVXDLmCYF', 'koPg5xxI5e4mMHNEc6EvalQRp7usoxWbZsp0o9xAVN0iLbQhMt', '1177711112-PSykhFEsx1bteI1z3BwdiVPqXC7GyBcFgor6TiX', '5C8LO8Ipo3w8ZpMoSl8cUgl6C8lapl10FPEEE96j8on3j');
//$content = $connection->get("account/verify_credentials");
$statuses = $connection->get("search/tweets", array("q" => "yemen"));
     

var_dump($statuses);
     die();
    }

    public function Fliker_search($query = null) {
        $search = 'http://flickr.com/services/rest/?method=flickr.photos.search&api_key=' . '56a49e86e09dfa22887c4083a7e0d892' . '&safe_search=1&content_type=1' . '&text=' . urlencode($query) . '&per_page=5&format=php_serial';
        $result = file_get_contents($search);
        $result = unserialize($result);
        return $result;
    }

    public function pixaAbayImage($query) {

        $query = strtolower($query);
        $url = 'http://pixabay.com/api/?username=dictionary&key=a4233c43c2eb0bff8d24&q=' . urlencode($query) . '&image_type=photo&per_page=6';

        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'www.dictionary3000.com bot akhan118@hotmail.com');
        $query = curl_exec($curl_handle);
        $error = curl_errno($curl_handle);


        curl_close($curl_handle);
        $res = json_decode($query, true);
        //die();

        return $res;
    }

    function spelling_suggestions() {
        //var_dump($_SERVER['REMOTE_ADDR']);
        if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1' && $_SERVER['REMOTE_ADDR'] != "::1") {

            $pspell_link = pspell_new("en");

            if (!pspell_check($pspell_link, strtolower($this->input))) {
                $suggestions = pspell_suggest($pspell_link, strtolower($this->input));

                // foreach ($suggestions as $suggestion) {
                //     echo "Possible spelling: $suggestion<br />";
                // }


                return $suggestions;
            }
        } else {






            //// Pspell doesn't work locally, had to sudo an array for local use.        
            $fakeArray = Array
                ('test', ''
                , 'khan',
                'ah-mad',
                'Ahmed/',
                'Amado',
                'armada',
                'amid',
                'ahead',
                'aimed',
                'armed',
                'Hammad',
                'AMA',
                'Ahmad',
                'Amata',
                'Amati',
                'amide',
                'mad',
                'Hamid',
                'Armand',
                'Ahmed'
            );
            return $fakeArray;
        }
    }

    function setInput($input) {


        $this->input = $input;
    }

    function is_arabic() {

        if (preg_match('/\p{Arabic}/u', $this->input)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
        function ink_get_getTextPronunciations()
    {
        
        $textPro= $this->WordApi->getTextPronunciations(strtolower($this->input));
         
        
        if(is_object($textPro[0]))
        {
            

            if (preg_match('/[0-9]/', $textPro[0]->raw))
{
                return FALSE;
}
 else {

                 return  $textPro[0]->raw;

 }
            
            die();
            
        }
        else
        {
            return FALSE;
        }
      
         
    }
    
    function get_word_of_the_day()
    {
   $word_object=$this->wordsAPI->getWordOfTheDay();
   
  return ($word_object);
    }
    function ink_get_synonym()
    {
        
        return $this->WordApi->getRelatedWords(strtolower($this->input));
    }
    
    function ink_get_audio() {
        return $this->WordApi->getAudio(strtolower($this->input));
    }

    function ink_get_def() {

        return $this->WordApi->getDefinitions(strtolower($this->input));
    }

    function ink_get_example() {

        return $this->WordApi->getExamples(strtolower($this->input));
    }

    function wikipediaCurl($query) {
        $query = strtolower($query);

        $url = 'http://en.wikipedia.org/w/api.php?action=parse&page=' . urlencode($query) . '&format=json&prop=text&section=0';
        // create curl resource
        $ch = curl_init();
//$url = 'http://en.wikipedia.org/w/api.php?action=query&titles='.  urlencode($query).'&prop=revisions&rvprop=content&format=json&rawcontinue=false';
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);
          // curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
   curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Dictionary3000.com/1.2 (http://Dictionary3000.com; akhan118@hotmail.com) BasedOnSuperLib/1.4');
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        curl_close($ch);

        $json = json_decode($output);
        // close curl resource to free up system resources
        //  return   json_decode($output,true);



        if (is_object($json)) {

            if (!property_exists($json, 'error')) {
                $content = $json->{'parse'}->{'text'}->{'*'}; // get the main text content of the query (it's parsed HTML)

                return $content;
            }
        }
    }

    function translations($input,$source,$target) {





        $text = $input;
        $source = $source;

        $target = $target;

        $stringsize = strlen($text);

        /// testing purpose
        //$text='test';
///	$source='en';
        ///$target='ar';

        $api = 'https://www.googleapis.com/language/translate/v2?';

        $apiKey = 'AIzaSyDad5chnPdXoCS-1xjduE6CZupwvMTsZrQ';

        $values = array(
            'key' => $apiKey,
            'q' => $text,
            'source' => $source,
            'target' => $target);

        $formData = http_build_query($values);
        $url = $api . $formData;


        $results = $this->getData($url);

        $data = json_decode($results, true);

        if ($data) {
            foreach ($data['data']['translations'] as $translation) {
                return $translation['translatedText'];
            }
        } else {
            return "You have reached your daily translation limit";
        }
    }

/// function ends

    function getData($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json = curl_exec($ch);
        curl_close($ch);
        return $json;
    }

    function workink() {


        $myAPIKey = '23631311975b9b88fa39b058846007e08bac8e96f14071b7d';
//$client = new \APIClient($myAPIKey, 'http://api.wordnik.com/v4');

        $client = new \APIClient($myAPIKey, 'http://api.wordnik.com/v4');
        $wordApi = new \WordApi($client);
        $wordsAPI= new \WordsApi($client);

        $this->WordApi = $wordApi;
        $this->wordsAPI=$wordsAPI;

//$example = $wordApi->getTopExample('irony');
//return $example->text;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'input' => '',
        ];
    }

}
