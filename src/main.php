<?PHP
/** 
 * HTML format PHPUnit tests results.
 *
 * To allow the running of normal PHPUnit tests from a web browser.
 *
 * @package PHPUnit
 * @author  Nick Turner
 */

$defaults = array(
    'phpunit_html' => null,
    'phpunit' => null,
    'tpldir' => null,
    'template' => 'default',
    'test' => null,
    'testFile' => null,
    'bootstrap' => null,
    'configuration' => null,
    'noConfiguration' => false,
    'coverageClover' => null,
    'coverageHtml' => null,
    'filter' => null,
    'groups' => null,
    'excludeGroups' => null, 
    'processInsolation' => false,
    'syntaxCheck' => false,
    'stopOnError' => false,
    'stopOnFailure' => false,
    'stopOnIncomplete' => false,
    'stopOnSkipped' => false,
    'noGlobalsBackup' => true,
    'staticBackup' => true,
    'strict' => false,
    );

// Merge any config parameters passed in the variable $config
if (isset($config) && is_array($config)) {
    $config = array_merge($defaults, $config);
} else {
    $config = $defaults;
}

// Merge any config parameters specified in the request $_REQUEST
foreach ($_REQUEST as $n => $v) {
    if (!array_key_exists($n, $defaults)) {
        die('Unknown request parameter: '.$n);
    }

    if (is_bool($config[$n])) {
        if (!isset($v) || $v === '' || strcasecmp($v, 'true') === 0 || $v === '1') {
            $_REQUEST[$n] = true;
        } else if (strcasecmp($v, 'false') === 0 || $v === '0') {
            $_REQUEST[$n] = false;
        } else {
            die("Request parameter '$n' must be either '0', '1', 'true', 'false'.");
        }
    } else if (!isset($v) || $v === '') {
        die("Request parameter '$n' must have a value.");
    }

    $config[$n] = $_REQUEST[$n];
}

// Sanatize a few config variables
if (!isset($config['tpldir'])) {
    $config['tpldir'] = __DIR__.'/templates/'.($config['template'] ?: 'default').'/';
}

if (isset($config['groups']) && is_string($config['groups'])) {
    $config['groups'] = explode(',', $config['groups']);
}

if (isset($config['excludeGroups']) && is_string($config['excludeGroups'])) {
    $config['excludeGroups'] = explode(',', $config['excludeGroups']);
}

foreach (array('phpunit_html', 'tpldir') as $d) {
    if ($config[$d]) {
        $config[$d] = realpath($config[$d]).DIRECTORY_SEPARATOR;
        if (!is_dir($config[$d])) {
            die('No such directory: '.$config[$d]);
        }
    }
}

if (isset($_SERVER['PATH_INFO'])) {
    // Resource request
    $path = $_SERVER['PATH_INFO'];
    if (strncasecmp($path, '/template/', 10) === 0) {
        // Return a template resource
	    $root = __DIR__.'/templates/'.($config['template'] ?: 'default').'/';
    }
    $file = $root.substr($path, 10);
    if (file_exists($file)) {
        switch (pathinfo($file, PATHINFO_EXTENSION )) {
            case 'css': $mime = 'text/css'; break;
            case 'js':  $mime = 'text/js'; break;
            case 'htm': 
            case 'html':$mime = 'text/html'; break;
            case 'pdf': $mime = 'application/pdf'; break; 
            case 'exe': $mime = 'application/octet-stream'; break; 
            case 'zip': $mime = 'application/zip'; break; 
            case 'doc': $mime = 'application/msword'; break; 
            case 'xls': $mime = 'application/vnd.ms-excel'; break; 
            case 'ppt': $mime = 'application/vnd.ms-powerpoint'; break; 
            case 'gif': $mime = 'image/gif'; break; 
            case 'png': $mime = 'image/png'; break; 
            case 'jpeg': 
            case 'jpg': $mime = 'image/jpg'; break; 
            default:
                $finfo = finfo_open();
                $mime = finfo_file($finfo, $file, FILEINFO_MIME);
                finfo_close($finfo);
                break;
        }
        $size = filesize($file);
        $time = filemtime($file);
        header('HTTP/1.1 200 OK');
        header('Content-Type: '.$mime);
        header('Content-Length: '.$size);
        header('Etag: '.md5("{$size}-{$time}"));
        header('Last-Modified: '.gmdate('D, d M Y H:i:s \G\M\T', $time));
        readfile($file);
    } else {
        header('HTTP/1.0 404 Not Found');
    }

    exit(0);
}

require($config['phpunit'].'PHPUnit/Autoload.php');

$filter = PHP_CodeCoverage_Filter::getInstance();

$filter->addDirectoryToBlacklist(
    __DIR__, '.php', '', 'PHPUNIT', FALSE
    );

$filter->addDirectoryToBlacklist(
     __DIR__.'/templates', '.php', '', 'PHPUNIT', FALSE
    );

$filter->addDirectoryToBlacklist(
    $config['tpldir'], '.php', '', 'PHPUNIT', FALSE
    );

$filter->addFileToBlacklist(__FILE__, 'PHPUNIT', FALSE);

$filter->addFileToBlacklist($_SERVER['SCRIPT_FILENAME'], 'PHPUNIT', FALSE);

require(__DIR__.'/PHPUnit_Html_Printer.php');
require(__DIR__.'/PHPUnit_Html_TestRunner.php');

PHPUnit_HTML_TestRunner::run($config);

/* vim: set expandtab tabstop=4 shiftwidth=4: */

?>
