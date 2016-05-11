<?php
	// this page is to create LS .lss file for importing survey in LS
	// page created by Jitendra Dayma
	// modified by: Jitendra dayma
	// modified on: 11-05-2016
	
	//function for db conn and session check
	include_once('../../../service/common/db_connection.php');
	include_once('../../../lib/log4php/Logger.php');
	Logger::configure('../../../config/log_config.xml');
	$log = Logger::getLogger('createlss.php');
	$log->debug("**** START - createlss.php ****");
	session_start();
	if (isset($_SESSION["user"])){
		// get the file name = userid_GUID_e.xml
		$Filename = ($_SESSION['Filename']);
		
	}else
	{
		header("Location: ../../../service/common/error_page.php");
	}
	 

	try{
		// substring the GUID from the file name
			$file_name=explode("_", $Filename);
			$GUID = $file_name[1];
		// log file name and GUID

			$log->INFO('filename:'.$Filename.'  GUID:'.$GUID);

		
        //Logic
			//1. fetch from DB msi_tools the data for exam (from table t_exam_org_qp)
			/*$xml = simplexml_load_file('../../../tmp/'.$Filename);
			if(!$xml){
				$log->debug("unable to load XML file");
			}else{
				$org_code = $xml->org;
				$qp_code = $xml->QP->qpCode;
				WHERE org_code = '{$org_code}' AND qp_code = '{$qp_code}'*/
			$Query = "SELECT exam_id
					  FROM t_exam_org_qp
					  ORDER BY exam_id DESC 
					  LIMIT 1";
			$result = mysql_query($connection, $Query);
			$row = mysqli_fetch_assoc($result);
			$exam_id = $row["exam_id"];
			
			//2. create a subxml for exam
			?>
				<surveys>
				  <fields>
				   <fieldname>sid</fieldname>
				   <fieldname>admin</fieldname>
				   <fieldname>expires</fieldname>
				   <fieldname>startdate</fieldname>
				   <fieldname>adminemail</fieldname>
				   <fieldname>anonymized</fieldname>
				   <fieldname>faxto</fieldname>
				   <fieldname>format</fieldname>
				   <fieldname>savetimings</fieldname>
				   <fieldname>template</fieldname>
				   <fieldname>language</fieldname>
				   <fieldname>additional_languages</fieldname>
				   <fieldname>datestamp</fieldname>
				   <fieldname>usecookie</fieldname>
				   <fieldname>allowregister</fieldname>
				   <fieldname>allowsave</fieldname>
				   <fieldname>autonumber_start</fieldname>
				   <fieldname>autoredirect</fieldname>
				   <fieldname>allowprev</fieldname>
				   <fieldname>printanswers</fieldname>
				   <fieldname>ipaddr</fieldname>
				   <fieldname>refurl</fieldname>
				   <fieldname>publicstatistics</fieldname>
				   <fieldname>publicgraphs</fieldname>
				   <fieldname>listpublic</fieldname>
				   <fieldname>htmlemail</fieldname>
				   <fieldname>sendconfirmation</fieldname>
				   <fieldname>tokenanswerspersistence</fieldname>
				   <fieldname>assessments</fieldname>
				   <fieldname>usecaptcha</fieldname>
				   <fieldname>usetokens</fieldname>
				   <fieldname>bounce_email</fieldname>
				   <fieldname>attributedescriptions</fieldname>
				   <fieldname>emailresponseto</fieldname>
				   <fieldname>emailnotificationto</fieldname>
				   <fieldname>tokenlength</fieldname>
				   <fieldname>showxquestions</fieldname>
				   <fieldname>showgroupinfo</fieldname>
				   <fieldname>shownoanswer</fieldname>
				   <fieldname>showqnumcode</fieldname>
				   <fieldname>bouncetime</fieldname>
				   <fieldname>bounceprocessing</fieldname>
				   <fieldname>bounceaccounttype</fieldname>
				   <fieldname>bounceaccounthost</fieldname>
				   <fieldname>bounceaccountpass</fieldname>
				   <fieldname>bounceaccountencryption</fieldname>
				   <fieldname>bounceaccountuser</fieldname>
				   <fieldname>showwelcome</fieldname>
				   <fieldname>showprogress</fieldname>
				   <fieldname>questionindex</fieldname>
				   <fieldname>navigationdelay</fieldname>
				   <fieldname>nokeyboard</fieldname>
				   <fieldname>alloweditaftercompletion</fieldname>
				   <fieldname>googleanalyticsstyle</fieldname>
				   <fieldname>googleanalyticsapikey</fieldname>
				  </fields>
				  <rows>
				   <row>
				    <sid><![CDATA[exam_id]]></sid>
				    <admin><![CDATA[admin]]></admin>
				    <adminemail><![CDATA[hello@iidea8.com]]></adminemail>
				    <anonymized><![CDATA[N]]></anonymized>
				    <format><![CDATA[S]]></format>
				    <savetimings><![CDATA[Y]]></savetimings>
				    <template><![CDATA[ubuntu_orange]]></template>
				    <language><![CDATA[en]]></language>
				    <additional_languages/>
				    <datestamp><![CDATA[Y]]></datestamp>
				    <usecookie><![CDATA[N]]></usecookie>
				    <allowregister><![CDATA[N]]></allowregister>
				    <allowsave><![CDATA[Y]]></allowsave>
				    <autonumber_start><![CDATA[1]]></autonumber_start>
				    <autoredirect><![CDATA[N]]></autoredirect>
				    <allowprev><![CDATA[N]]></allowprev>
				    <printanswers><![CDATA[N]]></printanswers>
				    <ipaddr><![CDATA[Y]]></ipaddr>
				    <refurl><![CDATA[Y]]></refurl>
				    <publicstatistics><![CDATA[N]]></publicstatistics>
				    <publicgraphs><![CDATA[N]]></publicgraphs>
				    <listpublic><![CDATA[N]]></listpublic>
				    <htmlemail><![CDATA[N]]></htmlemail>
				    <sendconfirmation><![CDATA[Y]]></sendconfirmation>
				    <tokenanswerspersistence><![CDATA[N]]></tokenanswerspersistence>
				    <assessments><![CDATA[N]]></assessments>
				    <usecaptcha><![CDATA[N]]></usecaptcha>
				    <usetokens><![CDATA[N]]></usetokens>
				    <bounce_email><![CDATA[hello@iidea8.com]]></bounce_email>
				    <tokenlength><![CDATA[15]]></tokenlength>
				    <showxquestions><![CDATA[Y]]></showxquestions>
				    <showgroupinfo><![CDATA[B]]></showgroupinfo>
				    <shownoanswer><![CDATA[Y]]></shownoanswer>
				    <showqnumcode><![CDATA[X]]></showqnumcode>
				    <bounceprocessing><![CDATA[N]]></bounceprocessing>
				    <showwelcome><![CDATA[Y]]></showwelcome>
				    <showprogress><![CDATA[Y]]></showprogress>
				    <questionindex><![CDATA[1]]></questionindex>
				    <navigationdelay><![CDATA[0]]></navigationdelay>
				    <nokeyboard><![CDATA[N]]></nokeyboard>
				    <alloweditaftercompletion><![CDATA[N]]></alloweditaftercompletion>
				    <googleanalyticsstyle><![CDATA[0]]></googleanalyticsstyle>
				   </row>
				  </rows>
				 </surveys>

				 3. select question for the exam from table r_exam_que
				 4. for each question create an xml row
					<questions>
					  <fields>
					   <fieldname>qid</fieldname>
					   <fieldname>parent_qid</fieldname>
					   <fieldname>sid</fieldname>
					   <fieldname>gid</fieldname>
					   <fieldname>type</fieldname>
					   <fieldname>title</fieldname>
					   <fieldname>question</fieldname>
					   <fieldname>preg</fieldname>
					   <fieldname>help</fieldname>
					   <fieldname>other</fieldname>
					   <fieldname>mandatory</fieldname>
					   <fieldname>question_order</fieldname>
					   <fieldname>language</fieldname>
					   <fieldname>scale_id</fieldname>
					   <fieldname>same_default</fieldname>
					   <fieldname>relevance</fieldname>
					   <fieldname>modulename</fieldname>
					  </fields>
					  <rows>
					   <row>
					    <qid><![CDATA[201]]></qid>
					    <parent_qid><![CDATA[0]]></parent_qid>
					    <sid><![CDATA[275875]]></sid>
					    <gid><![CDATA[11]]></gid>
					    <type><![CDATA[L]]></type>
					    <title><![CDATA[GKQ1]]></title>
					    <question><![CDATA[When had Muslim league passed the resolution "Divide and Quit" movement ?]]></question>
					    <preg/>
					    <help/>
					    <other><![CDATA[N]]></other>
					    <mandatory><![CDATA[Y]]></mandatory>
					    <question_order><![CDATA[0]]></question_order>
					    <language><![CDATA[en]]></language>
					    <scale_id><![CDATA[0]]></scale_id>
					    <same_default><![CDATA[1]]></same_default>
					    <relevance><![CDATA[1]]></relevance>
					   </row>
					   <row>
					  </questions>
					  5. for each question get answers
					  6. for each question get answer xml row
					<answers>
					  <fields>
					   <fieldname>qid</fieldname>
					   <fieldname>code</fieldname>
					   <fieldname>answer</fieldname>
					   <fieldname>sortorder</fieldname>
					   <fieldname>assessment_value</fieldname>
					   <fieldname>language</fieldname>
					   <fieldname>scale_id</fieldname>
					  </fields>
					  <rows>
					   <row>
					    <qid><![CDATA[217]]></qid>
					    <code><![CDATA[1]]></code>
					    <answer><![CDATA[ J.B. Kripalani]]></answer>
					    <sortorder><![CDATA[1]]></sortorder>
					    <assessment_value><![CDATA[0]]></assessment_value>
					    <language><![CDATA[en]]></language>
					    <scale_id><![CDATA[0]]></scale_id>
					   </row>
					   <row>
					    <qid><![CDATA[217]]></qid>
					    <code><![CDATA[2]]></code>
					    <answer><![CDATA[ M.K. Gandhi]]></answer>
					    <sortorder><![CDATA[2]]></sortorder>
					    <assessment_value><![CDATA[0]]></assessment_value>
					    <language><![CDATA[en]]></language>
					    <scale_id><![CDATA[0]]></scale_id>
					   </row>
					</answers>
					7. create a group xml
					<groups>
					  <fields>
					   <fieldname>gid</fieldname>
					   <fieldname>sid</fieldname>
					   <fieldname>group_name</fieldname>
					   <fieldname>group_order</fieldname>
					   <fieldname>description</fieldname>
					   <fieldname>language</fieldname>
					   <fieldname>randomization_group</fieldname>
					   <fieldname>grelevance</fieldname>
					  </fields>
					  <rows>
					   <row>
					    <gid><![CDATA[11]]></gid>
					    <sid><![CDATA[275875]]></sid>
					    <group_name><![CDATA[GK_Test]]></group_name>
					    <group_order><![CDATA[0]]></group_order>
					    <description/>
					    <language><![CDATA[en]]></language>
					    <randomization_group/>
					    <grelevance><![CDATA[1]]></grelevance>
					   </row>
					  </rows>
					 </groups>

					 8. concat all xml and save in tmp folder
					 9. create RPC session with LS
					 10. 0. Basic includes
Autoloading all Zend framework classes and instantiate the new XML-RPC client object.

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
$client = new Zend_XmlRpc_Client('http://<domain>/<limesurvey_dir>/index.php/admin/remotecontrol');

11.Create a session key
In order to use every function in the API, user must have a session key. This session key is created by the get_session_key function, which actually performs the user authentication and creates a session for the user.

$sessionkey = $client->call(‘get_session_key’, array(‘<username>’,'<password>’));
Result: string(32) "tgv7xrudi8u4jjxjhq8bspmey2z4ea87"

12.Release session key
The session key is the basic authentication token for every function in the API. After the end of the usage, user can or should release this session key. In any case this session key is only valid for a limited period of time, defined by the session_lifetime parameter in the applications config.

$result = $client->call(‘release_session_key’, $sessionkey);
Result: string(2) "OK" The most basic usage of the Api involves the creation of a survey. There are two ways of creating a survey, either by importing the individual groups or questions, or by importing the whole structure. The first scenario will do a complete import of a survey and the following will use individual imports.
13.Import survey
The native format for the surveys is the lss. Optionaly users can use csv, or zip files.

The file used for import is sample_survey.lss

$file_string=base64_encode(file_get_contents('sample_survey.lss'));
$format = 'lss';
$sNewSurveyName = 'A new title';
$iNewID = $client->call('import_survey', array($sessionkey,$file_string,$format,$sNewSurveyName));
Result: string(6) "685351"

14: update exam_survey table with survey link

		*/

		// load file in to an XML DOM object using 
		// begin transaction
    		mysqli_begin_transaction($connection);
    	
    	// stop autocommit
    		mysqli_autocommit($connection, FALSE);

		
	
	$log->debug("****END- createlss.php****");
	header('Location: thank.php');
?>