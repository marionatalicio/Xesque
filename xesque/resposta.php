<?php 
$valores = $_POST['array'];
$valores = explode(',',$valores);
$amostra = $valores;
for ($i=0; $i < count($valores); $i++) { 
	
	for ($j=0; $j < count($valores); $j++) { 

		 if ($valores[$i] < $valores[$j]){
		 	$var_menor =  $valores[$j];
		 	$var_maior = $valores[$i];
		 	$valores[$i] = $var_menor;
		 	$valores[$j] = $var_maior;
		}
	}
}
 // print_r($valores);

function media($valores){
	$soma = 0;
	for ($i=0; $i < count($valores) ; $i++){
		$soma = $soma + $valores[$i];
	}
	$media = $soma/count($valores);
	return $media;
}

function mediana($valores){
	$qtd = count($valores);
	if ($qtd%2 != 0) {
		$pos = count($valores)/2;
		$pos = floor($pos);
		$mediana = $valores[$pos];
		return $mediana;
		
	}
	else{
		$pos = count($valores)/2;
		$mediana = ( $valores[$pos] + $valores[$pos - 1] ) / 2 ;
		return $mediana;
	}

}
function moda($valores){
	$array = array();
	$count = count($valores);
	for ($i=0; $i < $count ; $i++) { 
		for ($j=0; $j < $count ; $j++) { 
			if ($valores[$i] == $valores[$j] AND $j != $i) {
				$array[] = $valores[$i];
			}
		}
	}
	if ($array == null) {
		$alert =  0;
		return $alert;
	}
	else{
		$array = array_unique($array);
		foreach ($array as $key => $elemento) {
			$novo_array[] = $elemento;
		}
		// var_dump($novo_array);
		// exit();
		$c = count($valores);
		$i = 0;
		$a = array();
		foreach ($novo_array as $key => $elemento) {
			$a[$i] = 0;
			for ($j=0; $j < $c ; $j++) { 
					
				if ($elemento == $valores[$j]) {
					$a[$i]++;
				}
			}
			$i++;
		}
		if (count($a)>1) {
			$o = null;
			foreach ($a as $key => $e) {
				foreach ($a as $ke => $i) {
					if ($e > $i) {
						$o = $key;
					}
					elseif ($e < $i) {
						$o = $ke;
					}
				}
			}
			if ($o == null) {
				$alert = 0;
				return $alert;
			}
			elseif ($o != null) {
				return $novo_array[$o];
			}	
		}
		else{
			return $novo_array['0'];
		}
	}
}


$media = media($valores);
// print_r($media);
// echo "<br>";
$mediana = mediana($valores);
// print_r($mediana);
// echo "<br>";
$moda = moda($valores);
// print_r($moda);
// mediana
// média
// moda
$count = count($amostra) - 1;
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	
          ['Posição', 'Amostra', 'Amostra Crescente', 'Moda', 'Média', 'Mediana'],
          
          <?php for ($i = 0; $i <= $count; $i++)  :?>
          <?php if ($i == $count) :?>
            [<?=$i?>, <?=$amostra[$i]?>, <?=$valores[$i]?>, <?=$moda?>, <?=$media?>, <?=$mediana?>]
          
          <?php else:?>
              [<?=$i?>, <?=$amostra[$i]?>, <?=$valores[$i]?>, <?=$moda?>, <?=$media?>, <?=$mediana?>],
          <?php endif ?>
          

          <?php endfor; ?>
        ]);

        var options = {
          title: 'Moda, Média, Mediana',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>