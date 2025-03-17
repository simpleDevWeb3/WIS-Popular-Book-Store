<h1> <?=$p->item_count?> Comments</h1>
<br><br>
<div style="display:flex; align-items:center;">
      <span class="user-profile">
            <img height="80px" width="80px" src="<?=$_SESSION['profile_image']??"img/user/default.jpg"?>" />
       </span>
        
        <textarea class="comment-section" id="comment-text"  placeholder="Write a comment..." ></textarea> 
        <label id="error-text"  class="error">**exceeds 200 words limit</label>
     </div>
     <div  id="comment-buttons" class="hidden">
      <button class="comment-cancel-button" id="cancel-comment">Cancel</button>
      <button class="comment-button" id="comment" data-product-id="<?=$product_details['product_id']?>">Comment</button>
     </div>
   
  
     <br>
     <br>
 
     <?php if($comments):?>
      <div id="comment-list" style="margin-left: 20px;">
        <?php foreach ($comments as $comment) :?>
            <div style="display: flex; align-items:start ;">
              <div class="comment">
                <span class="user-profile" style="padding-bottom: 0px;">
                  <img height="60px" width="60px" src="<?=$comment["profile_image"] ?? "img/user/default.jpg" ?>" />
                </span>   
            </div>
              <div>
                 <div style="display: flex; gap:10px; align-items:center;">
                    <label class="comment-user">@<?=$comment["username"]?> </label> <label style="opacity: 0.8; font-size:15px;">  <?= formatDate("d/m/Y",$comment["created_at"]) ?></label></div>
                      <div class="comment-box"> 
                        <p><?= htmlspecialchars($comment["comment"]) ?></p> 
                      </div>
                   </div>                        
            </div>
            <div style="margin-left:90px; margin-bottom:20px; display:flex; gap:5px; align-items:center;">
               <span class="like-container"><i class="ri-thumb-up-line"  data-id="<?=$comment["comment_id"]?>"></i></span>
               <span>1</span>
               <span class="dislike-container" ><i class="ri-thumb-down-line" data-id="<?=$comment["comment_id"]?>"></i></span>
               <span>2</span>
               <span class="reply-btn">reply</span>
            </div>    
            <div class="replies-pull" style="margin-left:90px; display:flex; max-width:130px;">
              <span><i class="ri-arrow-down-s-line"></i></span> <span>20 replies</span>
            </div>
            <div>
            </div>
            
            <br><br>
        <?php endforeach;?> 
      </div> 
   <?php endif;?>
 <br><br>
  