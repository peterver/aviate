<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/masonry.js"></script>
<script src="/assets/js/dime.js"></script>

<?php if(Config::get('gosquared')): ?>
	<?php echo 'analytics'; ?>
<?php endif; ?>

<script>
	
	fail = function() {
	    var wall = new Masonry(document.getElementsByClassName('products')[0]);
	    var bricks = document.getElementsByClassName('masonry-brick');
	    
	    var handle = function(wat, target, height) {
	    	var setHeight = function(expand) {
	    		var num = expand === true ? height : 0;
	    		target.style.height = num + 'px';
	    	}
	    	
	    	setHeight();
	    	
	    	wat.onmouseover = function() {
	    		setHeight(true);
	    	};
	    	wat.onmouseout = setHeight;
	    };
	    
	    for(var i = 0; i < bricks.length; i++) {
	    	var brick = bricks[i];
	    	var me = brick.childNodes[1].childNodes[3];
	    	me.setAttribute('data-height', me.clientHeight + 27);
	    	
	    	handle(brick, me, me.getAttribute('data-height'));
	    }
	    
	    var stopFlag = false;
	    window.onscroll = function() {
	    	var scrolled = document.body.scrollTop;
	    	
	    	if(scrolled > wall.element.offsetHeight - 100 && !stopFlag) {
	    		stopFlag = true;
	    		//document.write('<div class="loader"><span></span></div>');
	    	}
	    };
	};
</script>