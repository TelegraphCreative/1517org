<template>
  <div>
    <div @click="playVideo" :class="{ hidden: hideImg }">
      <img :src="imgSrc">
    </div>
    <iframe
      :src="`https://player.vimeo.com/video/${vimeoId}`"
      width="640" height="360"
      frameborder="0"
      allow="autoplay; fullscreen"
      allowfullscreen
    />
  </div>
</template>
<script>
  import Player from '@vimeo/player'
  
  export default {
    props: {
      imgSrc: {
        type: String,
        required: true
      },
      videoUrl: {
        type: String,
        required: true
      },
    },
    
    data() {
      return {
        player: null,
        hideImg: false,
      }
    },

    computed: {
      vimeoId() {
        var match = /vimeo.*\/(\d+)/i.exec( this.videoUrl )
        return match[1]
      }
    },

    methods: {
      playVideo() {
        this.player.play()
        this.hideImg = true;
      }
    },

    mounted() {
      const _this = this
      const playerEl = _this.$el
    
      window.addEventListener('load', function () {

        const iframe = playerEl.querySelector('iframe')
        _this.player = new Player(iframe)

        _this.player.on('ended', function() {
          _this.hideImg = false
        })
      })
    }
  }
</script>

<style lang="scss" scoped>
div {
  position: relative;
}
img {
  position: absolute;
}
.hidden {
  display: none;
}
</style>
