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

// samples volume
var samplesVolumeControl = $("#mixer__samples-volume");

// VARIABLES
// ------

var DOMInstances = {
  first: {
    trackDuration: firstTrackDuration,
    trackPlayed: firstTrackPlayed,
    trackName: firstTrackName,
    trackLoudLines: firstTrackLoudLines,
    bpm: $("#first__bpm")
  },
  second: {
    trackDuration: secondTrackDuration,
    trackPlayed: secondTrackPlayed,
    trackName: secondTrackName,
    trackLoudLines: secondTrackLoudLines,
    bpm: $("#second__bpm")
  }
};

var balance = 50;

function createAudioCtxObject(audioCtxLink) {
  var dom = DOMInstances[audioCtxLink];
  return {
    audioCtx: null,
    analyser: null,
    bufferLength: null,
    dataArray: null,
    volume: 100,
    balanceMultiplier: 0.5,
    duration: null,
    durationDom: dom.trackDuration /* firstTrackDuration */,
    playedDom: dom.trackPlayed /* firstTrackPlayed */,
    nameDom: dom.trackName /* firstTrackName */,
    bpmDom: dom.bpm,
    seekTo: null,
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
    bpm: 0,
    loudLines: dom.trackLoudLines /* firstTrackLoudLines */,
    dest: null,
    timerInterval: null
  };
}

var audioCtxS = {
  first: createAudioCtxObject("first"),
  second: createAudioCtxObject("second")
};

var playedOnce = {
  first: false,
  second: false
};

$("#mixer").on("click", function(e) {
  if (!audioCtxS.first.audioCtx && !audioCtxS.second.audioCtx) {
    e.stopPropagation();
    e.preventDefault();

    show_popup("Пожалуйста, сначала выберите оба трека в списке снизу.");
  }
})

// EVENTS
// ------

