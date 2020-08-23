<?php
    /**
     * @package    	Searching through Tarian
     * @copyright  	Copyright (c) 2020 Irianto Liko Koten
     * @developer	iriantokoten@gmail.com
     * @license    	GNU
     */
    


    set_include_path(get_include_path() . PATH_SEPARATOR . './easyrdf/lib/');
    require_once "./easyrdf/lib/EasyRdf.php";
    require_once "./easyrdf/examples/html_tag_helpers.php";

    // Setup some additional prefixes
    EasyRdf_Namespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    EasyRdf_Namespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
    EasyRdf_Namespace::set('owl', 'http://www.w3.org/2002/07/owl#');
	EasyRdf_Namespace::set('tar', 'http://www.semanticweb.org/user/ontologies/2019/9/untitled-ontology-19#');

    $sparql = new EasyRdf_Sparql_Client('http://localhost:3030/tujuh/query');

    function viewData($request){
		extract($request,EXTR_SKIP);
		

		include ("thk_ontology.php");
		$error ="";
		if($cboutput==""){
			$error .="Tidak ada output yang dipilih!<br>";
		}
		if($error==""){
			$qotari = "";
			$qoarah = "";
			$qofungsi = "";
			$qojumlah = "";
			$qosound = "";
			$qodimension = "";
			$qopengangge = "";
			$qobahanbaku = "";
			$qotipesuara = "";

			//kondisi untuk query output
			if($cboutput=="tari"){
				$qotari = "";
			}

			
			$qatributtari = "";
			$qinstrumenpengiring = "";
			$qaktivitas = "";
			$qkegsosial = "";
			$qupacara = "";
			$qtempat = "";
			$qperiodepraktek = "";
			$qjenistari = "";
			$qpelakutari = "";
			//kondisi untuk query input
			$s_input = "";
			if($cbinputaktivitas!=""){
				$qaktivitas = "?$cboutput tar:DitarikanSaat tar:$cbinputaktivitas .";
				$s_input .="Aktivitas : ".$cbinputaktivitas.",";
			}
			if($cbinputkegsosial!=""){
				$qkegsosial = "?$cboutput tar:DitarikanSaat tar:$cbinputkegsosial .";
				$s_input .=" Kegiatan Sosial : ".$cbinputkegsosial.",";
			}
			if($cbinputupacara!=""){
				$qupacara = "?$cboutput tar:DitarikanSaat tar:$cbinputupacara .";
				$s_input .=" Upacara : ".$cbinputupacara.",";
			}
			if($cbinputtempat!=""){
				$qtempat = "?$cboutput tar:BerasalDari tar:$cbinputtempat .";
				$s_input .=" Tempat : ".$cbinputtempat.",";
			}
			if($cbinputperiodepraktek!=""){
				$qperiodepraktek = "?$cboutput tar:MunculAntaraTahun tar:$cbinputperiodepraktek .";
				$s_input .=" Periode Praktek : ".$cbinputperiodepraktek.",";
			}
			if($cbinputjenistari!=""){
				$qjenistari = "?$cboutput tar:MerupakanJenisTari tar:$cbinputjenistari .";
				$s_input .=" Jenis Tari : ".$cbinputjenistari.",";
			}
			if($cbinputpelakutari!=""){
				$qpelakutari = "?$cboutput tar:DitarikanOleh tar:$cbinputpelakutari .";
				$s_input .=" Pelaku Tari : ".$cbinputpelakutari.",";
			}
			if($cbinputatributtari!=""){
				$qatributtari = "?$cboutput tar:MenggunakanAtribut tar:$cbinputatributtari .";
				$s_input .=" Atribut Tari : ".$cbinputatributtari.",";
			}
			if($cbinputinstrumenpengiring!=""){
				$qinstrumenpengiring = "?$cboutput tar:DiiringiDenganInstrumen tar:$cbinputinstrumenpengiring .";
				$s_input .=" Instrumen Pengiring : ".$cbinputinstrumenpengiring.",";
			}
			/*if($inpt_jumlah!=""){
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
					"SELECT DISTINCT (?$cboutput as ?output)
					{
						".$qotari."
						".$qofungsi."
						".$qojumlah."
						".$qosound."
						".$qodimension."
						".$qopengangge."
						".$qobahanbaku."
						".$qotipesuara."

						".$qaktivitas."
						".$qkegsosial."
						".$qupacara."
						".$qtempat."
						".$qperiodepraktek."
						".$qjenistari."
						".$qpelakutari."
						".$qatributtari."
						".$qinstrumenpengiring."
					} ORDER BY ?output");
			$view ="<div class=\"row\">
						<div class=\"col-md-12\">
							<div class=\"box box-success\" style=\"padding:20px 20px 20px 40px\">
								<div class=\"row\">
									<div class=\"col-md-5\">
									<h3>OUTPUT</h3>";
			$i = 1;
			foreach ($qc as $dc) {
				if($cboutput=="jumlahkulkul"){
					$voutput = $dc->output;
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$voutput."&tipe=kulkuljumlah\">".$voutput."</a>";
				}else if($cboutput=="tempat"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					//banjar
					$temp_tempat = substr($outputlink,0,4);
					if($temp_tempat=="Banj"){
						$voutput = "<a href=\"?page=Browsing&action=viewdetailbanjar&banjar_desc=".$outputlink."&kab_desc=".$kab_desc."\">".$voutput."</a>";
					}else if($temp_tempat=="Desa"){
						$voutput = "<a href=\"?page=Browsing&language=".$language."&domain=".$domain."&action=banjar&desa_desc=".$outputlink."&kab_desc=".$kab_desc."\">".$voutput."</a>";
					}else if($temp_tempat=="Pura"){
						$tempat_desc_pura = str_replace('PuraDesa','',$outputlink);
						$tempat_desc_pura = str_replace('PuraPuseh','',$tempat_desc_pura);
						$tempat_desc_pura = str_replace('PuraDalem','',$tempat_desc_pura);
						$voutput = "<a href=\"?page=Pura&action=pura&desa_desc=".$tempat_desc_pura."&kab_desc=".$kab_desc."&purakhayangan=".$outputlink."\">".$voutput."</a>";
					}

				}else if($cboutput=="rawMaterial"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$outputlink."&tipe=kulkulbahan\">".$voutput."</a>";
				}else if($cboutput=="dimension"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$outputlink."&tipe=kulkulukuran\">".$voutput."</a>";
				}else if($cboutput=="pengangge"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$outputlink."&tipe=kulkulpengangge\">".$voutput."</a>";
				}else if($cboutput=="sound"){
					$voutput = $dc->output;
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$voutput."&tipe=kulkulsound\">".$voutput."</a>";
				}else if($cboutput=="resourceType"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$outputlink."&tipe=kulkultypesuara\">".$voutput."</a>";
				}else if($cboutput=="aktivitas"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$outputlink."&tipe=kulkulactivity\">
									".$voutput."
								</a>";
				}else if($cboutput=="direction"){
					$voutput = trim(parsingString("#",$dc->output,1));
					$outputlink = str_replace(' ', '', $voutput);
					$voutput = "<a href=\"?page=Browsing&action=viewlink&value=".$voutput."&tipe=kulkularah\">".$outputlink."</a>";
				}else{
					$voutput = $dc->output;
					if(strstr($voutput, '#') == false){
			          	$tempString = $voutput;
			          	$tempArray = explode("/",$tempString);
			          	$tempString = $tempArray[3];
			          	$voutput = $tempString;
		          	}
		          	else{
		          		$tempString = $voutput;
			          	$tempArray = explode("#",$tempString);
			          	$tempString = $tempArray[1];
			          	$voutput = $tempString;
	          		}
	          		$outputlink = str_replace('_', ' ', $voutput);
	          		$voutput = "<a href=\"./browsingResult.php?action=viewlink&value=".$voutput."\">".$outputlink."</a>";
				}

				$view .=$i.". ".$voutput."<br>";
				$i++;
			}
				
				if ($qaktivitas != '') {
						$tempString1 = $qaktivitas;
			          	$tempArray1  = explode(":",$tempString1);
			          	$tempString1 = $tempArray1[1];
			          	$tempString1 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString1);
						$tempString1 = str_replace(' tar', ' ', $tempString1);
			          	$tempString2 = $qaktivitas;
			          	$tempArray1  = explode(":",$tempString2);
			          	$tempString2 = $tempArray1[2];
			          	$tempString2 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString2);
			          	$tempString2 = str_replace('.', '', $tempString2);
			          	$qaktivitas = $tempString1;
			          	$qaktivitas .= $tempString2;
			          	$qaktivitas .= "<br>";
	          			$qaktivitas = str_replace('_', ' ', $qaktivitas);
				}
			          	
				if ($qkegsosial != '') {
			          	$tempString17 = $qkegsosial;
			          	$tempArray2  = explode(":",$tempString17);
			          	$tempString17 = $tempArray2[1];
			          	$tempString17 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString17);
						$tempString17 = str_replace(' tar', ' ', $tempString17);
			          	$tempString18 = $qkegsosial;
			          	$tempArray2  = explode(":",$tempString18);
			          	$tempString18 = $tempArray2[2];
			          	$tempString18 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString18);
			          	$tempString18 = str_replace('.', '', $tempString18);
			          	$qkegsosial = $tempString17;
			          	$qkegsosial .= $tempString18;
			          	$qkegsosial .= "<br>";
	          			$qkegsosial = str_replace('_', ' ', $qkegsosial);
				}

				if ($qupacara != '') {
			          	$tempString3 = $qupacara;
			          	$tempArray3  = explode(":",$tempString3);
			          	$tempString3 = $tempArray3[1];
			          	$tempString3 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString3);
						$tempString3 = str_replace(' tar', ' ', $tempString3);
			          	$tempString4 = $qupacara;
			          	$tempArray3  = explode(":",$tempString4);
			          	$tempString4 = $tempArray3[2];
			          	$tempString4 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString4);
			          	$tempString4 = str_replace('.', '', $tempString4);
			          	$qupacara = $tempString3;
			          	$qupacara .= $tempString4;
			          	$qupacara .= "<br>";
	          			$qupacara = str_replace('_', ' ', $qupacara);
	          	}

				if ($qtempat != '') {
			          	$tempString5 = $qtempat;
			          	$tempArray4  = explode(":",$tempString5);
			          	$tempString5 = $tempArray4[1];
			          	$tempString5 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString5);
						$tempString5 = str_replace(' tar', ' ', $tempString5);
			          	$tempString6 = $qtempat;
			          	$tempArray4  = explode(":",$tempString6);
			          	$tempString6 = $tempArray4[2];
			          	$tempString6 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString6);
			          	$tempString6 = str_replace('.', '', $tempString6);
			          	$qtempat = $tempString5;
			          	$qtempat .= $tempString6;
			          	$qtempat .= "<br>";
	          			$qtempat = str_replace('_', ' ', $qtempat);
	          	}

				if ($qperiodepraktek != '') {
			          	$tempString7 = $qperiodepraktek;
			          	$tempArray5  = explode(":",$tempString7);
			          	$tempString7 = $tempArray5[1];
			          	$tempString7 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString7);
						$tempString7 = str_replace(' tar', ' ', $tempString7);
			          	$tempString8 = $qperiodepraktek;
			          	$tempArray5  = explode(":",$tempString8);
			          	$tempString8 = $tempArray5[2];
			          	$tempString8 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString8);
			          	$tempString8 = str_replace('.', '', $tempString8);
			          	$qperiodepraktek = $tempString7;
			          	$qperiodepraktek .= $tempString8;
			          	$qperiodepraktek .= "<br>";
	          			$qperiodepraktek = str_replace('_', ' ', $qperiodepraktek);
	          	}

				if ($qjenistari != '') {
			          	$tempString9 = $qjenistari;
			          	$tempArray6  = explode(":",$tempString9);
			          	$tempString9 = $tempArray6[1];
			          	$tempString9 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString9);
						$tempString9 = str_replace(' tar', ' ', $tempString9);
			          	$tempString10 = $qjenistari;
			          	$tempArray6  = explode(":",$tempString10);
			          	$tempString10 = $tempArray6[2];
			          	$tempString10 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString10);
			          	$tempString10 = str_replace('.', '', $tempString10);
			          	$qjenistari = $tempString9;
			          	$qjenistari .= $tempString10;
			          	$qjenistari .= "<br>";
	          			$qjenistari = str_replace('_', ' ', $qjenistari);
	          	}

				if ($qpelakutari != '') {
			          	$tempString11 = $qpelakutari;
			          	$tempArray7  = explode(":",$tempString11);
			          	$tempString11 = $tempArray7[1];
			          	$tempString11 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString11);
						$tempString11 = str_replace(' tar', ' ', $tempString11);
			          	$tempString12 = $qpelakutari;
			          	$tempArray7  = explode(":",$tempString12);
			          	$tempString12 = $tempArray7[2];
			          	$tempString12 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString12);
			          	$tempString12 = str_replace('.', '', $tempString12);
			          	$qpelakutari = $tempString11;
			          	$qpelakutari .= $tempString12;
			          	$qpelakutari .= "<br>";
	          			$qpelakutari = str_replace('_', ' ', $qpelakutari);
	          	}

				if ($qatributtari != '') {
			          	$tempString13 = $qatributtari;
			          	$tempArray8  = explode(":",$tempString13);
			          	$tempString13 = $tempArray8[1];
			          	$tempString13 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString13);
						$tempString13 = str_replace(' tar', ' ', $tempString13);
			          	$tempString14 = $qatributtari;
			          	$tempArray8  = explode(":",$tempString14);
			          	$tempString14 = $tempArray8[2];
			          	$tempString14 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString14);
			          	$tempString14 = str_replace('.', '', $tempString14);
			          	$qatributtari = $tempString13;
			          	$qatributtari .= $tempString14;
			          	$qatributtari .= "<br>";
	          			$qatributtari = str_replace('_', ' ', $qatributtari);
	          	}

				if ($qinstrumenpengiring != '') {
			          	$tempString15 = $qinstrumenpengiring;
			          	$tempArray9  = explode(":",$tempString15);
			          	$tempString15 = $tempArray9[1];
			          	$tempString15 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString15);
						$tempString15 = str_replace(' tar', ' ', $tempString15);
			          	$tempString16 = $qinstrumenpengiring;
			          	$tempArray9  = explode(":",$tempString16);
			          	$tempString16 = $tempArray9[2];
			          	$tempString16 = preg_replace('/(?<! )[A-Z]/', ' $0', $tempString16);
			          	$tempString16 = str_replace('.', '', $tempString16);
			          	$qinstrumenpengiring = $tempString15;
			          	$qinstrumenpengiring .= $tempString16;
			          	$qinstrumenpengiring .= "<br>";
	          			$qinstrumenpengiring = str_replace('_', ' ', $qinstrumenpengiring);
	          	}


			$view .="				</div>
									<div class=\"col-md-7\">
										<div class=\"alert alert-info alert-dismissable\">
											
											<p style=\"font-size:20px\"><b>QUERY</p>
											Tampilkan Nama Tarian Yang </b> <br>
												".$qaktivitas."
												".$qkegsosial."
												".$qupacara."
												".$qtempat."
												".$qperiodepraktek."
												".$qjenistari."
												".$qpelakutari."
												".$qatributtari."
												".$qinstrumenpengiring."
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>";
		}else{
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
    <title>Searching | Tarian Tradisional Bali</title>
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

  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class=\"main-sidebar sidebar-dark-primary elevation-4\">
    <!-- Brand Logo -->
    <!--<a href=\"/index.php\" class=\"brand-link\">
      <img src=\"https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.2/img/AdminLTELogo.png\"
           alt=\"AdminLTE Logo\"
           class=\"brand-image img-circle elevation-3\"
           style=\"opacity: .8\">
      <span class=\"brand-text font-weight-light\">Tarian Tradisional Bali</span>
    </a>-->

    <!-- Sidebar -->
    <div class=\"sidebar\">
      <!-- Sidebar user (optional) -->
      <div class=\"user-panel mt-3 pb-3 mb-3 d-flex\">
        <div class=\"image\">
          <img src=\"irianto.jpg\" class=\"img-circle elevation-2\" alt=\"User Image\">
        </div>
        <div class=\"info\">
          <a href=\".\index.php\" class=\"d-block\">Tarian Tradisional Bali</a>
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
		            <h1>Searching</h1>
		          </div>
		          <div class=\"col-sm-6\">
		            <ol class=\"breadcrumb float-sm-right\">
		              <li class=\"breadcrumb-item\"><a href=\"#\">Home</a></li>
		              <li class=\"breadcrumb-item active\">Searching</li>
		            </ol>
		          </div>
		        </div>
		      </div>
		    </section>

		    
		    <section class=\"content\">

		    <div class=\"col-md-12\">
		      
		      <div class=\"card card-outline card-dark\">
		        <div class=\"card-header\">
		          <h3 class=\"card-title\">Form Pencarian</h3>
		        </div>
		        <div class=\"card-body\">";

		$view .= "<form id=\"formSearch\" class=\"form-horizontal\" action=\"javascript:void(0);\">
			<div class=\"card card-bg-dark col-md-4\">
                <div class=\"form-group \">
                    <h4 id=\"current-place\">Output</h4>
                        <select name=\"cboutput\" id=\"cboutput\" class=\"form-control\">
                         <option value=\"\">Pilih...</option>
                         <option value=\"tari\">Tari</option>                          
                        </select>
                </div>
            </div>


                      <h4 id=\"current-place\">Input</h4>

		<!-- /.row -->
        	<div class=\"row\">
          		<div class=\"col-md-4\">
					<div class=\"card card-bg-dark col-md-10\">
                      <div class=\"form-group\">
                        <label>Aktivitas Bencana</label>
                        <select name=\"cbinputaktivitas\" id=\"cbinputaktivitas\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                          ".$formActivity."
                        </select>
                      </div>

                      <div class=\"form-group\">
                        <label>Kegiatan Sosial</label>
                        <select name=\"cbinputkegsosial\" id=\"cbinputkegsosial\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                         ".$formKegSosial."
                        </select>
                      </div> 

                      <div class=\"form-group\">
                        <label>Upacara</label>
                        <select name=\"cbinputupacara\" id=\"cbinputupacara\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                          ".$formUpacara."
                        </select>
                      </div>
                    </div>
          		</div>

          <!-- /.col -->

          		<div class=\"col-md-4\">
					<div class=\"card card-bg-dark col-md-10\">
                      <div class=\"form-group\">
                        <label>Tempat</label>
                        <select name=\"cbinputtempat\" id=\"cbinputtempat\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                          ".$formTempat."
                        </select>
                      </div>

                      <div class=\"form-group\">
                        <label>Periode Praktek</label>
                        <select name=\"cbinputperiodepraktek\" id=\"cbinputperiodepraktek\" class=\"form-control\">
                          <option value=\"\">Tidak ada</option>
                          ".$formPracticesPeriod."
                        </select>
                      </div>

                      <div class=\"form-group\">
                        <label>Jenis Tari</label>
                        <select name=\"cbinputjenistari\" id=\"cbinputjenistari\" class=\"form-control\">
                          <option value=\"\">Tidak ada</option>                         
                        ".$formJenisTari."
                        </select>  
                      </div>
                    </div>
          		</div>

          <!-- /.col -->

		  		<div class=\"col-md-4\">
					<div class=\"card card-bg-dark col-md-10\">
                      <div class=\"form-group\">
                        <label>Pelaku Tari</label>
                        <select name=\"cbinputpelakutari\" id=\"cbinputpelakutari\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                          ".$formPelakuTari."
                        </select>
                      </div>

                      <div class=\"form-group\">
                        <label>Atribut Tari</label>
                        <select name=\"cbinputatributtari\" id=\"cbinputatributtari\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                          ".$formAtributTari."
                        </select>
                      </div>

                      <div class=\"form-group\">
                        <label>Instrumen Pengiring</label>
                        <select name=\"cbinputinstrumenpengiring\" id=\"cbinputinstrumenpengiring\" class=\"form-control\">
                        <option value=\"\">Tidak ada</option>
                          ".$formInstrumenPengiring."
                        </select>
                      </div>
                    </div>
          		</div>

	          	<div class=\"col-md-12\">
					<div class=\"form-group\">
						<label class=\"col-sm-10 control-label\"></label>
						<div class=\"col-sm-10\">
							
								
								<input type=\"button\" class=\"btn btn-success\" onclick=\"viewData();\" value=\"Cari\" />
								</form>
							<!---->
							<input type=\"button\" class=\"btn btn-warning\" onclick=\"window.location.reload();\" value=\"Reset\" />
						</div>
					</div>
	 				<div id=\"wadahHasil\" class=\"row\">
						<p id=\"wadahError\" class=\"text-danger\"></p>
					</div>
	                </form>
	               
	          	</div>
	        </div>


		";
		$view .= "
		</div>
		</div>
        <!-- /.card-body -->
     
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

    <a id=\"back-to-top \" href=\"#\" class=\"card card-primary back-to-top bg-dark \" role=\"button\" aria-label=\"Scroll to top\">
      <i class=\" col-md fas fa-chevron-up \"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->


  <footer class=\"main-footer\">
    <strong>Copyright © 2019-2020 <a href=\".\index.php\">Tarian Tradisional Bali</a>.</strong> All rights
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
	var vOutput = document.getElementById('cboutput');
	var vAktivitas = document.getElementById('cbinputaktivitas');
	var vAnsambel = document.getElementById('cbinputkegsosial');
	var vInstrumen = document.getElementById('cbinputupacara');
	var vFitur = document.getElementById('cbinputtempat');
	var vPeran = document.getElementById('cbinputperiodepraktek');
	var vSumberSuara = document.getElementById('cbinputjenistari');
	var vLaras = document.getElementById('cbinputinstrumenpengiring');
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

					
					
					function resetPencarian() {
						var vOutput = document.getElementById('cboutput');
						var vAktivitas = document.getElementById('cbinputaktivitas');
						var vKegSosial = document.getElementById('cbinputkegsosial');
						var vUpacara = document.getElementById('cbinputupacara');
						var vTempat = document.getElementById('cbinputtempat');
						var vPeriodePraktek = document.getElementById('cbinputperiodepraktek');
						var vJenisTari = document.getElementById('cbinputjenistari');
						var vPelakuTari = document.getElementById('cbinputpelakutari');
						var vAtributTari = document.getElementById('cbinputatributtari');
						var vInstrumenPengiring = document.getElementById('cbinputinstrumenpengiring');
						vOutput.selectedIndex = 0;
					    vAktivitas.selectedIndex = 0;
					    vKegSosial.selectedIndex = 0;
					    vUpacara.selectedIndex = 0;
					    vTempat.selectedIndex = 0;
					    vPeriodePraktek.selectedIndex = 0;
					    vJenisTari.selectedIndex = 0;
					    vAtributTari.selectedIndex = 0;
					    vInstrumenPengiring.selectedIndex = 0;
					}
					function viewData(){
						// mengambil referensi semua dropdown
						var vOutput = document.getElementById('cboutput');
						var vAktivitas = document.getElementById('cbinputaktivitas');
						var vKegSosial = document.getElementById('cbinputkegsosial');
						var vUpacara = document.getElementById('cbinputupacara');
						var vTempat = document.getElementById('cbinputtempat');
						var vPeriodePraktek = document.getElementById('cbinputperiodepraktek');
						var vJenisTari = document.getElementById('cbinputjenistari');
						var vPelakuTari = document.getElementById('cbinputpelakutari');
						var vAtributTari = document.getElementById('cbinputatributtari');
						var vInstrumenPengiring = document.getElementById('cbinputinstrumenpengiring');
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

