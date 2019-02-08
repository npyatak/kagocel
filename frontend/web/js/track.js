
var audioCtx = null;
var leftTrack = null;
var rightTrack = null;
var masterGain = null;
var waveColor = '#f7323f';
var progressColor = '#bfbfbf';
var FADE=0.01;

//init: create plugin
$(document).ready(function() {
	audioCtx = new AudioContext();
	masterGain = audioCtx.createGain();
	masterGain.connect(audioCtx.destination);

	leftTrack = new Track($('.playlist .sound:eq(0)').data('url'), true);
	rightTrack = new Track($('.playlist .sound:eq(0)').data('url'), false);
});

function Track(url, isLeft) {
	this.currentPlaybackRate = 1.0;
  	this.lastBufferTime = 0.0;
	this.isPlaying = false;
  	this.class = isLeft ? 'leftTrack' : 'rightTrack';

	this.gain = 1.0;
	//this.gainSlider = gainSlider;
	//this.pbrSlider = pbrSlider;
  	this.lastBufferTime = 0.0;
	this.isPlaying = false;
	this.loadNewTrack(url);
	this.xfadeGain = audioCtx.createGain();
	this.xfadeGain.gain.value = 0.5;
	this.xfadeGain.connect(masterGain);

	this.low = audioCtx.createBiquadFilter();
	this.low.type = "lowshelf";
	this.low.frequency.value = 320.0;
	this.low.gain.value = 0.0;
	this.low.connect( this.xfadeGain );

	this.mid = audioCtx.createBiquadFilter();
	this.mid.type = "peaking";
	this.mid.frequency.value = 1000.0;
	this.mid.Q.value = 0.5;
	this.mid.gain.value = 0.0;
	this.mid.connect( this.low );

	this.high = audioCtx.createBiquadFilter();
	this.high.type = "highshelf";
	this.high.frequency.value = 3200.0;
	this.high.gain.value = 0.0;
	this.high.connect( this.mid );

	this.filter = audioCtx.createBiquadFilter();
	this.filter.frequency.value = 20000.0;
	this.filter.type = this.filter.LOWPASS;
	this.filter.connect( this.high );


	var bufferdrawer = $('.'+this.class).find('spectr');
	bufferdrawer.onclick = function ( ev ) {
		this.parentNode.track.jumpToPoint(ev.offsetX / 370.0 * this.parentNode.track.buffer.duration);
	}

	e.appendChild( bufferdrawer );
}

function getTrackName(url) {
	//url = $(this).parent().attr('data-file');
	var name = url.slice(url.lastIndexOf("/") + 1);
	var dot = name.lastIndexOf(".");
	if (dot != -1) {
		name = name.slice(0, dot);
  	}

  	return name;
}

Track.prototype.loadNewTrack = function(url) {
  	if (!url)
    	return;

    var track = this;
  	var request = new XMLHttpRequest();
  	request.open("GET", url, true);
  	request.responseType = "arraybuffer";
    $('.'+track.class + ' .name strong').html(getTrackName(url));
  	request.onload = function() {
    	audioCtx.decodeAudioData(request.response, function(buffer) { 
        	track.buffer = buffer;
        	canvas = $('.'+track.class + ' canvas')[0];
        	$('.'+track.class + ' .duration').html(formatTime(track.buffer.duration));
          	$('.'+track.class + ' .played').html('0.00');
  			drawBuffer(canvas.width, canvas.height, canvas.getContext("2d"), buffer); 
    	});
  	}
  	request.send();
}

