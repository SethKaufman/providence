<?php
/** ---------------------------------------------------------------------
 * app/lib/BatchMetadataImportProgress.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2021 Whirl-i-Gig
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
 * @subpackage UI
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
 
 /**
  * Implements data importinvoked via the web UI
  * This application dispatcher plugin ensures that the import starts
  * after the web UI page has been sent to the client
  */
 
 	require_once(__CA_LIB_DIR__.'/Controller/AppController/AppControllerPlugin.php');
 	require_once(__CA_LIB_DIR__.'/BatchProcessor.php');
 
	class BatchMetadataImportProgress extends AppControllerPlugin {
		# -------------------------------------------------------
		private $request;
		private $opa_options;
		# -------------------------------------------------------
		public function __construct($po_request, $options=null) {
			$this->request = $po_request;
			$this->opa_options = is_array($options) ? $options : array();
		}
		# -------------------------------------------------------
		public function dispatchLoopShutdown() {	
			//
			// Force output to be sent - we need the client to have the page before
			// we start flushing progress bar updates
			//	
			$app = AppController::getInstance();
			$req = $app->getRequest();
			$resp = $app->getResponse();
			$resp->sendResponse();
			$resp->clearContent();
			
			//
			// Do batch processing
			//
			if ($req->isLoggedIn()) {
				set_time_limit(3600*24); // if it takes more than 24 hours we're in trouble
			
				if (isset($_FILES['sourceFile']['tmp_name']) && $_FILES['sourceFile']['tmp_name']) {
					$input = $_FILES['sourceFile']['tmp_name'];
					$input_filename = $_FILES['sourceFile']['name'];
				} elseif(!($input = $req->getParameter('sourceUrl', pString))) {
					$input = $req->getParameter('sourceText', pString);
					$input_filename = null;
				}
				
				$file_input = caGetOption('fileInput', $this->opa_options, null); 
				$file_import_directory = caGetOption('fileImportPath', $this->opa_options, null);

				if ($file_input === 'import') { 
					// grab files from import directory
					$input = array_map(function($v) use ($file_import_directory) { return $v.'/'.$file_import_directory; }, caGetAvailableMediaUploadPaths($req->getUserID()));
				}
				
				$errors = BatchProcessor::importMetadata(
					$req, 
					$input,
					$req->getParameter('importer_id', pInteger),
					$req->getParameter('inputFormat', pString),
					array_merge($this->opa_options, array('originalFilename' => $input_filename, 'progressCallback' => 'caIncrementBatchMetadataImportProgress', 'reportCallback' => 'caUpdateBatchMetadataImportResultsReport'))
				);
			}
		}	
		# -------------------------------------------------------
	}
