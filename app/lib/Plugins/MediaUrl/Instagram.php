<?php
/** ---------------------------------------------------------------------
 * app/lib/Plugins/MediaUrlParser/Instagram.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2020 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage MediaUrlParser
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
namespace CA\MediaUrl\Plugins;
 
 /**
  *
  */
  require_once(__CA_LIB_DIR__.'/Plugins/MediaUrl/BaseMediaUrlPlugin.php');
 
class Instagram Extends BaseMediaUrlPlugin {	
	# ------------------------------------------------
	/**
	 *
	 */
	private $instalooter_path = null;
	
	/**
	 * Regular expressions to match URL host against. Valid matches are accepted by this plugin.
	 */
	private $valid_hosts = [
		'.instagram\.com$' => ['name' => 'Instagram', 'format' => 'jpg']
	];
	
	# ------------------------------------------------
	/**
	 *
	 */
	public function __construct() {
		$this->description = _t('Processes Instagram URLs using Instalooter');
		$this->instalooter_path = caInstalooterInstalled();
	}
	# ------------------------------------------------
	/**
	 *
	 */
	public function register() {
		$this->info["INSTANCE"] = $this;
		return $this->info;
	}
	# ------------------------------------------------
	/**
	 *
	 */
	public function checkStatus() {
		$status = parent::checkStatus();
		
		$status['available'] = is_array($this->register()) && $this->instalooter_path; 
		return $status;
	}
	# ------------------------------------------------
	/**
	 * Attempt to parse URL. If valid, transform url for to allow download in specifid format.
	 *
	 * @param string $url
	 * @param array $options No options are currently supported.
	 *
	 * @return bool|array False if url is not valid, array with information about the url if valid.
	 */
	public function parse(string $url, array $options=null) {
		if (!is_array($parsed_url = parse_url(urldecode($url)))) { return null; }
		
		// Is it a supported URL?
 		$is_valid = false;
 		$format = null;
 		foreach($this->valid_hosts as $regex => $info) {
 			if (preg_match("!{$regex}!", $parsed_url['host'])) {
 				$format = $info['format'];
 				$service = $info['name'];
 				
 				$is_valid = true;
 				break;
 			}
 		}
 		if(!$is_valid) { return false; }
 		
 		
		return ['url' => $url, 'originalUrl' => $url, 'format' => $format, 'plugin' => 'Instagram', 'service' => $service, 'originalFilename' => pathInfo($url, PATHINFO_BASENAME)];
	}
	# ------------------------------------------------
	/**
	 * Attempt to fetch content from a URL, transforming content to specified format for source.
	 *
	 * @param string $url
	 * @param array $options Options include:
	 *		filename = File name to use for fetched file. If omitted a random name is generated. [Default is null]
	 *		extension = Extension to use for fetched file. If omitted ".bin" is used as the extension. [Default is null]
	 *		returnAsString = Return fetched content as string rather than in a file. [Default is false]
	 *
	 * @throws UrlFetchException Thrown if fetch URL fails.
	 * @return bool|array|string False if url is not valid, array with path to file with content and format if successful, string with content if returnAsString option is set.
	 */
	public function fetch(string $url, array $options=null) {
		if ($p = $this->parse($url, $options)) {
			if($dest = caGetOption('filename', $options, null)) {
				$dest .= '.'.caGetOption('extension', $options, '.bin');
			}
			print_R($p);
			$tmp_file = tempnam('/tmp', 'INSTAGRAM_TMP').'.'.$p['format'];
			caExec($z=$this->instalooter_path.' post '.caEscapeShellArg($url).' '.caEscapeShellArg(pathinfo($tmp_file, PATHINFO_DIRNAME)).' -n 1 -T '.pathinfo($tmp_file, PATHINFO_FILENAME), $output);
print $z;
print_R($output);
print "<br>\nt=$tmp_file\n\n";
			if(!file_exists($tmp_file) || (filesize($tmp_file) === 0)) {
				return false;
			}
			
			if (caGetOption('returnAsString', $options, false)) {
				$content = file_get_contents($tmp_file);
				@unlink($tmp_file);
				return $content;
			}
			
			//if(!$dest) { rename($tmp_file, $tmp_file .= '.'.$format); }
			print "file is $tmp_file"; print_R($p);
			return array_merge($p, ['file' => $tmp_file]);
		}
		return false;
	}
	# ------------------------------------------------
}
