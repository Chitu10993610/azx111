<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class hs_rss {
	protected $_url;

	/**
	 * contruction
	 *
	 * @param unknown_type $url
	 */
	public function __construct($params) {
		$this->_url = $params['url'];
	}
	
	/**
	 * set url of rss
	 *
	 * @param unknown_type $url
	 */
	public function setUrl($url) {
		$this->_url = $url;
	}
	
	public function buildList() {
		$doc = new DOMDocument();
		$itemRSS = array();
		
		if($doc->load($this->_url)) {
			foreach ($doc->getElementsByTagName('item') as $node) {
				$itemRSS[] = array ( 
					'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
					'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
					'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
					'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
					);
			}
		}
		
	 	return $itemRSS;
	}
	
	public function cutstring($str)	{
		$strCut = mb_substr($str, 0, 100, 'utf-8');
		
		if(mb_strlen($str, 'utf-8') > 100) {
			$strCut = htmlspecialchars(mb_substr($strCut, 0, mb_strrpos($strCut, " ", 0, 'utf-8'), 'utf-8'));
			$strCut .= "...";
		}
		
		return $strCut;
	}
}

?>