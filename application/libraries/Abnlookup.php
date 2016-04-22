<?php
/**
 * @author Justin Swan - 16 August 2012
 * extends php soap client to utilize the Australian Government ABN Lookup web service 
 * requires php 5 or greater with lib-xml enabled/compiled in Apache, see the PHP manual for further requirements info
 * 
 * @link    http://www.php.net/manual/en/book.soap.php
 * @link    http://abr.business.gov.au/Webservices.aspx
 * 
 * @param string $guid - get a guid id by registering @ http://abr.business.gov.au/Webservices.aspx
 * 
 */
 
class Abnlookup extends SoapClient{
 
    //private $guid = "f684ffb7-f38c-4981-9b71-a6ae44a09437"; 
 
    public function __construct()
    {
        $this->guid = ABN_GUID;
        $params = array(
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        ); 
 
        parent::__construct('http://abr.business.gov.au/abrxmlsearch/ABRXMLSearch.asmx?WSDL', $params);
    }
 
    public function searchByAbn($abn, $historical = 'N'){
        $params = new stdClass();
        $params->searchString                = $abn;
        $params->includeHistoricalDetails    = $historical;
        $params->authenticationGuid          = $this->guid;
        $result = $this->ABRSearchByABN($params);
        $result = get_object_vars($result);
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        $status =  @$result[ABRPayloadSearchResults]->response->businessEntity->entityStatus->entityStatusCode;
        if($status != ''){
            return TRUE;
        }
        else{
            return FALSE;
        }
            
    }
 
    public function searchByName($company_name){
        $params = new stdClass();
        $params->externalNameSearch($company_name);
        $params->authenticationGuid            = $this->guid;
        return $this->ABRSearchByName($params);
    }
 }
