<?php
    /**
     * @package     Searching through Tarian
     * @copyright   Copyright (c) 2020 Irianto Liko Koten
     * @developer iriantokoten@gmail.com
     * @license     GNU
     */
    


    set_include_path(get_include_path() . PATH_SEPARATOR . './easyrdf/lib/');
    require_once "./easyrdf/lib/EasyRdf.php";
    require_once "./easyrdf/examples/html_tag_helpers.php";

    // Setup some additional prefixes
    EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
	EasyRdf_Namespace::set('tar', 'http://dpch.oss.web.id/Bali/TriHitaKarana.owl#');

    $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/tujuh/query');

    function viewData($request){
		extract($request,EXTR_SKIP);
		
		include ("thk_ontology.php");
		$error ="";
		if($cbsearching==""){
			$error .="Tidak ada output yang dipilih!<br>";
		}
		if($error==""){
			$qoansambel = "";
			$qoarah = "";
			$qofungsi = "";
			$qojumlah = "";
			$qosound = "";
			$qodimension = "";
			$qopengangge = "";
			$qobahanbaku = "";
			$qotipesuara = "";

			//kondisi untuk query output
			
			//if($cbsearching=="barungan"){
			//	$qoansambel = "";
			//}
			

			

			$qaktivitas = "";
			$qgolongan = "";
			$qinstrumen = "";
			$qjumlahpemaingamelan = "";
			$qjumlahnada = "";
			$qkategori = "";
			$qlaras = "";
			$qteknikpermainan = "";
			
			//kondisi untuk query input
			$s_input = "";
			//if($cbsearching=="barungan"){
        $cbsearching = str_replace(' ', '_', $cbsearching);
				$qsearching = "tar:$cbsearching ?predicate ?object ";
				$s_input .="Searching : ".$cbsearching.",";
			//}
			/*if($cbinputgolongan!=""){
				$qgolongan = "?$cboutput thk:memilikiGolongan thk:$cbinputgolongan . ";
				$s_input .=" Golongan : ".$cbinputgolongan.",";
			}
			if($cbinputinstrumen!=""){
				$qinstrumen = "?$cboutput thk:memilikiInstrumen thk:$cbinputinstrumen .
							";
				$s_input .=" Instrumen : ".$cbinputinstrumen.",";
			}
			if($cbinputjumlahnada!=""){
				$qjumlahnada = "?$cboutput thk:memilikiJumlahNada thk:$cbinputjumlahnada .
							";
				$s_input .=" Jumlah Nada : ".$cbinputjumlahnada.",";
			}
			if($cbinputjumlahpemaingamelan!=""){
				$qjumlahpemaingamelan = "?$cboutput thk:memilikiJumlahPemain thk:$cbinputjumlahpemaingamelan .
							";
				$s_input .=" Jumlah Pemain Gamelan : ".$cbinputjumlahpemaingamelan.",";
			}
			if($cbinputkategori!=""){
				$qkategori = "?$cboutput thk:termasukDalamKategori thk:$cbinputkategori .
							";
				$s_input .=" Kategori : ".$cbinputkategori.",";
			}
			if($cbinputlaras!=""){
				$qlaras = "?$cboutput thk:memilikiLaras thk:$cbinputlaras .
							";
				$s_input .=" Laras : ".$cbinputlaras.",";
			}
			if($cbinputteknikpermainan!=""){
				$qteknikpermainan = "?$cboutput thk:memilikiTeknikPermainan thk:$cbinputteknikpermainan .
							";
				$s_input .=" Teknik Permainan : ".$cbinputteknikpermainan.",";
			}
			if($inpt_jumlah!=""){
				$qjumlah = "?kulkulName thk:numberKulkul $inpt_jumlah .
								?tempat thk:hasKulkul ?kulkulName .";
				$s_input .=" Jumlah Kulkul : ".$inpt_jumlah.",";
			}
			if($inpt_tempat!=""){
				$qtempat = "?tempat thk:hasKulkul ?kulkulName .
							  ?tempat a thk:$inpt_tempat .
					  FILTER (?tempat NOT IN (owl:NamedIndividual))
					?tempat thk:isPartOf* ?kabupaten .
					?kabupaten a thk:Kabupaten .";
				$s_input .=" Lokasi : ".$inpt_tempat.",";
			}
			if($inpt_pengangge!=""){
				$qpengangge = "?kulkulName thk:hasPengangge thk:$inpt_pengangge .
								?tempat thk:hasKulkul ?kulkulName .";
				$s_input .=" Pengangge : ".$inpt_pengangge.",";
			}
			if($inpt_suara!=""){
				$qsuara = "?kulkulName thk:hasSound ?sound01 .
							?sound01 rdfs:label ?sound .
							?tempat thk:hasKulkul ?kulkulName .
							?sound01 thk:isSoundFor ?aktivitas .
							FILTER (CONTAINS (?sound, '$inpt_suara'))";
				$s_input .=" Suara Kulkul : ".$inpt_suara.",";
			}
			if($inpt_tipesuara!=""){
				$qtipesuara = "?kulkulName thk:hasSound ?sound01 .
								?sound01 thk:hasSoundFile ?soundFile .
										?kulkulName thk:hasSoundFile ?soundFile .
										?soundFile thk:hasUrl ?soundUrl .
										?soundFile thk:hasResourceType thk:$inpt_tipesuara .
								?tempat thk:hasKulkul ?kulkulName .";
				$s_input .=" Tipe Suara : ".$inpt_tipesuara.",";
			}
			if($inpt_ukuran!=""){
				$qdimensi = "?kulkulName thk:hasDimension thk:$inpt_ukuran .
									  thk:$inpt_ukuran rdfs:label ?dimension02 .
							?tempat thk:hasKulkul ?kulkulName .";
				$s_input .=" Ukuran Kulkul : ".$inpt_ukuran.",";
			}*/

			


			$qc = $sparql->query(
					"SELECT DISTINCT ?object WHERE
					{
						".$qsearching." .FILTER (?predicate != <http://schema.org/image> ) . ?object rdf:type/rdfs:subClassOf* tar:NamaTarian
						
					} ORDER BY ?object");//memfilter biar tidak ada image //mengeluarkan hasil berupa nama tarian yg terkait dengan instance yg diinputkan, lalu menampilkan sesuai objek yang dicari atau kata kunci yang diinputkan
			$view ="<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"box box-success\" style=\"padding:20px 20px 20px 40px\">
								<div class=\"row\">
									<div class=\"col-md-5\">
									<h3>Hasil Pencarian:</h3>";
			$i = 1;
			foreach ($qc as $dc) {
				
					$voutput = $dc->object;
					$tempString = $voutput;
			          	$tempArray = explode("#",$tempString);
			          	$tempString = $tempArray[1];
			          	$voutput = $tempString;
			          	$outputlink = preg_replace('/(?<! )[A-Z]/', ' $0', $voutput);
			          	$outputlink = str_replace('_', '', $outputlink);
	          		$voutput = "<a href=\"./browsingResult.php?action=viewlink&value=".$voutput."\">".$outputlink."</a>";
				

				$view .=$i.". ".$voutput."<br>";
				$i++;
			}

        if ($qsearching != '') {
                  $tempString1 = $qsearching;
                  $tempArray3  = explode(":",$tempString1);
                  $tempString1 = $tempArray3[1];
                  $tempString1 = str_replace('?predicate ?object', '', $tempString1);
                  $tempString1 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString1);
                  $tempString1 = str_replace(' tar', ' ', $tempString1);
                  $qsearching  = $tempString1;
                  $qsearching .= "<br>";
                  $qsearching = str_replace('_', ' ', $qsearching);
              }


      $view .="       </div>
                  <div class=\"col-md-7\">
                    <div class=\"alert alert-info alert-dismissable\">
                      
                      <p style=\"font-size:20px\"><b>QUERY</p>
                      Tampilkan Nama Tarian Yang Berhubungan Dengan</b> <br>
                        ".$qsearching."                      
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>";
		}
		else{
			$view ="<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"box box-success\" style=\"padding:20px\"><br>
								".$error."";
			$view .="		</div>
						</div>
					</div>";
		}
		return $view;
	}

	function viewFormSearch($request){
		extract($request,EXTR_SKIP);
		include ("thk_ontology.php");	

$formActivity = "";
        $liActivity = "";
        $tempActivity = "";
        $resultActivity1 = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdfs:subClassOf tar:Hazard }");
        $resultActivity2 = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:Hazard }");
        foreach ($resultActivity1 as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempActivity = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $liActivity .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempActivity."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }
        foreach ($resultActivity2 as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempActivity = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formActivity .= "<option value=".$tempActivity.">".$string."</option>"; 
        }

        $formKegSosial = "";
        $liKegSosial = "";
        $tempInstrumen = "";
        $resultKegSosial = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:KegiatanSosial }");
        foreach ($resultKegSosial as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempKegSosial = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formKegSosial .= "<option value=".$tempKegSosial.">".$string."</option>";
          $liKegSosial .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempKegSosial."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        $formUpacara = "";
        $liUpacara = "";
        $tempUpacara = "";
        $resultUpacara1 = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdfs:subClassOf tar:Upacara }");
        $resultUpacara2 = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:Upacara }");
        foreach ($resultUpacara1 as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempUpacara = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $liUpacara .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempUpacara."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }
        foreach ($resultUpacara2 as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempUpacara = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formUpacara .= "<option value=".$tempUpacara.">".$string."</option>"; 
        }

        $formTempat = "";
        $liTempat = "";
        $tempTempat = "";
        $resultTempat1 = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdfs:subClassOf tar:Space }");
        $resultTempat2 = $sparql->query( //query sparql
        "select * where {  ?column ?p ?o . FILTER (?o IN (tar:Regency, tar:CapitalCity, tar:District ) ) . FILTER (?p != <http://www.w3.org/2000/01/rdf-schema#domain>) . FILTER (?p != <http://www.w3.org/2000/01/rdf-schema#range>)}");
        foreach ($resultTempat1 as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempTempat = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $liTempat .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempTempat."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        foreach ($resultTempat2 as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempTempat = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formTempat .= "<option value=".$tempTempat.">".$string."</option>"; 
        }


        $formPracticesPeriod = "";
        $liPracticesPeriod = "";
        $tempPracticesPeriod = "";
        $resultPracticesPeriod = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:PracticesPeriod }");
        foreach ($resultPracticesPeriod as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempPracticesPeriod = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formPracticesPeriod .= "<option value=".$tempPracticesPeriod.">".$string."</option>";
          $liPracticesPeriod .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempPracticesPeriod."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        $formJenisTari = "";
        $liJenisTari = "";
        $tempJenisTari = "";
        $resultJenisTari = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:JenisTari }");
        foreach ($resultJenisTari as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempJenisTari = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formJenisTari .= "<option value=".$tempJenisTari.">".$string."</option>";
          $liJenisTari .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempJenisTari."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        $formPelakuTari = "";
        $liPelakuTari = "";
        $tempPelakuTari = "";
        $resultPelakuTari = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:PelakuTari }");
        foreach ($resultPelakuTari as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempPelakuTari = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formPelakuTari .= "<option value=".$tempPelakuTari.">".$string."</option>";
          $liPelakuTari .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempPelakuTari."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        $formAtributTari = "";
        $liAtributTari = "";
        $tempAtributTari = "";
        $resultAtributTari = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:AtributTari }");
        foreach ($resultAtributTari as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempAtributTari = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formAtributTari .= "<option value=".$tempAtributTari.">".$string."</option>";
          $liAtributTari .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempAtributTari."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        $formInstrumenPengiring = "";
        $liInstrumenPengiring = "";
        $tempInstrumenPengiring = "";
        $resultInstrumenPengiring = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:InstrumenPengiring }");
        foreach ($resultInstrumenPengiring as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempInstrumenPengiring = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
          $formInstrumenPengiring .= "<option value=".$tempInstrumenPengiring.">".$string."</option>";
          $liInstrumenPengiring .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempInstrumenPengiring."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }

        $formNamaTarian = "";
        $liNamaTarian = "";
        $tempNamaTarian = "";
        $resultNamaTarian = $sparql->query( //query sparql
        "SELECT DISTINCT * { ?column rdf:type tar:NamaTarian }");
        foreach ($resultNamaTarian as $row) {  //perulangan option
          $array = explode("#",$row->column);
          $string = $array[1];
          $tempNamaTarian = $string;
          $string = preg_replace('/(?<! )[A-Z]/', ' $0', $string);
          $string = str_replace('_', ' ', $string);
            
          $formNamaTarian .= "<li><a href=\"./browsingList.php?action=viewlink&value=".$tempNamaTarian."\">".$string."</a></li>";
          $liNamaTarian .= "<li class=\"nav-item\">
                <a href=\"./browsingList.php?action=viewlink&value=".$tempNamaTarian."\" class=\"nav-link\">
                  <i class=\"far fa-circle nav-icon\"></i>
                  <p>".$string."</p>
                </a>
              </li>";
        }
        
        $view = "<html>
					<head>
					<meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple Searching | Tarian Tradisional Bali</title>
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">

      <!-- Font Awesome -->
      <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all.min.css\">
      <!-- Ionicons -->
      <link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css\">
      <!-- overlayScrollbars -->
      <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.2/css/adminlte.min.css\" integrity=\"sha256-tDEOZyJ9BuKWB+BOSc6dE4cI0uNznodJMx11eWZ7jJ4=\" crossorigin=\"anonymous\" />
      <!-- Google Font: Source Sans Pro -->
      <link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700\" rel=\"stylesheet\">";
					 
		$view .= "</head>
					<body class=\"hold-transition sidebar-mini\">

					<div class=\"wrapper\">
					<!-- Navbar -->
  <nav class=\"main-header navbar navbar-expand navbar-white navbar-light\">
    <!-- Left navbar links -->
    <ul class=\"navbar-nav\">
      <li class=\"nav-item\">
        <a class=\"nav-link\" data-widget=\"pushmenu\" href=\"#\"><i class=\"fas fa-bars\"></i></a>
      </li>
      <li class=\"nav-item d-none d-sm-inline-block\">
        <a href=\"./index.php\" class=\"nav-link\">Home</a>
      </li>
      <li class=\"nav-item d-none d-sm-inline-block\">
        <a href=\"./browsing.php\" class=\"nav-link\">Browsing</a>
      </li>
      <li class=\"nav-item d-none d-sm-inline-block\">
        <a href=\"./searching.php\" class=\"nav-link\">Searching</a>
      </li>
      <li class=\"nav-item d-none d-sm-inline-block\">
        <a href=\"./simpleSearching.php\" class=\"nav-link\">Simple Searching</a>
      </li>  
      <li class=\"nav-item d-none d-sm-inline-block\">
        <a href=\"https://forms.gle/mJR9n1KWuS8tyEZQ7\" class=\"nav-link\">Questionnaire</a>
      </li>
    </ul>

    

    <!-- Right navbar links -->
    <ul class=\"navbar-nav ml-auto\">
      <!-- Messages Dropdown Menu -->
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link\" data-toggle=\"dropdown\" href=\"#\">
          <i class=\"far fa-comments\"></i>
          <span class=\"badge badge-danger navbar-badge\">3</span>
        </a>
        <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">
          <a href=\"#\" class=\"dropdown-item\">
            <!-- Message Start -->
            <div class=\"media\">
              <img src=\"irianto.jpg\" alt=\"User Avatar\" class=\"img-size-50 mr-3 img-circle\">
              <div class=\"media-body\">
                <h3 class=\"dropdown-item-title\">
                  Brad Diesel
                  <span class=\"float-right text-sm text-danger\"><i class=\"fas fa-star\"></i></span>
                </h3>
                <p class=\"text-sm\">Call me whenever you can...</p>
                <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item\">
            <!-- Message Start -->
            <div class=\"media\">
              <img src=\"irianto.jpg\" alt=\"User Avatar\" class=\"img-size-50 img-circle mr-3\">
              <div class=\"media-body\">
                <h3 class=\"dropdown-item-title\">
                  John Pierce
                  <span class=\"float-right text-sm text-muted\"><i class=\"fas fa-star\"></i></span>
                </h3>
                <p class=\"text-sm\">I got your message bro</p>
                <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item\">
            <!-- Message Start -->
            <div class=\"media\">
              <img src=\"irianto.jpg\" alt=\"User Avatar\" class=\"img-size-50 img-circle mr-3\">
              <div class=\"media-body\">
                <h3 class=\"dropdown-item-title\">
                  Nora Silvester
                  <span class=\"float-right text-sm text-warning\"><i class=\"fas fa-star\"></i></span>
                </h3>
                <p class=\"text-sm\">The subject goes here</p>
                <p class=\"text-sm text-muted\"><i class=\"far fa-clock mr-1\"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item dropdown-footer\">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link\" data-toggle=\"dropdown\" href=\"#\">
          <i class=\"far fa-bell\"></i>
          <span class=\"badge badge-warning navbar-badge\">15</span>
        </a>
        <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">
          <span class=\"dropdown-item dropdown-header\">15 Notifications</span>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item\">
            <i class=\"fas fa-envelope mr-2\"></i> 4 new messages
            <span class=\"float-right text-muted text-sm\">3 mins</span>
          </a>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item\">
            <i class=\"fas fa-users mr-2\"></i> 8 friend requests
            <span class=\"float-right text-muted text-sm\">12 hours</span>
          </a>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item\">
            <i class=\"fas fa-file mr-2\"></i> 3 new reports
            <span class=\"float-right text-muted text-sm\">2 days</span>
          </a>
          <div class=\"dropdown-divider\"></div>
          <a href=\"#\" class=\"dropdown-item dropdown-footer\">See All Notifications</a>
        </div>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link\" data-widget=\"control-sidebar\" data-slide=\"true\" href=\"#\">
          <i class=\"fas fa-th-large\"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class=\"main-sidebar sidebar-dark-primary elevation-4\">
 

    <!-- Sidebar -->
    <div class=\"sidebar\">
      <!-- Sidebar user (optional) -->
      <div class=\"user-panel mt-3 pb-3 mb-3 d-flex\">
        <div class=\"image\">
          <img src=\"irianto.jpg\" class=\"img-circle elevation-2\" alt=\"User Image\">
        </div>
        <div class=\"info\">
          <a href=\"#\" class=\"d-block\">Tarian Tradisional Bali</a>
        </div>
      </div>
            <!-- Sidebar Menu -->
      <nav class=\"mt-2\">
        <ul class=\"nav nav-pills nav-sidebar flex-column\" data-widget=\"treeview\" role=\"menu\" data-accordion=\"false\">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class=\"nav-header\">KELAS</li>
          
          <li class=\"nav-item has-treeview\">
            <a href=\"#\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Aktivitas
                <i class=\"right fas fa-angle-left\"></i>
              </p>
            </a>
            <ul class=\"nav nav-treeview\">
              ".$liActivity."
            </ul>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=KegiatanSosial\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Kegiatan Sosial
              </p>
            </a>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"#\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Upacara
                <i class=\"right fas fa-angle-left\"></i>
              </p>
            </a>
            <ul class=\"nav nav-treeview\">
              ".$liUpacara."
            </ul>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"#\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Tempat
                <i class=\"right fas fa-angle-left\"></i>
              </p>
            </a>
            <ul class=\"nav nav-treeview\">
              ".$liTempat."
            </ul>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=PracticesPeriod\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Periode Praktek
              </p>
            </a>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=JenisTari\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Jenis Tari
              </p>
            </a>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=PelakuTari\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Pelaku Tari
              </p>
            </a>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=AtributTari\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Atribut Tari
              </p>
            </a>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=InstrumenPengiring\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Instrumen Pengiring
              </p>
            </a>
          </li>

          <li class=\"nav-item has-treeview\">
            <a href=\"./browsingList.php?action=viewlink&value=NamaTarian\" class=\"nav-link\">
              <i class=\"nav-icon fas fa-circle\"></i>
              <p>
                Nama Tarian
              </p>
            </a>
          </li>


        </ul>
      </nav>
      
      </div>
    <!-- /.sidebar -->
  </aside>
      ";


		$view .= "<div class=\"content-wrapper\">
    
		    <section class=\"content-header\">
		      <div class=\"container-fluid\">
		        <div class=\"row mb-2\">
		          <div class=\"col-sm-6\">
		            <h1>Simple Searching</h1>
		          </div>
		          <div class=\"col-sm-6\">
		            <ol class=\"breadcrumb float-sm-right\">
		              <li class=\"breadcrumb-item\"><a href=\"#\">Home</a></li>
		              <li class=\"breadcrumb-item active\">Simple Searching</li>
		            </ol>
		          </div>
		        </div>
		      </div>
		    </section>

		    
		    <section class=\"content\">

		      
		      <div class=\"card card-dark card-outline col-md-12\">
		        <div class=\"card-header\">
		          <h3 class=\"card-title\">Form Pencarian</h3>

		          <div class=\"card-tools\">
		            <button type=\"button\" class=\"btn btn-tool\" data-card-widget=\"collapse\" data-toggle=\"tooltip\" title=\"Collapse\">
		              <i class=\"fas fa-minus\"></i></button>
		            <button type=\"button\" class=\"btn btn-tool\" data-card-widget=\"remove\" data-toggle=\"tooltip\" title=\"Remove\">
		              <i class=\"fas fa-times\"></i></button>
		          </div>
		        </div>
		        <div class=\"card-body\">";

		$view .= "<form class=\"form-inline\" id=\"formSearch\" action=\"javascript:void(0);\">
      <div class=\"input-group input-group-lg\">
        <input class=\"form-control form-control-navbar\" type=\"search\" placeholder=\"Search\" aria-label=\"Search\" name=\"cbsearching\" id=\"cbsearching\">
        
      </div>
    </form>

				<div class=\"form-group\">
					<label class=\"col-sm-2 control-label\"></label>
					<div class=\"col-sm-10\">
						
							
							<input type=\"button\" class=\"btn btn-success\" onclick=\"viewData();\" value=\"Cari\" />
							</form>
						<!---->
						<input type=\"button\" class=\"btn btn-warning\" onclick=\"window.location.reload();\" value=\"Reset\" />
					</div>
				</div>

                </form>
                

        
        
        
        <div id=\"wadahHasil\" class=\"row\">
			<p id=\"wadahError\" class=\"text-danger\">Masukan kata kunci yang ingin dicari.</p>
		</div>
		";
		$view .= "
		</div>
        <!-- /.card-body -->
        <div class=\"card-footer\">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class=\"main-footer\">
    <div class=\"float-right d-none d-sm-block\">
      <b>Version</b> 1.2.0
    </div>
    <strong>Copyright © 2019-2020 <a href=\"http://tari.oss.web.id\">Tarian Tradisional Bali</a>.</strong> All rights
    reserved.
  </footer>

  

  <!-- Control Sidebar -->
  <aside class=\"control-sidebar control-sidebar-dark\">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js\" integrity=\"sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=\" crossorigin=\"anonymous\"></script>
<!-- Bootstrap 4 -->
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js\"></script>
<!-- AdminLTE App -->
<script src=\"https://cdn.bootcss.com/admin-lte/3.0.2/js/adminlte.min.js\"></script>
<!-- AdminLTE for demo purposes -->
<script src=\"https://cdn.jsdelivr.net/npm/admin-lte@3.0.2/dist/js/demo.js\"></script>
</body>
</html>
";
		return $view;
	}
