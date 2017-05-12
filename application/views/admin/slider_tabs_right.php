  <? $url = explode('/',$_SERVER['REQUEST_URI']);
			   $reminURL = "";
			  for($j=4;$j<count($url);$j++) 
			   	  $reminURL .= '/'.$url[$j];
if($url[1]=='sites')
    $pageName=$url[3];
else $pageName=$url[1];
//echo 'pageName: '.$pageName;

 $priv=$this->session->userdata('priv') ;
            $network= $this->session->userdata('network');
        if($priv!=-1)
            $arr=explode(',',$priv);else $arr=array();
	 		?>      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url()?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini taxi_logo"><?=lang('TAXI')?><span><?=lang('APP')?></span></span>
          <!-- logo for regular state and mobile devices -->
          <p class="logo-lg taxi_logo"><?=lang('TAXI')?><span><?=lang('APP')?></span></p>
          <!--  <button class="button lang_btnheader" onclick="document.location='<?=base_url().lang('rdb').$reminURL?>';">
             <?=lang('xlangauge')?>
            </button>-->
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
        <!--  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>-->
          <div class="col-sm-10 three_tab">
                <div class="col-sm-3">
                   <h3><i class="fa fa-car" aria-hidden="true"></i><?=lang('TAXIS')?></h3>
                   <p><?=lang('Free_Taxis')?><span>(0)</span></p>
                   <p><?=lang('Busy_Taxis')?><span>(0)</span></p>
                </div>   
                <div class="col-sm-3">
                   <h3><i class="fa fa-calendar-o" aria-hidden="true"></i><?=lang('TODAY_TRIPS')?></h3>
                    <p><?=lang('Finished_TRIPS')?><span>(0)</span></p>
                    <p><?=lang('Current_TRIPS')?><span>(0)</span></p>
                </div>   
                <div class="col-sm-3">
                   <h3><i class="fa fa-calendar" aria-hidden="true"></i><?=lang('Later_TRIPS')?></h3>
                   <p><?=lang('Today_TRIPS')?><span>(0)</span></p>
                   <p><?=lang('Tomorrow_TRIPS')?><span>(0)</span></p>
                </div>    
                <? if(in_array('6',$arr) || $priv==-1){?>
                <div class="col-sm-2">
                <a type="button" class="btn btn-block colorbox" href="<?php echo site_url('admin/addtrip')?>/">
                <?=lang('ADD_NEW_ORDER')?>
                </a>
                </div>   
              <? }?>
<?php if($this->session->userdata('id')==-1):?>
                <div class="col-sm-1">
                <a type="button" class="btn btn-block colorbox" href="<?php echo site_url('Push/send')?>/">
                push
                </a>
                </div>        
<?php endif?>    
          </div>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
        
             
             
            
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?=base_url()?>assets/images/admin.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?=$this->session->userdata("username")?> </span><!--document.location='<?=base_url().lang('rdb').$reminURL?>';-->
				  <button class="button lang_btnheader" onclick="$('#returnSpan').load('<?=base_url()?>admin/switchLanguage',{language:'<?=lang('slang')?>'})">
                    <?=lang('xlangauge')?>
                    </button>
                    
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <p>
                     <?=$this->session->userdata("username")?>
                    </p>
                    <img src="<?=base_url()?>assets/images/admin.png" class="img-circle" alt="User Image" />
                  </li>
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?=site_url('Passengers/profile')?>" class="btn btn-default btn-flat"><?=lang('Profile')?></a>
                    </div>
                    <div class="pull-right">
                      <a href="<?=site_url('admin/SignOut')?>" class="btn btn-default btn-flat"><?=lang('Signout')?></a>
                    </div>
                  </li>
                </ul>
              </li>
              
              <!-- Control Sidebar Toggle Button -->
<!--
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
                
