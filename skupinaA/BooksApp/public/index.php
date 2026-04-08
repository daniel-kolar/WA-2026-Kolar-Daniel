<?php

session_start();

// Pro účely výuky a ladění na lokálním serveru (např. XAMPP)
// je vhodné zapnout kompletní zobrazení chyb, aby bylo možné snadno identifikovat a opravit problémy v kódu.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Dynamické zjištění základní adresy aplikace
// Vypočítá absolutní cestu ke složce, ve které běží tento index.php
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', $baseDir);

//kontrola správného nastavení BASE_URL (pro ladění)
//echo "BASE_URL: " . BASE_URL . "<br>";

// Načtení třídy routeru, která bude zpracovávat příchozí HTTP požadavky a směrovat je na správné kontrolery a akce.
require_once '../core/App.php';

// Inicializace aplikace, která vytvoří instanci třídy App a spustí router, aby mohl zpracovávat požadavky.
$app = new App();