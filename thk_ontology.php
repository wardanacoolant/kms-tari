<?php
/*
*Ontology connection to THK 
*/

		extract($request,EXTR_SKIP);
			include("easyrdf/lib/EasyRdf.php");
			require_once "easyrdf/examples/html_tag_helpers.php";
			
			// Setup some prefixes
			EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
			EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
			EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
			EasyRdf_Namespace::set('tar', 'http://www.semanticweb.org/user/ontologies/2019/9/untitled-ontology-19#');
			
			$sparql = new EasyRdf_Sparql_Client('http://localhost:3030/tujuh/query');






?>