Track.prototype.togglePlayback = function() {
    var now = audioCtx.currentTime;
    var track = this;

    if (this.isPlaying) {
        //stop playing and return
        if (this.sourceNode) {  // we may not have a sourceNode, if our PBR is zero.
			this.sourceNode.track = null;
			this.stopTime = 0;
			this.gainNode.gain.setTargetAtTime( 0.0, now, FADE );
			this.sourceNode.stop( now + FADE*4 );
			this.sourceNode = null;
			this.gainNode = null;
        }
        this.isPlaying = false;
		
		clearInterval(this.timer);

		$('.play_stop.'+track.class).removeClass('active');
		$('.handle.'+track.class).removeClass('active');

		return false;
    }

    this.isPlaying = true;
    this.lastTimeStamp = now;
    this.restartTime = now-1; // skips our "spin-up" animation
    this.offset = this.lastBufferTime;
    this.stopTime = 0;
    this.lastPBR = this.currentPlaybackRate;

    this.changePlaybackRate(this.lastPBR);
    
    this.timer = setInterval(function() {
    	$('.'+track.class + ' .played').html(formatTime(audioCtx.currentTime));
	}, 1000);

	return true;
}

function drawBuffer(width, height, context, buffer, color) {
    var data = buffer.getChannelData( 0 );
    var step = Math.floor( data.length / width );
    var amp = height / 1.2;

    context.clearRect(0,0,width,height);
    if (color) {
        context.fillStyle = waveColor;
    }
    for(var i=0; i < width; i++){
        var min = 1.0;
        var max = -1.0;
        for (j=0; j<step; j++) {
            var datum = data[(i*step)+j]; 
            if (datum < min)
                min = datum;
            if (datum > max)
                max = datum;
        }
        context.fillRect(i,(1+min)*amp,1,Math.max(1,(max-min)*amp));
    }
}

Track.prototype.changeGain = function( gain ) {
  gain = parseFloat(gain).toFixed(2);
  this.gain = gain;
  if (this.gainNode) {
    this.gainNode.gain.cancelScheduledValues( 0 );
    this.gainNode.gain.value = gain;
    this.gainNode.gain.setValueAtTime(gain,0);
  }
  this.gainText.innerHTML = gain;
}

function formatTime(time) {
    var minutes = parseInt(time / 60, 10);
    var seconds = parseInt(time % 60);
    if(seconds < 10) {
        seconds = '0' + seconds;
    }

    return minutes+":"+seconds;
}



function reverseBuffer( buffer ) {
  var newBuffer = audioCtx.createBuffer( buffer.numberOfChannels, buffer.length, buffer.sampleRate );
  if ( newBuffer ) {
    var length = buffer.length;
    for ( var channel=0; channel<buffer.numberOfChannels; channel++) {
      var oldBuf = buffer.getChannelData( channel );
      var newBuf = newBuffer.getChannelData( channel );
      for (var i=0; i<length; i++)
        newBuf[length-i-1] = oldBuf[i];
    }
  }
  return newBuffer;
}

Track.prototype.setCuePointAtCurrentTime = function(index) {
  // save the current time
  this.updatePlatter( false );
  this.cues[index] = new Cue(this.lastBufferTime);
  if (index==0)
    this.cueButton.classList.add("active");
  
  return this.cues[index];
}

Track.prototype.clearCuePoint = function( index ) {
  this.cues[index] = null;
  if (index==0)
    this.cueButton.classList.remove("active");
}

Track.prototype.jumpToCuePoint = function( index ) {
  if (this.isPlaying)
    this.togglePlayback();

  this.lastBufferTime = this.cues[index].time;
  this.togglePlayback();
}

Track.prototype.jumpToPoint = function( time ) {
  var wasPlaying = this.isPlaying;
  if (wasPlaying)
    this.togglePlayback();
  this.lastBufferTime = time;
  if (wasPlaying)
    this.togglePlayback();
}

