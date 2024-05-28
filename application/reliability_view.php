<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reliability Test</title>
</head>
<body>
    <h1>Calculate Cronbach's Alpha</h1>
    <form action="<?php echo site_url('ReliabilityController/calculate_cronbach_alpha'); ?>" method="post">
        <label for="scores">Enter Scores (comma separated for each respondent):</label><br>
        <textarea name="scores" id="scores" rows="10" cols="30"></textarea><br><br>
        <input type="submit" value="Calculate">
    </form>
</body>
</html>
