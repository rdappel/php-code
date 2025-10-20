<?php
// admin page (from template)
// member page (from template)
// index (from addmovie), update to handle username/pw

// admin page (add user)
//      -- username, email, password, password2, role (select/option)

session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: /login")
}

// check post vars and that pwds match






/* TABLES ---------------
members
-------
memberID int pk ai
memberName vc75
memberEmail vc255
memberPassword vc255
memberKey
roleID int nn


roles
-----
roleID int pk ai
roleValue vc50