selectAsFirstButton.on("click", function(e) {
  if (!playedOnce.first) {
    if (audioCtxS.first.audioCtx) {
      resetAudioObject("first");
    }
    var container = $(e.target).closest(".mixer__select-music-container");
    var url = container.data("sound_url");
    var bpm = container.data("bpm");
    var soundName = container.find(".mixer__select-music-name").html();
    var musicAuthor = container.find(".mixer__select-music-author").html();
    var audio = new Audio("first", url, {
      name: soundName,
      author: musicAuthor,
      bpm: bpm
    });
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
  if (!playedOnce.second) {
    if (audioCtxS.second.audioCtx) {
      resetAudioObject("second");
    }
    var container = $(e.target).closest(".mixer__select-music-container");
    var url = container.data("sound_url");
    var bpm = container.data("bpm");
    var soundName = container.find(".mixer__select-music-name").html();
    var musicAuthor = container.find(".mixer__select-music-author").html();
    var audio = new Audio("second", url, {
      name: soundName,
      author: musicAuthor,
      bpm: bpm
    });
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

// $("#mixer__first-seek").slider({
//   value: balance,
//   orientation: "horizontal",
//   range: "min",
//   animate: true,
//   min: 0,
//   max: 100,
//   value: 0,
//   slide: function(event, ui) {
//     console.log(ui.value);
//   }
// })

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
    show_popup("Пожалуйста, сначала выберите оба трека в списке снизу.");
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
  min: 80,
  max: 120,
  animate: true,
  slide: function(event, ui) {
    audioCtxS.first.filterControls.rate(ui.value / 100);
  }
});

secondRateControl.slider({
  value: audioCtxS.second.filters.rate * 100,
  orientation: "horizontal",
  range: "min",
  min: 80,
  max: 120,
  animate: true,
  slide: function(event, ui) {
    audioCtxS.second.filterControls.rate(ui.value / 100);
  }
});

samplesVolumeControl.slider({
  value: 50,
  orientation: "horizontal",
  min: 0,
  max: 100,
  animate: true,
  slide: function(event, ui) {
    sampleAudioCtx.changeVolume(ui.value / 100)
  }
})

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
    show_popup("Пожалуйста, для начала выберите трек из списка снизу.");
  } else if (context.state === "running") {
    playedOnce[audioCtxLink] = true;
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
    playedOnce[audioCtxLink] = true;
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

var mediaRecorder = null;

function startRecording() {
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

    var ourFile = new File([blob], "audio.ogg", { type: "audio/ogg" });
    console.log(ourFile);

    audioCtxS.first.audioCtx.suspend();
    audioCtxS.second.audioCtx.suspend();

    cancelAnimationFrame(audioCtxS.first.analyserAnimation);
    cancelAnimationFrame(audioCtxS.second.analyserAnimation);

    resetMixer();

    setTimeout(function() {
      audioCtxS.first.loudLines.map(function(line) {
        line.css(
          "height",
          "0%"
        );
      });
      audioCtxS.second.loudLines.map(function(line) {
        line.css(
          "height",
          "0%"
        );
      });
    }, 2000);

    firstTrackPlayButton.closest(".play_stop").removeClass("active");
    secondTrackPlayButton.closest(".play_stop").removeClass("active");

    setTimeout(function() {
      $("#first-handle").removeClass("active");
      $("#second-handle").removeClass("active");
    }, 100);

    $(".plate").removeClass("spinning");

    stopTimer();

    $("#mixer__done-message").css({ display: "block" });
    $(".mixer_playlist").css({ display: "none" });
    $("#mixer").css({ display: "none" });

    setTimeout(function() {
      $("body").append(
        $(
          "<audio controls style='display: none' id='audio-result'><source src='" +
            url +
            "' type='audio/ogg' /></audio>"
        )
      );
    }, 500);

    $("#resultSend").on("click", function() {
      console.log("SENDING FILE");

      var formData = new FormData();
      formData.append("audioFile", ourFile);

      var xhr = new XMLHttpRequest();
      xhr.open("post", "/personal/add-post");
      xhr.send(formData);
      xhr.onload = function() {
        $("#mixer__done-message").css({ display: "none" });
        $(".mixer_playlist").css({ display: "" });
        $("#mixer").css({ display: "block" });
        show_popup("Мы успешно отправили ваш трек на сервер!");
      }
      $("#resultSend").off("click");
      $("#tryAgain").off("click");
    });

    var playing = false;

    $("#mixer__result-play-button").on("click", function(e) {
      e.stopPropagation();
      if (playing) {
        $("#audio-result")[0].pause();
        playing = false;
      } else {
        $("#audio-result")[0].play();
        playing = true;
      }
    });

    $("#tryAgain").on("click", function() {
      $("#mixer__done-message").css({ display: "none" });
      $(".mixer_playlist").css({ display: "" });
      $("#mixer").css({ display: "block" });

      $("mixer__result-play-button").off("click");

      $("#audio-result").remove();
    });


  });

  mediaRecorder.start();
  initTimer();
}

function stopRecording() {
  mediaRecorder.stop();
}

var time = 0;
var timer = null;

function initTimer(duration) {
  timer = setInterval(function() {
    time += 10;
    recordTimer.html(moment.utc(time).format("mm:ss:SSSS"));
  }, 10);
}

function stopTimer() {
  clearInterval(timer);
  recordTimer.html("00:00:0000");
}

function resetAudioObject(audioCtxLink) {
  if (audioCtxS[audioCtxLink].audioCtx) {
    audioCtxS[audioCtxLink].audioCtx.close();
    clearInterval(audioCtxS[audioCtxLink].timerInterval);
    audioCtxS[audioCtxLink].playedDom.html("00:00");
    audioCtxS[audioCtxLink].durationDom.html("00:00");
    audioCtxS[audioCtxLink].nameDom.html("");
    $(".mixer__select-music-"+audioCtxLink).removeClass("active");
  }

  audioCtxS[audioCtxLink] = createAudioCtxObject(audioCtxLink);
}

