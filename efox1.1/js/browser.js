(function (c) {
    var d = (function () {
        var a = {
            mobile: "mobile",
            desktop: "desktop",
            js: "js",
            responsive: "responsive",
            touch: "touch"
        };
        var g = navigator.userAgent,
            b = document.documentElement;
        var h = a.desktop;
        return {
            initialize: function () {
                var e = b.className;
                var f;
                b.className = e.replace("no-js", a.js);
                if (this.isIE()) {
                    ieVersion = this.ieVersion();
                    b.className += " ie";
                    if (ieVersion < 9) {
                        b.className += " ie7"
                    } else {
                        if (8 < ieVersion && ieVersion < 11) {
                            b.className += " ie9"
                        }
                    }
                }
                if (this.isFirefox()) {
                    b.className += " mozilla"
                }
                if (g && this.isiPhone(g) && this.iOSVersion(g) >= 6 && typeof b.classList === "object") {
                    b.classList.add(a.mobile);
                    b.classList.remove(a.desktop);
                    h = a.mobile
                }
                if (this.isMobile(g) || this.isiPad(g) || this.isAndroid(g)) {
                    b.className += " " + a.responsive
                }
                b.className += " " + (this.isTouch() ? a.touch : "no-" + a.touch)
            },
            getExperience: function () {
                return h
            },
            isWebKit: function (e) {
                return e.match(/AppleWebKit/i)
            },
            isiPad: function (e) {
                return this.isWebKit(e) && e.match(/iPad/i)
            },
            isiPhone: function (e) {
                return this.isWebKit(e) && e.match(/iPhone/i)
            },
            isiPod: function (e) {
                return e.match(/iPod/i)
            },
            isMobile: function (e) {
                return this.isWebKit(e) && e.match(/Mobile/i) && !this.isiPad(e)
            },
            iOSVersion: function (e) {
                return this.isMobile(e) || this.isiPad(e) ? parseFloat(e.match(/os ([\d_]*)/i)[1].replace("_", ".")) : 0
            },
            isTouch: function () {
                return ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch
            },
            isIE: function () {
                var e = "MSIE";
                return (g.indexOf(e) !== -1) ? "IE" : false
            },
            isFirefox: function () {
                return g.indexOf("Firefox") > -1
            },
            isAndroid: function () {
                return g.indexOf("Android") > -1
            },
            ieVersion: function () {
                var e = window.navigator.userAgent;
                var f = "MSIE";
                var j = e.indexOf(f);
                return parseFloat(e.substring(j + f.length + 1))
            }
        }
    })();
    d.initialize()
})(window);