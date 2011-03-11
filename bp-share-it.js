jq(document).ready(function(){
		jq('.bp-share-it-button').live('click', function(){
			jq(this).toggleClass('active').next().slideToggle('fast');		
	});
		jq('.bp-share-it-button-forum').live('click', function(){
			jq(this).toggleClass('active').next().slideToggle('fast');			
	});
		jq('.bp-share-it-button-group.generic-button').live('click', function(){
			jq(this).toggleClass('active').next().slideToggle('fast');		
	});
	
    	jq('a.new-window').live('click', function(){
        	window.open(this.href,'newWindow','width=700,height=350');
        	return false;
    });
    	jq('a.new-window-digg').live('click', function(){
        	window.open(this.href,'newWindow','width=720,height=550');
        	return false;
    });
	
});
