<?php
include_once('config.php');
$app->get('/Trip/Counts', 'TripCounts');
$app->get('/trips/failed', 'FailedTrips');
function FailedTrips()
{
    $dbCon = getConnection();
    //$limitDate = date('Y-m-d H:i:s',strtotime('-20 minute'));
    $limitDate = date('Y-m-d 00:00:00');
    $query = "SELECT * FROM trips LEFT JOIN passengers ON passengers.passengerId=trips.tripPassengerId LEFT JOIN countries ON countries.countryId=passengers.passengerCountryId WHERE tripFailedToAssign=1 AND (tripCancelDate > '{$limitDate}' or tripCreateDate > '{$limitDate}') order by tripCreateDate DESC ,tripCancelDate DESC";
    $stmt = $dbCon->query($query);  
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($data, JSON_NUMERIC_CHECK);
}
function TripCounts() 
{
    global $app;
    try {
        $today = date('Y-m-d');
        $now = date('Y-m-d H:i:s');
        $tomorrow = date('Y-m-d',strtotime('+1 day'));
        $dbCon = getConnection();
        $query = "SELECT count(*) as total,DATE(tripDueDate) as TripDate FROM trips WHERE  tripNow=0 AND (tripDueDate>='{$today} 00:00:00' AND tripDueDate<='{$tomorrow} 23:59:59') AND tripStatus!=6 group BY TripDate ORDER BY TripDate ASC";

        $stmt = $dbCon->query($query);  
        $later = $stmt->fetchAll(PDO::FETCH_OBJ);



        $query = "SELECT count(*) as total FROM trips WHERE tripStatus=6 AND DATE(tripAcceptDate)= '{$today}'";
        $stmt = $dbCon->query($query);  
        $finished = $stmt->fetchAll(PDO::FETCH_OBJ);

        $query = "SELECT count(*) as total FROM trips WHERE tripStatus>=3 AND tripStatus<=5 AND DATE(tripAcceptDate)= '{$today}'";
        $stmt = $dbCon->query($query);  
        $current = $stmt->fetchAll(PDO::FETCH_OBJ);

        $dbCon = null;
        echo '{"later":'.json_encode($later).',"finished":'.json_encode($finished[0]).',"current":'.json_encode($current[0]).'}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
$app->run();
?>