<!DOCTYPE HTML>
<?php
session_set_cookie_params(3600*24);
session_start();

if (is_null($_SESSION['i'])) {
    $_SESSION['i'] = 0;
    $_SESSION['arr'] = array();
    echo "<script>console.log(\"У пользователя отсутсвуют куки\")</script>";
} else {
    echo "<script>console.log(\"У пользователя есть куки\")</script>";
}

?>
<html lang="ru">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Lab1-Web</title>
		<link rel="stylesheet" type="text/css" href="css/main.css">
        <script type="text/javascript">
            function markPoint(x, y, r) {
                createGraphic('canvas', r);
                context = canvas.getContext("2d");


                context.beginPath();
                context.rect(Math.round(150 + ((x / r) * 130))-3, Math.round(150 - ((y / r) * 130))-3, 6, 6);
                context.closePath();
                context.strokeStyle = 'black';

                color = 'red';
                if ( ((x >= (-r)) && (y >= (-r)) && (y <= 0) && (x <= 0)) || ((y >= (x/2 - r/2)) && (y <= 0) && (x >= 0) && (x <= r)) || (((Math.pow(x,2) + Math.pow(y,2)) <= (Math.pow(r/2, 2))) && (y >= 0) && (x <= 0))) {
                    color = 'lime';
                }
                context.fillStyle = color;
                context.fill();
                context.stroke();
            }
            function init() {
                createGraphic('canvas', r_out.value);
                document.getElementsByTagName('form')[0].submit();
                load.value = "noo";
            }
            function createGraphic(id, r){
                var canvas = document.getElementById(id),
                    context = canvas.getContext("2d");
                //очистка
                context.clearRect(0, 0, canvas.width, canvas.height);

                //прямоугольник
                context.beginPath();
                context.rect(20, 150, 130, 130);
                context.closePath();
                context.strokeStyle = "#2f9aff";
                context.fillStyle = "#2f9aff";
                context.fill();
                context.stroke();

                // сектор
                context.beginPath();
                context.moveTo(150, 150);
                context.arc(150, 150, 65, Math.PI, 3*Math.PI/2, false);
                context.closePath();
                context.strokeStyle = "#2f9aff";
                context.fillStyle = "#2f9aff";
                context.fill();
                context.stroke();

                //треугольник
                context.beginPath();
                context.moveTo(150, 150);
                context.lineTo(150, 215);
                context.lineTo(280, 150);
                context.lineTo(150, 150);
                context.closePath();
                context.strokeStyle = "#2f9aff";
                context.fillStyle = "#2f9aff";
                context.fill();
                context.stroke();

                //отрисовка осей
                context.beginPath();
                context.font = "10px Verdana";
                context.strokeStyle = "black";
                context.fillStyle = "black";
                context.moveTo(150, 0); context.lineTo(150, 300);
                context.moveTo(150, 0); context.lineTo(145, 15);
                context.moveTo(150, 0); context.lineTo(155, 15);
                context.fillText("Y", 160, 10);
                context.moveTo(0, 150); context.lineTo(300, 150);
                context.moveTo(300, 150); context.lineTo(285, 145);
                context.moveTo(300, 150); context.lineTo(285, 155);
                context.fillText("X", 290, 130);

                // деления Y
                context.moveTo(145, 20); context.lineTo(155, 20); context.fillText(r, 160, 20);
                context.moveTo(145, 85); context.lineTo(155, 85); context.fillText((r / 2), 160, 78);
                context.moveTo(145, 215); context.lineTo(155, 215); context.fillText(-(r / 2), 160, 215);
                context.moveTo(145, 280); context.lineTo(155, 280); context.fillText(-r, 160, 280);
                // деления X
                context.moveTo(20, 145); context.lineTo(20, 155); context.fillText(-r, 15, 140);
                context.moveTo(85, 145); context.lineTo(85, 155); context.fillText(-(r / 2), 70, 140);
                context.moveTo(215, 145); context.lineTo(215, 155); context.fillText((r / 2), 215, 140);
                context.moveTo(280, 145); context.lineTo(280, 155); context.fillText(r, 280, 140);

                context.closePath();
                context.strokeStyle = "black";
                context.fillStyle = "black";
                context.stroke();

            }
        </script>
	</head>
