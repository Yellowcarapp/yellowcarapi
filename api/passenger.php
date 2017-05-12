<?php
include_once('config.php');
$app->post('/GenerateCode/:passengerId/:column', 'GenerateCode');
$app->delete('/DeleteTrip/:tripId', 'DeleteTrip');
function DeleteTrip($tripId)
{
    try {
        $dbCon = getConnection();
        $query = "DELETE FROM trips WHERE  tripId=$tripId";
        $stmt = $dbCon->query($query);  
        $user = $stmt-> execute();
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


$app->post('/Checkresetcode/:passengerId/:resetcode/:passengerPass', 'Checkresetcode');

function Checkresetcode($passengerId,$resetcode,$passengerPass){
      
     try {
         $dbCon = getConnection();
         $resetsuccess  = CheckField('passengers','resetcode',$resetcode,$passengerId);
         if(!$resetsuccess ) echo 'resetcode error';
         else{
             $query="update passengers set passengerPass='".md5($passengerPass)."'  WHERE passengerId=".$passengerId;
             $stmt = $dbCon->prepare($query);  
             $stmt->execute();
             $dbCon = null;
         }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
 }
$app->post('/ResetPassword/:data', 'ResetPassword');
function ResetPassword($data){
    global $app;
    $data2 = json_decode($app->request()->getBody(),true);
    if(!isset($data2['countryTel']))$data2['countryTel']='';
    try {
        $dbCon = getConnection();
        $EmailExist = CheckField('passengers','passengerEmail',$data);
        $MobExist = CheckField('passengers','passengerMobile',$data2['countryTel'].ltrim($data,'0'));
        
        if(!$EmailExist&&!$MobExist)echo 'data not exist';
        else{
             $query = 'SELECT passengers.*,countryTel FROM passengers LEFT join countries on countryId=passengerCountryId WHERE passengerEmail="'.$data.'" or passengerMobile="'.$data2['countryTel'].ltrim($data,'0').'"';
             //echo $query;
             $stmt = $dbCon->query($query);  
             $users  = $stmt->fetchObject();   
             $Moblie=ltrim($users->passengerMobile,'0');  //$users->countryTel.
             $resetcode  = mt_rand(100000,999999); 
             $query='update passengers set resetcode='.$resetcode.' WHERE passengerId='.$users->passengerId;
             $stmt = $dbCon->prepare($query);  
             $stmt->execute();
             SendSms($Moblie,$resetcode);
             $dbCon = null;
            echo '{"rows": ' . json_encode($users) .'}';            
        }
         
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
 }


$app->get('/checkoffer/:offerText/:countryId/:cityId/:levelId/:offerExpireDate/:PassengerId', 'CheckOffer');
function CheckOffer($offerText,$countryId,$cityId,$levelId,$offerExpireDate,$PassengerId) 
{
    $dbCon = getConnection();
    global $offer;
    $Query = "select * from offers where offerText='".urldecode($offerText)."' and (countryId=-1 or countryId=".$countryId.") and (cityId=-1 or cityId=".$cityId.") and (levelId=-1 or levelId=".$levelId.") and offerExpireDate>='".urldecode($offerExpireDate)."'";
    $stmt = $dbCon->query($Query); 
    $result  = $stmt-> fetchObject();
    if($result) {
         $Query = "select * from trips where tripPassengerId=".$PassengerId." and tripStatus<7 and offerId=".$result->offerId;
        // $Query = "select * from offerLog where userId=".$PassengerId." offerId=".$result->offerId;
         $stmt = $dbCon->query($Query);  
         $result2  = $stmt-> fetchObject(); 
         if($result2 && $result->offerType!='multi') $offer['rows']='used';
         else $offer['rows']=$result;
    }
    else $offer['rows']='not found';
    $dbCon = null;
    echo json_encode($offer); 
}

$app->get('/getcountrycity/countrycity', 'GetCountryCity');
function GetCountryCity() 
{
    $dbCon = getConnection();
    $Query = 'select * from countries where countryStatus=1';
    $stmt = $dbCon->query($Query);  
    $result['countries']  = $stmt->fetchAll(PDO::FETCH_OBJ); 
    
    $Query = 'select * from cities where cityStatus=1';
    $stmt = $dbCon->query($Query);  
    $result['cities']  = $stmt->fetchAll(PDO::FETCH_OBJ);
    $dbCon = null;
    echo json_encode($result); 
}

$app->get('/page/:pageId', 'Page');
function Page($pageId) 
{
    global $app;
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM pages WHERE  pageId=$pageId";
        $stmt = $dbCon->query($query);  
        $user = $stmt-> fetchObject();
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/prices/:typeId/:levelId/:packageId/:cityId', 'Prices');
function Prices($typeId,$levelId,$packageId,$cityId) 
{
    global $app;
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM prices WHERE  typeId=$typeId AND levelId=$levelId AND packageId=$packageId ANd cityId=$cityId";
        $stmt = $dbCon->query($query);  
        $user = $stmt->fetchObject();
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/history/:passengerId/:offset', 'History');
function History($passengerId,$offset) 
{
    global $app;
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM trips as tr LEFT JOIN drivers as dr ON dr.driverId=tr.tripDriverId LEFT JOIN brands as br ON br.brandId=dr.brandId LEFT JOIN models as mo ON mo.modelId=dr.modelId LEFT JOIN levels as lv ON lv.levelId=dr.levelId WHERE  tripPassengerId=$passengerId  ORDER By tripId DESC LIMIT $offset,10";
        $stmt = $dbCon->query($query);  
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->post('/signin', 'SignIn');

function SignIn() 
{
    global $app;
    $data = json_decode($app->request()->getBody(),true);
    if(!isset($data['countryTel']))$data['countryTel']='';
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM passengers WHERE  1=1 ";
        if(isset($data['passengerEmail']) && !empty($data['passengerEmail']))  
                $query.=" AND passengerEmail='".$data['passengerEmail']."' ";
        if(isset($data['passengerMobile']) && !empty($data['passengerMobile']))  
                $query.=" AND passengerMobile='".$data['countryTel'].ltrim($data['passengerMobile'],'0')."' ";
        if(isset($data['passengerPass']) && !empty($data['passengerPass']))  $query.="  AND passengerPass='".md5($data['passengerPass'])."' ";

        $stmt = $dbCon->query($query);  
        $user = $stmt->fetchObject();  
        if(json_encode($user)!='false'){
            $query='update passengers set passengerLastLogin="'.date('Y-m-d H:i:s').'"  WHERE passengerId='.$user->passengerId;
            $stmt = $dbCon->prepare($query);  
            $stmt->execute();
        }
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->post('/checkprofile', 'CheckProfile');

function CheckProfile() 
{
    global $app;
    $data = json_decode($app->request()->getBody(),true);
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM passengers WHERE passengerId!=".$data['passengerId'];
        if(isset($data['passengerEmail']) && !empty($data['passengerEmail']))  
                $query.=" AND passengerEmail='".$data['passengerEmail']."' ";
        if(isset($data['passengerMobile']) && !empty($data['passengerMobile']))  
                $query.=" AND passengerMobile='".$data['passengerMobile']."' ";

        $stmt = $dbCon->query($query);  
        $user = $stmt->fetchObject();  
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/query/:query', 'Query');
function Query($query) 
{   global $app;
    if(!isset($_GET['encode']))
    $query=urldecode($query);
    
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->query($query);  
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"rows": ' . json_encode($users) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

$app->get('/CurrentTrip/:passengerId', 'CurrentTrip');
function CurrentTrip($passengerId) 
{
    try {
        $dbCon = getConnection();
        $query = 'SELECT * FROM trips as tr JOIN drivers as dr ON dr.driverId=tr.tripDriverId JOIN passengers as ps ON ps.passengerId=tr.tripPassengerId JOIN brands as br ON br.brandId=dr.brandId JOIN models as mo ON mo.modelId=dr.modelId JOIN levels as lv ON lv.levelId=dr.levelId where tr.tripStatus in(3,4,5) and tr.tripPassengerId='.$passengerId.' order By tr.tripId DESC LIMIT 1';
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
if(is_array($user) and count($user) and !empty($user[0]))
{

                    $user[0]->tripFrom = json_decode($user[0]->tripFrom);
                    $user[0]->tripTo = json_decode($user[0]->tripTo);
                    $user[0]->tripRealDropoff = json_decode($user[0]->tripRealDropoff);

}
        echo '{"rows": ' . json_encode($user,JSON_NUMERIC_CHECK) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/Reasons/:Tag', 'Reasons');
function Reasons($tag) 
{
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM reasons where reasonTag='".$tag."'";
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"rows": ' . json_encode($user,JSON_NUMERIC_CHECK) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/MyMarkers/:passengerId', 'MyMarkers');

function MyMarkers($passengerId) 
{
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM markers where passengerId=".$passengerId;
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo '{"rows": ' . json_encode($user,JSON_NUMERIC_CHECK) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/PlacesMarkers', 'PlacesMarkers');

function PlacesMarkers() 
{
    try {
        $dbCon = getConnection();
        $query = "SELECT placeName_en as markerTitle,placeAddress as markerAddress FROM places ";
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo '{"rows": ' . json_encode($user,JSON_NUMERIC_CHECK) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/Settings', 'Settings');

function Settings() 
{
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM settings";
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $return = array();
        foreach ($user as $key => $value) {
            $return[$value->name]=$value->value;
        }
        $dbCon = null;
        echo '{"rows": ' . json_encode($return,JSON_NUMERIC_CHECK) .'}';
       //echo '{"rows": ' . json_encode($user) . ',"$data":'.json_encode($data).'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/getlevels/:packageId/:countryId/:cityId/:typeId', 'GetLevels');

function GetLevels($packageId,$countryId,$cityId,$typeId) 
{
    try {
        $dbCon = getConnection();
        $query = "SELECT l.*,p.minNow FROM levels l left join prices p on (l.levelId=p.levelId and packageId=".$packageId." and countryId=".$countryId." and cityId=".$cityId." and typeId=".$typeId.") where levelStatus=1 ";
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo '{"rows": ' . json_encode($user,JSON_NUMERIC_CHECK) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->get('/Levels', 'Levels');

function Levels() 
{
    try {
        $dbCon = getConnection();
        $query = "SELECT * FROM levels";
        $stmt = $dbCon->query($query);  
        $user  = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo '{"rows": ' . json_encode($user,JSON_NUMERIC_CHECK) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->post('/AddMarker', 'AddMarker');

function AddMarker() 
{
    global $app;
    $data = json_decode($app->request()->getBody(),true);
    $keys = array_keys($data);
    $sql = "INSERT INTO markers (".join($keys,',').") VALUES (:".join($keys,', :').")";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        foreach($data as $key=>$value)
        {
            $stmt->bindParam($key, $data[$key]);
        }
        $stmt->execute();
        $user['id'] = $dbCon->lastInsertId();
        $dbCon = null;
        echo '{"rows": ' . json_encode($user) .'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

$app->post('/RemoveMarker', 'RemoveMarker');

function RemoveMarker() 
{
    global $app;
    $data = json_decode($app->request()->getBody(),true);
    $sql = "DELETE FROM markers WHERE markerId=:markerId";
    try 
    {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("markerId", $data['markerId']);
        $status['status'] = $stmt->execute();
        $dbCon = null;
        echo json_encode($data['markerId']);
    } 
    catch(PDOException $e) 
    {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

$app->post('/CheckActivationCode/:passengerId/:passengerActivation', 'CheckActivationCode');

function CheckActivationCode($passengerId,$passengerActivation){
      
     try {
         $dbCon = getConnection();
         $Activationsuccess  = CheckField('passengers','passengerActivation',$passengerActivation,$passengerId);
         if(!$Activationsuccess ) echo 'Activation error';
         else{
             $query='update passengers set passengerActivation=1 WHERE passengerId='.$passengerId;
             $stmt = $dbCon->prepare($query);  
             $stmt->execute();
             $dbCon = null;
         }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
 }
$app->post('/UpdateMobileNumber/:passengerId/:mobile', 'UpdateMobileNumber');
function UpdateMobileNumber($passengerId,$mobile){
      
    global $app;
    $data = json_decode($app->request()->getBody(),true);
    if(!isset($data['countryTel']))$data['countryTel']='';
    $mobile = ltrim($mobile,'0');
    $mobile=$data['countryTel'].$mobile;

     try {
         $dbCon = getConnection();
         $MobExist = CheckField('passengers','passengerMobile',$mobile,$passengerId);
         if($MobExist) echo 'Mobile exist';
         else{
             echo 'Mobile not exist';
             $ActivationCode = mt_rand(100000,999999);
             $query='update passengers set passengerMobile='.$mobile.',passengerActivation='.$ActivationCode.' WHERE passengerId='.$passengerId;
             $stmt = $dbCon->query($query);  
             SendSms($mobile,$ActivationCode);
             $dbCon = null;
         }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
 }

function CheckField($table,$column,$value,$passengerId='')
{
    try {
        $dbCon = getConnection();
        $sql = "SELECT * FROM {$table} where {$column}='{$value}' ";
        if(!empty($passengerId)&&$column!='passengerActivation'&&$column!='resetcode') $sql.=' and passengerId!='.$passengerId;
        else if(!empty($passengerId)&&($column=='passengerActivation'||$column=='resetcode')) $sql.=' and passengerId='.$passengerId;
        $stmt = $dbCon->query($sql);  
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
        unset($dbCon);
        return count($users);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function InsertInToTable($table,$Obj)
{   global $app;
    $dbCon = getConnection();
    $keys = array_keys($Obj);
    $sql = "INSERT INTO {$table} (".join($keys,',').") VALUES (:".join($keys,', :').")";
    $stmt = $dbCon->prepare($sql);  
    foreach($Obj as $key=>$value)
    {
        $stmt->bindParam($key, $Obj[$key]);
    }
    $stmt->execute();
    $user['id'] = $dbCon->lastInsertId();
    if($table=='passengers'){
        GenerateCode($user['id'],'passengerActivation');
    }
    unset($dbCon);
    return $user;
}

 function GenerateCode($passengerId,$column){
     $ActivationCode = mt_rand(100000,999999); 
     try {
         $dbCon = getConnection();
         $query = "SELECT passengers.*,countryTel FROM passengers join countries on countryId=passengers.passengerCountryId WHERE passengerId=".$passengerId;
         $stmt = $dbCon->query($query);  
         $users  = $stmt->fetchObject();   
         $Moblie=$users->passengerMobile;        
         $query='update passengers set '.$column.'='.$ActivationCode.' WHERE passengerId='.$passengerId;
         $stmt = $dbCon->prepare($query);  
         $stmt->execute();
         SendSms($Moblie,$ActivationCode);
         $dbCon = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
 }

function SendSms($numbers, $msg)
{
	$userAccount='Doc-Go'; 
	$passAccount='Lib@123';
	$sender="Doc-Go";
	$url = "www.mobily.ws/api/msgSend.php";
	$applicationType = "24";  
    $msg = convertToUnicode($msg);
	$sender = urlencode($sender);
	$domainName = $_SERVER['SERVER_NAME'];
$isSaudi=false;
    $numbers3d=substr($numbers,0,3);
    if($numbers3d=='966')
{ $numbers=substr($numbers,3);$isSaudi=true;}
    $numbers2d=substr($numbers,0,2);
    if($numbers2d=='05'){ $numbers=substr($numbers,1);$isSaudi=true;}
//if($isSaudi)
$numbers = '966'.$numbers;
    $stringToPost = "mobile=".$userAccount."&password=".$passAccount."&numbers=".$numbers."&sender=".$sender."&msg=".$msg."&applicationType=24";
//echo $stringToPost;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringToPost);
        $result = curl_exec($ch);
}
    
$app->post('/passengersignup', 'PassengerSignUp');
function PassengerSignUp() 
{
    global $app;
    $data = json_decode($app->request()->getBody(),true);
    if(!isset($data['countryTel']))$data['countryTel']='';
    $data['passengerMobile'] = ltrim($data['passengerMobile'],'0');
    $data['passengerMobile']=$data['countryTel'].$data['passengerMobile'];
    $data['passengerCreateDate']=date('Y-m-d H:i:s');

    $EmailExist = CheckField('passengers','passengerEmail',$data['passengerEmail']);
    $MobExist = CheckField('passengers','passengerMobile',$data['passengerMobile']);
    try {
        if($EmailExist)echo 'Email exist';
        else if($MobExist) echo 'Mobile exist';
        else{
           if(isset($data['passengerPass']))  $data['passengerPass']= md5($data['passengerPass']);
             unset($data['countryTel']);
            $user = InsertInToTable('passengers',$data); // Insert User To Table
            echo json_encode($user); 
        }
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

$app->delete('/deletepassenger/:passengerId','DeletePassenger');
 function DeletePassenger($passengerId) {   
    $sql = "DELETE FROM passengers WHERE passengerId=:passengerId";
    try 
    {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("passengerId", $passengerId);
        $status['status'] = $stmt->execute();
        $dbCon = null;
        echo json_encode($passengerId);
    } 
    catch(PDOException $e) 
    {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

$app->get('/allpassengers', 'AllPassengers');
function AllPassengers() 
{
        $sql = "SELECT * FROM passengers";
    try {
        $dbCon = getConnection();
        $stmt = $dbCon->query($sql);  
        $users  = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo '{"rows": ' . json_encode($users) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}



$app->post('/update_passenger22/:passengerId', 'UpdatePassenger22');
function UpdatePassenger22($passengerId) 
{
    global $app;
    $data = json_decode($app->request()->getBody (),true);    
    $sql = "UPDATE passengers SET ";
    foreach($data as $key=>$value)
    {
        $sql .="$key=:$key,";
    }
    $sql =trim($sql,',');
    $sql .=" WHERE passengerId=:passengerId";
    
    try 
    {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        foreach($data as $key=>$value){
            if($key == 'passengerPass') 
            {   
                if($data['passengerPass']!=''){
                    $pass=md5($data[$key]);
                    $stmt->bindParam($key, $pass);
                }
            }
            else $stmt->bindParam($key, $data[$key]);
        
        }
        $stmt->bindParam("passengerId", $passengerId);
        $status['status'] = $stmt->execute();
        
        $dbCon = null;
        echo json_encode($status); 
    } 
    catch(PDOException $e) 
    {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

$app->put('/updatepassengers/:passengerId', 'UpdatePassengers');
function UpdatePassengers($passengerId) 
{
    global $app;
    $data = json_decode($app->request()->getBody (),true);    
    $sql = "UPDATE passengers SET ";
    foreach($data as $key=>$value)
    {
        $sql .="$key=:$key,";
    }
    $sql =trim($sql,',');
    $sql .=" WHERE passengerId=:passengerId";
    
    try 
    {
        $dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        foreach($data as $key=>$value){
            if($key == 'passengerPass') 
            {   
                if($data['passengerPass']!=''){
                    $pass=md5($data[$key]);
                    $stmt->bindParam($key, $pass);
                }
            }
            else $stmt->bindParam($key, $data[$key]);
        
        }
        $stmt->bindParam("passengerId", $passengerId);
        $status['status'] = $stmt->execute();
        
        $dbCon = null;
        echo json_encode($status); 
    } 
    catch(PDOException $e) 
    {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}


$app->post('/passengertest', 'PassengerTest');
function PassengerTest() 
{
    global $app;
    $data=json_decode($app->request()->getBody(),true);
    $sql="INSERT INTO passengers (";
    $sql_value=' VALUES (';
    
        
    foreach($data as $key=>$value)
    {
        $sql .=$key .",";
        $sql_value .=$value . ",";   
    }
    $sql =trim($sql,',');
    $sql .=')';
    $sql_value =trim($sql_value,',');
    $sql .= $sql_value;
    $sql .=')';
    try {
        /*$dbCon = getConnection();
        $stmt = $dbCon->prepare($sql);  
        foreach($data as $key=>$value)
        {
            if($key == 'passengerPass') 
            {
                $pass=md5($data[$key]);
                $stmt->bindParam($key, $pass);
            }
            else $stmt->bindParam($key, $data[$key]);
        }
        $stmt->execute();
        $user['id'] = $dbCon->lastInsertId();
        $dbCon = null;
        echo json_encode($user); */
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

    
function convertToUnicode($message)
{
	$chrArray[0] = "�";
	$unicodeArray[0] = "060C";
	$chrArray[1] = "�";
	$unicodeArray[1] = "061B";
	$chrArray[2] = "�";
	$unicodeArray[2] = "061F";
	$chrArray[3] = "�";
	$unicodeArray[3] = "0621";
	$chrArray[4] = "�";
	$unicodeArray[4] = "0622";
	$chrArray[5] = "�";
	$unicodeArray[5] = "0623";
	$chrArray[6] = "�";
	$unicodeArray[6] = "0624";
	$chrArray[7] = "�";
	$unicodeArray[7] = "0625";
	$chrArray[8] = "�";
	$unicodeArray[8] = "0626";
	$chrArray[9] = "�";
	$unicodeArray[9] = "0627";
	$chrArray[10] = "�";
	$unicodeArray[10] = "0628";
	$chrArray[11] = "�";
	$unicodeArray[11] = "0629";
	$chrArray[12] = "�";
	$unicodeArray[12] = "062A";
	$chrArray[13] = "�";
	$unicodeArray[13] = "062B";
	$chrArray[14] = "�";
	$unicodeArray[14] = "062C";
	$chrArray[15] = "�";
	$unicodeArray[15] = "062D";
	$chrArray[16] = "�";
	$unicodeArray[16] = "062E";
	$chrArray[17] = "�";
	$unicodeArray[17] = "062F";
	$chrArray[18] = "�";
	$unicodeArray[18] = "0630";
	$chrArray[19] = "�";
	$unicodeArray[19] = "0631";
	$chrArray[20] = "�";
	$unicodeArray[20] = "0632";
	$chrArray[21] = "�";
	$unicodeArray[21] = "0633";
	$chrArray[22] = "�";
	$unicodeArray[22] = "0634";
	$chrArray[23] = "�";
	$unicodeArray[23] = "0635";
	$chrArray[24] = "�";
	$unicodeArray[24] = "0636";
	$chrArray[25] = "�";
	$unicodeArray[25] = "0637";
	$chrArray[26] = "�";
	$unicodeArray[26] = "0638";
	$chrArray[27] = "�";
	$unicodeArray[27] = "0639";
	$chrArray[28] = "�";
	$unicodeArray[28] = "063A";
	$chrArray[29] = "�";
	$unicodeArray[29] = "0641";
	$chrArray[30] = "�";
	$unicodeArray[30] = "0642";
	$chrArray[31] = "�";
	$unicodeArray[31] = "0643";
	$chrArray[32] = "�";
	$unicodeArray[32] = "0644";
	$chrArray[33] = "�";
	$unicodeArray[33] = "0645";
	$chrArray[34] = "�";
	$unicodeArray[34] = "0646";
	$chrArray[35] = "�";
	$unicodeArray[35] = "0647";
	$chrArray[36] = "�";
	$unicodeArray[36] = "0648";
	$chrArray[37] = "�";
	$unicodeArray[37] = "0649";
	$chrArray[38] = "�";
	$unicodeArray[38] = "064A";
	$chrArray[39] = "�";
	$unicodeArray[39] = "0640";
	$chrArray[40] = "�";
	$unicodeArray[40] = "064B";
	$chrArray[41] = "�";
	$unicodeArray[41] = "064C";
	$chrArray[42] = "�";
	$unicodeArray[42] = "064D";
	$chrArray[43] = "�";
	$unicodeArray[43] = "064E";
	$chrArray[44] = "�";
	$unicodeArray[44] = "064F";
	$chrArray[45] = "�";
	$unicodeArray[45] = "0650";
	$chrArray[46] = "�";
	$unicodeArray[46] = "0651";
	$chrArray[47] = "�";
	$unicodeArray[47] = "0652";
	$chrArray[48] = "!";
	$unicodeArray[48] = "0021";
	$chrArray[49]='"';
	$unicodeArray[49] = "0022";
	$chrArray[50] = "#";
	$unicodeArray[50] = "0023";
	$chrArray[51] = "$";
	$unicodeArray[51] = "0024";
	$chrArray[52] = "%";
	$unicodeArray[52] = "0025";
	$chrArray[53] = "&";
	$unicodeArray[53] = "0026";
	$chrArray[54] = "'";
	$unicodeArray[54] = "0027";
	$chrArray[55] = "(";
	$unicodeArray[55] = "0028";
	$chrArray[56] = ")";
	$unicodeArray[56] = "0029";
	$chrArray[57] = "*";
	$unicodeArray[57] = "002A";
	$chrArray[58] = "+";
	$unicodeArray[58] = "002B";
	$chrArray[59] = ",";
	$unicodeArray[59] = "002C";
	$chrArray[60] = "-";
	$unicodeArray[60] = "002D";
	$chrArray[61] = ".";
	$unicodeArray[61] = "002E";
	$chrArray[62] = "/";
	$unicodeArray[62] = "002F";
	$chrArray[63] = "0";
	$unicodeArray[63] = "0030";
	$chrArray[64] = "1";
	$unicodeArray[64] = "0031";
	$chrArray[65] = "2";
	$unicodeArray[65] = "0032";
	$chrArray[66] = "3";
	$unicodeArray[66] = "0033";
	$chrArray[67] = "4";
	$unicodeArray[67] = "0034";
	$chrArray[68] = "5";
	$unicodeArray[68] = "0035";;
	$chrArray[68] = "5";
	$unicodeArray[68] = "0035";
	$chrArray[69] = "6";
	$unicodeArray[69] = "0036";
	$chrArray[70] = "7";
	$unicodeArray[70] = "0037";
	$chrArray[71] = "8";
	$unicodeArray[71] = "0038";
	$chrArray[72] = "9";
	$unicodeArray[72] = "0039";
	$chrArray[73] = ":";
	$unicodeArray[73] = "003A";
	$chrArray[74] = ";";
	$unicodeArray[74] = "003B";
	$chrArray[75] = "<";
	$unicodeArray[75] = "003C";
	$chrArray[76] = "=";
	$unicodeArray[76] = "003D";
	$chrArray[77] = ">";
	$unicodeArray[77] = "003E";
	$chrArray[78] = "?";
	$unicodeArray[78] = "003F";
	$chrArray[79] = "@";
	$unicodeArray[79] = "0040";
	$chrArray[80] = "A";
	$unicodeArray[80] = "0041";
	$chrArray[81] = "B";
	$unicodeArray[81] = "0042";
	$chrArray[82] = "C";
	$unicodeArray[82] = "0043";
	$chrArray[83] = "D";
	$unicodeArray[83] = "0044";
	$chrArray[84] = "E";
	$unicodeArray[84] = "0045";
	$chrArray[85] = "F";
	$unicodeArray[85] = "0046";
	$chrArray[86] = "G";
	$unicodeArray[86] = "0047";
	$chrArray[87] = "H";
	$unicodeArray[87] = "0048";
	$chrArray[88] = "I";
	$unicodeArray[88] = "0049";
	$chrArray[89] = "J";
	$unicodeArray[89] = "004A";
	$chrArray[90] = "K";
	$unicodeArray[90] = "004B";
	$chrArray[91] = "L";
	$unicodeArray[91] = "004C";
	$chrArray[92] = "M";
	$unicodeArray[92] = "004D";
	$chrArray[93] = "N";
	$unicodeArray[93] = "004E";
	$chrArray[94] = "O";
	$unicodeArray[94] = "004F";
	$chrArray[95] = "P";
	$unicodeArray[95] = "0050";
	$chrArray[96] = "Q";
	$unicodeArray[96] = "0051";
	$chrArray[97] = "R";
	$unicodeArray[97] = "0052";
	$chrArray[98] = "S";
	$unicodeArray[98] = "0053";
	$chrArray[99] = "T";
	$unicodeArray[99] = "0054";
	$chrArray[100] = "U";
	$unicodeArray[100] = "0055";
	$chrArray[101] = "V";
	$unicodeArray[101] = "0056";
	$chrArray[102] = "W";
	$unicodeArray[102] = "0057";
	$chrArray[103] = "X";
	$unicodeArray[103] = "0058";
	$chrArray[104] = "Y";
	$unicodeArray[104] = "0059";
	$chrArray[105] = "Z";
	$unicodeArray[105] = "005A";
	$chrArray[106] = "[";
	$unicodeArray[106] = "005B";
	$char="\ ";
	$chrArray[107]=trim($char);
	$unicodeArray[107] = "005C";
	$chrArray[108] = "]";
	$unicodeArray[108] = "005D";
	$chrArray[109] = "^";
	$unicodeArray[109] = "005E";
	$chrArray[110] = "_";
	$unicodeArray[110] = "005F";
	$chrArray[111] = "`";
	$unicodeArray[111] = "0060";
	$chrArray[112] = "a";
	$unicodeArray[112] = "0061";
	$chrArray[113] = "b";
	$unicodeArray[113] = "0062";
	$chrArray[114] = "c";
	$unicodeArray[114] = "0063";
	$chrArray[115] = "d";
	$unicodeArray[115] = "0064";
	$chrArray[116] = "e";
	$unicodeArray[116] = "0065";
	$chrArray[117] = "f";
	$unicodeArray[117] = "0066";
	$chrArray[118] = "g";
	$unicodeArray[118] = "0067";
	$chrArray[119] = "h";
	$unicodeArray[119] = "0068";
	$chrArray[120] = "i";
	$unicodeArray[120] = "0069";
	$chrArray[121] = "j";
	$unicodeArray[121] = "006A";
	$chrArray[122] = "k";
	$unicodeArray[122] = "006B";
	$chrArray[123] = "l";
	$unicodeArray[123] = "006C";
	$chrArray[124] = "m";
	$unicodeArray[124] = "006D";
	$chrArray[125] = "n";
	$unicodeArray[125] = "006E";
	$chrArray[126] = "o";
	$unicodeArray[126] = "006F";
	$chrArray[127] = "p";
	$unicodeArray[127] = "0070";
	$chrArray[128] = "q";
	$unicodeArray[128] = "0071";
	$chrArray[129] = "r";
	$unicodeArray[129] = "0072";
	$chrArray[130] = "s";
	$unicodeArray[130] = "0073";
	$chrArray[131] = "t";
	$unicodeArray[131] = "0074";
	$chrArray[132] = "u";
	$unicodeArray[132] = "0075";
	$chrArray[133] = "v";
	$unicodeArray[133] = "0076";
	$chrArray[134] = "w";
	$unicodeArray[134] = "0077";
	$chrArray[135] = "x";
	$unicodeArray[135] = "0078";
	$chrArray[136] = "y";
	$unicodeArray[136] = "0079";
	$chrArray[137] = "z";
	$unicodeArray[137] = "007A";
	$chrArray[138] = "{";
	$unicodeArray[138] = "007B";
	$chrArray[139] = "|";
	$unicodeArray[139] = "007C";
	$chrArray[140] = "}";
	$unicodeArray[140] = "007D";
	$chrArray[141] = "~";
	$unicodeArray[141] = "007E";
	$chrArray[142] = "�";
	$unicodeArray[142] = "00A9";
	$chrArray[143] = "�";
	$unicodeArray[143] = "00AE";
	$chrArray[144] = "�";
	$unicodeArray[144] = "00F7";
	$chrArray[145] = "�";
	$unicodeArray[145] = "00F7";
	$chrArray[146] = "�";
	$unicodeArray[146] = "00A7";
	$chrArray[147] = " ";
	$unicodeArray[147] = "0020";
	$chrArray[148] = "\n";
	$unicodeArray[148] = "000D";
	$chrArray[149] = "\r";
	$unicodeArray[149] = "000A";

	$strResult = "";
	for($i=0; $i<strlen($message); $i++)
	{
		if(in_array(substr($message,$i,1), $chrArray))
		$strResult.= $unicodeArray[array_search(substr($message,$i,1), $chrArray)];
	}
	return $strResult;
}

$app->run();
?>