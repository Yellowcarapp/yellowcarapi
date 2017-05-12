<p class="button-height inline-label">
<label class="label" for="input-3">Title</label>
<input type="text" id="title_fr" value="<?php if(isset($page['title_fr'])) echo $page['title_fr']; ?>" name="title_fr"  class="input full-width" >
</p>



<p class="button-height inline-label">
<label class="label" for="input-3">  Details </label> 
<textarea name="details_fr" id="details_fr"  class="input full-width autoexpanding" rows="5" ><?php if(isset($page['details_fr'])) echo $page['details_fr']; ?></textarea>
</p>						

<p class="button-height inline-label">
<label class="label" for="input-3"> Description </label> 
<textarea name="description_fr" id="description_fr"  class="input full-width autoexpanding" rows="5" ><?php if(isset($page['description_fr'])) echo $page['description_fr']; ?></textarea>
</p>



<p class="button-height inline-label">
<label class="label" for="input-3"> Keywords </label> 
<textarea name="keyword_fr" id="keyword_fr"  class="input full-width autoexpanding" rows="5" ><?php if(isset($page['keyword_fr'])) echo $page['keyword_fr']; ?></textarea>

</p>