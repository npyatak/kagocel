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

  if (obj.hasClass("active")) {
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

