<template>
  <div>
    <!-- john: was having issues with video loading before img, "|| false" and v-cloak -->
    <!--       were attempts to fix this. open to suggestions -->
    <div @click="playVideo" :class="{ hidden: hideImg || false }">
      <img :src="imgSrc">
    </div>
    <slot v-cloak />
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
    },
    
    data() {
      return {
        player: null,
        hideImg: false,
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
