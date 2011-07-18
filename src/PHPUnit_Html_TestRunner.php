<?php
/** 
 * HTML format PHPUnit tests results.
 *
 * To allow the running of normal PHPUnit tests from a web browser.
 *
 * @package    PHPUnit_Html
 * @author     Nick Turner
 * @copyright  2011 Nick Turner <nick@nickturner.co.uk>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.nickturner.co.uk/
 */


/**
 * A TestRunner for the HTML WebBrowser interface.
 *
 * @package    PHPUnit_Html
 * @author     Nick Turner
 */
class PHPUnit_Html_TestRunner extends PHPUnit_TextUI_TestRunner {

    /**
     * Run the runner.
     *
     * This will get a singleton instance of the class and configure
     * it according to the given configuration and any $_REQUEST
     * overriding parameters.
     *
     * It will configure it to use a {@link PHPUnit_Html_Printer} object
     * as the default output printer.
     *
     * @param   array       $arguments  configuration
     * @return  void
     */
    static public function run($arguments = array()) {
        $_arguments = array(
            'tpldir' => null,
            'test' => null,
            'testFile' => null,
            'coverageClover' => null,
            'coverageHtml' => null,
            'filter' => null,
            'groups' => null,
            'excludeGroups' => null,
            'processInsolation' => null,
            'syntaxCheck' => false,
            'stopOnError' => false,
            'stopOnFailure' => false,
            'stopOnIncomplete' => false,
            'stopOnSkipped' => false,
            'noGlobalsBackup' => true,
            'staticBackup' => true,
            'syntaxCheck' => false, 
            'bootstrap' => null,
            'configuration' => null,
            'noConfiguration' => false,
            'strict' => false);

        $printer = new PHPUnit_Html_Printer($arguments['tpldir']);

        try {

            $arguments = ($arguments ? array_merge($_arguments, array_intersect_key($arguments, $_arguments)) : $_arguments);

            $arguments['backupGlobals'] = !$arguments['noGlobalsBackup'];
            unset($arguments['noGlobalsBackup']);

            $arguments['backupStaticAttributes'] = !$arguments['staticBackup'];
            unset($arguments['staticBackup']);

            $arguments['useDefaultConfiguration'] = !$arguments['noConfiguration'];
            unset($arguments['noConfiguration']);

            if (isset($arguments['coverageHtml'])) {
                $arguments['reportDirectory'] = $arguments['coverageHtml'];
                unset($arguments['coverageHtml']);
            }

            if (!isset($arguments['test']) && !isset($arguments['testFile'])) {
                $arguments['test'] = getcwd();
            }
    
            $arguments['printer'] = $printer;
            $arguments['listeners'] = array(new PHPUnit_Util_DeprecatedFeature_Logger());

            if ($arguments['bootstrap']) {
                PHPUnit_Util_Fileloader::checkAndLoad($arguments['bootstrap'], $arguments['syntaxCheck']);
            }

            $runner = new PHPUnit_Html_TestRunner();
            $suite = $runner->getTest(
                $arguments['test'],
                $arguments['testFile'],
                $arguments['syntaxCheck']);
        
            unset($arguments['test']);
            unset($arguments['testFile']);
    
            $result = $runner->doRun($suite, $arguments);
            $arguments['printer']->printResult($result);

        } catch (Exception $e) {

            $printer->printAborted($e);

        }
    }
}

/* vim: set expandtab tabstop=4 shiftwidth=4: */

?>
