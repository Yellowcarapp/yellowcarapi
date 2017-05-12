 
<?php if(isset($Lates_p['id']) && $Lates_p['id']!='' && $Lates_p['id']>0) { ?> 
 <tr>
                        <td>Pages</td>
                     
                        <td><a href="#"><?=$Lates_p['title_en']?></a></td>
                        
                         <?php if($Lates_p['active']) { ?>
                        <td><span class="stat_up" >Active<span class="arrow_up iconsweet"></span></span></td>
                        <?php } else { ?>
                        <td><span class="stat_down">Hidden<span class="arrow_up iconsweet"></span></span></td>
                         <?php } ?>
                        
                        
                        <td>
                             <span class="data_actions iconsweet">
                     <a class="tip_north" original-title="View" target="_blank" href="<?=site_url('Pages/details/'.$Lates_p['id']); ?>">P</a> 
                     <a class="tip_north" original-title="Edit" href="<?=site_url('page/PageForm/'.$Lates_p['id']); ?>">C</a> 
                    <?php if($Lates_p['fixed_page']==0) { ?>  
                     <a class="tip_north" original-title="Delete"  onclick="return deletecheckedLatest('Are you sure you want to delete !!','<?=site_url('page/DeletePage/'.$Lates_p['id']); ?>');" href="#">X</a>
                   <?php } ?>
                     
                    </span>
                        
                        </td>     
                                      
</tr>   
<?php  } ?>
 
<!--##########-->
<?php if(isset($Lates_N['id']) && $Lates_N['id']!='' && $Lates_N['id']>0) { ?> 
<tr>
                        <td>News</td>
                     
                        <td><a href="#"><?=$Lates_N['title_en']?></a></td>
                        
                         <?php if($Lates_N['active']) { ?>
                        <td><span class="stat_up" >Active<span class="arrow_up iconsweet"></span></span></td>
                        <?php } else { ?>
                        <td><span class="stat_down">Hidden<span class="arrow_up iconsweet"></span></span></td>
                         <?php } ?>
                        
                        
                        <td>
                             <span class="data_actions iconsweet">
                     <a class="tip_north" original-title="View" target="_blank" href="<?=site_url('events/details/'.$Lates_N['n_cat_type'].'/'.$Lates_N['id']); ?>">P</a> 
                     <a class="tip_north" original-title="Edit" href="<?=site_url('events/Form/'.$Lates_N['n_cat_type'].'/'.$Lates_N['id']); ?>">C</a> 
                    
                     <a class="tip_north" original-title="Delete"  onclick="return deletecheckedLatest('Are you sure you want to delete !!','<?=site_url('events/delete/'.$Lates_N['n_cat_type'].'/'.$Lates_N['id']); ?>');" href="#">X</a>
           
                     
                    </span>
                        
                        </td>     
                                      
</tr> 
<?php } ?>
 <!--##########-->
<?php if(isset($Lates_projects['id']) && $Lates_projects['id']!='' && $Lates_projects['id']>0) { ?> 
<tr>
                        <td>Projects</td>
                     
                        <td><a href="#"><?=$Lates_projects['title_en']?></a></td>
                        
                         <?php if($Lates_projects['active']) { ?>
                        <td><span class="stat_up" >Active<span class="arrow_up iconsweet"></span></span></td>
                        <?php } else { ?>
                        <td><span class="stat_down">Hidden<span class="arrow_up iconsweet"></span></span></td>
                         <?php } ?>
                        
                        
                        <td>
                             <span class="data_actions iconsweet">
                     <a class="tip_north" original-title="View" target="_blank" href="<?=site_url('projects/details/'.$Lates_projects['id']); ?>">P</a> 
                     <a class="tip_north" original-title="Edit" href="<?=site_url('projects/Form/'.$Lates_projects['id']); ?>">C</a> 
                      
                     <a class="tip_north" original-title="Delete"  onclick="return deletechecked('Are you sure you want to delete <?=$Lates_projects['title_en'] ?> !!','<?=site_url('projects/delete/'.$Lates_projects['id']); ?>');" href="#">X</a>
                     
                    </span>
                        
                        </td>     
                                      
</tr> 
<?php } ?>
 
<!--##########-->
 
<script>
  
 function deletecheckedLatest(msg,id)
	{
		var answer = confirm(msg)
		if (answer){
			document.location=id;
		}
		
		return false;  
	}  
</script>