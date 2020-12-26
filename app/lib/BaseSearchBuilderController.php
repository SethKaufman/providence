<?php
/** ---------------------------------------------------------------------
 * app/lib/BaseSearchBuilderController.php : base controller for search interface
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
 * @subpackage UI
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */
 
 /**
  *
  */
	require_once(__CA_LIB_DIR__."/BaseSearchController.php");
	require_once(__CA_LIB_DIR__."/Browse/ObjectBrowse.php");
	require_once(__CA_LIB_DIR__."/Datamodel.php");
	 	require_once(__CA_APP_DIR__.'/helpers/accessHelpers.php');
	require_once(__CA_LIB_DIR__.'/Media/MediaViewerManager.php');
	require_once(__CA_APP_DIR__.'/helpers/browseHelpers.php');
 	
 	class BaseSearchBuilderController extends BaseSearchController {
 		# -------------------------------------------------------
 		protected $opb_uses_hierarchy_browser = false;
 		protected $ops_find_type;
 		
 		# -------------------------------------------------------
 		/**
 		 * Options:
 		 *		appendToSearch = optional text to be AND'ed wuth current search expression
 		 *		output_format = determines format out search result output. "PDF" and "HTML" are currently supported; "HTML" is the default
 		 *		view = view with path relative to controller to use overriding default ("search/<table_name>_search_basic_html.php")
 		 *		vars = associative array with key value pairs to assign to the view
 		 *
 		 * Callbacks:
 		 * 		hookBeforeNewSearch() is called just before executing a new search. The first parameter is the BrowseEngine object containing the search.
 		 */
 		public function Index($options=null) {
 			$builder_conf = Configuration::load(__CA_CONF_DIR__."/search_query_builder.conf");
 			
 			$search = caGetBrowseInstance($this->ops_tablename);
 			
 			$t_subject = Datamodel::getInstance($this->ops_tablename, true);
 			
			$opts = $builder_conf->get('query_builder_global_options') ?: array();
			$opts['filters'] = caGetQueryBuilderFilters($t_subject, $builder_conf);
			$opts['allow_empty'] = true;
			$opts['icons'] = $builder_conf->get('query_builder_icons') ?: array();
			$opts['plugins'] = $builder_conf->get('query_builder_plugins') ?: array();
			
 			$this->view->setVar('options', $opts);
 			parent::Index([
 				'search' => $search,
 				'view' => 'SearchBuilder/'.$this->ops_tablename.'_search_builder_html.php'
 			]);
 		}
 		# -------------------------------------------------------
 		public function usesHierarchyBrowser() {
 			return (bool)$this->opb_uses_hierarchy_browser;
 		}
 		# -------------------------------------------------------
 		# Sidebar info handler
 		# -------------------------------------------------------
 		public function Tools($pa_parameters) {
 			parent::Tools($pa_parameters);
 			
			$this->view->setVar('mode_name', _t('search'));
			$this->view->setVar('mode_type_singular', $this->searchName('singular'));
			$this->view->setVar('mode_type_plural', $this->searchName('plural'));
			
			$this->view->setVar('table_name', $this->ops_tablename);
			$this->view->setVar('find_type', $this->ops_find_type);
 			
			$this->view->setVar('search_history', $this->opo_result_context->getSearchHistory());
 			
 			return $this->render('Search/widget_'.$this->ops_tablename.'_search_tools.php', true);
 		}
 		# -------------------------------------------------------
 	}