-->
                
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          
       <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
            <?php if($this->session->userdata('id') && $this->session->userdata('id') !="" ){
            ?>    
              
              <? if($network==-1) {if(in_array('7',$arr) || in_array('8',$arr)|| in_array('9',$arr)|| in_array('10',$arr)|| in_array('11',$arr)|| in_array('12',$arr)|| in_array('13',$arr)|| in_array('14',$arr)|| in_array('15',$arr) || in_array('21',$arr)|| $priv==-1){?> 
            <li class="<?php if((ucfirst($this->uri->segment(1))=='Page' || ucfirst($this->uri->segment(1))=='Generalsetting' || ucfirst($this->uri->segment(1))=='Generalsetting') && ( $this->uri->segment(2)=='Pages' || $this->uri->segment(2)=='PageForm' || $this->uri->segment(2)=='AllCity' || $this->uri->segment(2)=='AllCountry' || $this->uri->segment(2)=='Allplaces' || $this->uri->segment(2)=='CountryForm' || $this->uri->segment(2)=='CityForm' || $this->uri->segment(2)=='placeForm' || $this->uri->segment(2)=='BrandsForm' ||   $this->uri->segment(2)=='AllBrands' || $this->uri->segment(2)=='ModelForm' ||   $this->uri->segment(2)=='AllModel' || $this->uri->segment(2)=='TripTypeForm' ||   $this->uri->segment(2)=='AllTripType' || $this->uri->segment(2)=='LevelForm' ||   $this->uri->segment(2)=='AllLevel' ||  $this->uri->segment(2)=='packageForm' ||   $this->uri->segment(2)=='Allpackage' || $this->uri->segment(2)=='Setting' )) echo "active"; ?> treeview">
              <a href="#">
              <i class="fa fa-wrench main_icon" aria-hidden="true"></i>
                <span><?=lang('Setting')?><? //print_r($arr);?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
                   <? if(in_array('21',$arr) || $priv==-1){?>
                  <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ($this->uri->segment(2)=='Setting' )) { ?> class="active" <?php } ?> >
    <a href="<?=site_url('Generalsetting/Setting')?>"><i class="fa fa-circle-o"></i> <?=lang('Setting')?> </a>
</li>
  <? }?>
                  <? if(in_array('8',$arr) || $priv==-1){?>
                  <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ($this->uri->segment(2)=='AllCountry' || $this->uri->segment(2)=='CountryForm')) { ?> class="active" <?php } ?> >
    <a href="<?=site_url('Generalsetting/AllCountry')?>"><i class="fa fa-circle-o"></i> <?=lang('Country')?> </a>
</li>
  <? }?>
                  <? if(in_array('9',$arr) || $priv==-1){?>                 
<li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ($this->uri->segment(2)=='AllCity' || $this->uri->segment(2)=='CityForm')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/AllCity')?>"><i class="fa fa-circle-o"></i> <?=lang('City')?></a>
</li>   <? }?>
                  <? if(in_array('10',$arr) || $priv==-1){?>
                  <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ($this->uri->segment(2)=='Allplaces' || $this->uri->segment(2)=='placeForm')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/Allplaces')?>"><i class="fa fa-circle-o"></i> <?=lang('places')?></a>
</li>  
                  <? }?>
                  <? if(in_array('14',$arr) || $priv==-1){?> 
                  <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ( $this->uri->segment(2)=='BrandsForm' ||   $this->uri->segment(2)=='AllBrands')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/AllBrands')?>"><i class="fa fa-circle-o"></i> <?=lang('Brands')?></a>
</li> <? }?>
                  <? if(in_array('13',$arr) || $priv==-1){?>
                  <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ( $this->uri->segment(2)=='ModelForm' ||   $this->uri->segment(2)=='AllModel')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/AllModel')?>"><i class="fa fa-circle-o"></i> <?=lang('Models')?></a>
</li>
                   <? }?>
                  <? if(in_array('12',$arr) || $priv==-1){?>
                    <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ( $this->uri->segment(2)=='TripTypeForm' ||   $this->uri->segment(2)=='AllTripType')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/AllTripType')?>"><i class="fa fa-circle-o"></i> <?=lang('Trip_Type')?></a>
</li>
                  <? }?>
<? if(in_array('11',$arr) || $priv==-1){?>
   <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ( $this->uri->segment(2)=='LevelForm' ||   $this->uri->segment(2)=='AllLevel')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/AllLevel')?>"><i class="fa fa-circle-o"></i> <?=lang('Levels')?></a>
</li>
                  <? }?>
                  <? if(in_array('15',$arr) || $priv==-1){?>
                   <li <?php if(ucfirst($this->uri->segment(1))=='Generalsetting' && ( $this->uri->segment(2)=='packageForm' ||   $this->uri->segment(2)=='Allpackage')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Generalsetting/Allpackage')?>"><i class="fa fa-circle-o"></i> <?=lang('Packages')?></a>
</li>
                  <? }?>
<? if(in_array('7',$arr) || $priv==-1){?>
<li <?php if(ucfirst($this->uri->segment(1))=='Page' && $this->uri->segment(2)=='Pages') { ?> class="active" <?php } ?> >
    <a href="<?=site_url('Page/Pages'); ?>"><i class="fa fa-circle-o"></i> <?=lang('Pages')?></a>
</li>
  <? }?>          
              </ul>
            </li>
              <? }}?>
              <? if(in_array('1',$arr) || $priv==-1){?>
            <li class="<?php if(ucfirst($this->uri->segment(1))=='Users' && ( $this->uri->segment(2)=='memberList' || $this->uri->segment(2)=='Form' )) echo "active"; ?> treeview">
              <a href="#">
                <i class="fa fa-th main_icon" aria-hidden="true"></i>
                <span><?=lang('Users')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
                   <? if(in_array('1',$arr) || $priv==-1){?>
<li <?php if(ucfirst($this->uri->segment(1))=='Users' && ( $this->uri->segment(2)=='memberList' || $this->uri->segment(2)=='Form' )) { ?> class="active" <?php } ?> >
    <a href="<?=site_url('Users/memberList'); ?>"><i class="fa fa-circle-o"></i> <?=lang('Users')?></a>
</li>
                  <? }?>
            
              </ul>
            </li>
              <? }?>
              
             
              
            
           
          
          
         
              
                 
           
              
              
              
              <? if(in_array('3',$arr) || $priv==-1){?>
              
                <li class="<?php if(ucfirst($this->uri->segment(1))=='Cards' && ( $this->uri->segment(2)=='cardsForm' ||   $this->uri->segment(2)=='cardsList')) echo "active"; ?> treeview">
              <a href="#">
                   <i class="fa fa-users main_icon" aria-hidden="true"></i>
                <span><?=lang('Cards')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
<? if(in_array('3',$arr) || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='Cards' && ( $this->uri->segment(2)=='cardsForm' ||   $this->uri->segment(2)=='cardsList')) { ?> class="active" <?php } ?>>
    <a href="<?=base_url('Cards/cardsList')?>"><i class="fa fa-circle-o"></i> <?=lang('Cards')?></a>
</li>
<? }?>
              </ul>
            </li>
              <? }?>
              
               <? if(in_array('17',$arr) || $priv==-1){?>
              
                <li class="<?php if(ucfirst($this->uri->segment(1))=='Passengers' && ( $this->uri->segment(2)=='passengerForm' ||   $this->uri->segment(2)=='passengerList')) echo "active"; ?> treeview">
              <a href="#">
              <i class="fa fa-users main_icon" aria-hidden="true"></i>
                <span><?=lang('Passengers')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
 <? if(in_array('17',$arr) || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='Passengers' && ( $this->uri->segment(2)=='passengerForm' ||   $this->uri->segment(2)=='passengerList')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Passengers/passengerList')?>"><i class="fa fa-circle-o"></i> <?=lang('Passengers')?></a>
</li>
<? }?>
              </ul>
            </li>
              <? }?>
              
             
              
              
               <? if(in_array('2',$arr) ||in_array('18',$arr) || $priv==-1){?>
              
               <li class="<?php if(ucfirst($this->uri->segment(1))=='Drivers' && ( $this->uri->segment(2)=='networkForm' ||   $this->uri->segment(2)=='networkList' || $this->uri->segment(2)=='driverForm' ||   $this->uri->segment(2)=='driverList')) echo "active"; ?> treeview">
              <a href="#">
              <i class="fa fa-car main_icon" aria-hidden="true"></i>
                  <span><?=lang('Drivers')?><span class="badge"><?=$this->session->userdata('driverCount')?></span></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">

                <? if(in_array('18',$arr)  || $priv==-1){?>   
<li <?php if(ucfirst($this->uri->segment(1))=='Drivers' && ( $this->uri->segment(2)=='networkForm' ||   $this->uri->segment(2)=='networkList')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Drivers/networkList')?>"><i class="fa fa-circle-o"></i> <?=lang('Network')?></a>
</li>
                  <? }?>
                   <? if(in_array('2',$arr) || $priv==-1){?>
                  <li <?php if(ucfirst($this->uri->segment(1))=='Drivers' && ( $this->uri->segment(2)=='driverForm' ||   $this->uri->segment(2)=='driverList')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Drivers/driverList')?>"><i class="fa fa-circle-o"></i><?=lang('Drivers')?></a>
</li>
<? }?>
              </ul>
            </li>
              <? }?>
              
             
              <? if(in_array('19',$arr) ||in_array('20',$arr) || $priv==-1){?>
              
               <li class="<?php if(ucfirst($this->uri->segment(1))=='Trips' && ( $this->uri->segment(2)=='pricingList' ||   $this->uri->segment(2)=='pricingForm' || $this->uri->segment(2)=='offerForm' ||   $this->uri->segment(2)=='offerList' )) echo "active"; ?> treeview">
              <a href="#">
                <i class="fa fa-map-marker main_icon" aria-hidden="true"></i>
                <span><?=lang('Trips')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">

                  <? if(in_array('19',$arr) || $priv==-1){?>
<li <?php if(ucfirst($this->uri->segment(1))=='Trips' && ( $this->uri->segment(2)=='pricingForm' ||   $this->uri->segment(2)=='pricingList')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Trips/pricingList')?>"><i class="fa fa-circle-o"></i> <?=lang('pricing')?></a>
</li>
       <? }?>
                  <? if(in_array('20',$arr) || $priv==-1){?>
<li <?php if(ucfirst($this->uri->segment(1))=='Trips' && ( $this->uri->segment(2)=='offerForm' ||   $this->uri->segment(2)=='offerList')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Trips/offerList')?>"><i class="fa fa-circle-o"></i> <?=lang('offers')?></a>
</li>
                 <? }?>

              </ul>
            </li>
              <? }?>
              <? if(in_array('4',$arr) || $priv==-1){?>
         <li class="<?php if(ucfirst($this->uri->segment(1))=='Finnance' &&($this->uri->segment(2)=='finnanceForm'||$this->uri->segment(2)=='finnanceList' )) echo "active"; ?> treeview">
              <a href="#">
              <i class="fa fa-check-square-o main_icon" aria-hidden="true"></i>
                <span><?=lang('finnance')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
<? if(in_array('4',$arr) || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='Finnance' && ( $this->uri->segment(2)=='finnanceForm' ||   $this->uri->segment(2)=='finnanceList' ))  { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Finnance/finnanceForm')?>"><i class="fa fa-circle-o"></i> <?=lang('finnance')?></a>
</li>
          <? }?>       

              </ul>
            </li>  
              <? }?>
              
              
              
              <? if(in_array('16',$arr)  || $priv==-1){?>
               <li class="<?php if(ucfirst($this->uri->segment(1))=='News' && ( $this->uri->segment(2)=='NewsForm' ||   $this->uri->segment(2)=='NewsList')) echo "active"; ?> treeview">
              <a href="#">
                <i class="fa fa-file-text main_icon" aria-hidden="true"></i>
                <span><?=lang('News')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
 <? if(in_array('16',$arr)  || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='News' && ( $this->uri->segment(2)=='NewsForm' ||   $this->uri->segment(2)=='NewsList')) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('News/NewsList')?>"><i class="fa fa-circle-o"></i> <?=lang('News')?></a>
</li>
                  <? }?>

              </ul>
            </li>
              
              <? }?>
              
              
               <? if(in_array('5',$arr)  || $priv==-1){?>
                 <li class="<?php if(ucfirst($this->uri->segment(1))=='Reports' && ( $this->uri->segment(2)=='reportForm'  || $this->uri->segment(2)=='finnanceForm' || $this->uri->segment(2)=='finnanceForm'  || $this->uri->segment(2)=='StaticseForm' )) echo "active"; ?> treeview">
              <a href="#">
              <i class="fa fa-flag main_icon" aria-hidden="true"></i>
                <span><?=lang('Reports')?></span>
                <i class="fa fa-angle-left pull-right"></i>  
              </a>
              <ul class="treeview-menu">
<? if(in_array('5',$arr)  || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='Reports' && ( $this->uri->segment(2)=='reportForm'  )) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Reports/reportForm')?>"><i class="fa fa-circle-o"></i> <?=lang('TReports')?></a>
</li>
                  <? }?>
                 
<? if(in_array('5',$arr)  || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='Reports' && ( $this->uri->segment(2)=='finnanceForm'  )) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Reports/finnanceForm')?>"><i class="fa fa-circle-o"></i> <?=lang('FReports')?></a>
</li>
                  <? }?>
             <? if(in_array('5',$arr)  || $priv==-1){?>
                  
<li <?php if(ucfirst($this->uri->segment(1))=='Reports' && ( $this->uri->segment(2)=='StaticseForm'  )) { ?> class="active" <?php } ?>>
    <a href="<?=site_url('Reports/StaticseForm')?>"><i class="fa fa-circle-o"></i> <?=lang('Sreport')?></a>
</li>
                  <? }?>    
              </ul>
            </li>
              <? }?>
          <?php } ?>
                     

              
            


              
              
           
              
              
              
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
<script>
  $(function(){
    $('a.colorbox').colorbox({width:'80%',height:'90%',iframe:true});
  })
</script>
