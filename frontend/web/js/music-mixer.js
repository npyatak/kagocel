// our music mixer

// CONSTANTS
// ------------

var filterTypes = {
  "mixer__first-track-mid-filter": ["first", "mid"],
  "mixer__first-track-bass-filter": ["first", "bass"],
  "mixer__first-track-high-filter": ["first", "high"],
  "mixer__second-track-mid-filter": ["second", "mid"],
  "mixer__second-track-bass-filter": ["second", "bass"],
  "mixer__second-track-high-filter": ["second", "high"]
};

// DOM ELEMENTS
// ------------
// track labels
var firstTrackName = $("#mixer__first-track-name");
var secondTrackName = $("#mixer__second-track-name");

// play buttons
var firstTrackPlayButton = $("#mixer__first-track-play-button");
var secondTrackPlayButton = $("#mixer__second-track-play-button");

// volume loud lines
var firstTrackLoudLines = [
  $("#mixer__first-track-loudness-line-1"),
  $("#mixer__first-track-loudness-line-2")
];
var secondTrackLoudLines = [
  $("#mixer__second-track-loudness-line-1"),
  $("#mixer__second-track-loudness-line-2")
];

// volume controls
var firstTrackLoudControl = $("#mixer__first-track-loudness-control");
var secondTrackLoudControl = $("#mixer__second-track-loudness-control");
var balanceControl = $("#mixer__balance-control");

// track duration labels
var firstTrackDuration = $("#mixer__first-track-duration");
var secondTrackDuration = $("#mixer__second-track-duration");

// part of track that has been already played
var firstTrackPlayed = $("#mixer__first-track-played");
var secondTrackPlayed = $("#mixer__second-track-played");

// record button
var recordTimer = $("#mixer__record-timer");
var recordButton = $("#mixer__record-button");

// selectable music
var selectableMusic = $(".mixer__select-music-container");

// selectable music buttons
var selectAsFirstButton = $(".mixer__select-music-first");
var selectAsSecondButton = $(".mixer__select-music-second");

// track playback rate sliders
var firstRateControl = $("#mixer__first-track-playback-rate");
var secondRateControl = $("#mixer__second-track-playback-rate");

// VARIABLES
// ------

var balance = 50;

var audioCtxS = {
  first: {
    audioCtx: null,
    analyser: null,
    bufferLength: null,
    dataArray: null,
    volume: 100,
    balanceMultiplier: 0.5,
    duration: null,
    durationDom: firstTrackDuration,
    playedDom: firstTrackPlayed,
    nameDom: firstTrackName,
    filterInstances: {
      bass: null,
      mid: null,
      high: null,
      rate: null
    },
    filters: {
      bass: 0,
      mid: 0,
      high: 0,
      rate: 1
    },
    filterControls: {
      bass: null,
      mid: null,
      high: null,
      rate: null
    },
    loudLines: firstTrackLoudLines,
    dest: null
  },
  second: {
    audioCtx: null,
    analyser: null,
    bufferLength: null,
    dataArray: null,
    gain: null,
    duration: null,
    durationDom: secondTrackDuration,
    playedDom: secondTrackPlayed,
    nameDom: secondTrackName,
    volume: 100,
    balanceMultiplier: 0.5,
    filters: {
      bass: 0,
      mid: 0,
      high: 0,
      rate: 1
    },
    filterInstances: {
      bass: null,
      mid: null,
      high: null,
      rate: null
    },
    filterControls: {
      bass: null,
      mid: null,
      high: null,
      rate: null
    },
    loudLines: secondTrackLoudLines,
    dest: null
  }
};

// EVENTS
// ------

selectAsFirstButton.on("click", function(e) {
  if (!audioCtxS.first.audioCtx) {
    var container = $(e.target).closest(".mixer__select-music-container");
    var url = container.data("sound_url");
    var soundName = container.find(".mixer__select-music-name").html();
    var musicAuthor = container.find(".mixer__select-music-author").html();
    var audio = new Audio("first", url, { name: soundName, author: musicAuthor});
    if (alreadyStartedOne) {
      setTimeout(audio.initAudio.bind(audio), 2000);
    } else {
      audio.initAudio();
    }
    // initAudio("first", url, { name: soundName, author: musicAuthor });
  } else {
    e.stopPropagation();
  }
});

