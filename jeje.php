
<!DOCTYPE html><html lang='en' class=''>


<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
<style class="cp-pen-styles">@import url('https://fonts.googleapis.com/css?family=Lato:400,700');

.calendar-today {
  background-color: #E87571;
  color: #ffffff;
  font-family: 'Lato', sans serif;
  margin: 100px auto;
  padding: 10px 20px 50px;
  text-align: center;
  width: 320px;
}

.month-label { 
  font-size: 55px;
  border-bottom: 2px solid #ffffff;
}

.day-label {
  font-size: 120px;
  line-height: 120px;
  font-weight: 700;
  padding-top: 30px;
}</style></head><body>

<div class="calendar-today">
  <div class="month-label"></div>
  <div class="day-label"></div>
  <div class="weekday-label"></div>
</div>

<script >var date = new Date();
var day = date.getDate();
var month = date.getMonth()+1;
var year = date.getFullYear();
var monthNames = ["Januari", "Februari", "Maret", "April", "Mai", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"];
var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];

var monthLabel = document.getElementsByClassName("month-label")[0].innerHTML = monthNames[date.getMonth()];

var dayLabel = document.getElementsByClassName("day-label")[0].innerHTML = day;

var weekdayLabel = document.getElementsByClassName("weekday-label")[0].innerHTML = dayNames[date.getDay(0)];
//# sourceURL=pen.js
</script>
</body></html>