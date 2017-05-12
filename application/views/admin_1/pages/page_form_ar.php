<p class="button-height inline-label">
<label class="label" for="input-3">العنوان</label>
<input type="text" id="title_ar" value="<?php if(isset($page['page_name_ar'])) echo $page['page_name_ar']; ?>" name="title_ar"  class="input full-width" >
</p>



<p class="button-height inline-label">
<label class="label" for="input-3">  التفاصيل </label> 
<textarea name="details_ar" id="details_ar"  class="input full-width autoexpanding" rows="5" ><?php if(isset($page['page_details_ar'])) echo $page['page_details_ar']; ?></textarea>
</p>						

<!--<p class="button-height inline-label">
<label class="label" for="input-3"> Description </label> 
<textarea name="description_ar" id="description_ar"  class="input full-width autoexpanding" rows="5" ><?php //if(isset($page['description_ar'])) echo $page['description_ar']; ?></textarea>
</p>



<p class="button-height inline-label">
<label class="label" for="input-3"> Keywords </label> 
<textarea name="keyword_ar" id="keyword_ar"  class="input full-width autoexpanding" rows="5" ><?php //if(isset($page['keyword_ar'])) echo $page['keyword_ar']; ?></textarea>

</p>-->