import { getDarkShadow, getLightShadow, onDrag } from "./helpers";

document.addEventListener("alpine:init", () => {
  Alpine.data("wnca", () => ({
    init() {
      this.colors = JSON.parse(this.$refs.colors_json.innerHTML);
      this.$watch("val.text", () => this.onTextChange());
      this.$watch("val.font", () => this.onFontChange());
      this.$watch("state.spelling", () => this.onSpellingChange());

      this._fonts = JSON.parse(this.$refs.fonts_json.innerHTML);
      this.updateFonts();
    },
    _fonts: [],
    fonts: [],
    colors: [],

    getColorByHex(hex) {
      return this.colors.find((i) => i.color == hex);
    },

    tabs: ["Text", "Font", "Color"],
    activeTab: "Text",
    cache: {
      loadedFonts: [],
    },
    state: {
      spelling: "lat",
      font: null,
      color: {
        preview: "",
        detailPreview: "",
      },
      text: {
        light: true,
        align: "center",
        fontSize: "",
        dragStart: {
          x: 0,
          y: 0,
        },
        x: "auto",
        y: "17%",
      },
    },

    // FormValues
    val: {
      text: "",
      font: "",
      color: "",
    },

    onTextChange() {
      this.updateFontSize();
      this.updateSpelling();
    },
    onFontChange() {
      this.updateFontSize();
    },
    onSpellingChange(ov, nv) {
      if (nv !== ov) this.updateFonts();
    },
    onColorChange(color) {
      this.setColor(color);
    },
    onTabChange(tab) {
      this.setTab(tab);
    },

    setTab(tab) {
      this.activeTab = tab;
    },

    async setFont(font) {
      if (!this.cache.loadedFonts.includes(font.name)) {
        document.fonts.add(
          await new FontFace(font.name, `url(${font.link})`, {
            style: "normal",
            weight: 700,
          }).load()
        );
      }
      this.val.font = font.name;
      this.state.font = font;
      this.updateFontSize();
    },
    async setColor(color) {
      this.state.color = color;
      this.val.color = color.color;
    },
    getLightShadow() {
      return getLightShadow(this.val.color);
    },
    getDarkShadow() {
      return getDarkShadow()
    },
    toggleLight(status) {
      this.state.text.light = status;
    },

    onTextDrag(e) {
      const { dragStart, state } = onDrag(e, this.$refs.text, this.$refs.preview, this.state.text.dragStart);
      this.state.text.dragStart = dragStart;
      this.state.text.x = state.x;
      this.state.text.y = state.y;
    },

    get fontBaseSize() {
      return this.state.font.base_size;
    },

    updateFonts() {
      const fontIsNull = this.state.font == null;
      const fontHasCurrentSpelling =
        !fontIsNull && this.state.font.spelling.includes(this.state.spelling);

      this.fonts = this._fonts.filter((font) =>
        font.spelling.includes(this.state.spelling)
      );
      if (fontIsNull || !fontHasCurrentSpelling) this.setFont(this.fonts[0]);
    },

    updateSpelling() {
      this.state.spelling = this.val.text.match(/[а-я]/i) ? "cyr" : "lat";
    },
    updateFontSize() {
      const previewWidth = this.$refs.preview.clientWidth;
      const textWidth = this.$refs.text.clientWidth;

      this.state.text.fontSize = Math.min(
        this.fontBaseSize,
        this.state.text.fontSize / (textWidth / previewWidth)
      );

      if (this.val.text.length == 0)
        this.state.text.fontSize = this.fontBaseSize;

      // If text is out of preview - move it to right by delta of collision
      if (parseInt(this.state.text.x) + textWidth > previewWidth) {
        this.state.text.x = previewWidth - textWidth + 'px';
      }
    },

    text: {
      ["x-ref"]: "text",

      ":style": `{
          top: state.text.y,
          left: state.text.x,
          fontFamily: val.font,
          fontSize: state.text.fontSize + 'px',
          textAlign: state.text.align,
          textShadow: state.text.light ? getLightShadow() : getDarkShadow(),
          color: state.text.light ? 'white' : val.color,
        }`,
      "x-html": "val.text.replaceAll('\\n', '<br>') || 'Your Text'",
      ["@mousedown"](e) {
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
        document.onmousemove = this.onTextDrag.bind(this);
      },
    },
  }));
});
