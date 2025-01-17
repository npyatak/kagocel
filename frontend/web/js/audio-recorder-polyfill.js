(function() {
  var b,
    d,
    e = {},
    f = window.AudioContext || window.webkitAudioContext;
  function g(e) {
    var t = e
        .toString()
        .replace(/^function\s*\(\)\s*{/, "")
        .replace(/}$/, ""),
      r = new Blob([t]);
    return new Worker(URL.createObjectURL(r));
  }
  function c(e) {
    var t = new Event("error");
    return (t.data = new Error("Wrong state for " + e)), t;
  }
  function a(e) {
    (this.stream = e),
      (this.state = "inactive"),
      (this.em = document.createDocumentFragment()),
      (this.encoder = g(a.encoder));
    var t = this;
    this.encoder.addEventListener("message", function(e) {
      var r = new Event("dataavailable");
      (r.data = new Blob([e.data], { type: t.mimeType })),
        t.em.dispatchEvent(r),
        "inactive" === t.state && t.em.dispatchEvent(new Event("stop"));
    });
  }
  var h = {};
  h = function() {
    var t = 2,
      e = [];
    onmessage = function(n) {
      "encode" === n.data[0]
        ? (function(n) {
            for (
              var s = n.length, i = new Uint8Array(s * t), a = 0;
              a < s;
              a++
            ) {
              var r = a * t,
                U = n[a];
              U > 1 ? (U = 1) : U < -1 && (U = -1),
                (U *= 32768),
                (i[r] = U),
                (i[r + 1] = U >> 8);
            }
            e.push(i);
          })(n.data[1])
        : (function(n) {
            var s = e.length ? e[0].length : 0,
              i = e.length * s,
              a = new Uint8Array(44 + i),
              r = new DataView(a.buffer);
            r.setUint32(0, 1380533830, !1),
              r.setUint32(4, 36 + i, !0),
              r.setUint32(8, 1463899717, !1),
              r.setUint32(12, 1718449184, !1),
              r.setUint32(16, 16, !0),
              r.setUint16(20, 1, !0),
              r.setUint16(22, 1, !0),
              r.setUint32(24, n, !0),
              r.setUint32(28, n * t, !0),
              r.setUint16(32, t, !0),
              r.setUint16(34, 8 * t, !0),
              r.setUint32(36, 1684108385, !1),
              r.setUint32(40, i, !0);
            for (var U = 0; U < e.length; U++) a.set(e[U], U * s + 44);
            (e = []), postMessage(a.buffer, [a.buffer]);
          })(n.data[1]);
    };
  };
  (a.prototype = {
    mimeType: "audio/wav",
    start: function(e) {
      if ("inactive" !== this.state) return this.em.dispatchEvent(c("start"));
      (this.state = "recording"),
        b || (b = new f()),
        (this.clone = this.stream.clone());
      var t = b.createMediaStreamSource(this.clone);
      d = b.createScriptProcessor(2048, 1, 1);
      var r = this;
      (d.onaudioprocess = function(e) {
        "recording" === r.state &&
          r.encoder.postMessage(["encode", e.inputBuffer.getChannelData(0)]);
      }),
        t.connect(d),
        d.connect(b.destination),
        this.em.dispatchEvent(new Event("start")),
        e &&
          (this.slicing = setInterval(function() {
            "recording" === r.state && r.requestData();
          }, e));
    },
    stop: function() {
      return "inactive" === this.state
        ? this.em.dispatchEvent(c("stop"))
        : (this.requestData(),
          (this.state = "inactive"),
          this.clone.getTracks().forEach(function(e) {
            e.stop();
          }),
          clearInterval(this.slicing));
    },
    pause: function() {
      return "recording" !== this.state
        ? this.em.dispatchEvent(c("pause"))
        : ((this.state = "paused"), this.em.dispatchEvent(new Event("pause")));
    },
    resume: function() {
      return "paused" !== this.state
        ? this.em.dispatchEvent(c("resume"))
        : ((this.state = "recording"),
          this.em.dispatchEvent(new Event("resume")));
    },
    requestData: function() {
      return "inactive" === this.state
        ? this.em.dispatchEvent(c("requestData"))
        : this.encoder.postMessage(["dump", b.sampleRate]);
    },
    addEventListener: function() {
      this.em.addEventListener.apply(this.em, arguments);
    },
    removeEventListener: function() {
      this.em.removeEventListener.apply(this.em, arguments);
    },
    dispatchEvent: function() {
      this.em.dispatchEvent.apply(this.em, arguments);
    }
  }),
    (a.isTypeSupported = function(e) {
      return /audio\/wave?/.test(e);
    }),
    (a.notSupported = !navigator.mediaDevices || !f),
    (a.encoder = h),
    (e = a);
  document.addEventListener("DOMContentLoaded", function() {}),
    (window.MediaRecorder = e);
})();
