<div class="container mainContainer">
    
    <div class="row">
        <div class="col-8">
            <h2>Your Timeline</h2>
            <?php displayTweets('isFollowing'); ?>
        
        </div>
        <div class="col-4">
            
            <?php displaySearch() ?>
            <?php displayTweetBox() ?>
            
        
        </div>
    </div>

</div>