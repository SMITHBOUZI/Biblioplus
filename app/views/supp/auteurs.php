<div class="row" id="auteurs_container">
	<input type="button" name="xox" id="try" value="Button ajax">

<div class="row small-up-2 medium-up-3 large-up-4">
  
  <div class="column column-block">
    <img src="https://placehold.it/300x300" class="thumbnail" alt="">
  </div>
  <div class="column column-block">
    <img src="https://placehold.it/600x600" class="thumbnail" alt="">
  </div>
  <div class="column column-block">
    <img src="https://placehold.it/600x600" class="thumbnail" alt="">
  </div>
  <div class="column column-block">
    <img src="https://placehold.it/600x600" class="thumbnail" alt="">
  </div>
  <div class="column column-block">
    <img src="https://placehold.it/600x600" class="thumbnail" alt="">
  </div>
</div>
</div>
<script type="text/javascript">
$("#try").click(function(){

$.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('product/product_data')?>',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+data[i].product_code+'</td>'+
                                '<td>'+data[i].product_name+'</td>'+
                                '<td>'+data[i].product_price+'</td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-product_code="'+data[i].product_code+'" data-product_name="'+data[i].product_name+'" data-price="'+data[i].product_price+'">Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-product_code="'+data[i].product_code+'">Delete</a>'+
                                '</td>'+
                                '</tr>';
                    }
                  
                }
 
            });
        });


</script>





	
</div>










</div>