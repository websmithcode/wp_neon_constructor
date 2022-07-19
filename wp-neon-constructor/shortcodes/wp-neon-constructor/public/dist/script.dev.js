"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

document.addEventListener('alpine:init', function () {
  Alpine.data('wnca', function () {
    var _text;

    return {
      init: function init() {
        this.$watch('val.text', this.updateFontSize.bind(this));
        this.fonts = JSON.parse(this.$refs.fonts_json.innerHTML);
        console.log(this.filteredFonts());
        this.setFont(this.fonts[0]);
      },
      fonts: [],
      filteredFonts: function filteredFonts() {
        var _this = this;

        // returns filtered fonts based on font.spelling and this.getSpelling()
        return this.fonts.filter(function (font) {
          return font.spelling.includes(_this.spelling);
        });
      },

      get spelling() {
        // Returns containing spelling like cyr or lat
        return this.val.text.match(/[а-я]/i) ? 'cyr' : 'lat';
      },

      tabs: ["Text", "Font", "Color"],
      activeTab: 'Text',
      cache: {
        loadedFonts: []
      },
      state: {
        color: {
          preview: "",
          detailPreview: ""
        },
        text: {
          __BASE_SIZE: '',
          light: true,
          align: 'center',
          fontSize: '',
          dragStart: {
            x: 0,
            y: 0
          },
          x: 'auto',
          y: "17%"
        }
      },
      // FormValues
      val: {
        text: '',
        font: '',
        color: ''
      },
      setTab: function setTab(tab) {
        this.activeTab = tab;
      },
      setFont: function setFont(font) {
        return regeneratorRuntime.async(function setFont$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (this.cache.loadedFonts.includes(font.name)) {
                  _context.next = 6;
                  break;
                }

                _context.t0 = document.fonts;
                _context.next = 4;
                return regeneratorRuntime.awrap(new FontFace(font.name, "url(".concat(font.link, ")"), {
                  style: 'normal',
                  weight: 700
                }).load());

              case 4:
                _context.t1 = _context.sent;

                _context.t0.add.call(_context.t0, _context.t1);

              case 6:
                this.val.font = font.name;

              case 7:
              case "end":
                return _context.stop();
            }
          }
        }, null, this);
      },
      setColor: function setColor(color) {
        return regeneratorRuntime.async(function setColor$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                this.state.color = color;
                this.val.color = color.color;

              case 2:
              case "end":
                return _context2.stop();
            }
          }
        }, null, this);
      },
      getLightShadow: function getLightShadow() {
        var shadows = ["white 0px 0px 5px", "white 0px 0px 10px", "".concat(this.val.color, " 0px 0px 20px"), "".concat(this.val.color, " 0px 0px 30px"), "".concat(this.val.color, " 0px 0px 40px"), "".concat(this.val.color, " 0px 0px 55px"), "".concat(this.val.color, " 0px 0px 75px")];
        return shadows.join(', ');
      },
      getDarkShadow: function getDarkShadow() {
        var dimStep = 10;
        var color = RGB.from_hex(this.val.color);
        console.log(this.val.color, color, "".concat(color.dim(dimStep).toHex(), " 0px 1px 0px, ").concat(color.dim(dimStep).toHex(), " 0px 2px 0px, ").concat(color.dim(dimStep).toHex(), " 0px 3px 0px, ").concat(color.dim(dimStep).toHex(), " 0px 4px 0px, rgba(0, 0, 0, 0.23) 0px 0px 5px, rgba(0, 0, 0, 0.43) 0px 1px 3px, rgba(0, 0, 0, 0.4) 1px 4px 6px, rgba(0, 0, 0, 0.38) 0px 5px 10px, rgba(0, 0, 0, 0.25) 3px 7px 12px"));
        return "".concat(color.dim(dimStep).toHex(), " 0px 1px 0px, ").concat(color.dim(dimStep).toHex(), " 0px 2px 0px, ").concat(color.dim(dimStep).toHex(), " 0px 3px 0px, ").concat(color.dim(dimStep).toHex(), " 0px 4px 0px, rgba(0, 0, 0, 0.23) 0px 0px 5px, rgba(0, 0, 0, 0.43) 0px 1px 3px, rgba(0, 0, 0, 0.4) 1px 4px 6px, rgba(0, 0, 0, 0.38) 0px 5px 10px, rgba(0, 0, 0, 0.25) 3px 7px 12px");
      },
      toggleLight: function toggleLight(status) {
        this.state.text.light = status;
      },
      elementDrag: function elementDrag(e) {
        var $el = this.$refs.text;
        var $preview = this.$refs.preview;
        e.preventDefault(); // calculate the new cursor position:

        var innerBorderOffset = 10;
        var pos1 = this.state.text.dragStart.x - e.clientX;
        var pos2 = this.state.text.dragStart.y - e.clientY;
        this.state.text.dragStart.x = e.clientX;
        this.state.text.dragStart.y = e.clientY;
        var top = Math.min($preview.clientHeight - $el.clientHeight - innerBorderOffset, Math.max(0 + innerBorderOffset, $el.offsetTop - pos2));
        var left = Math.min($preview.clientWidth - $el.clientWidth - innerBorderOffset, Math.max(0 + innerBorderOffset, $el.offsetLeft - pos1)); // set the element's new position:

        this.state.text.y = top + "px";
        this.state.text.x = left + "px";
      },
      updateFontSize: function updateFontSize() {
        this.state.text.fontSize = this.state.text.__BASE_SIZE = this.fontBaseSize;
        var previewWidth = this.$refs.preview.clientWidth;
        var textWidth = this.$refs.text.clientWidth;
        this.state.text.fontSize = Math.min(this.state.text.__BASE_SIZE, this.state.text.fontSize / (textWidth / previewWidth));
        if (this.val.text.length == 0) this.state.text.fontSize = this.fontBaseSize;
      },

      get fontBaseSize() {
        if (this.state.text.__BASE_SIZE == '') return parseInt(getComputedStyle(this.$refs.text).fontSize.match(/\d*/)[0]);else return this.state.text.__BASE_SIZE;
      },

      text: (_text = {}, _defineProperty(_text, 'x-ref', 'text'), _defineProperty(_text, ':style', "{\n          top: state.text.y,\n          left: state.text.x,\n          fontFamily: val.font,\n          fontSize: state.text.fontSize + 'px',\n          textAlign: state.text.align,\n          textShadow: state.text.light ? getLightShadow() : getDarkShadow(),\n          color: state.text.light ? 'white' : val.color,\n        }"), _defineProperty(_text, 'x-html', "val.text.replaceAll('\\n', '<br>') || 'Your Text'"), _defineProperty(_text, '@mousedown', function mousedown(e) {
        e = e || window.event;
        e.preventDefault(); // get the mouse cursor position at startup:

        this.state.text.dragStart.x = e.clientX;
        this.state.text.dragStart.y = e.clientY;

        document.onmouseup = function () {
          document.onmouseup = null;
          document.onmousemove = null;
        }; // call a function whenever the cursor moves:


        document.onmousemove = this.elementDrag.bind(this);
      }), _text)
    };
  });
});