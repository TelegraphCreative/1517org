<template>
  <div class="w-screen max-w-full relative">
    <div
      class="text-white hover:text-red cursor-pointer"
      :class="{ hidden: hideImg }"
      @click="playVideo"
    >
      {{ videoUrl }}
      <play_icon :classes=" 'icon -md absolute z-20 align-yx' "/>
      <img :src="imgSrc" class="absolute w-screen max-w-full z-10 mt-2">
    </div>
    <div :style="`padding:${aspectRatio}% 0 0 0`" class="relative">
      <iframe
        :src="`https://player.vimeo.com/video/${vimeoId}`"
        class="absolute pin-t pin-l w-full h-full max-w-full"
        frameborder="0"
        allow="autoplay; fullscreen"
        allowfullscreen
      ></iframe>
    </div>
  </div>
</template>
<script>
import play_icon from '../icons/icon-play'
import Player from '@vimeo/player'

export default {
    props: {
        imgSrc: {
            type: String,
            required: true,
        },
        videoUrl: {
            type: String,
            required: true,
        },
        aspectRatio: {
            type: String,
            required: true,
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
            const match = /vimeo.*\/(\d+)/i.exec(this.videoUrl)
            return match[1]
        },
        // calculatedVideoHeight() {
        //   return `calc(100vw * (${this.aspectRatio} * 0.01))`
        // }
    },

    methods: {
        playVideo() {
            this.player.play()
            this.hideImg = true
        },
    },

    mounted() {
        const _this = this
        const playerEl = _this.$el

        window.addEventListener('load', function() {
            const iframe = playerEl.querySelector('iframe')
            _this.player = new Player(iframe)

            _this.player.on('ended', function() {
                _this.hideImg = false
            })
        })
    },

    components: {
        play_icon,
    },
}
</script>