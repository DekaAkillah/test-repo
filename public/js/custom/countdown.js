// Countdown UIUX
var countDownUIUX = new Date("Jul 12, 2022 15:00:00").getTime();
  
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownUIUX - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
  var textDays = document.getElementById("daysUIUX");
  var textHours = document.getElementById("hoursUIUX");
  var textMinutes = document.getElementById("minutesUIUX");
  var textSeconds = document.getElementById("secondsUIUX");
  
  // Display the result
  textDays.innerHTML = days < 10 ? "0" + days : days;
  textHours.innerHTML = hours < 10 ? "0" + hours : hours;
  textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
  textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  }
}, 1000);

//Countdown BPC
var countDownBPC = new Date("Jul 13, 2022 15:00:00").getTime();
  
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownBPC - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  var textDays = document.getElementById("daysBPC");
  var textHours = document.getElementById("hoursBPC");
  var textMinutes = document.getElementById("minutesBPC");
  var textSeconds = document.getElementById("secondsBPC");
  
  // Display the result
  textDays.innerHTML = days < 10 ? "0" + days : days;
  textHours.innerHTML = hours < 10 ? "0" + hours : hours;
  textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
  textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  }
}, 1000);

// Countdown Poster
var countDownPoster = new Date("Jul 14, 2022 15:00:00").getTime();
  
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownPoster - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  var textDays = document.getElementById("daysPoster");
  var textHours = document.getElementById("hoursPoster");
  var textMinutes = document.getElementById("minutesPoster");
  var textSeconds = document.getElementById("secondsPoster");
  
  // Display the result
  textDays.innerHTML = days < 10 ? "0" + days : days;
  textHours.innerHTML = hours < 10 ? "0" + hours : hours;
  textMinutes.innerHTML = minutes < 10 ? "0" + minutes : minutes;
  textSeconds.innerHTML = seconds < 10 ? "0" + seconds : seconds;

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
  }
}, 1000);