<template>
  <div class="content-card__container | flex-grid md:flex-row-reverse mb-4">
    <a href="#" @click.prevent="" class="content-card__media relative cursor-default">
      <img
        :src="imgSrc"
        :class="{ hidden: hideImg }"
        class="-is2x1 -fit-cover -hover-scale absolute z-10 mt-2"
      />
      <div :style="`padding:${aspectRatio}% 0 0 0`" class="relative">
        <iframe
          :src="`https://player.vimeo.com/video/${vimeoId}`"
          class="absolute pin-t pin-l w-full h-full"
          frameborder="0"
          allow="autoplay; fullscreen"
          allowfullscreen
        ></iframe>
      </div>
    </a>

    <div class="content-card__content"> 

      <slot name="main"></slot>

      <div class="content-card__action -play-podcast | mb-6">
        <a
          v-if="player"
          @click.prevent="togglePlayback"
          class="btn -xs -media -has-icon"
          href="#"
        >
          <span class="align-items-center">
            <pause_icon v-if="playing" />
            <play_icon v-else />
            <span class="btn__text">
              <template v-if="playing">
                Pause
                {{ currentTime | secondsToTime }}
              </template>
              <template v-else>
                Watch
                {{ duration | secondsToTime }}
              </template>
            </span>
          </span>
        </a>
      </div>

      <slot name="related-topics"></slot>

    </div>
  </div>
</template>
<script>
  import play_icon from '../icons/icon-play'
  import pause_icon from '../icons/icon-pause'
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
        hideImg: false,
        playerEl: null,
        player: null,
        duration: 0,
        playing: false,
        currentTime: 0,
        videoWidth: 0,
        videoHeight: 0,
      }
    },

    computed: {
      vimeoId() {
        const match = /vimeo.*\/(\d+)/i.exec( this.videoUrl )
        return match[1]
      },
    },

    methods: {
      togglePlayback() {
        if (this.playing) {
          this.player.pause()
          this.playing = false
        } else {
          this.player.play()
          this.playing = true
          this.hideImg = true
        }
      },

      resetPlayer() {
        this.playing = false
        this.player.setCurrentTime(0)
        this.hideImg = false
      },
    },

    mounted() {
      const _this = this
    
      window.addEventListener('load', function () {

        _this.playerEl = _this.$el.querySelector('iframe')
        _this.player = new Player(_this.playerEl)

        _this.player.getDuration().then((duration) => {
          _this.duration = duration
        })

        _this.player.on('ended', function() {
          _this.resetPlayer()
        })

        _this.player.on('pause', function() {
          _this.playing = false
        })

        _this.player.on('play', function() {
          _this.playing = true
        })

        _this.player.on('timeupdate', function(data) {
          _this.currentTime = data.seconds
        })

        _this.player.on('seeked', function(data) {
          _this.currentTime = data.seconds
        })

      })
    },

    components: {
      play_icon,
      pause_icon,
    }
  }
</script>