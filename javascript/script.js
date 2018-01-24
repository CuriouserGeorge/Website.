            

            console.log("javascript loaded");
            //create alert
            document.getElementById("alertButton").onclick = function(){
                
                alert("Button Clicked");
                
                
                
            }
            //change text
            document.getElementById("changeButton").onclick = function(){
                
                document.getElementById("text").innerHTML = "Text Changed"
            }
            //append text
            
            document.getElementById("appendButton").onclick = function(){
                
                document.getElementById("append").innerHTML +=  " appended";
            }
            //pop text
            document.getElementById("popButton").onclick = function(){
                text = document.getElementById("append").innerHTML;
                text = text.split(" ");
                text.pop();
                text = text.join(" ");
                document.getElementById("append").innerHTML = text;
                console.log(text);
            }
            //show text
            document.getElementById("createButton").onclick = function(){
                document.getElementById("hidden").innerHTML = "Here is some text";
                
            }
            //style text
            document.getElementById("styleButton").onclick = function(){
                text_style = document.getElementById("style").style;
                text_style.color = "red";
                text_style.fontFamily = "helvetica";
                text_style.fontWeight = "bold";
                text_style.fontSize = "20px";
                
            }
            //circle display
            document.getElementById("circle1").onclick = function(){
                circle = document.getElementById("circle1").style;
                circle.display = "none";
            }
            document.getElementById("circle2").onclick = function(){
                circle = document.getElementById("circle2").style;
                circle.display = "none";
            }            
            document.getElementById("circle3").onclick = function(){
                circle = document.getElementById("circle3").style;
                circle.display = "none";
            }            
            //input to text
            document.getElementById("textChanger").onclick = function(){
                let inputText = "";
                inputText = document.getElementById("textInput").value;
                if (inputText == ""){
                    return document.getElementById("editText").innerHTML += " <br> (text input cannot be empty)";
                    
                }
                document.getElementById("editText").innerHTML = inputText;
            }
            //using arrays
            document.getElementById("fingerButton").onclick = function(){
                let fingers = Math.floor(Math.random()*6);
                let guess = document.getElementById("userGuess").value;
                console.log(guess);
                if (guess == ""){
                    return document.getElementById("fingerMessage").innerHTML = "please enter a guess"
                }
                if (guess == fingers){
                    return document.getElementById("fingerMessage").innerHTML = `well done! it was ${fingers} fingers`
                }
                else{
                     return document.getElementById("fingerMessage").innerHTML = `nope! it was ${fingers} fingers`   
                }
                
                
            }
            //guess
            document.getElementById("choose").onclick = function(){
                document.getElementById("isIt").innerHTML = "Is it ";
                let numChoice = document.getElementById("choice").value;
                console.log(numChoice);
                let numGuess = 0
                let guesses = 0
                if(0< numChoice && numChoice<101){
                    while (numGuess != numChoice){
                        console.log(numGuess);
                        numGuess = Math.floor(Math.random()*100+1);
                        document.getElementById("isIt").innerHTML += numGuess + "? ";
                        guesses++
                    }
                    document.getElementById("nice").innerHTML = `Nice it only took me ${guesses} guesses, easy! `
                }
                else{
                    document.getElementById("isIt").innerHTML = "Please enter a valid input";
                }
                
            }
            //reaction
            //generates random time for stop button to appear
            let started = false;
            let startTime;
            let startX;
            let startY;
            let startShape;
            let startColor;
            let startPadding;
            let startRadius;
            let time = 0;
            let t;
            let fastest = null;

            document.getElementById("start").onclick = function(){
                document.getElementById("stop").style.display = "none";
                time = 0;
                document.getElementById("timer").innerHTML = "0.00";
                started = true;
                
                startTime = Math.floor(Math.random()*5000);
                startX = Math.floor(Math.random()*($(window).width()-160));
                startY = Math.floor(Math.random()*300);
                startColor = '#'+(Math.random()*0xFFFFFF<<0).toString(16);
                startPadding = (Math.random()*50).toString();
                startRadius = (50*Math.floor(Math.random()*2)).toString() + '%';
                setTimeout(startTimer, startTime);
                console.log(startTime);

                

            }
            //creates a timer to record reaction time
            
            function timer(){
                if(started){
                    document.getElementById("timer").innerHTML = time/100;
                    time++;
                    t =setTimeout(function(){timer()}, 10);
                }   
            }
            
            //displays timer and stop button after "start is pressed
            
            function startTimer() {
                document.getElementById("stop").style.display = "block";
                document.getElementById("stop").style.left = startX;
                document.getElementById("stop").style.top = startY;   document.getElementById("stop").style.backgroundColor = startColor;
                document.getElementById("stop").style.padding = startPadding;
                document.getElementById("stop").style.borderRadius = startRadius;
                timer();
            }
            
            document.getElementById("stop").onclick = function(){
                let stopTime = document.getElementById("timer").innerHTML;
                started=false;
                if (fastest == null){
                    fastest = stopTime;
                } 
                if (stopTime < fastest){
                    fastest = stopTime;
                }
                console.log(fastest);
                document.getElementById("record").innerHTML = fastest;
            }

            
            
            

        