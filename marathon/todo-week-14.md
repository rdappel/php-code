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
public function get_races()
{
    // get db stuff from Member.php Model
    // update query:
    $query = "SELECT * FROM race"

    //...
    return $query->getResultArray()
}
```

### Update Admin Controller

In manage_marathon:
```php
$Race = new Race();
// add to array:
'races' => $Race->get_races();
```

### Update marathon_page Vies
in <tbody>
```php
<?php
    foreach ($races as $race) {
        $name = $race['raceName']
        $location = $race['location']
        //$description...
        $date = date('m/d/Y H:i', strtotime($race['raceDateTime'])
    }
?>
```

## Add Marathon

## Delete Marathon

## Update Marathon