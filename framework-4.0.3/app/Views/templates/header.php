<!doctype html>
<html>
<head>
    <title>CodeIgniter Tutorial</title>
</head>
<body>

	<!-- esc() is a global function provided by
	CodeIgniter to help prevent XSS attacks -->
    <h1><?= esc($title); ?></h1>