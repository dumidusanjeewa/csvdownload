<!DOCTYPE html>
<html>
<head>
<style>
.button {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button-brand {background-color: #4CAF50;} /* Green */
.button-day {background-color: #008CBA;} /* Blue */
</style>
</head>
<body>

<h1>Turnover Report</h1>

<form action="/action_page.php" method="get">
  
  <button class="button button-brand" type="submit" formaction="/gapstars/report/brandwise/">Brand Wise</button>
  <button class="button button-day" type="submit" formaction="/gapstars/report/daywise/">Day Wise</button>
</form>

</body>
</html>