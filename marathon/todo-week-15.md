# View Titles?

# Create users:
Ben Grimm
ben@ben.com

Susan Storm
sue@sue.com

Richard Reed
richard@richard.com

John Storm
john@john.com


# Set session vars (in Member Model):
$this->session->set("roleID", $row->roleID);
$this->session->set("memberID", $row->memberID);
$this->session->set("memberKey", $row->memberKey);
$this->session->set("memberName", $row->memberName);


# Move session stuff 
    from admin_page to header
    add $memberName to the titlebar

# Logout
    change href="/marathon/public/logout
    add route
    add method:

        service('session')->destroy();
        header("Location: /marathon/public");
        exit();

# Confirm Role Values:
1. Admin
2. Promoter
3. Runner

# Add new table memberRace:
    memberID, raceID, roleID (all nn, concatinated pk)
    add entries


# new query
database + new > query console

SELECT * FROM race r # change * to only required fields (r.raceID, raceName, race...)
JOIN memberRace mr ON r.raceID = mr.raceID
JOIN memberLogin ml ON mr.memberID = ml.memberID
WHERE memberKey = '' AND mr.roleID <= 2

# Update get_races (in Race Model):

$this->session = service('session');
$this->session->start();
$memberKey = $this->session->get('memberKey');
// remember to set member key value in sql

# Update add_race:

// start session

$memberID = (get from session)

// add race then get id of race:
$sql = "SELECT LAST_INSERT_ID()";
$query = $db->query($sql);
$result = $query->getResultArray()[0];
$raceID = $result['LAST_INSERT_ID()'];

// insert values into memberRace:
INSERT INTO memberRace (...) VALUES (?, ?, ?)
etc...

# Helper function in Member Model

public function has_access($raceID, $memberKey)
{
    try {
        $db =...
        $sql =...
        $query =...
        $row = $query->getFirstRow();
        return $row != null;
    }
    catch(Excetion $ex) {
        return false;
    }
}

// query
SELECT r.raceID FROM race r
JOIN memberRace mr ON r.raceID = mr.raceID
JOIN memberLogin ml ON mr.memberID = ml.memberID
WHERE memberKey = '' AND mr.roleID <= 2 AND mr.raceID = N


# Update update_race in Admin Controller:
(get session for member key)

$Member = new Member();
if ($Member->hasAccess($id, $memberKey))

# same for edit race ( only update if they have access)
# same for delete race








