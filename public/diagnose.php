<?php
echo "Current File: " . __FILE__ . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Session Save Path: " . session_save_path() . "<br>";
echo "Writable Path (CI): " . (defined('WRITEPATH') ? WRITEPATH : 'Not Defined') . "<br>";
phpinfo(INFO_VARIABLES | INFO_CONFIGURATION);
