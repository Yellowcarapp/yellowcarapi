<?php

class Reports_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
 
//##########################page###########################
function get_orders()
{   
    $level = $this->input->post('level',TRUE);
    $orderRange = $this->input->post('offerRange',TRUE);
    $country = $this->input->post('country',TRUE);
    $cityId = $this->input->post('cityId',TRUE);
    $network = $this->input->post('network',TRUE);
    $driver = $this->input->post('driver',TRUE);
    $trip_type = $this->input->post('trip_type',TRUE);
    $passenger = $this->input->post('passenger',TRUE);
    $tripNow=explode(',',$this->input->post('tripNow',TRUE));
    
    $paymethod=$this->input->post('paymethod',TRUE);
     $trippromo = $this->input->post('trippromo',TRUE);
    $Status = $this->input->post('sts',TRUE);
    $reason = $this->input->post('reason',TRUE);
    if(!isset($reason))$reason=-1;
    $cost_from = $this->input->post('cost_from',TRUE);
    $cost_to=$this->input->post('cost_to',TRUE);
    
     $dist_from = $this->input->post('dist_from',TRUE);
    $dist_to=$this->input->post('dist_to',TRUE);
  // print_r($tripNow);
    $networkID= $this->session->userdata('network');
     $TimeZone= $this->session->userdata('timeZone');
    $this->db->select("*,CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."') as CreateDate",FALSE);
    $this->db->from('trips');
    $this->db->join('passengers','trips.tripPassengerId=passengers.passengerId','left');
    $this->db->join('drivers','trips.tripDriverId=drivers.driverId','left');
    $this->db->join('countries','trips.tripCountryId=countries.countryId','left');
    $this->db->join('cities','trips.tripCityId=cities.cityId','left');
     $this->db->join('network','trips.tripNetwork=network.network_id','left');
        $this->db->join('tripTypes','trips.tripType=tripTypes.typeId','left');

      if($networkID!=-1)
        $this->db->where('networkId',$networkID);
    
    if($orderRange!="")
    {
        $orderArr = explode(' to ',$orderRange);
        $this->db->where("DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) >=",$orderArr[0]);
        $this->db->where("DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) <=",$orderArr[1]);
    }
   $wh='';
  if($level!='')
    {
      if($wh!='')$wh.=' AND ';
         $level=explode(',',$level);
       // $this->db->where_in('tripLevelId', $level);
       // $this->db->where("tripLevelId",$level);
      
      
      for($i=0;$i<count($level);$i++)
      {
          if($i==0)$wh.=' tripLevelId  IN (';
          else $wh.=',';
          $wh.=$level[$i];
      }
      $wh.=')';
    }
       

    if($country!='')
    { if($wh!='')$wh.=' AND ';
        $country=explode(',',$country);
       for($i=0;$i<count($country);$i++)
      {
          if($i==0)$wh.=' tripCountryId  IN (';
          else $wh.=',';
          $wh.=$country[$i];
      }
      $wh.=')';
      
    }  
    if($cityId!='' )
    { $cityId=explode(',',$cityId);
     if($wh!='')$wh.=' AND ';
      for($i=0;$i<count($cityId);$i++)
      {
          if($i==0)$wh.=' tripCityId  IN (';
          else $wh.=',';
          $wh.=$cityId[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripCityId', $cityId);
       // $this->db->where("tripCityId",$cityId);
    }
  
    if($driver!='')
    {
        if($wh!='')$wh.=' AND ';
        $driver=explode(',',$driver);
         for($i=0;$i<count($driver);$i++)
      {
          if($i==0)$wh.=' tripDriverId  IN (';
          else $wh.=',';
          $wh.=$driver[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripDriverId', $driver);
       // $this->db->where("tripDriverId",$driver);        
    }  
    if($network!='')
    {
        if($wh!='')$wh.=' AND ';
        $network=explode(',',$network);
         for($i=0;$i<count($network);$i++)
      {
          if($i==0)$wh.=' networkId  IN (';
          else $wh.=',';
          $wh.=$network[$i];
      }
      $wh.=')';
       // $this->db->where_in('networkId', $network);
       // $this->db->where("networkId",$network);
    }
  if($trip_type!='')
    {
       if($wh!='')$wh.=' AND ';
      $trip_type=explode(',',$trip_type);
       for($i=0;$i<count($trip_type);$i++)
      {
          if($i==0)$wh.=' tripType  IN (';
          else $wh.=',';
          $wh.=$trip_type[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripType', $trip_type);
      //  $this->db->where("tripType",$trip_type);        
    }  
    if($passenger!='')
    {
         if($wh!='')$wh.=' AND ';
        $passenger=explode(',',$passenger);
         for($i=0;$i<count($passenger);$i++)
      {
          if($i==0)$wh.=' tripPassengerId  IN (';
          else $wh.=',';
          $wh.=$passenger[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripPassengerId', $passenger);
        //$this->db->where("tripPassengerId",$passenger);
    }
    
          
 if(count($tripNow)>0)
    {
      if($wh!='')$wh.=' AND ';
    
     $str='';
     if(isset($tripNow[0]) && $tripNow[0]>=0)
         $str.=' tripNow='.$tripNow[0];
        //$this->db->where("tripNow",$tripNow[0]);
     if(isset($tripNow[1]) && $tripNow[1]>=0)
     {
         if($str!='')$str.=' OR ';
           $str.='   tripNow='.$tripNow[1];
     }
      $wh.="(".$str.")";
       // $this->db->or_where("tripNow",$tripNow[1]);
    }  
    if($paymethod!=-1 )
    {
        if($wh!='')$wh.=' AND ';
        $wh.='(';
        $wh.='payBy ='.$paymethod;
      //  $this->db->where("payBy",$paymethod);
        if($trippromo==1)  $wh.=" OR payBy = 'promo' ";//$this->db->or_where("payBy",'promo');
        $wh.=')';
    }else {
       if($trippromo==1) { if($wh!='')$wh.=' AND ';//$this->db->where("payBy",'promo'); 
                         $wh.="  payBy = 'promo' ";
                         }
    }
 

    if($Status!=-1)
    {
          if($wh!='')$wh.=' AND ';
          $wh.='tripStatus ='.$Status;
       // $this->db->where("tripStatus",$Status);        
    }  
    if(isset($reason) and $reason>0)
    {  if($wh!='')$wh.=' AND ';
      $wh.='trpCancelReasonId ='.$reason;
       // $this->db->where("trpCancelReasonId",$reason);
    }

    
     if($cost_from!=0)
    {
         if($wh!='')$wh.=' AND ';
      $wh.='tripCost >='.$cost_from;
       // $this->db->where("tripCost >= ",$cost_from);        
    }  
    if($cost_to!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripCost <='.$cost_to;
     //   $this->db->where("tripCost <=",$cost_to);
    }
    
     if($dist_from!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_from;
        //$this->db->where("tripKm >= ",$dist_from);        
    }  
    if($dist_to!=0)
    {
        if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_to;
       // $this->db->where("tripKm <=",$dist_to);
    }
    $this->db->where('('.$wh.')',NULL,FALSE);
    $this->db->order_by('tripId','desc');
    $query = $this->db->get();
    return $query->result_array();

}

//##############################################################
//##########################page###########################
function get_Totals()
{   
    $level = $this->input->post('level',TRUE);
    $orderRange = $this->input->post('offerRange',TRUE);
    $country = $this->input->post('country',TRUE);
    $cityId = $this->input->post('cityId',TRUE);
    $network = $this->input->post('network',TRUE);
    $driver = $this->input->post('driver',TRUE);
    $trip_type = $this->input->post('trip_type',TRUE);
    $passenger = $this->input->post('passenger',TRUE);
    $tripNow=explode(',',$this->input->post('tripNow',TRUE));
    
    $paymethod=$this->input->post('paymethod',TRUE);
     $trippromo = $this->input->post('trippromo',TRUE);
    $Status = $this->input->post('sts',TRUE);
    $reasonID = $this->input->post('reason',TRUE);
    if(!isset($reasonID))$reasonID=-1;
   // echo $reasonID;
    $cost_from = $this->input->post('cost_from',TRUE);
    $cost_to=$this->input->post('cost_to',TRUE);
    
     $dist_from = $this->input->post('dist_from',TRUE);
    $dist_to=$this->input->post('dist_to',TRUE);
    /************** Grouping ****************************/
    /* $PassengersGrp = $this->input->post('PassengersGrp',TRUE);
    $NetworkGrp = $this->input->post('NetworkGrp',TRUE);
    $DriversGrp=$this->input->post('DriversGrp',TRUE);
    
     $CityGrp = $this->input->post('CityGrp',TRUE);
    $CountryrGrp=$this->input->post('CountryrGrp',TRUE);
    $DateGrp=$this->input->post('DateGrp',TRUE);
    $tripTypeGrp=$this->input->post('tripTypeGrp',TRUE);
    $stsGrp=$this->input->post('stsGrp',TRUE);*/
     $grCol=$this->input->post('grCol',TRUE);
    $networkID= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
    $this->db->select("*,count(tripId) as tripCount,sum(tripCost) as totalCost,sum(tripKm) as totalDistance,,CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."') as CreateDate ",false);
    $this->db->from('trips');
    $this->db->join('passengers','trips.tripPassengerId=passengers.passengerId','left');
    $this->db->join('drivers','trips.tripDriverId=drivers.driverId','left');
    $this->db->join('countries','trips.tripCountryId=countries.countryId','left');
    $this->db->join('cities','trips.tripCityId=cities.cityId','left');
     //$this->db->join('network','drivers.networkId=network.network_id','left');
     $this->db->join('network','trips.tripNetwork=network.network_id','left');
    $this->db->join('tripTypes','trips.tripType=tripTypes.typeId','left');
      if($networkID!=-1)
        $this->db->where('networkId',$networkID);
    if($orderRange!="")
    {
        $orderArr = explode(' to ',$orderRange);
        $this->db->where("DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) >=",$orderArr[0]);
        $this->db->where("DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) <=",$orderArr[1]);
    }
  $wh='';
  if($level!='')
    {
      if($wh!='')$wh.=' AND ';
         $level=explode(',',$level);
       // $this->db->where_in('tripLevelId', $level);
       // $this->db->where("tripLevelId",$level);
      
      
      for($i=0;$i<count($level);$i++)
      {
          if($i==0)$wh.=' tripLevelId  IN (';
          else $wh.=',';
          $wh.=$level[$i];
      }
      $wh.=')';
    }
       

    if($country!='')
    { if($wh!='')$wh.=' AND ';
        $country=explode(',',$country);
       for($i=0;$i<count($country);$i++)
      {
          if($i==0)$wh.=' tripCountryId  IN (';
          else $wh.=',';
          $wh.=$country[$i];
      }
      $wh.=')';
      
    }  
    if($cityId!='' )
    { $cityId=explode(',',$cityId);
     if($wh!='')$wh.=' AND ';
      for($i=0;$i<count($cityId);$i++)
      {
          if($i==0)$wh.=' tripCityId  IN (';
          else $wh.=',';
          $wh.=$cityId[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripCityId', $cityId);
       // $this->db->where("tripCityId",$cityId);
    }
  
    if($driver!='')
    {
        if($wh!='')$wh.=' AND ';
        $driver=explode(',',$driver);
         for($i=0;$i<count($driver);$i++)
      {
          if($i==0)$wh.=' tripDriverId  IN (';
          else $wh.=',';
          $wh.=$driver[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripDriverId', $driver);
       // $this->db->where("tripDriverId",$driver);        
    }  
    if($network!='')
    {
        if($wh!='')$wh.=' AND ';
        $network=explode(',',$network);
         for($i=0;$i<count($network);$i++)
      {
          if($i==0)$wh.=' networkId  IN (';
          else $wh.=',';
          $wh.=$network[$i];
      }
      $wh.=')';
       // $this->db->where_in('networkId', $network);
       // $this->db->where("networkId",$network);
    }
  if($trip_type!='')
    {
       if($wh!='')$wh.=' AND ';
      $trip_type=explode(',',$trip_type);
       for($i=0;$i<count($trip_type);$i++)
      {
          if($i==0)$wh.=' tripType  IN (';
          else $wh.=',';
          $wh.=$trip_type[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripType', $trip_type);
      //  $this->db->where("tripType",$trip_type);        
    }  
    if($passenger!='')
    {
         if($wh!='')$wh.=' AND ';
        $passenger=explode(',',$passenger);
         for($i=0;$i<count($passenger);$i++)
      {
          if($i==0)$wh.=' tripPassengerId  IN (';
          else $wh.=',';
          $wh.=$passenger[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripPassengerId', $passenger);
        //$this->db->where("tripPassengerId",$passenger);
    }
    
          
 if(count($tripNow)>0)
    {
      if($wh!='')$wh.=' AND ';
    
     $str='';
     if(isset($tripNow[0]) && $tripNow[0]>=0)
         $str.=' tripNow='.$tripNow[0];
        //$this->db->where("tripNow",$tripNow[0]);
     if(isset($tripNow[1]) && $tripNow[1]>=0)
     {
         if($str!='')$str.=' OR ';
           $str.='   tripNow='.$tripNow[1];
     }
      $wh.="(".$str.")";
       // $this->db->or_where("tripNow",$tripNow[1]);
    }  
    if($paymethod!=-1 )
    {
        if($wh!='')$wh.=' AND ';
        $wh.='(';
        $wh.='payBy ='.$paymethod;
      //  $this->db->where("payBy",$paymethod);
        if($trippromo==1)  $wh.=" OR payBy = 'promo' ";//$this->db->or_where("payBy",'promo');
        $wh.=')';
    }else {
       if($trippromo==1) { if($wh!='')$wh.=' AND ';//$this->db->where("payBy",'promo'); 
                         $wh.="  payBy = 'promo' ";
                         }
    }
 

    if($Status!=-1)
    {
          if($wh!='')$wh.=' AND ';
          $wh.='tripStatus ='.$Status;
       // $this->db->where("tripStatus",$Status);        
    }  
    if(isset($reasonID) && $reasonID>0)
    {  if($wh!='')$wh.=' AND ';
      $wh.='trpCancelReasonId ='.$reasonID;
       // $this->db->where("trpCancelReasonId",$reason);
    }

    
     if($cost_from!=0)
    {
         if($wh!='')$wh.=' AND ';
      $wh.='tripCost >='.$cost_from;
       // $this->db->where("tripCost >= ",$cost_from);        
    }  
    if($cost_to!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripCost <='.$cost_to;
     //   $this->db->where("tripCost <=",$cost_to);
    }
    
     if($dist_from!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_from;
        //$this->db->where("tripKm >= ",$dist_from);        
    }  
    if($dist_to!=0)
    {
        if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_to;
       // $this->db->where("tripKm <=",$dist_to);
    }
    $this->db->where('('.$wh.')',NULL,FALSE);
    if($grCol==1)
    $this->db->group_by('tripCountryId');
     if($grCol==5)
    $this->db->group_by('tripPassengerId');
     if($grCol==4)
    $this->db->group_by('`trips`.`tripNetwork`');
     if($grCol==3)
    $this->db->group_by('tripDriverId');
     if($grCol==2)
    $this->db->group_by('tripCityId');
          if($grCol==6)
    $this->db->group_by('tripCreateDate');
    if($grCol==7) $this->db->group_by('tripType');
     if($grCol==8) $this->db->group_by('tripStatus');
    $query = $this->db->get();
    return $query->result_array();

}
///////////////////////////////////////////////////////////////////
function getTable($table='',$column='',$val='',$wh='')
{
    $this->db->select('*');
    $this->db->from($table);
    if($val!='')
    $this->db->where($column,$val,FALSE);
    if($wh!='')$this->db->where($wh,'',FALSE);
    $query = $this->db->get();
    return $query->result_array();
}

//*********************************************//
    function get_CReffer($q='')
{
    $this->db->select('countryId as id,countryName_'.lang('db').' as name');
    $this->db->from('countries');
   
    $this->db->where('countryStatus','1');
   
         $this->db->like('countryName_'.lang('db'),$q);
    $query = $this->db->get();
    return $query->result_array();
}
//===========================	   
    function get_CityReffer($q='',$x='')
{
    $this->db->select('cityId as id,cityName_'.lang('db').' as name');
    $this->db->from('cities');
   
    $this->db->where('cityStatus','1');
   if($x!='')$this->db->where('countryId',$x);
         $this->db->like('cityName_'.lang('db'),$q);
    $query = $this->db->get();
    return $query->result_array();
}
    //***********************************/
      function get_LReffer($q='')
{
    $this->db->select('levelId as id,levelName_'.lang('db').' as name');
    $this->db->from('levels');
   
    $this->db->where('levelStatus','1');
   
         $this->db->like('levelName_'.lang('db'),$q);
    $query = $this->db->get();
    return $query->result_array();
}
    //********************************************//
    function get_NetReffer($q='')
    { $networkID= $this->session->userdata('network');
        $this->db->select('network_id as id,network_name as name');
    $this->db->from('network');
   if($networkID!=-1){
       $this->db->where('network_id',$networkID);
   }
    $this->db->where('network_active','1');
   
         $this->db->like('network_name',$q);
    $query = $this->db->get();
    return $query->result_array();
    }
    //*****************************************************//
      function get_DReffer($q='',$x='')
{$networkID= $this->session->userdata('network');
    $this->db->select('driverId as id,CONCAT(driverFName,"  ",driverLName," ( ",driverMobile," ) ") as name',FALSE);
    $this->db->from('drivers');
    $wh='';
         if($networkID!=-1){
      //  $this->db->where('networkId',$network);
             $wh.=' networkId ='.$networkID;
         }
 if($x!=''){if($wh!='') $wh.=' AND ';//$this->db->where('networkId',$x);
            $wh.=' networkId ='.$x;}
  if($wh!='') $wh.=' AND ';
    $wh.=' driverActivation <> 0';
        if($wh!='') $wh.=' AND ';
 $x=explode(' ',$q);
//echo count($x);
 if(count($x)==1)
        $wh.="(driverFName LIKE '%".$q."%' OR  driverLName LIKE '%".$q."%' )";
 else   $wh.="(driverFName LIKE '%".$x[0]."%' OR  driverLName LIKE '%".$x[1]."%' )";
        $this->db->where($wh,'',FALSE);
 //   $this->db->where('driverActivation <>','0',FALSE);
  /* if($x!='')$this->db->where('networkId',$x);
         $this->db->like('driverFName',$q);
                $this->db->or_like('driverLName',$q);*/
    $query = $this->db->get();
    return $query->result_array();
}
    //****************************************//
    function get_TripReffer($q='')
    {
         $this->db->select('typeId as id,typeName_'.lang('db').' as name');
    $this->db->from('tripTypes');
   
    $this->db->where('typeStatus','1');
   
         $this->db->like('typeName_'.lang('db'),$q);
    $query = $this->db->get();
    return $query->result_array();
    }
    //************************************************//
    function get_PassReffer($q='')
    {
         $this->db->select('passengerId as id,passengerName as name');
    $this->db->from('passengers');
   
    $this->db->where('passengerActivation <>','0' ,FALSE);
   
         $this->db->like('passengerName',$q);
    $query = $this->db->get();
    return $query->result_array();
    }
    //##########################Account###########################
function get_account()
{   
    $level = $this->input->post('level',TRUE);
    $orderRange = $this->input->post('offerRange',TRUE);
    $country = $this->input->post('country',TRUE);
    $cityId = $this->input->post('cityId',TRUE);
    $network = $this->input->post('network',TRUE);
    $driver = $this->input->post('driver',TRUE);
    $trip_type = $this->input->post('trip_type',TRUE);
    $passenger = $this->input->post('passenger',TRUE);
    $tripNow=explode(',',$this->input->post('tripNow',TRUE));
    
    $paymethod=$this->input->post('paymethod',TRUE);
     $trippromo = $this->input->post('trippromo',TRUE);
    $Status = $this->input->post('sts',TRUE);
    $reason = $this->input->post('reason',TRUE);
    $cost_from = $this->input->post('cost_from',TRUE);
    $cost_to=$this->input->post('cost_to',TRUE);
    
     $dist_from = $this->input->post('dist_from',TRUE);
    $dist_to=$this->input->post('dist_to',TRUE);
  // print_r($tripNow);
    $networkID= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
    $this->db->select("*,CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')  as CreateDate",false);
    $this->db->from('accounts');
        $this->db->join('trips','trips.tripId=acc_trip','left');

        $this->db->join('acc_coment as a','accounts.acc_com_id=a.acc_com_id','left');

    $this->db->join('passengers','trips.tripPassengerId=passengers.passengerId','left');
    $this->db->join('drivers','accounts.acc_driver=drivers.driverId','left');
    $this->db->join('countries','trips.tripCountryId=countries.countryId and countryStatus=1','left');
    $this->db->join('cities','trips.tripCityId=cities.cityId','left');
    // $this->db->join('network','drivers.networkId=network.network_id','left');
     $this->db->join('network','trips.tripNetwork=network.network_id','left');
        $this->db->join('tripTypes','trips.tripType=tripTypes.typeId','left');

      if($networkID!=-1)
        $this->db->where('networkId',$networkID);
    
    if($orderRange!="")
    {
        $orderArr = explode(' to ',$orderRange);
         $this->db->where("DATE(CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')) >=",$orderArr[0]);
        $this->db->where("DATE(CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')) <=",$orderArr[1]);
    //    $this->db->where("DATE(acc_date) >=",$orderArr[0]);
      //  $this->db->where("DATE(tripCreateDate) <=",$orderArr[1]);
    }
   $wh='';
  if($level!='')
    {
      if($wh!='')$wh.=' AND ';
         $level=explode(',',$level);
       // $this->db->where_in('tripLevelId', $level);
       // $this->db->where("tripLevelId",$level);
      
      
      for($i=0;$i<count($level);$i++)
      {
          if($i==0)$wh.=' tripLevelId  IN (';
          else $wh.=',';
          $wh.=$level[$i];
      }
      $wh.=')';
    }
       

    if($country!='')
    { if($wh!='')$wh.=' AND ';
        $country=explode(',',$country);
       for($i=0;$i<count($country);$i++)
      {
          if($i==0)$wh.=' tripCountryId  IN (';
          else $wh.=',';
          $wh.=$country[$i];
      }
      $wh.=')';
      
    }  
    if($cityId!='' )
    { $cityId=explode(',',$cityId);
     if($wh!='')$wh.=' AND ';
      for($i=0;$i<count($cityId);$i++)
      {
          if($i==0)$wh.=' tripCityId  IN (';
          else $wh.=',';
          $wh.=$cityId[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripCityId', $cityId);
       // $this->db->where("tripCityId",$cityId);
    }
  
    if($driver!='')
    {
        if($wh!='')$wh.=' AND ';
        $driver=explode(',',$driver);
         for($i=0;$i<count($driver);$i++)
      {
          if($i==0)$wh.=' acc_driver  IN (';
          else $wh.=',';
          $wh.=$driver[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripDriverId', $driver);
       // $this->db->where("tripDriverId",$driver);        
    }  
    if($network!='')
    {
        if($wh!='')$wh.=' AND ';
        $network=explode(',',$network);
         for($i=0;$i<count($network);$i++)
      {
          if($i==0)$wh.=' networkId  IN (';
          else $wh.=',';
          $wh.=$network[$i];
      }
      $wh.=')';
       // $this->db->where_in('networkId', $network);
       // $this->db->where("networkId",$network);
    }
  if($trip_type!='')
    {
       if($wh!='')$wh.=' AND ';
      $trip_type=explode(',',$trip_type);
       for($i=0;$i<count($trip_type);$i++)
      {
          if($i==0)$wh.=' tripType  IN (';
          else $wh.=',';
          $wh.=$trip_type[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripType', $trip_type);
      //  $this->db->where("tripType",$trip_type);        
    }  
    if($passenger!='')
    {
         if($wh!='')$wh.=' AND ';
        $passenger=explode(',',$passenger);
         for($i=0;$i<count($passenger);$i++)
      {
          if($i==0)$wh.=' tripPassengerId  IN (';
          else $wh.=',';
          $wh.=$passenger[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripPassengerId', $passenger);
        //$this->db->where("tripPassengerId",$passenger);
    }
    
          
 if(count($tripNow)>0 && count($tripNow) <2)
    {
      if($wh!='')$wh.=' AND ';
    
     $str='';
     if(isset($tripNow[0]) && $tripNow[0]>=0)
         $str.=' tripNow='.$tripNow[0];
        //$this->db->where("tripNow",$tripNow[0]);
     if(isset($tripNow[1]) && $tripNow[1]>=0)
     {
         if($str!='')$str.=' OR ';
           $str.='   tripNow='.$tripNow[1];
     }
      $wh.="(".$str.")";
       // $this->db->or_where("tripNow",$tripNow[1]);
    }  
    if($paymethod!=-1 )
    {
        if($wh!='')$wh.=' AND ';
        $wh.='(';
        $wh.='payBy ='.$paymethod;
      //  $this->db->where("payBy",$paymethod);
        if($trippromo==1)  $wh.=" OR payBy = 'promo' ";//$this->db->or_where("payBy",'promo');
        $wh.=')';
    }else {
       if($trippromo==1) { if($wh!='')$wh.=' AND ';//$this->db->where("payBy",'promo'); 
                         $wh.="  payBy = 'promo' ";
                         }
    }
 

    if($Status!=-1)
    {
          if($wh!='')$wh.=' AND ';
          $wh.='tripStatus ='.$Status;
       // $this->db->where("tripStatus",$Status);        
    }  
    if(isset($reason) and $reason>0)
    {  if($wh!='')$wh.=' AND ';
      $wh.='trpCancelReasonId ='.$reason;
       // $this->db->where("trpCancelReasonId",$reason);
    }

    
     if($cost_from!=0)
    {
         if($wh!='')$wh.=' AND ';
      $wh.='tripCost >='.$cost_from;
       // $this->db->where("tripCost >= ",$cost_from);        
    }  
    if($cost_to!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripCost <='.$cost_to;
     //   $this->db->where("tripCost <=",$cost_to);
    }
    
     if($dist_from!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_from;
        //$this->db->where("tripKm >= ",$dist_from);        
    }  
    if($dist_to!=0)
    {
        if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_to;
       // $this->db->where("tripKm <=",$dist_to);
    }
    if($wh!='')
    $this->db->where('('.$wh.')',NULL,FALSE);
    $this->db->order_by('acc_id','desc');
    $query = $this->db->get();
    return $query->result_array();

}
    //##########################page###########################
function get_FTotals()
{   
    $level = $this->input->post('level',TRUE);
    $orderRange = $this->input->post('offerRange',TRUE);
    $country = $this->input->post('country',TRUE);
    $cityId = $this->input->post('cityId',TRUE);
    $network = $this->input->post('network',TRUE);
    $driver = $this->input->post('driver',TRUE);
    $trip_type = $this->input->post('trip_type',TRUE);
    $passenger = $this->input->post('passenger',TRUE);
    $tripNow=explode(',',$this->input->post('tripNow',TRUE));
    
    $paymethod=$this->input->post('paymethod',TRUE);
     $trippromo = $this->input->post('trippromo',TRUE);
    $Status = $this->input->post('sts',TRUE);
    $reasonID = $this->input->post('reason',TRUE);
    $cost_from = $this->input->post('cost_from',TRUE);
    $cost_to=$this->input->post('cost_to',TRUE);
    
     $dist_from = $this->input->post('dist_from',TRUE);
    $dist_to=$this->input->post('dist_to',TRUE);
    /************** Grouping ****************************/
    /* $PassengersGrp = $this->input->post('PassengersGrp',TRUE);
    $NetworkGrp = $this->input->post('NetworkGrp',TRUE);
    $DriversGrp=$this->input->post('DriversGrp',TRUE);
    
     $CityGrp = $this->input->post('CityGrp',TRUE);
    $CountryrGrp=$this->input->post('CountryrGrp',TRUE);
    $DateGrp=$this->input->post('DateGrp',TRUE);
    $tripTypeGrp=$this->input->post('tripTypeGrp',TRUE);
    $stsGrp=$this->input->post('stsGrp',TRUE);*/
     $grCol=$this->input->post('grCol',TRUE);
    $networkID= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
    
    $this->db->select("*,count(acc_id) as tripCount,sum(if(acc_mode=0,acc_value,0)) AS totalCost,sum(if(acc_mode=1,acc_value,0)) AS totalDistance,,CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."') as CreateDate",FALSE);
  $this->db->from('accounts');
        $this->db->join('trips','trips.tripId=acc_trip','left');

        $this->db->join('acc_coment as a','accounts.acc_com_id=a.acc_com_id','left');

    $this->db->join('passengers','trips.tripPassengerId=passengers.passengerId','left');
    $this->db->join('drivers','accounts.acc_driver=drivers.driverId','left');
    $this->db->join('countries','trips.tripCountryId=countries.countryId','left');
    $this->db->join('cities','trips.tripCityId=cities.cityId','left');
   //  $this->db->join('network','drivers.networkId=network.network_id','left');
     $this->db->join('network','trips.tripNetwork=network.network_id','left');
    $this->db->join('tripTypes','trips.tripType=tripTypes.typeId','left');
      if($networkID!=-1)
        $this->db->where('networkId',$networkID);
    if($orderRange!="")
    {
        $orderArr = explode(' to ',$orderRange);
        $this->db->where("DATE(CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')) >=",$orderArr[0]);
        $this->db->where("DATE(CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')) <=",$orderArr[1]);
    }
  $wh='';
  if($level!='')
    {
      if($wh!='')$wh.=' AND ';
         $level=explode(',',$level);
       // $this->db->where_in('tripLevelId', $level);
       // $this->db->where("tripLevelId",$level);
      
      
      for($i=0;$i<count($level);$i++)
      {
          if($i==0)$wh.=' tripLevelId  IN (';
          else $wh.=',';
          $wh.=$level[$i];
      }
      $wh.=')';
    }
       

    if($country!='')
    { if($wh!='')$wh.=' AND ';
        $country=explode(',',$country);
       for($i=0;$i<count($country);$i++)
      {
          if($i==0)$wh.=' tripCountryId  IN (';
          else $wh.=',';
          $wh.=$country[$i];
      }
      $wh.=')';
      
    }  
    if($cityId!='' )
    { $cityId=explode(',',$cityId);
     if($wh!='')$wh.=' AND ';
      for($i=0;$i<count($cityId);$i++)
      {
          if($i==0)$wh.=' tripCityId  IN (';
          else $wh.=',';
          $wh.=$cityId[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripCityId', $cityId);
       // $this->db->where("tripCityId",$cityId);
    }
  
    if($driver!='')
    {
        if($wh!='')$wh.=' AND ';
        $driver=explode(',',$driver);
         for($i=0;$i<count($driver);$i++)
      {
          if($i==0)$wh.=' tripDriverId  IN (';
          else $wh.=',';
          $wh.=$driver[$i];
      }
      $wh.=')';
       // $this->db->where_in('tripDriverId', $driver);
       // $this->db->where("tripDriverId",$driver);        
    }  
    if($network!='')
    {
        if($wh!='')$wh.=' AND ';
        $network=explode(',',$network);
         for($i=0;$i<count($network);$i++)
      {
          if($i==0)$wh.=' networkId  IN (';
          else $wh.=',';
          $wh.=$network[$i];
      }
      $wh.=')';
       // $this->db->where_in('networkId', $network);
       // $this->db->where("networkId",$network);
    }
  if($trip_type!='')
    {
       if($wh!='')$wh.=' AND ';
      $trip_type=explode(',',$trip_type);
       for($i=0;$i<count($trip_type);$i++)
      {
          if($i==0)$wh.=' tripType  IN (';
          else $wh.=',';
          $wh.=$trip_type[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripType', $trip_type);
      //  $this->db->where("tripType",$trip_type);        
    }  
    if($passenger!='')
    {
         if($wh!='')$wh.=' AND ';
        $passenger=explode(',',$passenger);
         for($i=0;$i<count($passenger);$i++)
      {
          if($i==0)$wh.=' tripPassengerId  IN (';
          else $wh.=',';
          $wh.=$passenger[$i];
      }
      $wh.=')';
      //  $this->db->where_in('tripPassengerId', $passenger);
        //$this->db->where("tripPassengerId",$passenger);
    }
    
          
 if(count($tripNow)>0 && count($tripNow)<2)
    {
      if($wh!='')$wh.=' AND ';
    
     $str='';
     if(isset($tripNow[0]) && $tripNow[0]>=0)
         $str.=' tripNow='.$tripNow[0];
        //$this->db->where("tripNow",$tripNow[0]);
     if(isset($tripNow[1]) && $tripNow[1]>=0)
     {
         if($str!='')$str.=' OR ';
           $str.='   tripNow='.$tripNow[1];
     }
      $wh.="(".$str.")";
       // $this->db->or_where("tripNow",$tripNow[1]);
    }  
    if($paymethod!='-1' )
    {
        if($wh!='')$wh.=' AND ';
        $wh.='(';
        $wh.='payBy ='.$paymethod;
      //  $this->db->where("payBy",$paymethod);
        if($trippromo==1)  $wh.=" OR payBy = 'promo' ";//$this->db->or_where("payBy",'promo');
        $wh.=')';
    }else {
       if($trippromo==1) { if($wh!='')$wh.=' AND ';//$this->db->where("payBy",'promo'); 
                         $wh.="  payBy = 'promo' ";
                         }
    }
 

    if($Status!='-1')
    {
          if($wh!='')$wh.=' AND ';
          $wh.='tripStatus ='.$Status;
       // $this->db->where("tripStatus",$Status);        
    }  
    if(isset($reasonID) && $reasonID>0)
    {  if($wh!='')$wh.=' AND ';
      $wh.='trpCancelReasonId ='.$reasonID;
       // $this->db->where("trpCancelReasonId",$reason);
    }

    
     if($cost_from!=0)
    {
         if($wh!='')$wh.=' AND ';
      $wh.='tripCost >='.$cost_from;
       // $this->db->where("tripCost >= ",$cost_from);        
    }  
    if($cost_to!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripCost <='.$cost_to;
     //   $this->db->where("tripCost <=",$cost_to);
    }
    
     if($dist_from!=0)
    {if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_from;
        //$this->db->where("tripKm >= ",$dist_from);        
    }  
    if($dist_to!=0)
    {
        if($wh!='')$wh.=' AND ';
      $wh.='tripKm <='.$dist_to;
       // $this->db->where("tripKm <=",$dist_to);
    }
    if($wh!='')
    $this->db->where('('.$wh.')',NULL,FALSE);
    if($grCol==1)
    $this->db->group_by('tripCountryId');
     if($grCol==5)
    $this->db->group_by('tripPassengerId');
     if($grCol==4)
    $this->db->group_by('networkId');
     if($grCol==3)
    $this->db->group_by('tripDriverId');
     if($grCol==2)
    $this->db->group_by('tripCityId');
          if($grCol==6)
    $this->db->group_by('tripCreateDate');
    if($grCol==7) $this->db->group_by('tripType');
     if($grCol==8) $this->db->group_by('tripStatus');
    $query = $this->db->get();
    return $query->result_array();

}
    /***************************************************/
    function get_Credit()
    {
        
    $level = $this->input->post('level',TRUE);
    $orderRange = $this->input->post('offerRange',TRUE);
    $country = $this->input->post('country',TRUE);
    $cityId = $this->input->post('cityId',TRUE);
    $network = $this->input->post('network',TRUE);
    $driver = $this->input->post('driver',TRUE);
    $trip_type = $this->input->post('trip_type',TRUE);
    $passenger = $this->input->post('passenger',TRUE);
    $tripNow=explode(',',$this->input->post('tripNow',TRUE));
    
    $paymethod=$this->input->post('paymethod',TRUE);
     $trippromo = $this->input->post('trippromo',TRUE);
    $Status = $this->input->post('sts',TRUE);
    $reason = $this->input->post('reason',TRUE);
    $cost_from = $this->input->post('cost_from',TRUE);
    $cost_to=$this->input->post('cost_to',TRUE);
    
     $dist_from = $this->input->post('dist_from',TRUE);
    $dist_to=$this->input->post('dist_to',TRUE);
  // print_r($tripNow);
    $networkID= $this->session->userdata('network');
        $TimeZone= $this->session->userdata('timeZone');
        
    $this->db->select("*,CONVERT_TZ(acc_date,'+00:00','".$TimeZone."') AS CreateDate",FALSE);
    $this->db->from('accounts');
        $this->db->join('trips','trips.tripId=acc_trip','left');

        $this->db->join('acc_coment as a','accounts.acc_com_id=a.acc_com_id','left');

    $this->db->join('passengers','trips.tripPassengerId=passengers.passengerId','left');
    $this->db->join('drivers','accounts.acc_driver=drivers.driverId','left');
    $this->db->join('countries','trips.tripCountryId=countries.countryId','left');
    $this->db->join('cities','trips.tripCityId=cities.cityId','left');
    // $this->db->join('network','drivers.networkId=network.network_id','left');
         $this->db->join('network','trips.tripNetwork=network.network_id','left');
        $this->db->join('tripTypes','trips.tripType=tripTypes.typeId','left');

      if($networkID!=-1)
        $this->db->where('networkId',$networkID);
    
    if($orderRange!="")
    {
        $orderArr = explode(' to ',$orderRange);
        $this->db->where("DATE(CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')) >=",$orderArr[0]);
        $this->db->where("DATE(CONVERT_TZ(acc_date,'+00:00','".$TimeZone."')) <=",$orderArr[1]);
    }
   $wh='acc_mode =1 and a.acc_com_id=1 ';
  

   
    if($driver!='')
    {
        if($wh!='')$wh.=' AND ';
        $driver=explode(',',$driver);
         for($i=0;$i<count($driver);$i++)
      {
          if($i==0)$wh.=' tripDriverId  IN (';
          else $wh.=',';
          $wh.=$driver[$i];
      }
      $wh.=')';
             
    }  
    if($network!='')
    {
        if($wh!='')$wh.=' AND ';
        $network=explode(',',$network);
         for($i=0;$i<count($network);$i++)
      {
          if($i==0)$wh.=' networkId  IN (';
          else $wh.=',';
          $wh.=$network[$i];
      }
      $wh.=')';
       // $this->db->where_in('networkId', $network);
       // $this->db->where("networkId",$network);
    }
 
          
 

   
    if($wh!='')
    $this->db->where('('.$wh.')',NULL,FALSE);
    $this->db->order_by('acc_id','desc');
    $query = $this->db->get();
    return $query->result_array();
    }
      //##########################page###########################
function get_STotals()
{   
    
    $orderRange = $this->input->post('offerRange',TRUE);
   
    $network = $this->input->post('network',TRUE);
    $driver = $this->input->post('driver',TRUE);
    
    $passenger = $this->input->post('passenger',TRUE);
    $repType=$this->input->post('rep_type',TRUE);
    $tenRequest=$this->input->post('tenRequest',TRUE);
    $bitmode=$this->input->post('bitmode',TRUE);
   if(!isset($bitmode))
   {
       $bitmode=0;
   }
   //echo $bitmode;
     
    $networkID= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
    if($repType==1){
                    $cols='*,count(tripId) as Ids';
                         $this->db->select($cols,FALSE);
                         $this->db->from(' trips as a');


                    $this->db->join('passengers as b','a.tripPassengerId=b.passengerId','inner');
                    $this->db->join('drivers as c','a.tripDriverId=c.driverId','inner');

                 //    $this->db->join('network as d','c.networkId=d.network_id','inner');
                    $this->db->join('network as d','a.tripNetwork=d.network_id','left');
                        if($networkID!=-1)
                        $this->db->where('networkId',$networkID);
                    if($orderRange!="")
                    {
                        $orderArr = explode(' to ',$orderRange);
                       $this->db->where("DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) >=",$orderArr[0]);
                        $this->db->where("DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) <=",$orderArr[1]);
                    }
                  $wh='tripStatus = 6';
                           if($wh!='')
                    $this->db->where('('.$wh.')',NULL,FALSE);
                 if($tenRequest==1)
                    $this->db->group_by('a.tripPassengerId');
                 else if($tenRequest==2)$this->db->group_by('d.network_id');
                  else if($tenRequest==3)$this->db->group_by('c.driverId');
                 $this->db->order_by('Ids','desc');
                 $this->db->limit(10);
        $query = $this->db->get();
    return $query->result_array();
    }
    else if($repType==2){
        $cols="*,COUNT(a.tripId) AS Ids,DATE_FORMAT(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."'),'%H:%i') as Timing";
        $q="Select ".$cols." FROM 			`trips` AS a  INNER JOIN `passengers` AS b ON `a`.`tripPassengerId` = `b`.`passengerId`  INNER JOIN `drivers` AS c ON `a`.`tripDriverId` = `c`.`driverId`		INNER JOIN `network` AS d ON `c`.`networkId` = `d`.`network_id` WHERE tripStatus = 6";
       if($orderRange!="")
                    {
                        $orderArr = explode(' to ',$orderRange);
                      $q.=" AND DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) >=".$orderArr[0];
                         $q.=" AND DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) <=".$orderArr[1];
                    }
             if($networkID!=-1)
                 $q.=" AND networkId =".$networkID;
        $q.=" GROUP BY HOUR(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')),MINUTE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."'))";
        
     //   $this->db->query($q);
        $query = $this->db->query($q);
    return $query->result_array();
    }
    else if($repType==3){
      //  $cols=" t.`Range`,	count(*) AS Ids";
       
          if($bitmode==0){
              $c="tripKm";
        }else {
            $c="tripCost";
        }
         $q="Select t.`Range`,	count(*) AS Ids  FROM ";
  $q.="  (";
		 $q.="SELECT ";
 $q.="			 CASE";
   $q.=" when ".$c." between 0 and 10 then '0-10'";
    $q.="  when ".$c." between 10 and 20 then '21-30'";
     $q.=" when ".$c." between 30 and 40 then '31-40'";
     $q.=" when ".$c." between 40 and 50 then '41-50'";
     $q.=" when ".$c." between 50 and 60 then '51-60'";
	  $q.="	when ".$c." between 60 and 70 then '61-70'";
  $q.="   when ".$c." between 70 and 80 then '71-80'";
    $q.="  when ".$c." between 80 and 90 then '81-90'";
    $q.="  when ".$c." between 90 and 100 then '91-100'";
    $q.="  when ".$c." between 100 and 110 then '101-110'";
	  $q.="	when ".$c." between 110 and 120 then '111-120'";
    $q.="  when ".$c." between 120 and 130 then '121-130'";
     $q.=" when ".$c." between 130 and 140 then '131-140'";
    $q.="  when ".$c." between 140 and 150 then '141-150'";
    $q.="  when ".$c." between 150 and 160 then '151-160'";
  $q.="		when ".$c." between 160 and 170 then '161-170'";
   $q.="   when ".$c." between 170 and 180 then '171-180'";
    $q.="  when ".$c." between 180 and 190 then '181-190'";
    $q.="  when ".$c." between 190 and 200 then '191-200'";
    
     $q.=" else 'more than 200'";
	 $q.="	END AS `Range`,";
	 $q.="	tripId,	tripTime";
	 $q.="	FROM";
		 $q.="	`trips` AS a  INNER JOIN `passengers` AS b ON `a`.`tripPassengerId` = `b`.`passengerId`  INNER JOIN `drivers` AS c ON `a`.`tripDriverId` = `c`.`driverId`		INNER JOIN `network` AS d ON `c`.`networkId` = `d`.`network_id`";
 $q.="where a.tripStatus=6";
         if($orderRange!="")
                    {
                        $orderArr = explode(' to ',$orderRange);
                      $q.="  AND DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) >=".$orderArr[0];
                         $q.="  AND DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) <=".$orderArr[1];
                    }
             if($networkID!=-1)
                 $q.="  AND networkId =".$networkID;
	 $q.=") AS t " ;
        
   $q.= "  GROUP BY `Range`";
       // $this->db->query($q);
        $query = $this->db->query($q);
    return $query->result_array();
    }
       

          

 

   
   
 
 
    

}
    //****************************************/
    function Sreport2()
    {
         $orderRange = $this->input->post('offerRange',TRUE);
   
    
    $repType=$this->input->post('rep_type',TRUE);
   
     
    $networkID= $this->session->userdata('network');
    $TimeZone= $this->session->userdata('timeZone');
        
        
         
            $c="tripCost";
       
         $q="Select t.`Range`,	count(*) AS Ids  FROM ";
  $q.="  (";
		 $q.="SELECT ";
 $q.="			 CASE";
   $q.=" when ".$c." between 0 and 10 then '0-10'";
    $q.="  when ".$c." between 10 and 20 then '21-30'";
     $q.=" when ".$c." between 30 and 40 then '31-40'";
     $q.=" when ".$c." between 40 and 50 then '41-50'";
     $q.=" when ".$c." between 50 and 60 then '51-60'";
	  $q.="	when ".$c." between 60 and 70 then '61-70'";
  $q.="   when ".$c." between 70 and 80 then '71-80'";
    $q.="  when ".$c." between 80 and 90 then '81-90'";
    $q.="  when ".$c." between 90 and 100 then '91-100'";
    $q.="  when ".$c." between 100 and 110 then '101-110'";
	  $q.="	when ".$c." between 110 and 120 then '111-120'";
    $q.="  when ".$c." between 120 and 130 then '121-130'";
     $q.=" when ".$c." between 130 and 140 then '131-140'";
    $q.="  when ".$c." between 140 and 150 then '141-150'";
    $q.="  when ".$c." between 150 and 160 then '151-160'";
  $q.="		when ".$c." between 160 and 170 then '161-170'";
   $q.="   when ".$c." between 170 and 180 then '171-180'";
    $q.="  when ".$c." between 180 and 190 then '181-190'";
    $q.="  when ".$c." between 190 and 200 then '191-200'";
    
     $q.=" else 'more than 200'";
	 $q.="	END AS `Range`,";
	 $q.="	tripId,	tripTime";
	 $q.="	FROM";
		 $q.="	`trips` AS a  INNER JOIN `passengers` AS b ON `a`.`tripPassengerId` = `b`.`passengerId`  INNER JOIN `drivers` AS c ON `a`.`tripDriverId` = `c`.`driverId`		INNER JOIN `network` AS d ON `a`.`tripNetwork` = `d`.`network_id`";
 $q.="where a.tripStatus=6";
         if($orderRange!="")
                    {
                        $orderArr = explode(' to ',$orderRange);
                      $q.="  AND DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) >=".$orderArr[0];
                         $q.="  AND DATE(CONVERT_TZ(tripCreateDate,'+00:00','".$TimeZone."')) <=".$orderArr[1];
                    }
             if($networkID!=-1)
                 $q.="  AND networkId =".$networkID;
	 $q.=") AS t " ;
        
   $q.= "  GROUP BY `Range`";
      //echo $q;
        $query = $this->db->query($q);
    return $query->result_array();
    }
//===========================	  
}//end model


?>