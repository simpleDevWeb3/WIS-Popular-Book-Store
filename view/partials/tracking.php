<h3>Now on</h3>

<?php
if(urlIs('/register-account')){
  $progress_title  = 'Create Account';  
}else if(urlIs('/register-address')){
  $progress_title  = 'Address';  
}else{
  $progress_title  = 'General Details';  
}

?>

<h2 style="margin-bottom: 10px; margin-top: 10px;"><?=$progress_title?></h2>

<div class="progress-bar-tracking" >
    <div style="display: flex; align-items:center; gap:10px;  <?=urlIs('/register-general')||urlIs('/register-account') || urlIs('/register-address')? 'color:#036ffc' : ''?>;"">
      <i  class="ri-number-1"></i> <span> General Details </span> 
      <div class= "track"  style="<?= urlIs('/register-address') || urlIs('/register-account') ? 'background-color:#036ffc' : ''?>;" ></div>
    </div>
  
    
    <div style="display: flex; align-items:center; gap:10px; <?=urlIs('/register-account') || urlIs('/register-address') ? 'color:#036ffc' : ''?>;" ">
      <i class="ri-number-2"></i> <span> Create Account</span> 
      <div  class= "track" style="<?=urlIs('/register-address') ? 'background-color:#036ffc' : ''?>;" ></div>
    </div>


    <div style="display: flex; align-items:center; gap:10px;  <?=urlIs('/register-address')? 'color:#036ffc': ''?>;"">
      <i class="ri-number-3"></i> <span> House Address </span> 
    
    </div> 
</div>

<style>
  .ri-number-1,
  .ri-number-2,
  .ri-number-3{
    border: solid 1px; 
    border-radius:50%; padding:10px; 
    font-size:13px;
  }

  .track{
    width: 100px; 
    height:2px; 
    background-color:gray;  
    margin-right:10px;
  }
  .progress-bar-tracking{
    margin-bottom: 60px; 
    display:flex;
  }
</style>