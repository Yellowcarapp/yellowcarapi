
	<!-- Side tabs shortcuts -->
	<ul id="shortcuts" role="complementary" class="children-tooltip tooltip-right">
 		 
 
  	<li <?php if($this->uri->segment(1)=='admin' && $this->uri->segment(2)=='admin' ) { ?> class="current" <?php } ?> >
 		<a class="shortcut-dashboard" href="<?=site_url('admin/Admin')?>"   title="الرئيسية" > الرئيسية </a>
   </li>
 <li class="current">
 		<a class="shortcut-messages" href="<?=site_url('admin/Feedback')?>" title="مراسلات"> مراسلات </a>
   </li>


	</ul>
    
    <div id="HiddenDiv" style="display:none;"></div>
    