<body onload="init()">
		<header>
			<h1>Проверка попадания точки в график</h1>
			Савин Георгий Евгеньевич P3202 
			<br>Вариант - 202018
		</header>
		<div class="container">
		
		
		<div class="form">


				<p>X координата: <output name="x_output" id="x_out" class="output">0</output></p>
				<table>
					<tr>
						<td><input type="button" name="x11" id="x_11" value=" 4" onclick="setX(x_11.value)"></td>
						<td><input type="button" name="x12" id="x_12" value=" 3" onclick="setX(x_12.value)"></td>
						<td><input type="button" name="x13" id="x_13" value="-1" onclick="setX(x_13.value)"></td>
					</tr>
					<tr>
						<td><input type="button" name="x21" id="x_21" value=" 2" onclick="setX(x_21.value)"></td>
						<td><input type="button" name="x22" id="x_22" value=" 0" onclick="setX(x_22.value)"></td>
						<td><input type="button" name="x23" id="x_23" value="-2" onclick="setX(x_23.value)"></td>
					</tr>
					<tr>
						<td><input type="button" name="x31" id="x_31" value=" 1" onclick="setX(x_31.value)"></td>
						<td><input type="button" name="x32" id="x_32" value="-3" onclick="setX(x_32.value)"></td>
						<td><input type="button" name="x33" id="x_33" value="-4" onclick="setX(x_33.value)"></td>
					</tr>
				</table>

				<p>Y координата: <output name="y_output" id="y_out" class="output">0</output></p>
				<span class="tooltip"><input type="text" name="y_input" id="y_in" value="0" onblur="return verifyY(this);" oninput="return verifyY(this);">
                    <span>Y координата должна быть числом в диапазоне [-3 ... 5]</span>
                </span>

				<p>И наконец, R:  <output name="r_output" id="r_out" class="output">1</output></p>
				<p>
                    <input type="radio" name="radius" class="rb" id="r_1" value="1" my-title="1" onclick="setRadius(r_1.value)" checked>
                    <input type="radio" name="radius" class="rb" id="r_1_5" value="1.5" my-title="1.5" onclick="setRadius(r_1_5.value)">
                    <input type="radio" name="radius" class="rb" id="r_2" value="2" my-title="2" onclick="setRadius(r_2.value)">
                    <input type="radio" name="radius" class="rb" id="r_2_5" value="2.5" my-title="2.5" onclick="setRadius(r_2_5.value)">
                    <input type="radio" name="radius" class="rb" id="r_3" value="3" my-title="3" onclick="setRadius(r_3.value)">
                </p>

            <form method="GET" action="handler.php" target="result">
				<input type="hidden" name="x_h" id="x_h_id" value="0">
				<input type="hidden" name="r_h" id="r_h_id" value="1">
				<input type="hidden" name="y_h" id="y_h_id" value="0">
                <input type="hidden" name="load" id="load" value="yes">

				<p><input type="submit" value="Проверить" onclick="markPoint(x_out.value, y_out.value, r_out.value)"></p>
			</form>

		</div>
		
		<div class="graphic">
			<canvas id="canvas" style="background-color:#ffffff; border-radius: 15px;"
			width="300" height="300"></canvas>
		</div>
		
		
		
		</div>
		
		
		<div >
			<iframe class="result" name="result" >
            </iframe>
		</div>
		

	<script type="text/javascript">
        var prev_y = 0;

        function setRadius(r) {
            r_h_id.value = r;
            r_out.value = r;
            createGraphic('canvas', r);
        }

        function setX(x) {
            x_h_id.value = x;
            x_out.value = x;
        }

        function verifyY(y) {
            var y1 = parseFloat(y.value.replace(/,/, '.'));
            var elem = document.getElementById("y_in");
            if (y.value != '' && y.value != '-') {
                if (!isNumber(y.value.replace(/,/, '.')) || y1 < -3 || y1 > 5) {
                    //alert('Y координата должна быть числом в диапазоне -3 ... 5');
                    y.focus();
                    elem.style.backgroundColor = "red";
                    y.value = prev_y;
                    return false;
                }
                prev_y = y1;
                y_h_id.value = y1;
                y_out.value = y1;
                elem.style.backgroundColor = "#E0FFFF";
                return true;
            }
            elem.style.backgroundColor = "#E0FFFF";
            prev_y = y.value;
            return true;
        }

        function isNumber(n) {
            return !isNaN(parseFloat(n)) && !isNaN(n - 0)
        }
	</script>
</body>
</html>