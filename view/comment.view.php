<div style="display:flex; align-items:center;">
      <span class="user-profile">
            <img height="80px" width="80px" src="<?=$_SESSION['profile_image']??"img/user/default.jpg"?>" />
       </span>
        
        <textarea class="comment-section" id="comment-text"  placeholder="Write a comment..." ></textarea>
     </div>
     <button class="comment-cancel-button" id="cancel-comment">Cancel</button>
     <button class="comment-button" id="comment" data-product-id="<?=$product_details['product_id']?>">Comment</button>
 
     <br>
     <br>
     <?php if($comments):?>
      <div id="comment-list">
        <?php foreach ($comments as $comment) :?>
            <div style="display: flex; margin-bottom:30px; ">
              <div class="comment">
                <span class="user-profile" style="padding-bottom: 40px;">
                  <img height="60px" width="60px" src="<?=$comment["profile_image"] ?? "img/user/default.jpg" ?>" />
                </span>   
              </div>
              <div>
                  
                    <div style="display: flex; gap:10px;"><div style="margin-left: 20px; font-weight:700; font-size:21px;"><?=$comment["username"]?></div> <label style="opacity: 0.8;">  <?= formatDate("d/m/Y",$comment["created_at"]) ?></label></div>
                      <div style="margin-top:10px; margin-left:20px; display: flex; border:solid 1px; padding:20px; font-size:25px;"> 
                          <?=$comment["comment"]?>
                      </div>
                    </div>         
            </div>
        <?php endforeach;?> 
      </div> 
   <?php endif;?>