// play a short snippet of sound
Track.prototype.playSnippet = function() {
  var now = audioCtx.currentTime;
  var snippetLength = 11.0/360.0;
  var then = now + snippetLength; // one tick
    var sourceNode = audioCtx.createBufferSource();
  var gainNode = audioCtx.createGain();

    sourceNode.loop = false;
  gainNode.connect( this.filter );
    sourceNode.connect( gainNode );
    sourceNode.buffer = (this.currentPlaybackRate>0) ? this.buffer : this.revBuffer;
    var startTime = (this.currentPlaybackRate>0) ? this.lastBufferTime : sourceNode.buffer.duration-this.lastBufferTime;
    
    // for now, let's try full playback rate
  // sourceNode.playbackRate.setValueAtTime( Math.abs(rate), now );

  // fade the sound in and out to avoid "clicking"
    gainNode.gain.setValueAtTime( 0.0, now );
    gainNode.gain.setTargetAtTime( this.gain, now, FADE );
    gainNode.gain.setTargetAtTime( 0.0, then, FADE );

  sourceNode.track = this;
  sourceNode.onended = shutDownNodeWhenDonePlaying.bind(sourceNode);
  sourceNode.start( now, startTime, sourceNode.buffer.duration - startTime );
  sourceNode.stop( then+snippetLength );
}

Track.prototype.skip = function( ticks ) {
  var restart = false;
  if (this.isPlaying) {
    restart = true;
    this.togglePlayback();
  }
  this.lastBufferTime += ticks * 11/360;
  if (this.lastBufferTime<0.0)
    this.lastBufferTime = 0.0;
  if ( restart )
    this.togglePlayback();
    else {
      this.playSnippet();
    }
}

function shutDownNodeWhenDonePlaying() {
  if (this.track) {
    this.track.sourceNode = null;
      this.track.gainNode = null;
    this.track.isPlaying = false;
  }
  if (this.onPlaybackEnd)
    this.onPlaybackEnd();
}

Track.prototype.togglePlaybackSpinUpDown = function() {
    var now = audioCtx.currentTime;

//  this.cuePointIsActive = false;

    if (this.isPlaying) {
        //stop playing and return
        if (this.sourceNode) {  // we may not have a sourceNode, if our PBR is zero.
          var playback = this.sourceNode.playbackRate;
          playback.cancelScheduledValues( now );
          playback.setValueAtTime( playback.value, now );
          playback.linearRampToValueAtTime( 0.001, now+1 );
          this.gainNode.gain.setTargetAtTime( 0, now+1, 0.01 );
          this.stopTime = now;
        this.sourceNode.stop( now + 2 );
          this.sourceNode = null;
          this.gainNode = null;
        }
        this.isPlaying = false;
        return false;
    }

    sourceNode = audioCtx.createBufferSource();
    sourceNode.buffer = this.buffer;
    sourceNode.loop = false;
    // The "now" below causes issues in FFnightly
    sourceNode.playbackRate.setValueAtTime( 0.001, now );
    sourceNode.playbackRate.linearRampToValueAtTime( this.currentPlaybackRate, now+1 );

  this.gainNode = audioCtx.createGain();
  this.gainNode.connect( this.filter );
  this.gainNode.gain.value = this.gain;
    sourceNode.connect( this.gainNode );

    this.sourceNode = sourceNode;
    this.isPlaying = true;
    this.lastTimeStamp = now + 0.5;   // the 0.5 is to make up for the initial 1s "spin-up" ramp.
    this.offset = this.lastBufferTime;
    this.restartTime = now;
    this.stopTime = 0.0;
    this.lastPBR = this.currentPlaybackRate;

    sourceNode.onended = shutDownNodeWhenDonePlaying.bind(this);
    sourceNode.start( now, this.lastBufferTime );

    return true;
}

Track.prototype.updateTime = function( now ) {
//  console.log("updateTime: " + now + ", " + this.lastBufferTime)
    // update the position we're at in the buffer
    this.lastBufferTime += (now-this.lastTimeStamp) * this.lastPBR;
    this.lastTimeStamp = now;
}

var cueColors = ["red", "blue", "green", "yellow"];
var cueText = ["cue", "1", "2", "3"];

