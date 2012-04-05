<?php
/*
 * This is a plugin for CakePHP to perform searches in Soundcloud.com.
 * @author Chuck (david.mejorado@gmail.com)
 * @links github.com/davidmh
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class SoundcloudSearchComponent extends Component {
  public $name = 'Soundcloud';

  private $client_id;

  private $curl;

  private $base_url = 'http://api.soundcloud.com/';

  public function __construct(){
    //Soundclud App ID, should be set in app/Config/core.php
    $this->client_id = Configure::read('Soundcloud.AppID');
  }

  public function __destruct(){
    if(!empty($this->curl)){
      curl_close($this->curl);
    }
  }

  /*
   * Performs a track search in soundcloud.com
   * @access public
   * @param array $params
   *          array 'filters' Valid filters in http://developers.soundcloud.com/docs/api/tracks
   *          array 'fields'  Fields to retrieve
   * @return array with results or an empty one
   */
  public function find($params){
    $filters =& $params['filters'];
    $fields  =& $params['fields'];

    $url = $this->base_url . 'tracks.json';
    $results = $this->get($url, $filters);
    if(!empty($fields)){
      foreach($results as $i => $r){
        foreach($r as $k => $v){
          if(!in_array($k, $fields)){
            //removes the non-requested fields
            unset($results[$i][$k]);
          }
        }
      }
    }
    return $results;
  }

  private function get($url, $params){
    if(!empty($url)){

      $params = (array) $params;
      $params['client_id'] = $this->client_id;

      $url .= '?'.http_build_query($params);

      $this->prepare_curl();

      curl_setopt($this->curl, CURLOPT_URL, $url);
      curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);

      $response = curl_exec($this->curl);

      return json_decode($response, true);

    }
    return array('error' => 'You have to specify a URL');
  }

  private function prepare_curl() {
    if (!empty($this->curl)) {
      $this->curl = null;
    }
    $this->curl = curl_init();
  }

}
		
?>
