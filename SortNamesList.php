<?php
declare(strict_types=1);

use App\NamesSorter;
use App\MultiArraySorter;
use App\Transformer;

require_once("./vendor/autoload.php");

/**
 * Is it running in CLI.
 * (this function  and its calling are put outside class
 * because it doesn't fit the class's responsibility)
 *
 * @return bool
 */
function isCli(): bool
{
    return in_array(PHP_SAPI, ['cli', 'cgi', 'cgi-fcgi']);
}

$runningCli = isCli();
$eol = $runningCli ? PHP_EOL : '<br/>';

if (version_compare(phpversion(), '7.0.00', '<')) {
    echo 'The application needs to run on PHP 7 or higher.' . $eol;
}

if (!$runningCli) {
    die('This program needs to run in CLI.');
}

if ($argc !== 2) {
    die('The CLI script needs only file path as argument.' . $eol);
}
$filePath = $argv[1];


$unsortedNamesList = file_get_contents($filePath);
if (false === $unsortedNamesList) {
    die('Unable to open the file.');
}

if (empty($unsortedNamesList)) {
    die('File is empty.');
}

$sortedNamesList = (new NamesSorter(
    new MultiArraySorter(),
    new Transformer()
))->sortList($unsortedNamesList);

file_put_contents('./sorted-names-list.txt', $sortedNamesList);

echo "The sorted names list has been written into file ./sorted-names-list.txt.\n";
echo "\n=== The following is the sorted names list: ===\n";
print_r($sortedNamesList);
echo "\n=== END ===\n";
