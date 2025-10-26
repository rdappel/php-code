Admin Page
[ ] MD5 (1 way hash)
	echo md5("password");
[ ] PHP Guid (using mt_rand)


```php
<?php

echo md5("buddy") // "fishing"
$memberKey = sprintf(...) // uses mt_rand
$hashedPassword = md5($password . $memberKey)

?>


[ ] Make email unique (new unique key for memberEmail)
[ ] index
	[ ] login with email (rather than username)
	[ ] Select * from members where memberEmail = ?   // use movielist update for query
		[ ] if ($row != null)