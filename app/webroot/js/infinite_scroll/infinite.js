$(document).ready(function() {
 	// console.log('test');
  $('.category_product_container').infinitescroll({  
     
      navSelector  : "div.navigation",            
                     // selector for the paged navigation (it will be hidden)
      nextSelector : "div.navigation a:first",    
                     // selector for the NEXT link (to page 2)
      itemSelector : ".category_product_container > li",
                     // selector for all items you'll retrieve
      loading: {
          finishedMsg: "<em>That is all for now folks!</em>",
          msgText: "<em>Loading new ads...</em>",
       }
       // path: function(){
       // 	 // return 'http://localhost/fx_new/categories/index/index_ajax/<?php echo $page+1; ?>';
       // }
    });
});
