<?php

namespace WPNeonConstructor;
?>
<div id="wnca" x-data="wnca" x-cloak>
  <div class="form">
    <div class="constructor-form">
      <div class="header">
        <ul class="tabs">
          <template x-for="tab in tabs">
            <li class="tab" :class="{active: activeTab==tab}" @hover="alert('hover')">
              <button x-text="tab" @click="setTab(tab)"></button>
            </li>
          </template>
        </ul>
      </div>
      <div class="content">
        <div class="tab-content">
          <div class="text" x-show="activeTab=='Text'" x-transition.in.duration.600>
            <textarea x-model="val.text" placeholder="ENTER TEXT HERE
Press Enter/Return for a new line"></textarea>
            <div class="buttons">
              <button class="align-left" :class="{active: 'left' ==state.text.align}" @click="state.text.align = 'left'"><span class="dashicons dashicons-editor-alignleft"></span></button>
              <button class="align-center" :class="{active: 'center' ==state.text.align}" @click="state.text.align = 'center'"><span class="dashicons dashicons-editor-aligncenter"></span></button>
              <button class="align-right" :class="{active: 'right' == state.text.align}" @click="state.text.align = 'right'"><span class="dashicons dashicons-editor-alignright"></span></button>
            </div>
          </div>
          <div class="fonts" x-show="activeTab=='Font'" x-transition.in.duration.600>
            <div class="title">Choose font</div>
            <script type="json" x-ref="fonts_json">
              <?php echo json_encode(array_map(function ($font) {
                return ['name' => $font['name'], 'preview' => $font['preview']['sizes']['FontPreview'], 'link' => $font['file']['url']];
              }, $settings['fonts'])); ?>
          </script>
            <div class="fonts-items" x-data="{fonts: JSON.parse($refs.fonts_json.innerHTML)}" x-init="setFont(fonts[0])">
              <template x-for="font in fonts">
                <div class="font" @click="setFont(font)" :class="{active: font.name == val.font}">
                  <img :src="font.preview" :alt="font.name">
                </div>
              </template>
            </div>
          </div>
          <div class="colors" x-show="activeTab=='Color'" x-transition.in.duration.600>
            <script type="json" x-ref="colors_json">
              <?php echo json_encode(array_map(function ($color) {
                return [
                  'name' => $color['name'],
                  'color' => $color['color'],
                  'description' => $color['description'],
                  'preview' => $color['preview']['sizes']['NeonPreview'],
                  'detailPreview' => $color['detail-preview']['url']
                ];
              }, $settings['colors'])); ?>
          </script>
            <div class="color-items" x-data="{colors: JSON.parse($refs.colors_json.innerHTML)}" x-init="setColor(colors[0]);">
              <template x-for="color in colors">
                <div class="color" :class="{active: color.color == val.color}" @click="setColor(color)">
                  <div class="icon" :style="{color: color.color}">
                    <i class="dashicons dashicons-lightbulb"></i>
                    <i class="w dashicons dashicons-lightbulb"></i>
                  </div>
                  <div class="color-name" x-text="color.name"></div>
                </div>
              </template>
            </div>
            <div class="color-preview">
              <div class="desc" x-html="state.color.description" x-show="state.color.description"></div>
              <img :src="state.color.preview" :alt="state.color.name" x-show="state.color.preview">
              <div class="link" x-show="state.color.detailPreview"><strong>Detail preview:</strong> <a :href="state.color.detailPreview">Photos of <span x-text="state.color.name"></span></a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer">
        <button @click="$refs.feedbackForm.scrollIntoView()"><?php echo $settings['submit_text']; ?></button>
      </div>
    </div>
  </div>
  <div class="preview-wrapper">
    <div class="preview" style="background-image: url(<?php echo $settings['background_image']['url']; ?>);" x-ref="preview">
      <div class="switcher" x-data="{enabled: true}" :class="{off: !enabled}" @click="toggleLight(enabled = !enabled);">
        <div class="off">Off</div>
        <div class="on">On</div>
      </div>
      <div class="text" x-bind="text"></div>
    </div>
  </div>

  <div id="wnca-form" class="feedback-form" x-ref="feedbackForm">
    <div class="form-body">
      <?php echo $settings['popup_form'] ?>
    </div>
    <div class="fields">
      <input type="text" x-model="val.text" name="text" hidden>
      <input type="text" x-model="val.font" name="font" hidden>
      <input type="text" x-model="val.color" name="color" hidden>
    </div>
  </div>
</div>