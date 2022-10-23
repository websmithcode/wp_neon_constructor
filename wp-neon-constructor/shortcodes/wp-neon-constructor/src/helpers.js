export function getLightShadow(color) {
  const shadows = [
    `white 0px 0px 5px`,
    `white 0px 0px 10px`,
    `${color} 0px 0px 20px`,
    `${color} 0px 0px 30px`,
    `${color} 0px 0px 40px`,
    `${color} 0px 0px 55px`,
    `${color} 0px 0px 75px`,
  ];
  return shadows.join(", ");
}

export function getDarkShadow(dimStep = 10) {
  const color = RGB.from_hex("#aaa");
  const shadows = [
    `${color.dim(dimStep).toHex()} 0px 1px 0px`,
    `${color.dim(dimStep * 2).toHex()} 0px 2px 0px`,
    `${color.dim(dimStep * 3).toHex()} 0px 3px 0px`,
    `${color.dim(dimStep * 4).toHex()} 0px 4px 0px`,
    `rgba(0, 0, 0, 0.23) 0px 0px 5px`,
    `rgba(0, 0, 0, 0.43) 0px 1px 3px`,
    `rgba(0, 0, 0, 0.4) 1px 4px 6px`,
    `rgba(0, 0, 0, 0.38) 0px 5px 10px`,
    `rgba(0, 0, 0, 0.25) 3px 7px 12px`,
  ];
  return shadows.join(", ");
}

export class RGB {
  constructor(rgb = [0, 0, 0]) {
    this.r = rgb[0];
    this.g = rgb[1];
    this.b = rgb[2];
  }
  static from_hex(hex) {
    if (hex.match(/[\w\d]/g).length == 3) {
      var aRgbHex = hex.match(/[\w\d]/g);
      var aRgb = [
        parseInt(aRgbHex[0], 16) * 17,
        parseInt(aRgbHex[1], 16) * 17,
        parseInt(aRgbHex[2], 16) * 17
      ];
    } else {
      var aRgbHex = hex.match(/[\w\d]{2}/g);
      var aRgb = [
        parseInt(aRgbHex[0], 16),
        parseInt(aRgbHex[1], 16),
        parseInt(aRgbHex[2], 16)
      ];
    }
    return new RGB(aRgb);
  }

  toHex() {
    const convertColor = (c) => c.toString(16).padStart(2, '0')
    return `#${convertColor(this.r)}${convertColor(this.g)}${convertColor(this.b)}`
  }

  dim(v) {
    const calc = c => Math.max(0, c - v)
    this.r = calc(this.r);
    this.g = calc(this.g);
    this.b = calc(this.b);
    return this;
  }
  bright(v) {
    const calc = c => Math.min(255, c + v)
    this.r = calc(this.r);
    this.g = calc(this.g);
    this.b = calc(this.b);
    return this;
  }

  toCssRGB() {
    return `rgb(${this.r}, ${this.g}, ${this.b})`
  }
}

export function getSpelling(text) {
  return text.match(/[а-я]/i) ? "cyr" : "lat";
}

export function onDrag(e, $el, $container, dragStart = { x: 0, y: 0 }) {
  e.preventDefault();
  // calculate the new cursor position:
  const innerBorderOffset = 10;
  const pos1 = dragStart.x - e.clientX;
  const pos2 = dragStart.y - e.clientY;

  const top = Math.min(
    $container.clientHeight - $el.clientHeight - innerBorderOffset,
    Math.max(0 + innerBorderOffset, $el.offsetTop - pos2)
  );
  const left = Math.min(
    $container.clientWidth - $el.clientWidth - innerBorderOffset,
    Math.max(0 + innerBorderOffset, $el.offsetLeft - pos1)
  );

  return {
    dragStart: { y: e.clientY, x: e.clientX },
    state: { y: top + "px", x: left + "px" }
  }
}