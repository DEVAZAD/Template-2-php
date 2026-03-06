<?php
require_once __DIR__ . '/../../src/config/database.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('/');

$fields = ['name','contact','email','country','state','city','message'];
$data = [];
foreach ($fields as $f) { $data[$f] = clean($_POST[$f]??''); }
foreach ($data as $v) { if (!$v) redirect('/?error=1'); }
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) redirect('/?error=1');

try {
    $pdo->prepare("INSERT INTO contact_submissions (name,contact,email,country,state,city,message) VALUES (?,?,?,?,?,?,?)")
        ->execute(array_values($data));
    redirect('/?success=1');
} catch (PDOException) { redirect('/?error=1'); }
