        <p class="button-height inline-label">
        <label for="validation-required" class="label"> Welcome Title </label>
            <input type="text" name="home_welcome_title_en" id="home_welcome_title_en" class="input full-width validate[required] " value="<?php if(isset($page['home_welcome_title_en'])) echo $page['home_welcome_title_en']; ?>" data-tooltip-options='{"position":"left"}' style="text-align:left;"  />
        </p>

        <p class="button-height inline-label">
        <label  class="label floatLeft">Welcome Simple Words  
          </label>
           <textarea  id="home_welcome_en" name="home_welcome_en" ><?php if(isset($page['home_welcome_en'])) echo $page['home_welcome_en']; ?></textarea>
        </p>

<p class="button-height inline-label">
        <label  class="label">keywords  
          </label>
           <textarea  id="keywords_en" name="keywords_en" class="input full-width validate[required]"><?php if(isset($seo['keywords_en'])) echo $seo['keywords_en']; ?></textarea>
        </p>  
<p class="button-height inline-label">
        <label  class="label">Description  
          </label>
           <textarea  id="desc_en" name="desc_en" class="input full-width validate[required]"><?php if(isset($seo['desc_en'])) echo $seo['desc_en']; ?></textarea>
        </p>
 <!--<p class="button-height " style="display:none;">
            <label for="validation-required" class="label"> <b>ÇáåíÏÑ</b> </label>
			<textarea name="home_header" id="home_header" class="input full-width " data-tooltip-options='{"position":"left"}' style="text-align:right;height:450px;" ><?php if(isset($page['home_header'])) echo $page['home_header']; ?></textarea>	
        </p>
        <p class="button-height " style="display:none;">
            <label for="validation-required" class="label"> <b>ÇáÝæÊÑ</b> </label>
			<textarea name="home_footer" id="home_footer" class="input full-width " data-tooltip-options='{"position":"left"}' style="text-align:right;height:450px;" ><?php if(isset($page['home_footer'])) echo $page['home_footer']; ?></textarea>
        </p>
       
-->