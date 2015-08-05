<div class="breadcrumbin">
	<div class="container">
		<div class="row">
	    	<div class="col-md-12">
	        	<ul>
	        		Home > Product Details
				<?
				if(isset($pid))
				{
					$getcatdata=$data['getcatdata'] = $this->mdashboard->getcatdata($pid);												
					if($getcatdata['cat']!=0){						
					$getcatdatabyiddata = $this->mdashboard->getcatdatabyid($getcatdata['cat']);
					//print_r($getcatdatabyiddata);
					//print_r($getcatdatabyiddata['name']);die;					
						$string1 = str_replace('&', ' ', $getcatdatabyiddata['name']);
						$string1 = str_replace(' ', '-', $getcatdatabyiddata['name']);
						$string9 = str_replace('   ', '-', $string1);
						$string = str_replace('-&-', '-', $string9);

						$subcat = preg_replace('/&(amp;)?#?[a-z0-9]+;/i ', '', $getcatdata['name']);
						$string2 = str_replace(' ', '-', $subcat);
						$string3 = str_replace('&', '', $string2);
						$string4 = str_replace(',', '', $string3);
						$string5 = str_replace('---', '-', $string4);
						$string6 = str_replace('--', '-', $string5);
						}
					 ?>
				  
	            	<li><a href="<?=base_url();?>">Home</a></li>
					<?if($getcatdata['cat']!=0){	?>
	                <li><a href="<?=base_url();?><?=$index?>category/<?=$getcatdata['cat']?>/<?=$string?>"><?=$getcatdatabyiddata['name'];?></a></li>
					<?}?>
					
					<li><?=$getcatdata['name'];?></li>
					<?}?>
	            </ul>
	        </div>
	    </div>
	</div>
</div>