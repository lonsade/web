<div class="dialog_error">

<?if(isset($_SESSION['request'])):?>

  <?foreach($_SESSION['request']['message'] as $message):?>
  <p><?=$message?></p>
  <?endforeach;?>
  <script type="text/javascript">
    $(function(){
      $('.dialog_error').dialog('option', 'title', '<?=$_SESSION['request']['title']?>').dialog('open');
    });
  </script>
  <?php
  unset($_SESSION['request']);
  if(isset($_SESSION['prev']))
    unset($_SESSION['prev']);
  ?>

<?endif;?>

</div>