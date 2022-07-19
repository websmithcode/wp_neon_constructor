document.addEventListener('alpine:init', () => {
  Alpine.data('wnca', () => ({
    init() {
      this.$watch('val.text', this.updateFontSize.bind(this));
      this.$watch('val.text', this.updateSpelling.bind(this));
      this.$watch('state.spelling', (ov, nv) => (nv !== ov) && this.updateFonts());

      this._fonts = JSON.parse(this.$refs.fonts_json.innerHTML);
      this.updateFonts();
    },
    _fonts: [],
    fonts: [],

    tabs: ["Text", "Font", "Color"],
    activeTab: 'Text',
    cache: {
      loadedFonts: []
    },
    state: {
      spelling: 'lat',
      font: null,
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
        y: "17%",
      }
    },

    // FormValues
    val: {
      text: '',
      font: '',
      color: ''
    },

    setTab(tab) {
      this.activeTab = tab;
    },

    async setFont(font) {
      if (!this.cache.loadedFonts.includes(font.name)) {
        document.fonts.add(await (new FontFace(font.name, `url(${font.link})`, { style: 'normal', weight: 700 })).load());
      }
      this.val.font = font.name;
      this.state.font = font
    },
    async setColor(color) {
      this.state.color = color;
      this.val.color = color.color;
    },
    getLightShadow() {
      const shadows = [
        `white 0px 0px 5px`,
        `white 0px 0px 10px`,
        `${this.val.color} 0px 0px 20px`,
        `${this.val.color} 0px 0px 30px`,
        `${this.val.color} 0px 0px 40px`,
        `${this.val.color} 0px 0px 55px`,
        `${this.val.color} 0px 0px 75px`
      ];
      return shadows.join(', ');
    },
    getDarkShadow() {
      const dimStep = 10;
      const color = RGB.from_hex(this.val.color);
      return `${color.dim(dimStep).toHex()} 0px 1px 0px, ${color.dim(dimStep).toHex()} 0px 2px 0px, ${color.dim(dimStep).toHex()} 0px 3px 0px, ${color.dim(dimStep).toHex()} 0px 4px 0px, rgba(0, 0, 0, 0.23) 0px 0px 5px, rgba(0, 0, 0, 0.43) 0px 1px 3px, rgba(0, 0, 0, 0.4) 1px 4px 6px, rgba(0, 0, 0, 0.38) 0px 5px 10px, rgba(0, 0, 0, 0.25) 3px 7px 12px`
    },
    toggleLight(status) {
      this.state.text.light = status;
    },

    elementDrag(e) {
      const $el = this.$refs.text;
      const $preview = this.$refs.preview;

      e.preventDefault();
      // calculate the new cursor position:
      const innerBorderOffset = 10;
      const pos1 = this.state.text.dragStart.x - e.clientX;
      const pos2 = this.state.text.dragStart.y - e.clientY;
      this.state.text.dragStart.x = e.clientX;
      this.state.text.dragStart.y = e.clientY;

      const top = Math.min($preview.clientHeight - $el.clientHeight - innerBorderOffset, Math.max(0 + innerBorderOffset, $el.offsetTop - pos2));
      const left = Math.min($preview.clientWidth - $el.clientWidth - innerBorderOffset, Math.max(0 + innerBorderOffset, $el.offsetLeft - pos1));
      // set the element's new position:
      this.state.text.y = top + "px";
      this.state.text.x = left + "px";
    },

    get fontBaseSize() {
      if (this.state.text.__BASE_SIZE == '')
        return parseInt(getComputedStyle(this.$refs.text).fontSize.match(/\d*/)[0]);
      else return this.state.text.__BASE_SIZE;
    },

    updateFonts() {
      const fontIsNull = this.state.font == null;
      const fontHasCurrentSpelling = !fontIsNull && this.state.font.spelling.includes(this.state.spelling);

      this.fonts = this._fonts.filter(font => font.spelling.includes(this.state.spelling));
      if (fontIsNull || !fontHasCurrentSpelling) this.setFont(this.fonts[0]);
    },

    updateSpelling() {
      this.state.spelling = this.val.text.match(/[а-я]/i) ? 'cyr' : 'lat';
    },
    updateFontSize() {
      this.state.text.fontSize = this.state.text.__BASE_SIZE = this.fontBaseSize;

      const previewWidth = this.$refs.preview.clientWidth;
      const textWidth = this.$refs.text.clientWidth;

      this.state.text.fontSize = Math.min(this.state.text.__BASE_SIZE, this.state.text.fontSize / (textWidth / previewWidth));

      if (this.val.text.length == 0) this.state.text.fontSize = this.fontBaseSize;
    },

    text: {
      ['x-ref']: 'text',

      ':style': `{
          top: state.text.y,
          left: state.text.x,
          fontFamily: val.font,
          fontSize: state.text.fontSize + 'px',
          textAlign: state.text.align,
          textShadow: state.text.light ? getLightShadow() : getDarkShadow(),
          color: state.text.light ? 'white' : val.color,
        }`,
      'x-html': "val.text.replaceAll('\\n', '<br>') || 'Your Text'",
      ['@mousedown'](e) {
        e = e || window.event;
        e.preventDefault();
        // get the mouse cursor position at startup:
        this.state.text.dragStart.x = e.clientX;
        this.state.text.dragStart.y = e.clientY;
        document.onmouseup = () => {
          document.onmouseup = null;
          document.onmousemove = null;
        };
        // call a function whenever the cursor moves:
        document.onmousemove = this.elementDrag.bind(this);
      },
    },

  }))
})