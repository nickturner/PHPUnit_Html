<div class="error message rounded show closed">
  <div class="icon"></div>
  <div class="text"><?php echo htmlentities($e->getMessage().' in '.$e->getFile().'#'.$e->getLine()) ?></div>
  <div class="expand-button"></div>
  <div class="trace closed"><?PHP include('stacktrace.php'); ?></div>
</div>