?>

      

<script languange="javascript">
  $(function () {
    //Initialize Select2 Elements
    //$('.select2').select2()

    // mengambil referensi semua dropdown
	var vSearching = document.getElementById('cbsearching');
	
	var wadahQuery = document.getElementById('wadahQuery');/**/
	var p = document.getElementById('wadahError');
	var wadahHasil = document.getElementById('wadahHasil');

	
    /*$error = 0;
    if(vOutput.value == ""){
      $error = 1;
    }

    // menampilkan data inputan semua dropdown
    document.getElementById('showVal').onclick = function () {
        wOutput.value = vOutput.value;  
        wAktivitas.value = vAktivitas.value;
        wAnsambel.value = vAnsambel.value;  
        wInstrumen.value = vInstrumen.value;
        wFitur.value = vFitur.value;
        wPeran.value = vPeran.value;
        wSumberSuara.value = vSumberSuara.value;
        wLaras.value = vLaras.value;
    }*/

    document.getElementById('resetPencarian').onclick = function () {
      vOutput.selectedIndex = 0;
      vAktivitas.selectedIndex = 0;
      vAnsambel.selectedIndex = 0;
      vInstrumen.selectedIndex = 0;
      vFitur.selectedIndex = 0;
      vPeran.selectedIndex = 0;
      vSumberSuara.selectedIndex = 0;
      vLaras.selectedIndex = 0;
    }

    document.getElementById('viewData').onclick = function () {
      
      if(vOutput.value == ""){ //Jika output belum dipilih maka muncul error
        wadahHasil.style.display = "none";
        p.style.display = "block";

      }
      	else{ //Tapi jika output telah dipilih maka jalankan fungsi query
			wadahHasil.style.display = "block";
			p.style.display = "none";


			//insert query
			wadahQuery.value = "SELECT DISTINCT (?"+vOutput.value+" as ?output) { "+vAktivitas.value+" "+vAnsambel.value+" "+vInstrumen.value+" "+vFitur.value+" "+vPeran.value+" "+vSumberSuara.value+" "+vLaras.value+" } ORDER BY ?output";
			
			//tampilkan hasil query

			/*if ($(wadahQuery).val() != 0) {
				$.post("searchingResult.php", {
					variable:wadahQuery
				}, 
				function(data) {
					if (data != "") {
						alert('We sent Jquery string to PHP : ' + data);
					}
				});
			}
			var xhr = new XMLHttpRequest();
			xhr.open("POST", yourUrl, true);
			xhr.setRequestHeader('Content-Type', 'application/json');
			xhr.send(JSON.stringify({
				value: wadahQuery
			}));

			var http1 = new XMLHttpRequest();
			http1.open("POST","searchingResult.php",true);
			
			// Set headers
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.setRequestHeader("Content-length", params.length);
			http.setRequestHeader("Connection", "close");

			http.onreadystatechange = function(){
				if(http.readyState == 4 && http.status == 200){
					document.getElementById("response").innerHTML = http.responseText;
				}
			}

			http.send(params);
			formsubmission.preventDefault();

			var http = new XMLHttpRequest();
			var url = 'searchingResult.php';
			var params = 'data=ipsum&wadahQuery='+wadahQuery.value;
			http.open('POST', url, true);
			alert('We sent Jquery string to PHP : ' + params);
			//Send the proper header information along with the request
			http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			http.onreadystatechange = function() {//Call a function when the state changes.
				if(http.readyState == 4 && http.status == 200) {
					alert(http.responseText);
				}
			}
			http.send(params);*/

			

    	}
	  	
		
		
    }
})
</script>