Track.prototype.updatePlatter = function( drawOnScreen ) {
    var now = audioCtx.currentTime;
    var bufferTime;
    var keepAnimating = this.isPlaying;

  if (!this.isPlaying) {
    if (this.stopTime) {  // still in spin-down; 
      if (now > (this.stopTime + 1) ) { // done spinning down.
        this.lastBufferTime = this.lastBufferTime + 0.5;
        this.stopTime = 0;
        return false;
      } else {
        // bufferTime = 1/2 acceleration * t^2;  // keeping acceleration = 1 simplifies this!!
        bufferTime = 1 - (now-this.stopTime);
        bufferTime = bufferTime * bufferTime;
        bufferTime = bufferTime / 2;
        bufferTime = 0.5 - bufferTime + this.lastBufferTime;
        keepAnimating = true;
//        console.log( "now:" + now + " stopTime:" + this.stopTime + " bufferTime:" + bufferTime + " this.lastBufferTime:" + this.lastBufferTime );
      }
    } else
      bufferTime = this.lastBufferTime;
  } else if ((this.restartTime + 1) > now) {  // we're still in "spin-up"
    // bufferTime = 1/2 acceleration * t^2;  // acceleration = 1
    bufferTime = now-this.restartTime;
    bufferTime = bufferTime * bufferTime;
    bufferTime = bufferTime / 2;
    bufferTime += this.offset;
    } else {
    this.updateTime( now );
    bufferTime = this.lastBufferTime;
  }

  if (drawOnScreen) {
    var radians = ((bufferTime * REVPERSEC) % 1) * 2 * Math.PI;
    var context = this.platterContext;

    context.clearRect(-150,-150,300,300);  // TODO: shouldn't hardcode

        context.rotate( radians );
    context.fillStyle = "white";
    context.fillText("wubwubwub",-61,8);
        context.rotate( -radians );

    if (this.buffer) {
      // Now draw the position in the buffer

      var w = this.trackDisplayCanvas.width;
      var h = this.trackDisplayCanvas.height;
      var ctx = this.trackDisplayCanvas.getContext('2d');
      ctx.clearRect(0,0,w,h);
        ctx.drawImage( this.bufferCanvas, 0, 0 );
      var boxWidth = w * bufferTime / this.buffer.duration;
      ctx.fillStyle = "rgba(255,255,255,0.33)";
      ctx.fillRect(0,0,boxWidth,h);

      for (var i=0; i<4; i++) {
        var cue = this.cues[i]; 
        if (cue ) {
          var x = cue.time / this.buffer.duration * w; 
          ctx.fillStyle = cueColors[i];
          ctx.fillRect( x, 0, 1, h );
          ctx.font = "12px bold Skia, Arial, sans-serif";
          ctx.fillText( cueText[i], x+2, h/4 );
        }
      }

      drawRunningDisplay( runningDisplayContext, this.waveformDisplayCache, bufferTime ); 

        // draw the center bar
        var isTop = this.isLeftTrack;
        ctx = runningDisplayContext;
        runningDisplayContext.fillStyle = "gray";
        runningDisplayContext.fillRect(RUNNING_DISPLAY_HALF_WIDTH,isTop?0:RUNNING_DISPLAY_HALF_HEIGHT,1,RUNNING_DISPLAY_HALF_HEIGHT);

      // draw cues on the running display
      var begin = bufferTime - (SECONDS_OF_RUNNING_DISPLAY/2);
      var end = begin + SECONDS_OF_RUNNING_DISPLAY;
      for (var i=0; i<4; i++) {
        var cue = this.cues[i]; 
        if (cue && (cue.time>begin) && (cue.time<end)) {
          var x = (cue.time-begin) * RUNNING_DISPLAY_WIDTH / SECONDS_OF_RUNNING_DISPLAY; 
          ctx.fillStyle = cueColors[i];
          ctx.fillRect( x, isTop ? 0 : RUNNING_DISPLAY_HALF_HEIGHT, 1, RUNNING_DISPLAY_HALF_HEIGHT );
          ctx.font = "12px bold Skia, Arial, sans-serif";
          ctx.fillText( cueText[i], x+2, isTop ? RUNNING_DISPLAY_HALF_HEIGHT/2 : RUNNING_DISPLAY_HALF_HEIGHT*1.5 );
        }
      }

    }
  }

  return keepAnimating; // "keep animating" - may need to check if !isplaying
}

