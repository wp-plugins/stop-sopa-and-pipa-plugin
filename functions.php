<?php 

   function my_print_script(){
   
   wp_register_script('datepicker',REDIRECT_URL.'/js/jquery.ui.datepicker.min.js');
   wp_enqueue_script ('datepicker');
   wp_register_script('widget',REDIRECT_URL.'/js/jquery.ui.widget.min.js');
   wp_enqueue_script('widget');
   wp_register_script('core',REDIRECT_URL.'/js/jquery.ui.core.min.js');
   wp_enqueue_script('core');
   wp_register_script('slider',REDIRECT_URL.'/js/jquery.ui.slider.min.js');
   wp_enqueue_script('slider');
   wp_register_script('custom',REDIRECT_URL.'/js/jquery-ui-1.8.17.custom.min.js'); 
   wp_enqueue_script('custom');	
   wp_register_script('timepickerjs',REDIRECT_URL.'/js/jquery-ui-timepicker-addon.js');
   wp_enqueue_script('timepickerjs');
   }


   function my_print_styles(){
   wp_register_style('base',REDIRECT_URL.'/css/jquery.ui.all.css');
   wp_enqueue_style('base');
   wp_register_style('demo',REDIRECT_URL.'/css/demos.css');
   wp_enqueue_style('demo');
   wp_register_style('timepicker',REDIRECT_URL.'/css/jquery-ui-timepicker-addon.css');
   wp_enqueue_style('timepicker');
   wp_register_style('customstyle',REDIRECT_URL.'/css/jquery-ui-1.8.17.custom.css');
   wp_enqueue_style('customstyle');
   wp_register_style('redirectstyle',REDIRECT_URL.'/css/style.css');
   wp_enqueue_style('redirectstyle');
   }
  function add_admin_menu(){

    add_menu_page('Stop SOPA and PIPA','Stop SOPA and PIPA','administrator','redirect','wp_redirect_url');
 
  }

 function my_redirect_url(){
	  if(!is_admin()){
		  $redirect_url = get_option('redirect_url');
		  $start_time = get_option('start_time');
		  $end_time = get_option('end_time');	  
		  $time_now = current_time('timestamp');

		  if(($start_time <= $time_now) && ($time_now < $end_time)){			 
			 if($redirect_url == '')
			 $redirect_url = 'http://americancensorship.org/';
			 
			 header("Location: $redirect_url",TRUE,302);
			 exit;
		  }
	  }
 }
 

   function wp_redirect_url(){
		global $post;

		if(($_POST['save']) || ($_POST['update'])){
 
			  $start_time = strtotime($_POST['start_time']);
			  $end_time = strtotime($_POST['end_time']);
			  update_option('start_time',$start_time);
			  update_option('end_time',$end_time);
			  update_option('redirect_url',$_POST['url']);
			  
			  if($_POST['reset_redirect_settings']){
				update_option('start_time','');
				update_option('end_time','');
				update_option('redirect_url','');
			  }

    }

?>
<script>	
	jQuery(function() {
		jQuery( "#start_time" ).datetimepicker({
		ampm:true
		
		});
		
		jQuery("#end_time").datetimepicker({
		ampm:true
		});
	});
</script>
	
<div class="icon32" id="icon-options-general" style="background:url(<?php echo REDIRECT_URL.'/images/what-is-sopa.png';?>) no-repeat;"><br></div>	
<h2>configure your temporary traffic redirect here</h2>
<form method="post" action="" >
  <table class="form-table">
    <tr>
      <th scope="row"><label>Start time</label></th>
      <td><input type="text" class="regular-text" name="start_time" id="start_time" value="<?php if($_GET['action']== 'edit' && get_option('start_time')):?><?php echo date("d-m-Y h:i:s",get_option('start_time'));?><?php endif;?>"/></td>
    </tr>
    <tr>
      <th scope="row"><label>End time</label></th>
      <td><input type="text" class="regular-text" name="end_time" id="end_time" value="<?php if($_GET['action']== 'edit' && get_option('end_time')):?><?php echo date("d-m-Y h:i:s",get_option('end_time'));?><?php endif;?>" /></td>
    </tr>
	<tr>
      <th scope="row"><label>Default URL</label></th>
      <td><span class="description"><i>http://americancensorship.org/</i></span></td>
    </tr>
    <tr>
      <th scope="row"><label>Enter Different URL</label></th>
      <td><input type="text" class="regular-text" name="url" id="url"  value="<?php if($_GET['action']=='edit'):?><?php echo get_option('redirect_url');?><?php endif;?>"/></td>
    </tr>
	<tr>
      <th scope="row"><label>Reset Settings</label></th>
      <td><input type="checkbox" name="reset_redirect_settings" value="reset" /></td>
    </tr>
  </table>
  <p class="submit">
    <?php if($_GET['action']=='edit'):?>
    <input type="submit" name="update" id="update" value="Update" class="button-primary" />
    <?php else:?>
    <input type="submit" name="save" id="save" value="Save" class="button-primary"/>
    <?php endif;?>
  </p>
</form>
<?php  $start_time = get_option('start_time')?date("d-m-Y h:i:s",get_option('start_time')):null;?>
<?php  $end_time = get_option('end_time')?date("d-m-Y h:i:s",get_option('end_time')):null;?>
<div style="padding:10px 10px 10px 0;">
  <table class="wp-list-table widefat fixed posts">
    <thead>
		<tr style="padding:10px;">
		  <th>Start Time</th>
		  <th>End Time</th>
		  <th>Url</th>
		  <th>&nbsp;</th>
		</tr>
	</thead>
    <tbody>
		<?php if($start_time && $end_time): ?>
		<tr class="alternate author-self status-publish format-default iedit">
		  <td><?php echo $start_time;?></td>
		  <td><?php echo $end_time;?></td>
		  <td><?php echo get_option('redirect_url');?></td>
		  <td><a href="admin.php?page=redirect&action=edit" class="button">Edit</a></td>
		</tr>
		<?php else: ?>
		<tr class="alternate author-self status-publish format-default iedit">
			<td colspan="4">No date specified.</td>
		</tr>
		<?php endif; ?>
	</tbody>
  </table>
</div>
<?php }
?>