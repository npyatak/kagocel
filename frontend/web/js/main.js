// var workerOptions = {
//   OggOpusEncoderWasmPath:
//     "https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/OggOpusEncoder.wasm",
//   WebMOpusEncoderWasmPath:
//     "https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/WebMOpusEncoder.wasm"
// };

// // Existing MediaRecorder is replaced
// window.MediaRecorder = OpusMediaRecorder;

$(document).on("click", ".post .action", function(e) {
  e.preventDefault();

  var obj = $(this);
  var post = $(this).closest(".post");

  if (!obj.hasClass("inactive")) {
    $.ajax({
      type: "GET",
      url: "/site/post-action",
      data: "id=" + post.attr("data-id") + "&type=" + obj.attr("data-type"),
      success: function(data) {
        post.find(".score").html(data.score);
        obj.removeClass("active");
      }
    });
  }
});

window.onload = function() {
  $(".wrapper").css("opacity", "1");
};

var wavesurferArray = [];

$(document).on("click", ".track_item .play", function(e) {
  var post = $(this).closest(".track_item");
  var id = post.attr("data-id");
  var audio = post.find("audio")[0];

  if (typeof wavesurferArray[id] == "undefined") {
    wavesurfer = WaveSurfer.create({
      container: document.querySelector("#post_" + id + " .spectrogram"),
      waveColor: "#f7323f",
      progressColor: "#bfbfbf",
      height: 38
    });

    wavesurfer.load(audio.src);
    wavesurferArray[id] = wavesurfer;
  }

  if (audio.paused) {
    audio.play();
    $(this).removeClass("icon-play");
    $(this).addClass("icon-stop");
  } else {
    audio.pause();
    $(this).removeClass("icon-stop");
    $(this).addClass("icon-play");
  }

  wavesurferArray[id].playPause();

  audio.ontimeupdate = function() {
    post.find(".timer_range .current").html(formatTime(audio.currentTime));
  };
});

function formatTime(time) {
  var minutes = parseInt(time / 60, 10);
  var seconds = parseInt(time % 60);
  if (seconds < 10) {
    seconds = "0" + seconds;
  }

  return minutes + ":" + seconds;
}

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
    filterInstances: {
      bass: null,
      mid: null,
      high: null
    },
    filters: {
      bass: 0,
      mid: 0,
      high: 0
    },
    filterControls: {
      bass: null,
      mid: null,
      high: null
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
    volume: 100,
    balanceMultiplier: 0.5,
    filters: {
      bass: 0,
      mid: 0,
      high: 0
    },
    filterInstances: {
      bass: null,
      mid: null,
      high: null
    },
    filterControls: {
      bass: null,
      mid: null,
      high: null
    },
    loudLines: secondTrackLoudLines,
    dest: null
  }
};

// EVENTS
// ------

var recording = false;

