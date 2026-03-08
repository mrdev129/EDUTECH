<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OTP Verification</title>

<style>
body {
font-family: Arial, sans-serif;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
margin: 0;
background-color: #121212;
color: #e0e0e0;
}

.container {
background-color: #1e1e1e;
padding: 2rem;
border-radius: 8px;
box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
text-align: center;
}

h1 {
margin-bottom: 1rem;
color: #ffffff;
}

.otp-input {
display: flex;
justify-content: center;
margin-bottom: 1rem;
}

.otp-input input {
width: 40px;
height: 40px;
margin: 0 5px;
text-align: center;
font-size: 1.2rem;
border: 1px solid #444;
border-radius: 4px;
background-color: #2a2a2a;
color: #ffffff;
}

.otp-input input::-webkit-outer-spin-button,
.otp-input input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}

.otp-input input[type=number] {
-moz-appearance: textfield;
}

button {
background-color: #4CAF50;
color: white;
border: none;
padding: 10px 20px;
font-size: 1rem;
border-radius: 4px;
cursor: pointer;
margin: 5px;
}

button:hover {
background-color: #45a049;
}

button:disabled {
background-color: #cccccc;
color: #666666;
cursor: not-allowed;
}

#timer {
font-size: 1.2rem;
margin-bottom: 1rem;
color: #ff9800;
}
</style>

</head>

<body>

<div class="container">

<h1>OTP Verification</h1>
<p>Enter the 6-digit code sent to your device</p>

<div id="timer">Time remaining: 1:00</div>

<form action="verify_otp.php" method="POST">

<div class="otp-input">
<input type="number" min="0" max="9" required>
<input type="number" min="0" max="9" required>
<input type="number" min="0" max="9" required>
<input type="number" min="0" max="9" required>
<input type="number" min="0" max="9" required>
<input type="number" min="0" max="9" required>
</div>

<input type="hidden" name="otp" id="otp">

<button type="submit">Verify</button>

<button type="button" id="resendButton" onclick="resendOTP()" disabled>
Resend Code
</button>
<p id="otpMessage" style="color:red;margin-top:10px;"></p>
</form>

</div>

<script>

const inputs = document.querySelectorAll('.otp-input input');
const timerDisplay = document.getElementById('timer');
const resendButton = document.getElementById('resendButton');
const otpField = document.getElementById('otp');

let timerId;

// load saved expiry time
let expiryTime = localStorage.getItem("otp_expiry");

if(!expiryTime){
expiryTime = Date.now() + 60000; // 1 minute
localStorage.setItem("otp_expiry", expiryTime);
}

function startTimer(){

timerId = setInterval(()=>{

let timeLeft = Math.floor((expiryTime - Date.now()) / 1000);

if(timeLeft <= 0){

clearInterval(timerId);

timerDisplay.textContent = "Code expired";

resendButton.disabled = false;

inputs.forEach(input=>input.disabled=true);

localStorage.removeItem("otp_expiry");

}else{

const minutes = Math.floor(timeLeft/60);
const seconds = timeLeft%60;

timerDisplay.textContent =
`Time remaining: ${minutes}:${seconds.toString().padStart(2,'0')}`;

}

},1000);

}

function resendOTP(){

fetch("resend_otp.php")

.then(response=>response.text())

.then(data=>{

alert(data);

// reset timer
expiryTime = Date.now() + 60000;

localStorage.setItem("otp_expiry", expiryTime);

inputs.forEach(input=>{
input.value='';
input.disabled=false;
});

resendButton.disabled=true;

clearInterval(timerId);

startTimer();

})

.catch(error=>{
console.log(error);
alert("Error sending OTP");
});

}

inputs.forEach((input,index)=>{

input.addEventListener('input',(e)=>{

if(e.target.value.length>1){
e.target.value=e.target.value.slice(0,1);
}

if(e.target.value.length===1){
if(index<inputs.length-1){
inputs[index+1].focus();
}
}

});

input.addEventListener('keydown',(e)=>{

if(e.key==='Backspace' && !e.target.value){
if(index>0){
inputs[index-1].focus();
}
}

if(e.key==='e'){
e.preventDefault();
}

});

});

document.querySelector("form").addEventListener("submit", function(e){

e.preventDefault(); // stop page refresh

const otp = Array.from(inputs).map(input => input.value).join('');

if(otp.length !== 6){
document.getElementById("otpMessage").textContent = "Please enter a 6 digit OTP";
return;
}

fetch("verify_otp.php", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: "otp=" + otp
})

.then(response => response.text())

.then(data => {

if(data === "success"){

localStorage.removeItem("otp_expiry");

window.location = "dashboard.php";

}else{

document.getElementById("otpMessage").textContent = "Invalid OTP";

}

})

.catch(error => {

document.getElementById("otpMessage").textContent = "Server error";

});

});

startTimer();

</script>

</body>
</html>