<?php
/* ----------------------------------------------------------------------
 * app/service/controllers/GraphQLController.php :
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
 * ----------------------------------------------------------------------
 */

	use GraphQL\GraphQL;
	use GraphQL\Type\Schema;
	use GraphQL\Type\Definition\ObjectType;
	use GraphQL\Type\Definition\Type;
	
	require_once(__CA_LIB_DIR__.'/Service/BaseServiceController.php');

	class GraphQLController extends BaseServiceController {
		# -------------------------------------------------------
		public function __construct(&$po_request, &$po_response, $pa_view_paths) {
 			parent::__construct($po_request, $po_response, $pa_view_paths);
 		}
		# -------------------------------------------------------
		public function __call($ps_table, $pa_args){
			$queryType = new ObjectType([
				'name' => 'Query',
				'fields' => [
					'echo' => [
						'type' => Type::string(),
						'args' => [
							'id' => Type::nonNull(Type::int()),
							'bundle' => Type::nonNull(Type::string()),
						],
						'resolve' => function ($rootValue, $args) {
							$o = new ca_objects($args['id']);
							return $o->get($args['bundle']);
						}
					],
				],
			]);
			$schema = new Schema([
				'query' => $queryType
			]);

			$rawInput = file_get_contents('php://input');
			$input = json_decode($rawInput, true);
			$query = $input['query'];
			$variableValues = isset($input['variables']) ? $input['variables'] : null;

			try {
				$rootValue = ['prefix' => 'You said: '];
				$result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
				$output = $result->toArray();
			} catch (\Exception $e) {
				$output = [
					'errors' => [
						[
							'message' => $e->getMessage()
						]
					]
				];
			}
			
			if(intval($this->request->getParameter("pretty",pInteger))>0){
				$this->view->setVar("pretty_print",true);
			}
						
			$this->view->setVar("content",$output);
			$this->render("json.php");
		}
		# -------------------------------------------------------
	}