selectAsSecondButton.on("click", function(e) {
  if (!audioCtxS.second.audioCtx) {
    var container = $(e.target).closest(".mixer__select-music-container");
    var url = container.data("sound_url");
    var soundName = container.find(".mixer__select-music-name").html();
    var musicAuthor = container.find(".mixer__select-music-author").html();
    var audio = new Audio("second", url, { name: soundName, author: musicAuthor });
    if (alreadyStartedOne) {
      setTimeout(audio.initAudio.bind(audio), 2000);
    } else {
      audio.initAudio();
    }
    // initAudio("second", url, { name: soundName, author: musicAuthor });
  } else {
    e.stopPropagation();
  }
});

var recording = false;

recordButton.on("click", function(e) {
  if (audioCtxS.first.audioCtx && audioCtxS.second.audioCtx) {
    if (!recording) {
      startRecording();
      recording = true;
      recordButton.addClass("active");
    } else {
      stopRecording();
      recordButton.removeClass("active");
      recording = false;
    }
  } else {
    alert("Пожалуйста, сначала выберите оба трека в списке снизу.");
  }
});

$.each($(".knob"), function(i, e) {
  Draggable.create(e, {
    type: "rotation",
    throwProps: true,
    bounds: { minRotation: -140, maxRotation: 140 },
    onDrag: function() {
      var parent = $(this.target).parent();
      var filterType = filterTypes[$(this.target).attr("id")];
      if (audioCtxS[filterType[0]].filterControls[filterType[1]]) {
        audioCtxS[filterType[0]].filterControls[filterType[1]](this.rotation);
      }
      parent
        .children(".color_circle")
        .css("transform", "rotate(" + this.rotation + "deg)");

      if (this.rotation <= 0) {
        parent.children(".color_circle").addClass("left");
        parent.children(".grey_circle").addClass("right");
        // parent.css("background-color","#fff")
      } else {
        parent.children(".color_circle").removeClass("left");
        parent.children(".grey_circle").removeClass("right");
      }
    }
  });
});

firstTrackLoudControl.slider({
  value: audioCtxS.first.volume,
  orientation: "vertical",
  range: "min",
  animate: true,
  slide: function(event, ui) {
    audioCtxS.first.volume = ui.value;
    updateVolume("first");
  }
});

secondTrackLoudControl.slider({
  value: audioCtxS.first.volume,
  orientation: "vertical",
  range: "min",
  animate: true,
  slide: function(event, ui) {
    audioCtxS.second.volume = ui.value;
    updateVolume("second");
  }
});

balanceControl.slider({
  value: balance,
  orientation: "horizontal",
  range: "min",
  animate: true,
  slide: function(event, ui) {
    balance = ui.value;
    audioCtxS.second.balanceMultiplier = ui.value / 100;
    audioCtxS.first.balanceMultiplier = (100 - ui.value) / 100;
    updateVolume("first");
    updateVolume("second");
  }
});

firstRateControl.slider({
  value: audioCtxS.first.filters.rate * 100,
  orientation: "horizontal",
  range: "min",
  min: 0,
  max: 200,
  animate: true,
  slide: function(event, ui) {
    audioCtxS.first.filterControls.rate(ui.value / 100);
  }
});

secondRateControl.slider({
  value: audioCtxS.second.filters.rate * 100,
  orientation: "horizontal",
  range: "min",
  min: 0,
  max: 200,
  animate: true,
  slide: function(event, ui) {
    audioCtxS.second.filterControls.rate(ui.value / 100);
  }
});


function updateVolume(audioCtxLink) {
  var target = audioCtxS[audioCtxLink];
  if (target.gain) {
    target.gain.gain.value = (target.volume / 100) * target.balanceMultiplier;
  }
}

window.requestAnimationFrame =
  window.requestAnimationFrame ||
  window.webkitRequestAnimationFrame ||
  window.mozRequestAnimationFrame ||
  function(f) {
    setTimeout(f, 30);
  };

function mean(numbers) {
  var total = 0,
    i;
  for (i = 0; i < numbers.length; i += 1) {
    total += numbers[i];
  }
  return total / numbers.length;
}

console.log(
  [
    firstTrackName,
    secondTrackName,
    firstTrackPlayButton,
    secondTrackPlayButton
  ],
  "OUR CONTROLS"
);

function coder(type, value, musicIndex) {
  return {
    t: type,
    v: value,
    m: musicIndex
  };
}

function getSoundIndex(audioCtxLink) {
  if (audioCtxLink === "first") {
    return 0;
  } else {
    return 1;
  }
}

