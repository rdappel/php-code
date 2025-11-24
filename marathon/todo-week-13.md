IF YOU GET ERROR: app/config/boot/production: line 15 "0" -> "1"

app/views/homepage:
~line 55 (copy services and change to login)

create login section (from about) // alternate a/b/a/b
clear the divs
add <h2>Login</h2> (and Create Account in the other)

then:
<?php
    echo form_open('/marathon/public/login');
    echo form_input('username', '', 'placeholder="Username") . "<br>";
    echo form_password('password', '', 'placeholder="Password") . "<br>";
    echo form_submit('submit', 'Login');
    echo form_close();
?>
<?php
    echo form_open('/marathon/public/create');
    echo form_input('username', '', 'placeholder="Username") . "<br>";
    echo form_password('password', '', 'placeholder="Password") . "<br>";
    echo form_password('password2', '', 'placeholder="Retype Password") . "<br>";
    echo form_input('email', '', 'placeholder="Email") . "<br>";
    echo form_submit('submit', 'Create Account');
    echo form_close();
?>


In Home controller
```php
// add in index():
helper('form');


//add:
public function login(): string
{
    //echo "Good";

    $rules=[
        'username'=>'required|valid_email',
        'password'=>'required',
    ]

    if (!$this->validate($rules)) {
       // echo "Bad";
        $data = array('load_error' => 'true')
        helper('form');
        return view('homepage', $data);
    }
    else {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        //echo "$username ==== $password";

        // do database stuff
        $Member = new Member($username, $password); // use App\Models\Member <-- up top
        if ($Member->user_login()) {
            // worked!
            echo "yay!";
            exit();
            return view('admin_page');
        }
        else { // move failed here
        }

        // worked (todo)

        // failed
        $data = array(
            'load_error' => 'true', 'error_message', 'Invalid username or pw')
        helper('form');
        return view('homepage', $data);


    }

    exit();
}

public function create(): string
{
    echo "Create";
    exit();
}
```

homepage.php:

```




app > config > Routes.php:
$routes->post('/login', 'Home::login')
$routes->post('/create', 'Home::create')


homepage.php (view)

Update Title: Marathon Master
Add css??? bootstrap (12)

Add div:
div class="row
    div class="col-sm-12 alert alert-danger <--- based on $error_classes

<?php
    $validation = service('validation');

    if ($validation->hasError('username'))
    echo $validation->getError('username') . <br>;
    echo $validation->getError('password') . <br>;
    
    if (isset($error_message)) {
        echo $error_message;
    }


above to add style style (php):

```php
if (isset($load_error)) {
    $load_error = null;
    echo '<script>document.location.href="#login"</script>';
}
```

NEW PHP CLASS:
  Name: Member
  Namespace: App\Models
  Extends: Model (Codeigniter model)

```php
  public function user_login($email, $password)
  {
    //echo "$email --- $password";

    $db = db_connect();
    $query = "SELECT memberPassword, memberKey, roleID, memberID FROM memberLogin WHERE memberEmail = ? AND roleID = 2";
    $result = $db->query($query, [ $email ])
    $row = $result->getFirstRow();
    //var_dump($row)

    if ($row == null) return false;

    $dbPass = $row->memberPassword;
    $memberKey = $row->memberKey;
    $hashed = md5($dbPass . $memberKey);

    if ($dbPass != $hashed) return false;

    return true;
  }
```



Config > Database.php
username: dbuser
pass: dbdev123
db: phpclass


Change Roles:
1 Admin
2 Promoter
3 Runner



Homework:
    make the create work:
        Route already exists
        Home controller has the create method (use login as example)
        Model needs a create function
            - validate pwds matching in the controller
