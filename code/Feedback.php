<?php

class Feedback extends DataObject{
	
	static $db = array(
		'Name' => 'Varchar',
		'Email' => 'Varchar',
		'OverallRating' => 'Int',
		'Message' => 'Text',
		'Category' => 'Enum("Bug,Site Content,Suggestion,Compliment,Other","Compliment")',
		'URL' => 'Varchar'
	);
	
	static $has_one = array(
		'Page' => 'SiteTree',
		'Submitter' => 'Member'
	);

   static $summary_fields = array(
		'Created',
		'Message',
		'OverallRating',
		'Category',
		'URL',
		'MemberName',
		'MemberEmail'
	);
   
   public static $searchable_fields = array(
    'URL',
   	'MemberName',
   	'Message',
   	'Category'
   );
   
   static $casting = array(
   	'MemberEmail' => 'Varchar',
   	'MemberName' => 'Varchar',
   );
   
   static $membergroup = null;
   
   static function set_member_group($group = 'all'){
   		self::$membergroup = $group;
   }
   
	static function canSee(){
		if(!self::$membergroup)
			return true;
		if(self::$membergroup == 'all' && Member::currentUser()){
			return true;
		}elseif(Member::currentUser() && Member::currentUser()->inGroup(self::$membergroup)){
			return true;
		}
		return false;
	}
   
   function getMemberEmail(){
   		if($this->Email){
   			return $this->Email; 
   		}
   		if($this->SubmitterID){
   			return $this->Submitter()->Email;
   		}
   		
   		return null;
   }
   
   function getMemberName(){
   		if($this->Name){
   			return $this->Name;
   		}
   		if($this->SubmitterID){
   			return $this->Submitter()->Name;
   		}
   		return null;
   }
   

}

?>
