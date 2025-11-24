# Manage Marathons Walkthrough

## Manage Marathons

### Add 'race' Table
raceID NN AI
raceName varchar(63)
raceLocation varchar(255)
raceDescription varchar(255)
raceDateTime dateTime
PK raceID

*add a couple of races via the UI*

### Add a 'Race' model
marathon\Models > new Php file
- Name: 'Race'
- NS: 'Models'
- Extends: CodeIgniter\Model

*update namesapce to: App\Models*

```php
public function get_races() {
    // get db stuff from Member.php Model
    // update query:
    $query = "SELECT * FROM race"

    //...
    return $result->getResultArray()
}

public function get_race($id) {
    $query = "SELECT * FROM race WHERE raceID = ?";
    $result = $db->query($sql, [ $id ])
    return $result->getFirstRow();
}
```

### Update Admin Controller

In manage_marathon:
```php
$Race = new Race();
// add to array:
'races' => $Race->get_races();
```

### Update marathon_page View
in <tbody>
```php
<?php
    foreach ($races as $race) {
        $id = $race['raceID'];
        $name = $race['raceName'];
        $location = $race['location'];
        //$description...
        $date = date('m/d/Y H:i', strtotime($race['raceDateTime']);
        Edit | Delete
    }
?>
```

## Add Marathon
### Update UI
row/div(12)
```html
<form role="form" method="post" action="/marathon/public/add_race">
    <div class="form-group">
        <label>Race Name</label>
        <input name="race_name" id="race_name" type="text" class="form-control">
        Race Location
    
        Race Description
        <textarea rows="3"></textarea>

        Race Date
        type="datetime-local"
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
```

### Routes
```php
// Races
$routes->post('/add_race', 'Admin::add_race')
$routes->get('/delete_race/(:any)', 'Admin::delete_race/$1')
$routes->get('/update_race/(:any)', 'Admin::update_race/$1')
```

### Race Model new fns:
```php
public function add_race($name, $location, $description, $datetime) {
    try {
        $db = db_connect();
        $query = "INSERT INTO race(raceName, raceLocation, raceDescription, raceDateTime) VALUES(?, ?, ?, ?)";
        $db->query($sql, [ $name, $location, $description, $datetime ])
        return true;
    }
    catch (Exception $ex) {
        return false;
    }
}

public function update_race($id, $name, $location, $description, $datetime) {
    try {
        $db = db_connect();
        $query = "UPDATE race SET raceName = ?, ...  WHERE raceID = ?";
        $db->query($sql, [ $name, $location, $description, $datetime, $id ])
        return true;
    }
    catch (Exception $ex) {
        return false;
    }
}

public function delete_race($id) {
    try {
        $db = db_connect();
        $query = "DELETE FROM race WHERE raceID = ?";
        $db->query($sql, [ $id ])
        return true;
    }
    catch (Exception $ex) {
        return false;
    }
}

```

### Admin controller new fn:
```php
//Add New Race
public function add_race() {
    $Race = new Race();
    $name = $this->request->getPost('race_name');
    $location = $this->request->getPost('race_location');
    $description = $this->request->getPost('race_description');
    $datetime = $this->request->getPost('race_datetime');

    $Race->add_race($name, $location, $description, $datetime);
    header("Location: marathon");
    exit();
}
```

## Delete Marathon

### Update marathon_page View
<a href="/marathon/public/update_race/$id">Edit</a> |
<a href="/marathon/public/delete_race/$id">Delete</a>

### Add update_page View
(Copy from add_page.php)

### Admin Controller
```php
public function delete_race($id) {
    $Race = new Race();
    $Race->delete_race($id);
    //header("Location: marathon");
    //header("Location: /marathon/public/marathon", true, 302)
    header("Refresh:0; url=/marathon/public/marathon");
    exit();
}

public function update_race($id) {
    $Race = new Race();
    $race = $Race->get_race($id);

    $data = [
        'manage_marathon' => 'true',
        'race' => $race
    ]
    return view('update_page', $data)
}

public function edit_race() {
    $Race = new Race();
    // copy vars from add_race
    $Race->update_race($race_id, $race_name, ....)
    //header("Location: marathon");
    //header("Location: /marathon/public/marathon", true, 302)
    header("Refresh:0; url=/marathon/public/marathon");
    exit();
}
```

### fix css on update_race.php

### fix href pathing on menu.php
/marathon/public/###



### Add to update_page View
Change "Add New Race" to "Update Race"
change form action to /marathon/public/edit_race

input: value="$race['raceName'], etc....
(textarea is different)

<input type="hidden" id="race_id" name="race_id" value="$race['raceID']">





## Homework

Push to GitHub, submit the link