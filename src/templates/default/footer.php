<?PHP if (!class_exists('PHP_Timer', false)) { require('PHP/Timer.php'); } ?>
      <div id="footer">
        <div class="w3c-valid-html"><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Transitional"></a></div>

        <div class="w3c-valid-css"><a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!"></a></div>
        <div class="copyright">&copy; <?PHP echo date('Y'); ?> Nick Turner. Inspired by Matt Mueller.<br><?PHP echo htmlentities(PHPUnit_Runner_Version::getVersionString());?><br><?PHP echo htmlentities(PHP_Timer::resourceUsage());?></div>
      </div>
    </div>
    <script src="<?PHP echo $this->url('/template/javascript/jquery.js');?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?PHP echo $this->url('/template/javascript/main.js');?>" type="text/javascript" charset="utf-8"></script>
  </body>
</html>
