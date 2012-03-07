function fix_flash() {
    // loop through every embed tag on the site
    var embeds = document.getElementsByTagName('embed');
    for (i = 0; i < embeds.length; i++) {
        embed = embeds[i];
        var new_embed;
        // everything but Firefox & Konqueror
        if (embed.outerHTML) {
            var html = embed.outerHTML;
            // replace an existing wmode parameter
            if (html.match(/wmode\s*=\s*('|")[a-zA-Z]+('|")/i))
                new_embed = html.replace(/wmode\s*=\s*('|")window('|")/i, "wmode='transparent'");
            // add a new wmode parameter
            else
                new_embed = html.replace(/<embed\s/i, "<embed wmode='transparent' ");
            // replace the old embed object with the fixed version
            embed.insertAdjacentHTML('beforeBegin', new_embed);
            embed.parentNode.removeChild(embed);
        } else {
            // cloneNode is buggy in some versions of Safari & Opera, but works fine in FF
            new_embed = embed.cloneNode(true);
            if (!new_embed.getAttribute('wmode') || new_embed.getAttribute('wmode').toLowerCase() == 'window')
                new_embed.setAttribute('wmode', 'transparent');
            embed.parentNode.replaceChild(new_embed, embed);
        }
    }
    // loop through every object tag on the site
    var objects = document.getElementsByTagName('object');
    for (i = 0; i < objects.length; i++) {
        object = objects[i];
        var new_object;
        // object is an IE specific tag so we can use outerHTML here
        if (object.outerHTML) {
            var html = object.outerHTML;
            // replace an existing wmode parameter
            if (html.match(/<param\s+name\s*=\s*('|")wmode('|")\s+value\s*=\s*('|")[a-zA-Z]+('|")\s*\/?\>/i))
                new_object = html.replace(/<param\s+name\s*=\s*('|")wmode('|")\s+value\s*=\s*('|")window('|")\s*\/?\>/i, "<param name='wmode' value='transparent' />");
            // add a new wmode parameter
            else
                new_object = html.replace(/<\/object\>/i, "<param name='wmode' value='transparent' />\n</object>");
            // loop through each of the param tags
            var children = object.childNodes;
            for (j = 0; j < children.length; j++) {
                try {
                    if (children[j] != null) {
                        var theName = children[j].getAttribute('name');
                        if (theName != null && theName.match(/flashvars/i)) {
                            new_object = new_object.replace(/<param\s+name\s*=\s*('|")flashvars('|")\s+value\s*=\s*('|")[^'"]*('|")\s*\/?\>/i, "<param name='flashvars' value='" + children[j].getAttribute('value') + "' />");
                        }
                    }
                }
                catch (err) {
                }
            }
            // replace the old embed object with the fixed versiony
            object.insertAdjacentHTML('beforeBegin', new_object);
            object.parentNode.removeChild(object);
        }
    }
}


jQuery(document).ready(function($) {
	
	fix_flash();

	$('.flexslider').flexslider({
		controlsContainer: '#content',
		slideshow: false,
		prevText: 'Previous',
		nextText: 'Next',
		keyboardNav: true,
		start: function(slider) {
        $('.total-slides').text(slider.count);
      },
      after: function(slider) {
        $('.current-slide').text(slider.currentSlide);
      }
	});
/*	$('ul.menu li:first').addClass('first');
	
	$shrdluprv = $('.prev_slide');
	if (1 == $shrdluprv.length) {
		$('.prev_slide').next('li').addClass('homelink');		
	}

	$shrdlunxt = $('.next_slide');
	if (1 == $shrdlunxt.length) {
		$('.next_slide').prev('li').addClass('endlink');		
	}


	$(document).keydown(function(evt) {
		if ($('body').hasClass('single')) {
			return;
		} else {

			evt = evt || window.event;
			switch (evt.keyCode) {
				case 33: // page up
				case 37: // leftkey
				case 38: // upkey
					$shrdluprev = $('.prev_slide a');					if (1 == $shrdluprev.length) {
						window.location = $shrdluprev.attr('href');
					}
	
				break;
				case 32: // spacebar
				case 34: // page down
				case 39: // rightkey
				case 40: // downkey
					$shrdlunext = $('.next_slide a');
					if (1 == $shrdlunext.length) {
						window.location = $shrdlunext.attr('href');
					}
				break;
				case 36: // home
					$shrdluhm = $('.homelink a');
					if (1 == $shrdluhm.length) {
						window.location = $shrdluhm.attr('href');
					}
				break;
				case 35: // end
					$shrdlend = $('.endlink a');
					if (1 == $shrdlend.length) {
						window.location = $shrdlend.attr('href');
					}
				break;
			}
		}
	});
*/


});


