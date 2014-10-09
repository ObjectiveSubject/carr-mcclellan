(function($){
	
	window.CMC = {
		location: window.location.origin,	  
	}; // CMC 
	
	CMC.ajaxUrl = CMC.location + "/wp-content/themes/cmc/ajax/";
	
  CMC.load_posts = function(options){
  	var defaults = {
  		type: 'post',
	  	number: 1, 
	  	page: 1
  	};
  	if (typeof options !== "object") {
	  	options = defaults;
  	} else {
	  	options = $.extend(defaults, options);	  	
  	}
  	  	  	  	
		$.ajax({
	    type      : "GET",
	    data      : { numPosts : options.number, pageNumber: options.page, postType: options.type },
	    dataType  : "html",
	    url       : CMC.ajaxUrl + 'loophandler.php',
	    beforeSend: function(){
	    	console.log('loading...');
	    },
	    success 	: function(data){
	    	console.log("success!");
	    	console.log(data);
	    },
	    error 		: function(jqXHR, textStatus, errorThrown) {
	      console.log(jqXHR);
	      throw textStatus + " :: " + errorThrown;
	    }
		});
  };
	
})(jQuery);