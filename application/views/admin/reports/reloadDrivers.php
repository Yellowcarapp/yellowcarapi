
                 <input class="form-control" type="text"  name="driver" id="driver"  />
<script>
  $().ready(function(){
       $('#driver').tokenInput("<?=site_url('Reports/getDriver/'.$network)?>", {
               hintText:'<?=lang('Driver')?>'
                ,theme: "facebook"
                ,preventDuplicates: true
              });
  });
</script>
                 