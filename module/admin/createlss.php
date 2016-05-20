<?php
	// this page is to create LS .lss file for importing survey in LS
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 11-05-2016
	
	//function for db conn and session check
	include_once('../../service/common/db_connection.php');
	include_once('../../lib/log4php/Logger.php');
	Logger::configure('../../config/log_config.xml');
	$log = Logger::getLogger('createlss.php');
	$log->debug("**** START - createlss.php ****");
	session_start();
	if (isset($_SESSION["user"])){
		// get the file name = userid_GUID_e.xml
		$Filename = ($_SESSION['Filename']);
		
	}else
	{
		header("Location: ../../service/common/error_page.php");
	}
	 

	try{
		// substring the GUID from the file name
			$file_name=explode("_", $Filename);
			$GUID = $file_name[1];
		// log file name and GUID

			$log->INFO('filename:'.$Filename.'  GUID:'.$GUID);

		
        //Logic
			//1. fetch from DB msi_tools the data for exam (from table t_exam_org_qp)
			$query = "SELECT exam_id,exam_name
					  FROM t_exam_org_qp
					  ORDER BY exam_id DESC 
					  LIMIT 1";
			$result = mysqli_query($connection, $query);
			$row = mysqli_fetch_assoc($result);
			$exam_id = $row["exam_id"];
			$exam_name = $row["exam_name"];

			//create XMl  according to template
			$xml = new DOMDocument('1.0', 'UTF-8');
			$xml->formatOutput=true;
			$doc = $xml->createElement("document");
			$xml->appendChild($doc);
			$lsdt=$xml->createElement("LimeSurveyDocType","Survey");
			$doc->appendChild($lsdt);
			//add DBversion in config file and 
			$db_v=$xml->createElement("DBVersion",LS_DBversion);
			$doc->appendChild($db_v);
			$lan=$xml->createElement("languages");
			$doc->appendChild($lan);
			$lan_en=$xml->createElement("language","en");
			$lan->appendChild($lan_en);

			//fields of answer
			$ans=$xml->createElement("answers");
			$doc->appendChild($ans);
			$feilds=$xml->createElement("fields");
			$ans->appendChild($feilds);
			$feildname=$xml->createElement("fieldname","qid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","code");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","answer");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","sortorder");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","assessment_value");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","language");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","scale_id");
			$feilds->appendChild($feildname);		
	        $rows=$xml->createElement("rows");
			$ans->appendChild($rows);

			// for each question in exam get answers
			$query = "SELECT qid
					  FROM r_exam_que
					  WHERE exam_id ='{$exam_id}'";
			$result = mysqli_query($connection, $query);
			while($q_row = mysqli_fetch_assoc($result)){
				$q_id = $q_row["qid"];
				$a_query = "SELECT a_desc,
				                   a_scaleid,
				                   a_sortorder,
				                   a_lang_code
				            FROM t_ansbank
				            WHERE qid = '{$q_id}'";
				$a_result = mysqli_query($connection, $a_query);
				while($a_row = mysqli_fetch_assoc($a_result)){
					$row=$xml->createElement("row");
					$rows->appendChild($row);
					
					$qid=$xml->createElement("qid");
					$row->appendChild($qid);
					$qid->appendChild($xml->createCDATASection($q_id)); 
							
					$code=$xml->createElement("code");
					$row->appendChild($code); 
					$code->appendChild($xml->createCDATASection($a_row['a_sortorder'])); 
							
					$answer=$xml->createElement("answer");
					$row->appendChild($answer);
					$answer->appendChild($xml->createCDATASection($a_row["a_desc"])); 
					
					$sort_order=$xml->createElement("sortorder");
					$row->appendChild($sort_order);
					$sort_order->appendChild($xml->createCDATASection($a_row['a_sortorder'])); 
					
					$av=$xml->createElement("assessment_value");
					$row->appendChild($av);
					$av->appendChild($xml->createCDATASection(0));
					
					$lan=$xml->createElement("language");
					$row->appendChild($lan);
					$lan->appendChild($xml->createCDATASection($a_row["a_lang_code"]));
					
					$scale=$xml->createElement("scale_id");
					$row->appendChild($scale);
					$scale->appendChild($xml->createCDATASection($a_row["a_scaleid"]));

				}//end of answer query loop

			} // end of question query loop

			//creating groups
			$grp=$xml->createElement("groups");
			$doc->appendChild($grp);
			$feilds=$xml->createElement("fields");
			$grp->appendChild($feilds);
			$feildname=$xml->createElement("fieldname","gid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","sid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","group_name");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","group_order");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","description");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","language");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","randomization_group");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","grelevance");
			$feilds->appendChild($feildname);
			$rows=$xml->createElement("rows");
			$grp->appendChild($rows);

			//nos as a group
			$n_query = "SELECT nos_code
						FROM t_exam_nos_pc
						WHERE exam_id = '{$exam_id}'";
			$n_result = mysqli_query($connection,$n_query);
			while($n_row = mysqli_fetch_assoc($n_result)){
				//it is a nos id which is treated a s group id
				$g_id = $n_row["nos_code"];

				
				$row=$xml->createElement("row");
				$rows->appendChild($row);
						
				$gid=$xml->createElement("gid");
				$row->appendChild($gid);
				$gid->appendChild($xml->createCDATASection(1)); 
						
				$sid=$xml->createElement("sid");
				$row->appendChild($sid); 
				$sid->appendChild($xml->createCDATASection($exam_id)); 

				$n_query="SELECT nos_name,
								 nos_desc
						  FROM t_nos
						  WHERE nos_code ='{$g_id}'";
				$n_result1=mysqli_query($connection,$n_query);
				$n_row1=mysqli_fetch_assoc($n_result1);						
				$gn=$xml->createElement("group_name");
				$row->appendChild($gn);
				$gn->appendChild($xml->createCDATASection($n_row1["nos_name"])); 
						
				$go=$xml->createElement("group_order");
				$row->appendChild($go);
				$go->appendChild($xml->createCDATASection(0)); 
						
				$desc=$xml->createElement("description");
				$row->appendChild($desc);
				$desc->appendChild($xml->createCDATASection($n_row1["nos_desc"])); 
						
				$lan=$xml->createElement("language");
				$row->appendChild($lan);
				$lan->appendChild($xml->createCDATASection("en")); 
						
				$rand_g=$xml->createElement("randomization_group");
				$row->appendChild($rand_g);
						
				$grel=$xml->createElement("grelevance");
				$row->appendChild($grel);
				$grel->appendChild($xml->createCDATASection(1));
			}
			//groups ended

			//question XML
				//fields
			
			$que=$xml->createElement("questions");
			$doc->appendChild($que);	
			$feilds=$xml->createElement("fields");
			$que->appendChild($feilds);
			$feildname=$xml->createElement("fieldname","qid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","parent_qid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","sid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","gid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","type");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","title");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","question");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","preg");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","help");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","other");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","mandatory");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","question_order");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","language");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","scale_id");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","same_default");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","relevance");
			$feilds->appendChild($feildname);
			$rows=$xml->createElement("rows");
			$que->appendChild($rows);

			//question's data 
			$num = 0;
			$query = "SELECT qid
					  FROM r_exam_que
					  WHERE exam_id ='{$exam_id}'";
			$result = mysqli_query($connection, $query);
			while($q_row1=mysqli_fetch_assoc($result)){
$log->debug("###########################################################################");
				$log->debug($q_row1);
				$log->debug("###########################################################################");
				$q_id = $q_row1["qid"];
				//qd = question's detail
				$qd_query = "SELECT q_type_code,
									q_description,
									q_lang_code
							 FROM t_qbank
							 WHERE qid = '{$q_id}'";
				$qd_result = mysqli_query($connection,$qd_query);
				$qd_row = mysqli_fetch_assoc($qd_result);

				$row=$xml->createElement("row");
				$rows->appendChild($row);
				$qid=$xml->createElement("qid"); 
				$row->appendChild($qid);
				$qid->appendChild($xml->createCDATASection($q_id)); 
				$pid=$xml->createElement("parent_qid");
				$row->appendChild($pid);
				$pid->appendChild($xml->createCDATASection(0)); 
				$sid=$xml->createElement("sid");
				$row->appendChild($sid);
				$sid->appendChild($xml->createCDATASection($exam_id));
				$gid=$xml->createElement("gid");
				$row->appendChild($gid);
				$gid->appendChild($xml->createCDATASection(1));
				$type=$xml->createElement("type");
				$row->appendChild($type);
				$type->appendChild($xml->createCDATASection($qd_row['q_type_code']));		   
				$title=$xml->createElement("title");
				$row->appendChild($title);
				$title->appendChild($xml->createCDATASection("Q".($num + 1)));		//look what title question should have   
				//need to update CDATA if queation have image or video
				$question=$xml->createElement("question");
				$row->appendChild($question);
				$question->appendChild($xml->createCDATASection($qd_row["q_description"]));
				$preg=$xml->createElement("preg");
				$row->appendChild($preg);
				$help=$xml->createElement("help");
				$row->appendChild($help);  
				$other=$xml->createElement("other");
				$row->appendChild($other);
				$other->appendChild($xml->createCDATASection("N"));
				$mandatory=$xml->createElement("mandatory");
				$row->appendChild($mandatory);
				$mandatory->appendChild($xml->createCDATASection("Y"));
				$question_order=$xml->createElement("question_order");
				$row->appendChild($question_order);
				$question_order->appendChild($xml->createCDATASection($num));
				$language=$xml->createElement("language");
				$row->appendChild($language);
				$language->appendChild($xml->createCDATASection($qd_row["q_lang_code"]));
				$scale_id=$xml->createElement("scale_id");
				$row->appendChild($scale_id);
				$scale_id->appendChild($xml->createCDATASection(0));
				$same_default=$xml->createElement("same_default");
				$row->appendChild($same_default);
				$same_default->appendChild($xml->createCDATASection(1));
				$relevance=$xml->createElement("relevance");
				$row->appendChild($relevance);
				$relevance->appendChild($xml->createCDATASection(1));

				$num = $num + 1;

			}

			// A subxml for exam
			$sur=$xml->createElement("surveys");
			$doc->appendChild($sur);
			$feilds=$xml->createElement("fields");
			$sur->appendChild($feilds);
			$feildname=$xml->createElement("fieldname","sid");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","admin");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","expires");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","startdate");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","adminemail");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","anonymized");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","faxto");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","format");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","savetimings");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","template");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","language");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","additional_languages");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","datestamp");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","usecookie");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","allowregister");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","allowsave");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","autonumber_start");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","autoredirect");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","allowprev");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","printanswers");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","ipaddr");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","refurl");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","publicstatistics");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","publicgraphs");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","listpublic");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","htmlemail");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","sendconfirmation");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","tokenanswerspersistence");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","assessments");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","usecaptcha");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","usetokens");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounce_email");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","attributedescriptions");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","emailresponseto");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","emailnotificationto");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","tokenlength");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","showxquestions");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","showgroupinfo");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","shownoanswer");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","showqnumcode");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bouncetime");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounceprocessing");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounceaccounttype");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounceaccounthost");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounceaccountpass");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounceaccountencryption");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","bounceaccountuser");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","showwelcome");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","showprogress");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","questionindex");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","navigationdelay");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","nokeyboard");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","alloweditaftercompletion");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","googleanalyticsstyle");
			$feilds->appendChild($feildname);
			
			$rows=$xml->createElement("rows");
			$sur->appendChild($rows);
			$row=$xml->createElement("row");
			$rows->appendChild($row);		  
			$sid=$xml->createElement("sid");
			$row->appendChild($sid);
			$sid->appendChild($xml->createCDATASection($exam_id));		  
			$admin=$xml->createElement("admin");
			$row->appendChild($admin);
			$admin->appendChild($xml->createCDATASection(admin));		  
			$adminemail=$xml->createElement("adminemail");
			$row->appendChild($adminemail);
			$adminemail->appendChild($xml->createCDATASection(adminMail));	
			$anonymized=$xml->createElement("anonymized");
			$row->appendChild($anonymized);
			$anonymized->appendChild($xml->createCDATASection("N"));		  
			$faxto=$xml->createElement("faxto");
			$row->appendChild($faxto);		  
			$format=$xml->createElement("format");
			$row->appendChild($format);
			$format->appendChild($xml->createCDATASection("S"));		  
			$savetimings=$xml->createElement("savetimings");
			$row->appendChild($savetimings);
			$savetimings->appendChild($xml->createCDATASection("Y"));		  
			$template=$xml->createElement("template");
			$row->appendChild($template);
			$template->appendChild($xml->createCDATASection("ubuntu_orange"));		  
			$language=$xml->createElement("language");
			$row->appendChild($language);
			$language->appendChild($xml->createCDATASection("en"));		  
			$additional_languages=$xml->createElement("additional_languages");
			$row->appendChild($additional_languages);				  
			$datestamp=$xml->createElement("datestamp");
			$row->appendChild($datestamp);
			$datestamp->appendChild($xml->createCDATASection("Y"));		  
			$usecookie=$xml->createElement("usecookie");
			$row->appendChild($usecookie);
			$usecookie->appendChild($xml->createCDATASection("N"));		  
			$allowregister=$xml->createElement("allowregister");
			$row->appendChild($allowregister);
			$allowregister->appendChild($xml->createCDATASection("N"));		  
			$allowsave=$xml->createElement("allowsave");
			$row->appendChild($allowsave);
			$allowsave->appendChild($xml->createCDATASection("Y"));		  
			$autonumber_start=$xml->createElement("autonumber_start");
			$row->appendChild($autonumber_start);
			$autonumber_start->appendChild($xml->createCDATASection(1));		  
			$autoredirect=$xml->createElement("autoredirect");
			$row->appendChild($autoredirect);
			$autoredirect->appendChild($xml->createCDATASection("N"));		  
			$allowprev=$xml->createElement("allowprev");
			$row->appendChild($allowprev);
			$allowprev->appendChild($xml->createCDATASection("Y"));	  
			$printanswers=$xml->createElement("printanswers");
			$row->appendChild($printanswers);
			$printanswers->appendChild($xml->createCDATASection("N"));		  
			$ipaddr=$xml->createElement("ipaddr");
			$row->appendChild($ipaddr);
			$ipaddr->appendChild($xml->createCDATASection("Y"));	  
			$refurl=$xml->createElement("refurl");
			$row->appendChild($sid);
			$refurl->appendChild($xml->createCDATASection("Y"));		  
			$publicstatistics=$xml->createElement("publicstatistics");
			$row->appendChild($publicstatistics);
			$publicstatistics->appendChild($xml->createCDATASection("N"));		  
			$publicgraphs=$xml->createElement("publicgraphs");
			$row->appendChild($publicgraphs);
			$publicgraphs->appendChild($xml->createCDATASection("N"));	  
			$listpublic=$xml->createElement("listpublic");
			$row->appendChild($listpublic);
			$listpublic->appendChild($xml->createCDATASection("N"));	  
			$htmlemail=$xml->createElement("htmlemail");
			$row->appendChild($htmlemail);
			$htmlemail->appendChild($xml->createCDATASection("N"));	  
			$sendconfirmation=$xml->createElement("sendconfirmation");
			$row->appendChild($sendconfirmation);
			$sendconfirmation->appendChild($xml->createCDATASection("Y"));	  
			$tokenanswerspersistence=$xml->createElement("tokenanswerspersistence");
			$row->appendChild($tokenanswerspersistence);
			$tokenanswerspersistence->appendChild($xml->createCDATASection("N"));  
			$assessments=$xml->createElement("assessments");
			$row->appendChild($assessments);
			$assessments->appendChild($xml->createCDATASection("N"));	  
			$usecaptcha=$xml->createElement("usecaptcha");
			$row->appendChild($usecaptcha);
			$usecaptcha->appendChild($xml->createCDATASection("N"));  
			$usetokens=$xml->createElement("usetokens");
			$row->appendChild($usetokens);
			$usetokens->appendChild($xml->createCDATASection("N")); 
			$bounce_email=$xml->createElement("bounce_email");
			$row->appendChild($bounce_email);
			$bounce_email->appendChild($xml->createCDATASection(adminMail));  
			$emailresponseto=$xml->createElement("emailresponseto");
			$row->appendChild($emailresponseto);
			$emailnotificationto=$xml->createElement("emailnotificationto");
			$row->appendChild($emailnotificationto);		 
			$tokenlength=$xml->createElement("tokenlength");
			$row->appendChild($tokenlength);
			$tokenlength->appendChild($xml->createCDATASection(15));  
			$showxquestions=$xml->createElement("showxquestions");
			$row->appendChild($showxquestions);
			$showxquestions->appendChild($xml->createCDATASection("Y")); 
			$showgroupinfo=$xml->createElement("showgroupinfo");
			$row->appendChild($showgroupinfo);
			$showgroupinfo->appendChild($xml->createCDATASection("N"));  
			// if this doesn't work then chage groupinfo value to null
			$shownoanswer=$xml->createElement("shownoanswer");
			$row->appendChild($shownoanswer);
			$shownoanswer->appendChild($xml->createCDATASection("Y"));  
			$showqnumcode=$xml->createElement("showqnumcode");
			$row->appendChild($showqnumcode);
			$showqnumcode->appendChild($xml->createCDATASection("X"));
			$bounceprocessing=$xml->createElement("bounceprocessing");
			$row->appendChild($bounceprocessing);
			$bounceprocessing->appendChild($xml->createCDATASection("N")); 
			$showwelcome=$xml->createElement("showwelcome");
			$row->appendChild($showwelcome);
			$showwelcome->appendChild($xml->createCDATASection("Y")); 
			$showprogress=$xml->createElement("showprogress");
			$row->appendChild($showprogress);
			$showprogress->appendChild($xml->createCDATASection("Y"));
			$questionindex=$xml->createElement("questionindex");
			$row->appendChild($questionindex);
			$questionindex->appendChild($xml->createCDATASection(0)); 
			$navigationdelay=$xml->createElement("navigationdelay");
			$row->appendChild($navigationdelay);
			$navigationdelay->appendChild($xml->createCDATASection(0));
			$nokeyboard=$xml->createElement("nokeyboard");
			$row->appendChild($nokeyboard);
			$nokeyboard->appendChild($xml->createCDATASection("N")); 
			$alloweditaftercompletion=$xml->createElement("alloweditaftercompletion");
			$row->appendChild($alloweditaftercompletion);
			$alloweditaftercompletion->appendChild($xml->createCDATASection("N"));
			$googleanalyticsstyle=$xml->createElement("googleanalyticsstyle");
			$row->appendChild($googleanalyticsstyle);
			$googleanalyticsstyle->appendChild($xml->createCDATASection(0));



			//languagesettings
			$sls=$xml->createElement("surveys_languagesettings");
			$doc->appendChild($sls);
			$feilds=$xml->createElement("fields");
			$sls->appendChild($feilds);
			$feildname=$xml->createElement("fieldname","surveyls_survey_id");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_language");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_title");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_description");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_welcometext");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_endtext");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_url");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_urldescription");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_invite_subj");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_invite");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_remind_subj");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_remind");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_register_subj");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_register");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_confirm_subj");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_email_confirm");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_dateformat");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_attributecaptions");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","email_admin_notification_subj");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","email_admin_notification");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","email_admin_responses_subj");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","email_admin_responses");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","surveyls_numberformat");
			$feilds->appendChild($feildname);
			$feildname=$xml->createElement("fieldname","attachments");
			$feilds->appendChild($feildname);
			
			$rows=$xml->createElement("rows");
			$sls->appendChild($rows);
			$row=$xml->createElement("row");
			$rows->appendChild($row);		  
			$surveyls_survey_id=$xml->createElement("surveyls_survey_id");
			$row->appendChild($surveyls_survey_id);
			$surveyls_survey_id->appendChild($xml->createCDATASection($exam_id));
			$surveyls_language=$xml->createElement("surveyls_language");
			$row->appendChild($surveyls_language);
			$surveyls_language->appendChild($xml->createCDATASection("en"));
			$surveyls_title=$xml->createElement("surveyls_title");
			$row->appendChild($surveyls_title);
			$surveyls_title->appendChild($xml->createCDATASection($n_row1["nos_name"]." ".$exam_id));
			$surveyls_description=$xml->createElement("surveyls_description");
			$row->appendChild($surveyls_description);
			$surveyls_description->appendChild($xml->createCDATASection($exam_name));
			$surveyls_welcometext=$xml->createElement("surveyls_welcometext");
			$row->appendChild($surveyls_welcometext);
			$surveyls_welcometext->appendChild($xml->createCDATASection("Welcome To ".$n_row1["nos_name"]." test"));
			$surveyls_endtext=$xml->createElement("surveyls_endtext");
		 	$row->appendChild($surveyls_endtext);
		 	$surveyls_endtext->appendChild($xml->createCDATASection("Thank you. You Have completed the exam".$exam_name."  Click The Link Below To Submit Your Result"));
		 	$surveyls_url=$xml->createElement("surveyls_url");
			$row->appendChild($surveyls_url);
			//this is a link where user will come at the end of survey and we have to add code to export the result here to matchand show the number of correct reponse
			$surveyls_url->appendChild($xml->createCDATASection("http://52.39.26.22/myskillindex/module/candidate/Thank.php"));
			$surveyls_urldescription=$xml->createElement("surveyls_urldescription");
			$row->appendChild($surveyls_urldescription);
			$surveyls_urldescription->appendChild($xml->createCDATASection("To see your result, Click on link above it"));
			//below is the email survey format
			$surveyls_email_invite_subj=$xml->createElement("surveyls_email_invite_subj");
			$row->appendChild($surveyls_email_invite_subj);
			$surveyls_email_invite_subj->appendChild($xml->createCDATASection("Invitation to participate in a survey"));
			$surveyls_email_invite=$xml->createElement("surveyls_email_invite");
			$row->appendChild($surveyls_email_invite);
			$surveyls_email_invite->appendChild($xml->createCDATASection("Dear {FIRSTNAME},  you have been invited to participate in a survey.  The survey is titled: '{SURVEYNAME}' '{SURVEYDESCRIPTION}' To participate, please click on the link below.  Sincerely,  {ADMINNAME} ({ADMINEMAIL})  ---------------------------------------------- Click here to do the survey: {SURVEYURL}  If you do not want to participate in this survey and don't want to receive any more invitations please click the following link: {OPTOUTURL}  If you are blacklisted but want to participate in this survey and want to receive invitations please click the following link: {OPTINURL}"));
			$surveyls_email_remind_subj=$xml->createElement("surveyls_email_remind_subj");
			$row->appendChild($surveyls_email_remind_subj);
			$surveyls_email_remind_subj->appendChild($xml->createCDATASection("Reminder to participate in a survey"));
			$surveyls_email_remind=$xml->createElement("surveyls_email_remind");
			$row->appendChild($surveyls_email_remind);
			$surveyls_email_remind->appendChild($xml->createCDATASection("Dear {FIRSTNAME},  Recently we invited you to participate in a survey.  We note that you have not yet completed the survey, and wish to remind you that the survey is still available should you wish to take part.  The survey is titled: '{SURVEYNAME}' '{SURVEYDESCRIPTION}'  To participate, please click on the link below.  Sincerely,  {ADMINNAME} ({ADMINEMAIL})  ---------------------------------------------- Click here to do the survey: {SURVEYURL}  If you do not want to participate in this survey and don't want to receive any more invitations please click the following link: {OPTOUTURL}"));
			$surveyls_email_register_subj=$xml->createElement("surveyls_email_register_subj");
			$row->appendChild($surveyls_email_register_subj);
			$surveyls_email_register_subj->appendChild($xml->createCDATASection("Survey registration confirmation"));
			$surveyls_email_register=$xml->createElement("surveyls_email_register");
			$row->appendChild($surveyls_email_register);
			$surveyls_email_register->appendChild($xml->createCDATASection("Dear {FIRSTNAME},You, or someone using your email address, have registered to participate in an online survey titled {SURVEYNAME}.To complete this survey, click on the following URL:{SURVEYURL} If you have any questions about this survey, or if you did not register to participate and believe this email is in error, please contact {ADMINNAME} at {ADMINEMAIL}."));
			$surveyls_email_confirm_subj=$xml->createElement("surveyls_email_confirm_subj");
			$row->appendChild($surveyls_email_confirm_subj);
			$surveyls_email_confirm_subj->appendChild($xml->createCDATASection("Confirmation of your participation in our survey"));
			$surveyls_email_confirm=$xml->createElement("surveyls_email_confirm");
			$row->appendChild($surveyls_email_confirm);
			$surveyls_email_confirm->appendChild($xml->createCDATASection("Dear {FIRSTNAME},this email is to confirm that you have completed the survey titled {SURVEYNAME} and your response has been saved. Thank you for participating.If you have any further questions about this email, please contact {ADMINNAME} on {ADMINEMAIL}.Sincerely,{ADMINNAME}"));
			$surveyls_dateformat=$xml->createElement("surveyls_dateformat");
			$row->appendChild($surveyls_dateformat);
			$surveyls_dateformat->appendChild($xml->createCDATASection(9));
			$email_admin_notification_subj=$xml->createElement("email_admin_notification_subj");
			$row->appendChild($email_admin_notification_subj);
			$email_admin_notification_subj->appendChild($xml->createCDATASection("Response submission for survey {SURVEYNAME}"));
			$email_admin_notification=$xml->createElement("email_admin_notification");
			$row->appendChild($email_admin_notification);
			$email_admin_notification->appendChild($xml->createCDATASection("Hello,A new response was submitted for your survey '{SURVEYNAME}'.Click the following link to reload the survey:{RELOADURL}Click the following link to see the individual response:{VIEWRESPONSEURL}Click the following link to edit the individual response:{EDITRESPONSEURL}View statistics by clicking here:{STATISTICSURL}"));
			$email_admin_responses_subj=$xml->createElement("email_admin_responses_subj");
			$row->appendChild($email_admin_responses_subj);
			$email_admin_responses_subj->appendChild($xml->createCDATASection("Response submission for survey {SURVEYNAME} with results"));
			$email_admin_responses=$xml->createElement("email_admin_responses");
			$row->appendChild($email_admin_responses);
			$email_admin_responses->appendChild($xml->createCDATASection("Hello,A new response was submitted for your survey '{SURVEYNAME}'.Click the following link to reload the survey:{RELOADURL}Click the following link to see the individual response:{VIEWRESPONSEURL}Click the following link to edit the individual response:{EDITRESPONSEURL}View statistics by clicking here:{STATISTICSURL}The following answers were given by the participant:{ANSWERTABLE}"));
			$surveyls_numberformat=$xml->createElement("surveyls_numberformat");
			$row->appendChild($surveyls_numberformat);
			$surveyls_numberformat->appendChild($xml->createCDATASection(0));

			// save xml in tmp folder
			$file=$exam_id.'_'.$exam_name;
			//$log->debug('<xmp>'. $xml->saveXML().'</xmp>');
			$file=$file.'.lss';

			$xml->save('../../tmp/'.$file);
			
			//create RPC session with LS
			// without composer this line can be used
			include_once('../../lib/jsonrpcphp/JsonRPCClient.php');
			// with composer support just add the autoloader
			// include_once 'vendor/autoload.php';

			// the survey to process
			$survey_id=$exam_id;
			//$log->debug($survey_id);

			// instanciate a new client
			$myJSONRPCClient = new JsonRPCClient( LS_BASEURL , TRUE );
			//$log->debug($myJSONRPCClient);

			// receive session key
			$sessionKey= $myJSONRPCClient->__call('get_session_key',array( LS_USER, LS_PASSWORD ));
			//$log->debug($sessionKey);

			//import survey to limesurvey
			$file_string=base64_encode(file_get_contents('../../tmp/'.$file));
			$format = 'lss';
			$sNewSurveyName = 'A new title';
			$new_survey_id = $myJSONRPCClient->__call('import_survey',array($sessionKey,$file_string,$format,$sNewSurveyName));
			//$log->debug($new_survey_id);
			//to form a survey link
			$survey_link="http://52.39.26.22/limesurvey/index.php/" ;
		    $survey_link .= $new_survey_id."?lang=en";
		    $_SESSION['survey_link'] = $survey_link;

			//insert data in exam_survey table
			$query = "INSERT INTO t_exam_survey(survey_link,
												survey_id,
												exam_id,
												created_by,
												modified_by,
												created_time,
												modified_time)
						values('{$survey_link}','{$new_survey_id}','{$exam_id}','{$file_name[0]}','{$file_name[0]}',NOW(),NOW())";
			//$log->debug($query);
			$result = mysqli_query($connection,$query);

			//activate survey
			$active = $myJSONRPCClient->activate_survey($sessionKey,$new_survey_id);
			//activate tokens
			$active_tokens=$myJSONRPCClient->activate_tokens($sessionKey, $new_survey_id);
			// release the session key
			$myJSONRPCClient->release_session_key( $sessionKey );
	
	
			
	}
	catch(exception $e){
		$log->error("****Error- createlss.php :". $e->getmessage()."****");
	}
	$log->debug("****END- createlss.php****");
			header('Location: thank.php');
?>