Track.prototype.changePlaybackRate = function( rate ) { // rate may be negative
  //this.pbrText.innerHTML = parseFloat(rate).toFixed(2);
    if (!this.isPlaying) {
      this.currentPlaybackRate = rate;
      return;
    }
    var now = audioCtx.currentTime;

    // update the position we're at in the buffer
    this.lastBufferTime += (now-this.lastTimeStamp) * this.lastPBR;
    this.lastPBR = rate;
    this.lastTimeStamp = now;

    if(this.lastBufferTime > this.buffer.duration) { // we've run off the end
      this.sourceNode = null;
      this.gainNode = null;
      this.lastPBR = this.buffer.duration;
      if (rate >=0)
        return;
      else
        this.lastBufferTime = this.buffer.duration;
    }
    if (this.lastBufferTime < 0) {  // we've run backwards over the beginning
      this.sourceNode = null;
    this.gainNode = null;
    this.lastPBR = 0;
    if (rate <= 0)
      return;
    else
      this.lastBufferTime = 0;
    }
    if ( rate == 0.0 ) {
      // stop playing and null the sourceNode
      if (this.sourceNode) {
        this.gainNode.gain.setTargetAtTime( 0, now, 0.01 );
        this.sourceNode.stop(now + 0.1);
        this.sourceNode = null;
        this.gainNode = null;
      }
      return;
    }
    // if the rate isn't zero, we know we'll need a source node.
    // if the old value and the new value are on the same side
    // of zero, we can just set the rate, but otherwise we'll
    // need to stop the node and re-create it.  We may already 
    // be stopped, with no sourceNode.
    if ( this.sourceNode ) {
      if (((this.currentPlaybackRate > 0) && (rate < 0)) ||
        ((this.currentPlaybackRate < 0) && (rate > 0))  ) {
        if (this.sourceNode) {
        this.gainNode.gain.setTargetAtTime( 0, now, FADE );
        this.sourceNode.stop(now + FADE*4);
        this.sourceNode = null;
        this.gainNode = null;
        }
      }
  }

    // so... we may have just killed the sourceNode to flip, or 
    // we may have been stopped before.  Create the sourceNode,
    // pointing to the correct direction buffer.
  if (!this.sourceNode) {
      var sourceNode = audioCtx.createBufferSource();
      sourceNode.loop = false;
    this.gainNode = audioCtx.createGain();
    this.gainNode.gain.value = this.gain;
    this.gainNode.connect( this.filter );
      sourceNode.connect( this.gainNode );
      sourceNode.buffer = (rate>0) ? this.buffer : this.revBuffer;
      var startTime = (rate>0) ? this.lastBufferTime : sourceNode.buffer.duration-this.lastBufferTime;
      
      sourceNode.playbackRate.setValueAtTime( Math.abs(rate), now );
      var duration = (sourceNode.buffer.duration - startTime);
        this.gainNode.gain.value = 0.0;
        this.gainNode.gain.setTargetAtTime( this.gain, now, FADE );
    sourceNode.onended = shutDownNodeWhenDonePlaying.bind(sourceNode);
        sourceNode.start( now, startTime, duration );
      this.sourceNode = sourceNode;
  } else  // if I replace "now" with "0" below, Firefox works.
      this.sourceNode.playbackRate.setValueAtTime( Math.abs(rate), now );
    this.currentPlaybackRate = rate;
}

Track.prototype.changeGain = function( gain ) {
  gain = parseFloat(gain).toFixed(2);
  this.gain = gain;
  if (this.gainNode) {
    this.gainNode.gain.cancelScheduledValues( 0 );
    this.gainNode.gain.value = gain;
    this.gainNode.gain.setValueAtTime(gain,0);
  }
  this.gainText.innerHTML = gain;
}
