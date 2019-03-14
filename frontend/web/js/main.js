// var workerOptions = {
//   OggOpusEncoderWasmPath:
//     "https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/OggOpusEncoder.wasm",
//   WebMOpusEncoderWasmPath:
//     "https://cdn.jsdelivr.net/npm/opus-media-recorder@latest/WebMOpusEncoder.wasm"
// };

// // Existing MediaRecorder is replaced
// window.MediaRecorder = OpusMediaRecorder;

function detectIE() {
  var ua = window.navigator.userAgent;

  // Test values; Uncomment to check result …

  // IE 10
  // ua = 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)';
  
  // IE 11
  // ua = 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko';
  
  // Edge 12 (Spartan)
  // ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36 Edge/12.0';
  
  // Edge 13
  // ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Safari/537.36 Edge/13.10586';

  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

  // other browser
  return false;
}

if (detectIE()) {
  show_popup("К сожалению, ваш браузер не поддерживает технологии, которые активно применялись при создании данного сайта. Как насчет Google Chrome?")
}

$(document).on("click", ".post .action", function(e) {
  e.preventDefault();

  var obj = $(this);
  var post = $(this).closest(".post");

  if($(this).hasClass("share")) {
    if(typeof $(this).data('data-ga-click') !== 'undefined') {
        ga('send', 'event', 'click', $(this).data('data-ga-click'));
    }
    
    url = getShareUrl($(this));
    window.open(url,'','toolbar=0,status=0,width=626,height=500');
  }

  if($(this).hasClass("active")) {
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

$(document).ready(function() {
  $(".wrapper").css("opacity", "1");
});

var wavesurferArray = [];

$(".volume_range").slider({
  value: 50,
  orientation: "horizontal",
  range: "min",
  animate: true,
  slide: function(e, ui) {
    var post = $(this).closest(".track_item");
    var id = post.attr("data-id");

    if (wavesurferArray[id]) {
      wavesurferArray[id].setVolume(ui.value / 100);
    }
  }
})

$(document).on("click", ".track_item .play", function(e) {
  var post = $(this).closest(".track_item");
  var id = post.attr("data-id");
  var audio = post.find("audio")[0];

  console.log(id, "TRACK ID");
  console.log(document.querySelector("#post_" + id + " .spectrogram"));

  if (typeof wavesurferArray[id] == "undefined") {
    wavesurfer = WaveSurfer.create({
      container: document.querySelector("#post_" + id + " .spectrogram"),
      waveColor: "#f7323f",
      progressColor: "#bfbfbf",
      height: 38
    });

    wavesurfer.load(audio.src);
    wavesurferArray[id] = wavesurfer;

    setInterval(function() {
      post.find(".timer_range .current").html(formatTime(wavesurferArray[id].getCurrentTime()));
    }, 100)

    wavesurferArray[id].on("ready", function() {
      wavesurferArray[id].setVolume(0.5);
      console.log(wavesurferArray[id].getDuration());
      wavesurferArray[id].play();
      wavesurferArray[id].seekTo(Math.ceil(wavesurferArray[id].getDuration() / 2));
      $(this).addClass("active");
    });

    wavesurferArray[id].on("finish", function() {
      wavesurferArray[id].seekTo(0);
      $(this).removeClass("active");
    }.bind(this))
  }

  if (!wavesurferArray[id].isPlaying()) {
    wavesurferArray[id].play();
    $(this).addClass("active");
  } else {
    wavesurferArray[id].pause();
    $(this).removeClass("active");
  }
  
});


  // if (audio.paused) {
  //   audio.play();
  //   $(this).removeClass("icon-play");
  //   $(this).addClass("icon-stop");
  // } else {
  //   audio.pause();
  //   $(this).removeClass("icon-stop");
  //   $(this).addClass("icon-play");
  // }

  // audio.ontimeupdate = function() {
  //   post.find(".timer_range .current").html(formatTime(audio.currentTime));
  // };

function formatTime(time) {
  var minutes = parseInt(time / 60, 10);
  var seconds = parseInt(time % 60);
  if (seconds < 10) {
    seconds = "0" + seconds;
  }

  return minutes + ":" + seconds;
}

