<div class="well sidebar-nav">
  <ul class="nav nav-list">
  <?php 
    for ($i=0; $i < 10; $i++) { 
      echo '<li>'.$this->Html->link(__($i, true), $i) . '  ' . '</li>';
    }
  ?>
  </ul>            
</div><!--/.well -->