function initAudioProccesser(audioCtxLink, e) {
  var context = audioCtxS[audioCtxLink].audioCtx;
  var container = $(e.target).closest(".mixer_bottom_item");
  if (!context) {
    alert("Пожалуйста, для начала выберите трек из списка снизу.");
  } else if (context.state === "running") {
    context.suspend();
    $(e.target)
      .closest(".play_stop")
      .removeClass("active");
    setTimeout(function() {
      $("#" + audioCtxLink + "-handle").removeClass("active");
    }, 100);

    container.find(".plate").removeClass("spinning");
    firstTrackLoudLines.map(function(line) {
      line.css("height", "0 !important");
    });
  } else {
    $(e.target)
      .closest(".play_stop")
      .addClass("active");
    console.log(container);
    setTimeout(function() {
      $("#" + audioCtxLink + "-handle").addClass("active");
    }, 100);
    container.find(".plate").addClass("spinning");
    context.resume();
  }
}

firstTrackPlayButton.click(function(e) {
  initAudioProccesser("first", e);
});

secondTrackPlayButton.click(function(e) {
  initAudioProccesser("second", e);
});

var allowedToPush = false;

window.sound = {};

var mediaRecorder = null;

function startRecording() {
  window.sound = {
    operations: {},
    sources: [
      "http://localhost:5000/files/kino.mp3",
      "http://localhost:5000/files/splean.mp3"
    ],
    startValues: {
      first: {
        v: audioCtxS.first.volume,
        b: audioCtxS.first.filters.bass,
        m: audioCtxS.first.filters.mid,
        h: audioCtxS.first.filters.high,
        timecode: audioCtxS.first.currentTime
          ? audioCtxS.first.audioCtx.currentTime
          : 0
      },
      second: {
        v: audioCtxS.second.volume,
        b: audioCtxS.second.filters.bass,
        m: audioCtxS.second.filters.mid,
        h: audioCtxS.second.filters.high,
        timecode: audioCtxS.second.audioCtx
          ? audioCtxS.second.audioCtx.currentTime
          : 0
      }
    }
  };

  console.log(audioCtxS.first.dest.stream);
  console.log(audioCtxS.second.dest.stream);

  function mix(audioContext, streams) {
    var dest = audioContext.createMediaStreamDestination();
    streams.forEach(stream => {
      var source = audioContext.createMediaStreamSource(stream);
      source.connect(dest);
    });
    return dest.stream;
  }

  var ac = new AudioContext();
  var mixedStream = mix(ac, [
    audioCtxS.first.dest.stream,
    audioCtxS.second.dest.stream
  ]);

  mediaRecorder = new MediaRecorder(mixedStream);

  chunks = [];
  mediaRecorder.addEventListener("dataavailable", function(evt) {
    // push each chunk (blobs) in an array
    chunks.push(evt.data);
  });

  mediaRecorder.addEventListener("stop", function(evt) {
    console.log("STOPPED");
    // Make blob out of our blobs, and open it.
    var blob = new Blob(chunks, { type: "audio/ogg; codecs=opus" });
    var url = URL.createObjectURL(blob);

    console.log(chunks);
    console.log(url);

    audioCtxS.first.audioCtx.suspend();
    audioCtxS.second.audioCtx.suspend();

    $("#mixer__done-message").css({ display: "block" });
    $("#mixer__inner").css({ display: "none" });

    setTimeout(function() {
      $("#mixer__done-message").append(
        $(
          "<audio controls style='margin-top: 20px;'><source src='" +
            url +
            "' type='audio/ogg' /></audio>"
        )
      );
    }, 500);
  });

  mediaRecorder.start();

  allowedToPush = true;
  setInterval(function() {
    allowedToPush = true;
  }, 200);
  initTimer();
}

function stopRecording() {
  mediaRecorder.stop();
}

function soundPusher(frame) {
  if (allowedToPush) {
    sound.operations[time] = frame;
    allowedToPush = false;
  }
}

var time = 0;

function initTimer(duration) {
  setInterval(function() {
    time += 10;
    recordTimer.html(moment.utc(time).format("mm:ss:SSSS"));
  }, 10);
}

var alreadyStartedOne = false;

