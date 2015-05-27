<?php

/*This class is meant to have all the SI data laid out. An Si Data Class will hold SI data Nodes, which will hold the lowest level information
I.E. PD50 will be an SI Data Node. SI data Nodes will be responsible for holding the value of data, the range of values for data (for select fields)
and for representing the data as a string for front end display

The SI Data Class is responsible for form level information. Shares will be implemented as separate SI Data Class instances.*/


include('SiDataNode.php');

class SiData{
	static $allSIFields = 	array(
							'ESCMM','RSLVD','MOS','WEBLO','CLNO','PD50','CASE','CLADJ',
							'PD011','CLNO3','CASCA','LAWFM','HAND','CS015','CASTY','PD049',
							'PD048','POL','SHARE','DATAOP','PFIRM','PATTY','DEDYN',
							'ITYPE','LDAT','PLSHN','ESTAT','VNUMB','PER1','NOC1',
							'SETYP','CLBEH','INJTY','ACEBU','ACECL','ACEPE','ACEBL',
							'ACECT','CAEDA','ACETY','ACEPH','ACEID','ACEHF','ACEHE',
							'LEDES','CLNO6','PD041','PD055','LSSMN','INSEQ','DTYPE',
							'INVDE','LIBDE','LIBMT','UMR','P','D','DEC','BAD','PSUB',
							'PROLB','JCITY','JSTAT','JTYPE','CNAME','ACAST','FAC',
							'ZIPOB','NAMOI','UCRN','UMRN','CHKCOMP','MRNTS');//Every single emd field in a line
	
	private $clnt;
	private $mttr;
	private $share;
	private $SIDataNodes;
	
	private function getCDBDTLInfo($arr){//takes a cdbdtl/cnfnar array and returns an array with the correct relevant data
	$ret = Array();
	switch($arr['DNDTYP']){
		case 'U':
			return (trim($arr['DNC206'])=='')?$arr['NCNARR']:$arr['DNC206'] ;//if dnc206 is empty, use ncnarr;else dnc206
			break;
		case 'D':
			return $arr['DNDATE'] ;
			break;
		case 'T':
			return $arr['NCNARR'] ;
			break;
		default:
			return 'valueNotKnown' ;
			break;
	}
	return null;//sanity check - default case should always trigger
}
	
	
	public function __construct($clnt,$mttr,$share){
		$this->clnt = $clnt;
		$this->mttr = $mttr;
		$this->share = $share;
		$this->SIDataNodes = array();
	}
	
	//this function will take data passed from the model and construct all the appropriate SIDataNodes from passed cdbdtl data
	public function loadData($data){
		foreach($data as $field){
			if(in_array(trim($field['DNC052']),SiData::$allSIFields)){
				$field = array_map('trim',$field);
				$dataName = $field['DNC052'];
				//$displayName = $field['DNC052'];//might want to change query to make this happen
				$displayName = null;
				$Value = $this->getCDBDTLInfo($field);
				$valuesList = null;
				$EorA = null;
				$sinode = new SiDataNode($dataName,$Value,$EorA,$valuesList,$displayName);
				$this->SIDataNodes[$dataName]=$sinode;
			}
		}
		//the following section will construct nodes for all the remaining data that wasn't populated from cdbdtl
		//this section is here to tie front end presentation to the back end objects
		$keys = array_keys($this->SIDataNodes);
		foreach(SiData::$allSIFields as $field){
			if(!in_array($field,$keys)){
				$node = new SiDataNode($field,null,null,null,null);
				$this->SIDataNodes[$field]=$node;
			}
		}
		
	}
}
?>