<?php

/* 
	The SI data Node class is responsible for holding data, ranges of values for data, and for displaying that data
*/
class SIDataNode{
	
	//static portion
	//this will have general information such as a dataname to display name translation if it is unavailable through the db
	//or valuesLists by dataname
	static $nameTranslations = array(
		'ESCMM'=>'Escalate to Matter Management',
		'RSLVD'=>'Matter Reconciled',
		'MOS'=>'Matter Status',
		'WEBLO'=>'Website Line of Business',
		'CLNO'=>'Claim Number',
		'PD50'=>'Matter ID',
		'CASE'=>'Case Name',
		'CLADJ'=>'Adjuster',
		'PD011'=>'PD011',
		'CLNO3'=>'CLNO3',
		'CASCA'=>'CASCA',
		'LAWFM'=>'Law Firm Office Location',
		'HAND'=>'Handling Office',
		'CS015'=>'Date of Loss',
		'CASTY'=>'Case Type',
		'PD049'=>'Division Name',
		'PD048'=>'Division Office',
		'POL'=>'Policy Number',
		'SHARE'=>'Share Percentage',
		'DATAOP'=>'Date Instructed',
		'PFIRM'=>'Plaintiff Firm Name',
		'PATTY'=>'Plaintiff Attorney Name',
		'DEDYN'=>'Deductible Yes/No',
		'ITYPE'=>'Status for Tymetrix Invoice',
		'LDAT'=>'ACE Date of Loss',
		'PLSHN'=>'Plaintiff Short Name',
		'ESTAT'=>'Estate Name',
		'VNUMB'=>'Vendor Number',
		'PER1'=>'Policy Effective Date',
		'NOC1'=>'Nature of Case',
		'SETYP'=>'Suffix/Exposure Type',
		'CLBEH'=>'Claim Behaviors',
		'INJTY'=>'Injury Type',
		'ACEBU'=>'Ace Business Unit Name',
		'ACECL'=>'Class of Business Code',
		'ACEPE'=>'Ace\'s Percent of Liability',
		'ACEBL'=>'ACE Business Unit Office Location',
		'ACECT'=>'Court Track Code',
		'CAEDA'=>'Date Litigation Commenced',
		'ACETY'=>'Type of Instruction Code',
		'ACEPH'=>'Phase of Instruction Code',
		'ACEID'=>'Total Indemnity/Damages Paid',
		'ACEHF'=>'Fees Through to SLA Effective Date',
		'ACEHE'=>'Disbursements Through to SLA Effective Date',
		'LEDES'=>'FFIC LEDES ID',
		'CLNO6'=>'CSC Matter ID',
		'PD041'=>'Marmon Matter Type',
		'PD055'=>'Marmon Entity',
		'LSSMN'=>'LSS Matter Name',
		'INSEQ'=>'Invoice Sequence',
		'DTYPE'=>'Disease Type',
		'INVDE'=>'Invoice Description',
		'LIBDE'=>'Liberty Defendant',
		'LIBMT'=>'Liberty Case Name',
		'UMR'=>'Unique Market Reference',
		'P'=>'Plaintiff',
		'D'=>'Defendant',
		'DEC'=>'Is This a Dec Action',
		'BAD'=>'Is This Bad Faith?',
		'PSUB'=>'Is This Pursuit of Subrogration',
		'PROLB'=>'Is This Products Liability',
		'JCITY'=>'Jurisdiction: City',
		'JSTAT'=>'Jurisdiction: State',
		'JTYPE'=>'Jurisdiction: Type',
		'CNAME'=>'Company Name',
		'ACAST'=>'Legal-X Case Type',
		'FAC'=>'Facility',
		'ZIPOB'=>'WEMED Firm Office Zip',
		'NAMOI'=>'Name Of Insured',
		'UCRN'=>'UCR Number',
		'UMRN'=>'UMR Number',
		'CHKCOMP'=>'Matter Compliant',
		'MRNTS'=>'Matter Recon Notes'
	);
	
	static $valuesListTranslations = array(
	);
	static function getDisplayName($dataname){
		return SIDataNode::$nameTranslations[$dataname];
	}
	//instance portion
	private $DataName;//C052 / internal name for data ie:PD50
	private $DisplayName;//Human readable name for data ie:Matter ID
	private $Value;//Value stored for this data ie: MATTERID
	private $valuesList; // list of values possible for this field (if applicable) ie []MOS->Matter on SITE, ARR->additional research required...]
	private $EorA; // is 'E','A', or null. Is required for compliance if one of first two
	
	public function __construct($DataName, $Value, $EorA = null, $valuesList = null, $displayName = null){
		$this->DataName = $DataName;
		$this->DisplayName = ($displayName == null)?SIDataNode::getDisplayName($DataName):$displayName; //use name given, otherwise use static look up for name
		$this->Value = $Value;
		$this->EorA = $EorA;
		$this->valuesList = $valuesList;//use values provided or use static lookup
	}
}

?>