function resetMixer() {
  ["first", "second"].map(function(i) {
    resetAudioObject(i);
  });
  playedOnce = { first: false, second: false };
}

var alreadyStartedOne = false;

function Audio(audioCtxLink, musicLink, musicInfo) {
  this.audioCtxLink = audioCtxLink;
  this.musicLink = musicLink;
  this.musicInfo = musicInfo;
  this.request = null;

  this.initAudio = function() {
    $("#plate__" + this.audioCtxLink).attr("src", "/img/plate_3.png").addClass("spinning");
    alreadyStartedOne = true;

    var audioCtxLink = this.audioCtxLink;
    var musicLink = this.musicLink;
    var musicInfo = this.musicInfo;

    var audioObject = audioCtxS[audioCtxLink];
    audioObject.bpm = this.musicInfo.bpm;

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
    audioObject.bpmDom.html(audioObject.bpm);
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
          
          var canvas = $("#mixer__"+audioCtxLink+"-seek")[0];
          drawBuffer(canvas.width, canvas.height, canvas.getContext("2d"), buffer);

          songDuration = moment.duration(buffer.duration, "seconds");
          audioObject.duration = songDuration;
          audioObject.durationDom.html(
            moment.utc(songDuration.as("milliseconds")).format("mm:ss")
          );

          audioObject.seekTo = function(sec) {
            audioObject.source.stop();
            audioObject.source = ourContext.createBufferSource();
            audioObject.source.buffer = buffer;
            audioObject.source.start(0, sec);
            audioObject.source.connect(ourAnalyser);
          }.bind(this);

          window.buffAudio = new BuffAudio(ourContext, audioObject.source);

          audioObject.timerInterval = setInterval(function() {
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

          console.log(audioObject);
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
            audioObject.bpmDom.html(Math.ceil(rateValue * audioObject.bpm));
            audioObject.filters.rate = rateValue;
          };

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
              audioObject.analyserAnimation = window.requestAnimationFrame(renderFFT);
            };
            audioObject.analyserAnimation = renderFFT();
          })();

          var plates = {
            first: "/img/plate_1.png",
            second: "/img/plate_2.png"
          }

          $("#plate__" + audioCtxLink).attr("src", plates[audioCtxLink]).removeClass("spinning");
        },
        function(e) {
          "Error with decoding audio data" + e.err;
        }
      );
    }.bind(this);
    this.request.send();
  };
}

function Sample(url) {
  this.url = url;
  this.request = null;

  this.getAudioBuffer = function(callback) {
    console.log("we are here");
    this.request = new XMLHttpRequest();
    var request = this.request;
    this.request.open("GET", this.url, true);
    this.request.responseType = "arraybuffer";

    this.request.onload = function() {
      callback(request.response);
    }

    this.request.send();
  }
}

function SampleAudioCtx() {
  this.audioCtx = null;
  this.stream = null;
  this.gain = null;

  this.init = function() {
    this.audioCtx = new AudioContext();
    this.stream = this.audioCtx.createMediaStreamDestination();
    this.gain = this.audioCtx.createGain();
    this.gain.gain.value = 0.5;
    
    this.gain.connect(this.audioCtx.destination);
    console.log(this.audioCtx, "AUDIO CTX");
  }

  this.changeVolume = function(vol) {
    this.gain.gain.value = vol;
  }

  this.playSample = function(link) {
    var source = this.audioCtx.createBufferSource();
    var sample = new Sample(link);
    sample.getAudioBuffer(function(data) {
      console.log('WE ARE HERE');
      this.audioCtx.decodeAudioData(data, function(buffer) {
        source.buffer = buffer;
        source.connect(this.gain);
        source.loop = false;
        source.start(0);
      }.bind(this))
    }.bind(this));
  }
}

window.sampleAudioCtx = new SampleAudioCtx();
sampleAudioCtx.init();

$(".mixer__additional-track-player").on("click", function(e) {
  var audioUrl = $(this).data("url");
  console.log(audioUrl);
  sampleAudioCtx.playSample(audioUrl);
})