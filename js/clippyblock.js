if (typeof clippyblock === 'undefined') {
	var clippyblock = {
		agent: null,
		foo: "bar",
		
		_loadcb: function(agent) {
			this.agent = agent;
			this.agent.show();
		},
		
		switchagent: function(agentname) {
			if (this.agent == null) {
				clippy.load(agentname, jQuery.proxy(clippyblock, '_loadcb'));
			}
			else {
				this.agent.hide(false, function() {
					clippy.load(agentname, jQuery.proxy(clippyblock, '_loadcb'));
				});
			}
		},
		
		speak: function(speakme) {
			if (clippyblock.agent) {
				clippyblock.agent.speak(speakme);
			}
		},
		
		gestureAt: function(x, y) {
		    if (clippyblock.agent) {
		        clippyblock.agent.gestureAt(x, y);
		    }
		},
		
		moveTo: function(x, y) {
		    if (clippyblock.agent) {
		        clippyblock.agent.moveTo(x, y);
		    }
		},
		
		stopCurrent: function() {
		    if (clippyblock.agent) {
		        clippyblock.agent.stopCurrent();
		    }
		},
		
		stop: function() {
		    if (clippyblock.agent) {
		        clippyblock.agent.stop();
		    }
		},
		
		play: function(animation) {
		    if (clippyblock.agent) {
		        clippyblock.agent.Play(animation);
		    }
		},
		
		animate: function() {
		    if (clippyblock.agent) {
		        clippyblock.agent.animate();
		    }
		},
		
		animations: function() {
		    if (clippyblock.agent) {
		        return clippyblock.agent.animations();
		    }
		    else {
		        return false;
		    }
		}
	};
}
