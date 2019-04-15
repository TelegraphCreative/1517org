<template>
  <div>
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
            Listen
            {{ player.duration | secondsToTime }}
          </template>
        </span>
      </span>
    </a>
    <audio
      :src="audioUrl"
      @timeupdate="updateCurrentTime"
      @ended="resetPlayer"
      class="hidden"
      controls
    >
        Your browser does not support the <code>audio</code> element.
    </audio>
  </div>
</template>
<script>
  import play_icon from '../icons/icon-play'
  import pause_icon from '../icons/icon-pause'
  
  export default {
    props: {
      audioUrl: {
        type: String,
        required: true,
      },
    },
    
    data() {
      return {
        player: null,
        playing: false,
        currentTime: 0,
      }
    },

    methods: {
      togglePlayback() {
        if (this.playing) {
          this.player.pause()
          this.playing = false
        } else {
          this.player.play()
          this.playing = true
        }
      },

      updateCurrentTime() {
        if (!this.player) return
        this.currentTime = this.player.currentTime
      },

      resetPlayer() {
        this.togglePlayback()
        this.player.currentTime = 0
      },

    },

    mounted() {
      const _this = this
      const playerEl = _this.$el
    
      window.addEventListener('load', function () {
        _this.player = playerEl.querySelector('audio')
      })
    },

    components: {
      play_icon,
      pause_icon,
    }
  }
</script>