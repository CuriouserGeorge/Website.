
    <footer class="footer">
      <div class="container">
        <span class="text-muted">Copyright twitter &copy; 2010-<?php echo date("Y");?>
 .</span>
      </div>
    </footer>    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalTitle">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="loginAlert" class="alert alert-danger" ></div>
            <form>
                <input type="hidden" name="loginActive" id="loginActive" value="1">
              <div class="form-group">
                <label for="emailInput">Email</label>
                <input type="email" class="form-control" id="emailInput" placeholder="name@example.com">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput2">Password</label>
                <input type="password" class="form-control" id="passwordInput" placeholder="*****">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a id="toggleLogin">Sign up</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="loginSignUpButton">Login</button>
          </div>
        </div>
      </div>
    </div>

<script>
        
        $("#toggleLogin").click(function(){
            console.log($("#loginActive").val());
            if($("#loginActive").val() == "1"){

                $("#loginActive").val("0");
                $("#loginModalTitle").text("Sign Up");
                $("#toggleLogin").html("Login");
                $("#loginSignUpButton").html("Sign Up");

            }else if($("#loginActive").val() == "0"){
                $("#loginActive").val("1");
                $("#loginModalTitle").text("Login");
                $("#toggleLogin").html("Sign Up");
                 $("#loginSignUpButton").html("Login");
            }        
                
        });
    
        $('#loginSignUpButton').click(function(){
            
            $.ajax({
                type: "POST",
                url: "actions.php?action=loginSignUp",
                data: "email=" + $('#emailInput').val() + "&password=" + $('#passwordInput').val() + '&loginActive=' + $('#loginActive').val(),
                success: function(result){
                    if(result == "1"){
                        
                        window.location.assign("https://georgetimbrell.co.uk/MVC/");
                    }else{
                        
                        $('#loginAlert').html(result).show();
                    }                 
                }
            });
            
            
        });
    
        $('.toggleFollow').click(function(){
             var id = $(this).attr("data-userId")
            $.ajax({
                type: "POST",
                url: "actions.php?action=toggleFollow",
                data: "userId=" + id,
                success: function(result){
                    if(result == "1"){
            
                    $("a[data-userId ='" + id + "']").html("follow");
                    }
                    if(result == "2"){           
                    $("a[data-userId ='" + id + "']").html("unfollow");            
                    }                               
                }
            });
            
        });
    
        $('#postTweet').click(function(){
                $.ajax({
                type: "POST",
                url: "actions.php?action=postTweet",
                data: "tweetContent=" + $('#tweetContent').val(),
                success: function(result){
                    if(result == "1"){
                        $('#tweetSuccess').show();
                        $('#tweetFail').hide();
                    }else if(result != ""){
                        $('#tweetFail').html(result).show();
                         $('#tweetSuccess').hide();
                        
                    }
                }
            });
            
            
        });
</script>

  </body>
</html>