recordButton.on("click", function(e) {
  if (!recording) {
    startRecording();
    recording = true;
  } else {
    stopRecording();
    recording = false;
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

function initAudioProccesser(audioCtxLink, musicLink) {
  var context = audioCtxS[audioCtxLink].audioCtx;
  if (!context) {
    initAudio(audioCtxLink, musicLink);
    soundPusher(coder("pl", 0, audioCtxLink === "first" ? 0 : 1));
  } else if (context.state === "running") {
    context.suspend();
    firstTrackLoudLines.map(function(line) {
      line.css("height", "0 !important");
    });

    soundPusher(coder("ps", 0, audioCtxLink === "first" ? 0 : 1));
  } else {
    context.resume();
    soundPusher(coder("pl", 0, audioCtxLink === "first" ? 0 : 1));
  }
}

firstTrackPlayButton.click(function() {
  initAudioProccesser("first", "http://localhost:5000/files/kino.mp3");
});

secondTrackPlayButton.click(function() {
  initAudioProccesser("second", "http://localhost:5000/files/splean.mp3");
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

  mediaRecorder = new MediaRecorder(mixedStream, {});
  mediaRecorder.start();

  chunks = [];
  mediaRecorder.ondataavailable = function(evt) {
    // push each chunk (blobs) in an array
    chunks.push(evt.data);
  };

  mediaRecorder.onstop = function(evt) {
    // Make blob out of our blobs, and open it.
    var blob = new Blob(chunks, { type: "audio/ogg; codecs=opus" });
    var url = URL.createObjectURL(blob);

    console.log(chunks);
    console.log(url);

    setTimeout(function() {
      $("#mixer").append(
        $(
          "<audio controls><source src='" +
            url +
            "' type='audio/ogg' /></audio>"
        )
      );
    }, 500);
  };

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

function initAudio(audioCtxLink, musicLink) {
  try {
    window.audioCtx = window.AudioContext || window.webkitAudioContext;
    audioCtxS[audioCtxLink].audioCtx = new AudioContext();
    audioCtxS[audioCtxLink].analyser = audioCtxS[
      audioCtxLink
    ].audioCtx.createAnalyser();
  } catch (e) {
    alert("Web Audio API is not supported in this browser");
  }
  // load the audio file
  var ourContext = audioCtxS[audioCtxLink].audioCtx;
  var ourAnalyser = audioCtxS[audioCtxLink].analyser;
  source = ourContext.createBufferSource();
  var gainNode = ourContext.createGain();
  var request = new XMLHttpRequest();
  request.open("GET", musicLink, true);
  request.responseType = "arraybuffer";
  request.onload = function() {
    var audioData = request.response;
    ourContext.decodeAudioData(
      audioData,
      function(buffer) {
        source.buffer = buffer;

        songDuration = moment.duration(buffer.duration, "seconds");
        audioCtxS[audioCtxLink].duration = songDuration;
        audioCtxS[audioCtxLink].durationDom.html(
          moment.utc(songDuration.as("milliseconds")).format("mm:ss")
        );

        setInterval(function() {
          audioCtxS[audioCtxLink].playedDom.html(
            moment
              .utc(
                moment
                  .duration(ourContext.currentTime, "seconds")
                  .as("milliseconds")
              )
              .format("mm:ss")
          );
        }, 1000);

        source.connect(ourAnalyser);
        source.loop = true;
        ourAnalyser.connect(gainNode);

        bassFilter = ourContext.createBiquadFilter();
        bassFilter.type = "lowshelf";

        midFilter = ourContext.createBiquadFilter();
        midFilter.type = "peaking";

        highFilter = ourContext.createBiquadFilter();
        highFilter.type = "highshelf";

        mediaDest = ourContext.createMediaStreamDestination();

        audioCtxS[audioCtxLink].filterInstances.bass = bassFilter;
        audioCtxS[audioCtxLink].filterInstances.mid = midFilter;
        audioCtxS[audioCtxLink].filterInstances.high = highFilter;

        window.ourBassFilter = bassFilter;

        gainNode.connect(bassFilter);
        gainNode.gain.value =
          (audioCtxS[audioCtxLink].volume / 100) *
          audioCtxS[audioCtxLink].balanceMultiplier;
        bassFilter.connect(midFilter);
        midFilter.connect(highFilter);
        highFilter.connect(mediaDest);
        highFilter.connect(ourContext.destination);

        source.start(0);

        audioCtxS[audioCtxLink].filterControls.bass = function(val) {
          var bassValue = (val / 140) * 50;
          audioCtxS[audioCtxLink].filterInstances.bass.gain.value = bassValue;
          audioCtxS[audioCtxLink].filters.bass = bassValue;
          soundPusher(coder("b", bassValue, getSoundIndex(audioCtxLink)));
        };

        audioCtxS[audioCtxLink].filterControls.mid = function(val) {
          var midValue = (val / 140) * 50;
          audioCtxS[audioCtxLink].filterInstances.mid.gain.value = midValue;
          audioCtxS[audioCtxLink].filters.mid = midValue;
          soundPusher(coder("m", midValue, getSoundIndex(audioCtxLink)));
        };

        audioCtxS[audioCtxLink].filterControls.high = function(val) {
          var highValue = (val / 140) * 50;
          audioCtxS[audioCtxLink].filterInstances.high.gain.value = highValue;
          audioCtxS[audioCtxLink].filters.high = highValue;
          soundPusher(coder("h", highValue, getSoundIndex(audioCtxLink)));
        };

        bassFilter.frequency.setValueAtTime(1000, ourContext.currentTime);

        audioCtxS[audioCtxLink].gain = gainNode;

        audioCtxS[audioCtxLink].dest = mediaDest;

        (function() {
          var analyser = ourAnalyser;
          analyser.fftSize = 128;
          analyser.smoothingTimeConstant = 0.4;
          var freqByteData = new Uint8Array(analyser.frequencyBinCount);
          var renderFFT = function() {
            analyser.getByteFrequencyData(freqByteData);
            audioCtxS[audioCtxLink].loudLines.map(function(line) {
              line.css(
                "height",
                ((audioCtxS[audioCtxLink].volume *
                  audioCtxS[audioCtxLink].balanceMultiplier) /
                  128) *
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
  };
  request.send();
}

// SOUND PLAYER

// var playingSoundCtxs = {

// }

// function initializeSoundPlayer(mixedSoundData) {
//   try {
//     window.audioCtx = window.AudioContext || window.webkitAudioContext;
//     audioCtxS[audioCtxLink].audioCtx = new AudioContext();
//     audioCtxS[audioCtxLink].analyser = audioCtxS[
//       audioCtxLink
//     ].audioCtx.createAnalyser();
//   } catch (e) {
//     alert("Web Audio API is not supported in this browser");
//   }
// }
