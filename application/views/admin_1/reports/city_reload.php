<input type="text" class="form-control"  name="cityId" id="cityId"  />
<script>
  $().ready(function(){
       $('#cityId').tokenInput("<?=site_url('admin/Reports/getCity/'.$country)?>", {
               hintText:'<?=lang('City')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });
  });
</script>