(WEEK 12)
Add link to nav (target="blank")


1. Fix login redirect
-----
Login redirects to /public/login (refresh)

Home Controller

replace:
  return view('admin_page');

with:
  header ("Location: admin")
  exit()


2. Secure admin page
-----
Member model

if (password == dbPassword)
{
	$this->session = service('session');
	$this->session->start();

	// reference: login/index.php:
	$this->session->set('roleID', $row->roleID);
	$this->session->set('userID', $row->memberID);

	retunrn true
}

-----
admin_page (view): at top:
<?php
	$this->session = service('session');
	$this->session->start();
	$roleID = $this->get('roleID');
	if ($roleID == null || $roleID != 1) {
		header('Location: /marathon/public#login');
		exit();
	}
?>



3. Layout actual Admin panels:
example at /public/tmp/admin
Dashboard - (index)
Manage Marathons - (tables)
Add Marathon - (forms)
Manage Runners - (tables)
Registration - (bootstrap elements)
----------------------------------
Admin Controller:

public function index()
{
	$data = array('index' => 'true');
	return view('admin_page', $data);
}

public function manage_marathon()
{
	$data = array('manage_marathon' => 'true');
	return view('marathon_page', $data);
}

public function add_marathon()
{
	$data = array('add_marathon' => 'true');
	return view('add_page', $data);
}

public function manage_runners()
{
	$data = array('manage_runners' => 'true');
	return view('runners_page', $data);
}

public function registration_form()
{
	$data = array('registration_form' => 'true');
	return view('registration_page', $data);
}

Router:
$routes->get('/admin', 'Admin::index');
$routes->get('/marathon', 'Admin::manage_marathon');
$routes->get('/add', 'Admin::add_marathon');
$routes->get('/runners', 'Admin::manage_runners');
$routes->get('/registration', 'Admin::registration_form');

4. Make Views
-------------

5. Clean up navigation (admin_page view)
-------------
// aprox line 168
Dashboard -> admin
Manage Marathons -> marathon
Add Marathon -> add
Manage Runners -> runners
Registration Form -> registration
Get rid of rest

6. Create include dir in views
-----------------------------
add: header.php & menu.php

Move 56 (navbar-header) - 166 (before sidebar menu items (collapse))
    to header.php

Move 57 (comment + div class="collapse navb...")
	to menu.php

<nav>
<?php
	echo view('include/header')
	echo view('include/menu')
?>
</nav>


then copy comment and <nav> and replace in:
	add_page, marathon_page, registration_page, runners_page


7. Fix selected menu item:
------------------------
<li>
	<?php
		if (isset($index)) { echo ' class="active"'; }
	?>
</li>

replace $index with $manage_marathon, etc..


8. Fix header
-------------
delete li's in ul nav (line 13) 
LEAVE THE LAST ONE

inside the last one leave only the logout

Change "SB Admin" to "Marathon Master"


9. Clean up Dashboard (admin)
--------------------------
Leave header (dashboard) and 2 charts, resized to 6 ea (12 total)


10. Clean up marathon_page
----------------------
Remove 3 of 4 bordered tables, leaving 1, resize to 12
remove breadcrumbs


Homework:
Clean up the other pages (watch joes video)