
ARC-- advanced rest client
arc-setup.exe


# change sql in has_access
add in memberName, memberEmail, memberID, roleID


# Routes:
$routes->get('/api/get_races/(:any), Api::get_races/$1);
$routes->get('/api/get_runners/(:any)/(:any), 'Api::get_runners/$1/$2);
$routes->post('/api/runner', 'Api::add_runner');
$routes->delete('/api/runner', 'Api::delete_runner');




# New API Controller
Name: Api
Namespace App\Controllers

class Api extends BaseController

public function get_races($key)
{
    $Race = new Race();
    $races = $Race->get_races($key)
    echo json_encode($races)
    exit();
}

get_runners($key, $raceID)
{
    $Race = new Race();
    $runners = $Race->get_runners($key, $raceID); // need to create in Race controller
    echo json_encode($runners);
    exit();

    // get_runners():
    // db connect (copy dup from get_races)

    // SELECT * FROM member_race mr JOIN member m ON mr.memberID = m.memberID
    // WHERE memberKey = '?' AND raceID = '?' AND roleID = '3'
    // $result= $db->query($query, [ $key, $raceID ])
    // return $result->getResultArray();
}

// Body for POST: { "ApiKey": "memberkey from db", "RaceID", "", "MemberID" : "" }
add_runner()
{
    $requestBody = file_get_contents("php://input");
    $json = json_decode($requestBody, true);
    $key = $json["ApiKey"]
    $raceID = $json["RaceID"]

    $Member = new Member();
    if (!$Member->has_access($raceID, $key))
    {
        echo "Access Denied!";
        quit();
    }

    $memberID = $json["MemberID"]
    $Race = new Race();
    $race->add_runner($memberID, $raceID); // need to add in race controller
    echo "Runner Added!"
    quit();
}

// Race Controller:
add_runner($memberID, $raceID)
{
    $db = db_connect()
    $query = "INSERT INTO member_race(memberID, raceID, roleID) VALUES(?, ?, 3)"
    $result = $db->query($query, [ $memberID, $raceID ])
}

delete_runner()
{
    $requestBody = file_get_contents("php://input");
    $json = json_decode($requestBody, true);
    $key = $json["ApiKey"]
    $raceID = $json["RaceID"]

    $Member = new Member();
    if (!$Member->has_access($raceID, $key))
    {
        echo "Access Denied!";
        quit();
    }

    $memberID = $json["MemberID"]
    $Race = new Race();
    $race->delete_runner($memberID, $raceID);
    echo "Runner Deleted!"
    quit();
}