<?php

/**
 * graph creater
 */
class Graph
{
	
	public $canvasX 	= 1000;
	public $canvasY 	= 400;
	public $font_size 	= 16;
	public $title 	= "Graph Title";
	public $xtitle 	= "Title X";
	public $styles 	= "";




	public function display($data)
	{
		

		$canvasX = $this->canvasX;
		$canvasY = $this->canvasY;

		if(!is_array($data) || empty($data))
		{
			echo "Data variable must be an array and contain data!";
			return;
		}

		$xText = array_keys($data);

		$maxY = max($data);
		$maxX = count($data);

		$multiplierY = $canvasY/$maxY;
		$multiplierX = $canvasX/$maxX;

		$num = 1;
		$points = "0,$canvasY ";

		foreach ($data as $key => $value)
		{
			$points .= $multiplierX*$num .",".$canvasY - ($value*$multiplierY)." ";
			$num++;
		}

		$points .= " $canvasX,$canvasY";

		$extraX = 100;
		$extraY = 50;
	?>


	<svg viewBox = "0 -<?=$extraY?> <?=$canvasX + $extraX ?> <?=$canvasY + ( $extraY * 2.5 )?>"  class="shadow border" style="width: 100%;<?=$this->styles?>;">
	

		<!--top to bottom lines -->
		<?php

			for ($i=0; $i < $maxX; $i++) 
			{ 
					$x1 = $i * $multiplierX;
					$y1 = 0;

					$x2 = $x1;
					$y2 = $canvasY;
		?>
					<polyline points="<?=$x1?>,<?=$y1?> <?=$x2?>,<?=$y2?>" style="stroke-width: 1;stroke: #eee;"/>
		<?php

			}

		?>

		<!--left to right lines -->
		<?php

			$max_line 	= count($data);
			$Ysegment		= round($canvasY / $max_line);

			for ($i=0; $i < $max_line; $i++) 
			{ 
					$x1 = 0;
					$y1 = $i * $Ysegment;

					$x2 = $canvasX;
					$y2 = $y1;

		?>
		<polyline points="<?=$x1?>,<?=$y1?> <?=$x2?>,<?=$y2?>" style="stroke-width: 1;stroke: #eee;"/>
		<?php

			}

		?>


		<polyline points="<?=$points?>" style="stroke-width: 4;stroke: white;fill: #cccccc66;"/>

		<?php

			$num = 1;
			$points = "0,$canvasY ";

			foreach ($data as $key => $value)
			{?>

				<circle r="6" cx="<?=$multiplierX*$num?>" cy="<?=$canvasY - ($value*$multiplierY)?>" style="stroke: white; fill: grey; stroke-width: 2;" />
				
				<?php if ($value != 0): ?>

				<text r="8" x="<?=$multiplierX*$num?>" y="<?=$canvasY - ($value*$multiplierY) + 22?>" style="font-size: 16px;fill: blue;"><?=$value?></text>
				
				<?php endif; ?>
			<?php

				$num++;
			}

		?>

		<!--X text values -->
		<?php $num = 0?>		
		<?php foreach ($xText as $value) : $num++?>
				<a href="">
					<text x="<?=($num * $multiplierX) - ($multiplierX/5)?>" y="<?=$canvasY + ($extraY/1.5)?>" style="fill:black; font-size: <?=$this->font_size?>;"><?=$value?></text>
				</a>		
		<?php endforeach;?>



		<!--Y text values -->
		<?php

			$max_line 	= count($data);
			$Ysegment		= round($canvasY / $max_line);
			$num = $maxY;
			for ($i=0; $i < $max_line; $i++) 
			{ 

				$x = $canvasX;
				$y = $i * $Ysegment;

				if(round($num) < 0)
				{
					break;
				}
		?>
				<text x="<?=$x + ($multiplierX/7)?>" y="<?=$y?>" style="fill:black; font-size: <?=$this->font_size?>;"><?=round($num)?></text>
				<?php

				$max_line = $max_line ? $max_line : 1;
				$num -= $maxY / $max_line;
			}
		?>
		<!--Graph Title-->
		<text x="10" y="-<?=$extraY/2.5?>" style="font-size: 24px;">
			<tspan><?=$this->title?></tspan>
		</text>	

		<!--Graph X-Title-->
		<?php
			$textoffset = (strlen($this->xtitle) / 2) * 3;//calculation for the pixel
		?>

		<text x="<?=($canvasX/2) - $textoffset?>" y="<?=($canvasY + $extraY + 10)?>" style="font-size: 16px;">
			<tspan><?=$this->xtitle?></tspan>
		</text>
			</svg>
		<?php
	}

}