<script languange="javascript">
					$(function(){
					  $("#header").load("header.html"); 
					  $("#footer").load("footer.html"); 
					});

					function viewDivOutput(){
						var t = document.getElementById('cboutput');
						var selectedText = t.options[t.selectedIndex].text;
						var v_output = $('#cboutput').val();
						$('#output').val(v_output);
						$('#output_view').val(selectedText);
					}
					function viewInputTempat(value1,value2){
						var y = document.getElementById('divtempat');
						y.style.display = 'block';
						$('#inpt_tempat').val(value1);
						$('#divtempat').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".LOCATION." : '+value2+'</button>')
					}
					function viewInputActivity(value1,value2){
						var y = document.getElementById('divactivity');
						y.style.display = 'block';
						$('#inpt_activity').val(value1);
						$('#divactivity').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".ACTIVITY." : '+value2+'</button>')
					}
					function viewInputUkuran(value1,value2){
						var y = document.getElementById('divukuran');
						y.style.display = 'block';
						$('#inpt_ukuran').val(value1);
						$('#divukuran').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".DIMENSION." : '+value2+'</button>')
					}
					function viewInputJumlah(value){
						var y = document.getElementById('divjumlah');
						y.style.display = 'block';
						$('#inpt_jumlah').val(value);
						$('#divjumlah').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".NUMBER_KULKUL." : '+value+'</button>')
					}
					function viewInputPengangge(value1,value2){
						var y = document.getElementById('divpengangge');
						y.style.display = 'block';
						$('#inpt_pengangge').val(value1);
						$('#divpengangge').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".PENGANGGE." : '+value2+'</button>')
					}
					function viewInputArahKulkul(value1,value2){
						var y = document.getElementById('divarah');
						y.style.display = 'block';
						$('#inpt_arah').val(value1);
						$('#divarah').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".ARAH_KULKUL." : '+value2+'</button>')
					}
					function viewInputBahanKulkul(value1,value2){
						var y = document.getElementById('divbahanbaku');
						y.style.display = 'block';
						$('#inpt_bahanbaku').val(value1);
						$('#divbahanbaku').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".BAHAN_BAKU_KULKUL." : '+value2+'</button>')
					}
					function viewInputSuaraKulkul(value1,value2){
						var y = document.getElementById('divsuara');
						y.style.display = 'block';
						$('#inpt_suara').val(value1);
						$('#divsuara').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".SUARA_KULKUL." : '+value2+'</button>')
					}
					function viewInputSoundType(value1,value2){
						var y = document.getElementById('divtipesuara');
						y.style.display = 'block';
						$('#inpt_tipesuara').val(value1);
						$('#divtipesuara').html('<button type="button" title="".DELETE_INPUT_FILTER."" onclick="$(this).remove();" class="btn btn-labeled btn-primary btn-xs"><span class="btn-label"><i class="glyphicon glyphicon-remove"></i></span>".SOUND_TYPE." : '+value2+'</button>')
					}
					
					function resetPencarian() {
						var vOutput = document.getElementById('cboutput');
						var vAktivitas = document.getElementById('cbinputaktivitas');
						var vGolongan = document.getElementById('cbinputgolongan');
						var vInstrumen = document.getElementById('cbinputinstrumen');
						var vJumlahNada = document.getElementById('cbinputjumlahnada');
						var vJumlahPemainGamelan = document.getElementById('cbinputjumlahpemaingamelan');
						var vKategori = document.getElementById('cbinputkategori');
						var vLaras = document.getElementById('cbinputlaras');
						var vTeknikPermainan = document.getElementById('cbinputteknikpermainan');
						vOutput.selectedIndex = 0;
					    vAktivitas.selectedIndex = 0;
					    vGolongan.selectedIndex = 0;
					    vInstrumen.selectedIndex = 0;
					    vJumlahNada.selectedIndex = 0;
					    vJumlahPemainGamelan.selectedIndex = 0;
					    vKategori.selectedIndex = 0;
					    vLaras.selectedIndex = 0;
					    vTeknikPermainan.selectedIndex = 0;
					}
					function viewData(){
						// mengambil referensi semua dropdown
						var vOutput = document.getElementById('cbsearching');
						
						var wadahQuery = document.getElementById('wadahQuery');/**/
						var p = document.getElementById('wadahError');
						var wadahHasil = document.getElementById('wadahHasil');
						
						wadahHasil.style.display = "none";
						p.style.display = "none";

						if(vOutput.value == ""){ //Jika output belum dipilih maka muncul error
						wadahHasil.style.display = "none";
						p.style.display = "block";

						}
						else{ //Tapi jika output telah dipilih maka jalankan fungsi query
							wadahHasil.style.display = "block";
							p.style.display = "none";
							var urltarget = '?action=viewdata';
							var query = $('#formSearch').serialize();

							//alert(' : ' + query);
							$.ajax({
								type: 'POST',
								url: urltarget,
								data: query,
								success: function(response){
									response = response.replace(/^s+|s+$/g,'');
									$('#wadahHasil').html(response);
									//alert('Success! ' + response);
								}
							});
							
						}
					}
					
				</script>
	<?php
	if (!stripos($_SERVER["PHP_SELF"],"modules")){
		
		if(!isset($_GET['action'])){
			//echo headerHTML(createHeader($_REQUEST),$_REQUEST);
			echo viewFormSearch($_REQUEST);
			//echo footerHTML($_REQUEST);
			//echo "Action is empty";
		}else{
			$action=$_GET['action'];
			if ($action=="viewdata"){
				echo viewData($_REQUEST);
				//echo "Action is not empty";
			}
		}

	}else{
		echo "<script type=\"text/javascript\">location.href = '/index.php';</script>";
	}
	?>

