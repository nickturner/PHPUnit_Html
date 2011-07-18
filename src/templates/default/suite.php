  <div class="box rounded suite <?PHP echo "suite-{$suiteno}".($suiteno % 1 ? ' odd' : ' even').($suiteno == ($numsuites - 1) ? ' last ' : ' ').$suite['status'].($suite['status'] !== 'passed' ? ' open' : ' closed'); ?>">
    <div class="icon"></div>
    <div class="name"><?PHP echo htmlentities($suite['name']); ?></div>
    <div class="desc"><span class="stats"><?PHP $max_i = count($suite['stats']); $i = 1; foreach($suite['stats'] as $what => $count) { echo "<span class=\"{$what}\">".htmlentities(ucwords($what)).': <b>'.(int)$count.'</b>'.($i < $max_i ? ',' : '').'</span>'; $i++; }?></span><span class="assertions">Assertions: <b><?PHP echo (int)$suite['assertions'] ?></b>,</span><span class="problems">Problems: <b><?PHP echo $suite['deprecated'] + $suite['errors']; ?></b>,</span><span class="time">Executed in <?PHP printf('%06f', $suite['time']); ?> seconds.</span></div>
    <div class="expand-button"></div>
    <div class="more tests">
      <?PHP
      $testno = 0;
      $numtests = count($suite['tests']);
      foreach($suite['tests'] as $testname => $test) {
        echo '<hr class="'.($testno == 0 ? 'big' : 'small').'">';
        include('test.php');
	$testno++;
      }
      ?>
    </div>
  </div>
