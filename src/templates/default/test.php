<div class="test <?PHP echo "test-{$testno}".($testno % 1 ? ' odd' : ' even').($testno == ($numtests - 1) ? ' last ' : ' ').$test['status'].($test['status'] !== 'passed' ? ' open' : ' closed'); ?>">
  <div class="icon"></div>
  <div class="name"><?PHP echo htmlentities($test['name']); ?></div>
  <div class="desc"><span class="assertions">Assertions: <b><?PHP echo (int)$test['assertions'] ?></b>,</span><span class="problems">Problems: <b><?PHP echo count($test['deprecated']) + count($test['errors']); ?></b>,</span><span class="time">Executed in <?PHP printf('%06f', $test['time']); ?> seconds.</span></div>
  
  <div class="expand-button"></div>
  <div class="more">
    <div class="result"><pre><?PHP echo (isset($test['result']['e']) ? htmlentities(PHPUnit_Framework_TestFailure::exceptionToString($test['result']['e']).PHPUnit_Util_Filter::getFilteredStacktrace($test['result']['e'], FALSE)) : ''); ?></pre></div>
    <?PHP if ($test['errors'] !== null) { foreach($test['errors'] as $error) { $e = $error['e']; include('exception.php'); } } ?>
    <?PHP if ($test['deprecated'] !== null) { foreach($test['deprecated'] as $deprecated) { include('deprecated.php'); } } ?>
    <?PHP if ($test['output'] !== null && $test['output'] !== '') { ?>
    <div class="output rounded show">
      <pre><?PHP echo htmlentities($test['output']); ?></pre>
    </div>
    <?PHP } ?>
    <div class="source closed">
      <div class="toggle-button"></div>
      <div class="listing rounded show"><?PHP echo $this->listing($suite, $test); ?></div>
      <div class="clear"></div>
    </div>
  </div>
</div>