function Audio(audioCtxLink, musicLink, musicInfo) {
  this.audioCtxLink = audioCtxLink;
  this.musicLink = musicLink;
  this.musicInfo = musicInfo;
  this.request = null;

  this.initAudio = function() {
    alreadyStartedOne = true;

    var audioCtxLink = this.audioCtxLink;
    var musicLink = this.musicLink;
    var musicInfo = this.musicInfo;

    var audioObject = audioCtxS[audioCtxLink];

    // try {
    //   window.audioCtx = window.AudioContext || window.webkitAudioContext;
      audioObject.audioCtx = new AudioContext();
      audioObject.analyser = audioObject.audioCtx.createAnalyser();
    // } catch (e) {
    //   alert("Web Audio API is not supported in this browser");
    // }

    // load the audio file
    var ourContext = audioObject.audioCtx;
    var ourAnalyser = audioObject.analyser;
    audioObject.nameDom.html(musicInfo.name + " - " + musicInfo.author);
    audioObject.source = ourContext.createBufferSource();
    var gainNode = ourContext.createGain();
    this.request = new XMLHttpRequest();
    console.log(this.request);
    this.request.open("GET", musicLink, true);
    this.request.responseType = "arraybuffer";
    this.request.onload = function() {
      var audioData = this.request.response;
      ourContext.decodeAudioData(
        audioData,
        function(buffer) {
          audioObject.source.buffer = buffer;

          songDuration = moment.duration(buffer.duration, "seconds");
          audioObject.duration = songDuration;
          audioObject.durationDom.html(
            moment.utc(songDuration.as("milliseconds")).format("mm:ss")
          );

          setInterval(function() {
            audioObject.playedDom.html(
              moment
                .utc(
                  moment
                    .duration(ourContext.currentTime, "seconds")
                    .as("milliseconds")
                )
                .format("mm:ss")
            );
          }, 1000);

          console.log(audioObject)
          audioObject.source.connect(ourAnalyser);
          audioObject.source.loop = true;
          ourAnalyser.connect(gainNode);

          bassFilter = ourContext.createBiquadFilter();
          bassFilter.type = "lowshelf";

          midFilter = ourContext.createBiquadFilter();
          midFilter.type = "peaking";

          highFilter = ourContext.createBiquadFilter();
          highFilter.type = "highshelf";

          mediaDest = ourContext.createMediaStreamDestination();

          audioObject.filterInstances.bass = bassFilter;
          audioObject.filterInstances.mid = midFilter;
          audioObject.filterInstances.high = highFilter;
          audioObject.filterInstances.rate = audioObject.source.playbackRate;

          window.ourBassFilter = bassFilter;

          gainNode.connect(bassFilter);
          gainNode.gain.value =
            (audioObject.volume / 100) * audioObject.balanceMultiplier;
          bassFilter.connect(midFilter);
          midFilter.connect(highFilter);
          highFilter.connect(mediaDest);
          highFilter.connect(ourContext.destination);

          audioObject.source.start(0);
          ourContext.suspend();

          audioObject.filterControls.bass = function(val) {
            var bassValue = (val / 140) * 50;
            audioObject.filterInstances.bass.gain.value = bassValue;
            audioObject.filters.bass = bassValue;
          };

          audioObject.filterControls.mid = function(val) {
            var midValue = (val / 140) * 50;
            audioObject.filterInstances.mid.gain.value = midValue;
            audioObject.filters.mid = midValue;
          };

          audioObject.filterControls.high = function(val) {
            var highValue = (val / 140) * 50;
            audioObject.filterInstances.high.gain.value = highValue;
            audioObject.filters.high = highValue;
          };

          audioObject.filterControls.rate = function(val) {
            var rateValue = val;
            audioObject.filterInstances.rate.value = rateValue;
            audioObject.filters.rate = rateValue;
          }

          bassFilter.frequency.setValueAtTime(1000, ourContext.currentTime);

          audioObject.gain = gainNode;

          audioObject.dest = mediaDest;

          (function() {
            var analyser = ourAnalyser;
            analyser.fftSize = 128;
            analyser.smoothingTimeConstant = 0.4;
            var freqByteData = new Uint8Array(analyser.frequencyBinCount);
            var renderFFT = function() {
              analyser.getByteFrequencyData(freqByteData);
              audioObject.loudLines.map(function(line) {
                line.css(
                  "height",
                  ((audioObject.volume * audioObject.balanceMultiplier) / 128) *
                    mean(freqByteData) +
                    "%"
                );
              });
              window.requestAnimationFrame(renderFFT);
            };
            renderFFT();
          })();
        },
        function(e) {
          "Error with decoding audio data" + e.err;
        }
      );
    }.bind(this);
    this.request.send();
  };
}