<?php

namespace WPNeonConstructor;
?>
<div id="wnca" x-data="wnca" x-cloak>
  <script type="json" x-ref="colors_json">
    <?php echo json_encode($colors); ?>
  </script>
  <div class="form">
    <div class="constructor-form">
      <div class="header">
        <ul class="tabs">
          <template x-for="tab in tabs">
            <li class="tab" :class="{active: activeTab==tab}" @hover="alert('hover')">
              <button x-text="tab" @click="onTabChange(tab)"></button>
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
              <?php echo json_encode($fonts); ?>
          </script>
            <div class="fonts-items">
              <template x-for="font in fonts">
                <div class="font" @click="setFont(font)" :class="{active: font.name == val.font}">
                  <div class="img-wrap">
                    <img :src="font.preview" :alt="font.name">
                  </div>
                </div>
              </template>
            </div>
          </div>
          <div class="colors" x-show="activeTab=='Color'" x-transition.in.duration.600>
            <div class="color-items" x-data="{}" x-init="onColorChange(colors[0]);">
              <template x-for="color in colors">
                <div class="color" :class="{active: color.color == val.color}" :data-color="color.color" @click="onColorChange(color)">
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
      </div>
    </div>
  </div>
  <div class="preview-container">
    <div class="preview-wrapper">
      <div class="preview" style="background-image: url(<?php echo $settings['background_image']['url']; ?>);" x-ref="preview">
        <div class="switcher" x-data="{enabled: true}" :class="{off: !enabled}" @click="toggleLight(enabled = !enabled);">
          <div class="off">Off</div>
          <div class="on">On</div>
        </div>
        <div class="text" x-bind="text"></div>
      </div>
    </div>
  </div>
  
  <template x-teleport="#wnca-form form">
    <div class="fields">
      <input type="text" :value="val.text  || 'Your text (Default value)'" name="text" hidden>
      <input type="text" :value="val.font" name="font" hidden>
      <input type="text" :value="getColorByHex(val.color).name" name="color" hidden>
      <input type="text" :value="val.color" name="color_hex" hidden>
    </div>
  </template>
  <div id="wnca-form" class="feedback-form" x-ref="feedbackForm">
    <div class="form-body">
      <?php echo $settings['popup_form'] ?>
    </div>
  </div>
</div>
