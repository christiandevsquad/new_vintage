<div class="form-group">
	<input type="text" class="form-control" name="tags" data-role="tagsinput" value="
		<?php 
			$list = "";

			foreach($product->tags as $tag) { 
				$list .= ",".$tag->product_tag;
			} 

			print($list);
		?>">
</div>