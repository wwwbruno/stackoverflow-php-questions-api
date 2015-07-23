<?php

namespace Disvolvi\ApiBundle\Utils;

class CallApi {

  /**
	 * Get
	 *
	 * Executes a get json request
	 *
   * @param String $url
   * @param Array $parameters
	 * @param String $enconding
   *
   * @return stdClass;
	 */
	public function get($url, $parameters=array(), $encoding="gzip")
	{
      if ($parameters)
          $url .= '?' . http_build_query($parameters);

      $curl = curl_init();

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPGET, true);
      curl_setopt($curl, CURLOPT_ENCODING , $encoding);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Accept: application/json'
      ));

      $result = curl_exec($curl);

      curl_close($curl);

      return json_decode($result);
	}
}
