<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

/**
* This file creates new schema files for every database.
* The filenames will be prefixed with an underscore to not overwrite the current schema files.
*
* If you overwrite the original schema files please make sure you save the file with UNIX linefeeds.
*/

$schema_path = __DIR__ . '/../install/schemas/';
$supported_dbms = array(
	'mssql',
	'mysql_41',
	'oracle',
	'postgres',
	'sqlite',
);
$table_prefix = 'phpbb_';

if (!is_writable($schema_path))
{
	die('Schema path not writable');
}

define('IN_PHPBB', true);
$phpbb_root_path = __DIR__ . '/../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);

include($phpbb_root_path . 'vendor/autoload.php');
include($phpbb_root_path . 'includes/constants.' . $phpEx);
require($phpbb_root_path . 'phpbb/class_loader.' . $phpEx);
$phpbb_class_loader = new \phpbb\class_loader('phpbb\\', "{$phpbb_root_path}phpbb/", $phpEx);
$phpbb_class_loader->register();

$finder = new \phpbb\finder($phpbb_root_path);
$classes = $finder->core_path('phpbb/')
	->directory('/db/migration/data')
	->get_classes();

$db = new \phpbb\db\driver\sqlite3();
$factory = new \phpbb\db\tools\factory();
$db_tools = $factory->get($db, true);

$tables_data = \Symfony\Component\Yaml\Yaml::parseFile($phpbb_root_path . '/config/default/container/tables.yml');
$tables = [];

foreach ($tables_data['parameters'] as $parameter => $table)
{
	$tables[str_replace('tables.', '', $parameter)] = str_replace('%core.table_prefix%', $table_prefix, $table);
}

$schema_generator = new \phpbb\db\migration\schema_generator($classes, new \phpbb\config\config(array()), $db, $db_tools, $phpbb_root_path, $phpEx, $table_prefix, $tables);
$schema_data = $schema_generator->get_schema();

$fp = fopen($schema_path . 'schema.json', 'wb');
fwrite($fp, json_encode($schema_data, JSON_PRETTY_PRINT));
fclose($fp);

echo 'Successfully created schema file';
