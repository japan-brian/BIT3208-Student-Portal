<!DOCTYPE html>
<html>
<head><title>Week 3 – DOM Demo</title></head>
<body>
    <h2>DOM Manipulation Demo</h2>
    <p id="message">Click the button</p>
    <button onclick="changeMessage()">Click Me</button>
    <hr>
    <h2>PHP Basics</h2>
    <?php
        // Variables and conditionals
        $name = "Brian";
        $year = 3;

        if ($year >= 3) {
            echo "<p>$name is a senior student (Year $year)</p>";
        } else {
            echo "<p>$name is a junior student</p>";
        }

        // Loop demo
        echo "<ul>";
        for ($i = 1; $i <= 4; $i++) {
            echo "<li>Year $i</li>";
        }
        echo "</ul>";
    ?>
    <script>
        function changeMessage() {
            document.getElementById('message').textContent = 'DOM manipulation works!';
            document.getElementById('message').style.color = 'green';
        }
    </script>
</body>
</html>