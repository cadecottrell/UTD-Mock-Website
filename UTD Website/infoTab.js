
//variable to see if double size has already been switched
var switched = false;
var colorSwitched = false;

//Timer
var timer = 0;
var timerMinutes = 0;
var timeShown = "";
//Function to start the clock and refresh every half a second
function startDate(){
  getDateTime();
  setInterval(getDateTime, 500);
}

//Function to calculate time and post on webpage
function getDateTime(){
  var months = ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'Jun.', 'Jul.', 'Aug.', 'Sept.', 'Oct.', 'Nov.','Dec.'];
  var amOrPM = 'AM';
  var time = '';

  //Figure out the date, Month, Day, Year...
  var date = new Date(),
  current = [date.getDate(), months[date.getMonth()], date.getFullYear()].join(' ');

  //Hours and Minutes
  var hour = date.getHours(),
  minutes = ("0" + date.getMinutes()).slice(-2);


  //Determine if it is the afternoon or morning (AM OR PM)
  if(hour > 12){
    hour = hour - 12;
    amOrPM = 'PM';
  }
  else {
    amOrPM = 'AM';
  }

  //Put it all together
  time = hour + ':' + minutes + ' ' + amOrPM;

  //Display
  document.getElementById("Date/Time").innerHTML = current + " " + time;
}


//Doubles p, h1, h2, h6 tags text, and also reverts it
function doubleTextSize(){
  var x = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6');
  var text = "";
  var style1 = "";
  var size = "";

  var i;

  //If they are not doubled in size make them double in size.
  if(!switched)
  {
    for(i = 0; i < x.length; i++)
    {
      text = x[i];
      style1 = window.getComputedStyle(text, null).getPropertyValue('font-size');
      size = parseFloat(style1);
      text.style.fontSize = (size + size) + 'px';
    }

    switched = true;
  }
  //If they are doubled in sized go back to original size.
  else {
    for(i = 0; i < x.length; i++)
    {
      text = x[i];
      style1 = window.getComputedStyle(text, null).getPropertyValue('font-size');
      size = parseFloat(style1);
      text.style.fontSize = (size/2) + 'px';
    }

    switched = false;
  }

}

//Background color change function
function changeTabBackground(){
  var x = document.querySelectorAll('.tab');
  var i;

  //If we have not switched the color change it to the alternative
  if(!colorSwitched){

    for(i = 0; i < x.length; i++){
      x[i].style.backgroundColor = 'rgba(255,179,179,0.6)';
    }
    colorSwitched = true;
  }
  //If it has been switched, change it back to the original
  else {

    for(i = 0; i < x.length; i++){
      x[i].style.backgroundColor = 'rgba(255, 255, 255, 0.6)';
      colorSwitched = false;
    }

  }
}

//Validate the contactUs form.
function validate(){
  var fname = document.forms["contactUs"]["fname"].value;
  var lname = document.forms["contactUs"]["lname"].value;
  var phoneNumber = document.forms["contactUs"]["phone"].value;
  var email = document.forms["contactUs"]["email"]
  var comment = document.forms["contactUs"]["comment"].value;
  var gender;
  var findGender = document.getElementsByName("gender");

  if(fname == lname)
  {
    alert("First name and last name can NOT be the same.");
    return false;
  }

  if(comment.length < 10)
  {
    alert("Comment must be ATLEAST 10 characters long.");
    return false;
  }

  for(var i = 0; i < findGender.length; i++){
    if(findGender[i].checked){
      gender = findGender[i].value;
    }
  }

  var contactObject = new Object();
  contactObject.fname = fname;
  contactObject.lname = lname;
  contactObject.phone = phoneNumber;
  contactObject.email = email;
  contactObject.gender = gender;
  contactObject.comment = comment;

  var contactString = JSON.stringify(contactObject);

  alert("Your message has been sent" + contactString);
  return true;

}

//Function used for showing faculty education, awards, etc.
//The elements will always be underneath each heading so we will grab it using nextElementSibling.
function showInfo(element){
  var list = element.nextElementSibling;

  if(list.style.display == "none"){
    list.style.display = "block";
  }
  else {
    list.style.display = "none";
  }

}

//Starter function to start the Enrollment Survey.
function startSurvey(element){
  //Starts timer
  setInterval(startTimer, 1000);
  //Hides the button you clicked to start the survey
  hideStart(element);
  //Starts the survey, showing the first question
  startQuiz();
}

//Timer counter
function startTimer(){
  timer++;

  //adds a zero if number is less than 10
  if(timer < 10){
    timer = "0" + timer;
  }

  //adds a minute after 60 seconds gone by
  if(timer >= 60){
    timerMinutes++;
    timer = 0;
    timer = "0" + timer;
  }

  //shows time
  timeShown = timerMinutes + ":" + timer;
  document.getElementById("timer").innerHTML = timeShown;
}

//hides survey start button
function hideStart(element)
{
  element.style.display = "none";
}

//displays the survey
function startQuiz(){
  var quiz = document.getElementById("surveyHolder")

  quiz.style.display = "block";
}

//goes to next question
function nextQuestion(element){
  var parentDivQues = element.parentElement;
  var nextQuestionDiv = parentDivQues.nextElementSibling;

  parentDivQues.style.display = "none";
  nextQuestionDiv.style.display = "block";

}

//goes back to the question before
function lastQuestion(element){
  var parentDivQues = element.parentElement;
  var lastQuestionDiv = parentDivQues.previousElementSibling;

  parentDivQues.style.display = "none";
  lastQuestionDiv.style.display = "block";

}

function displayTime(){
  alert("You took " + timeShown + " to complete the survey.\nSummary:\nQuestion 1: "+ "holder" +"\nQuestion 2: ");
}

function getTimer(){
  return timeShown;
}
