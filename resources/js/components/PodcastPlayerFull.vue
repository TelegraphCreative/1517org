<template>
  <div class="w-full bg-ivory-light relative">
      <!-- class="btn -xs -media -has-icon" -->
    <a
      @click.prevent="togglePlayback"
      :class="{ 'bg-slate-dark': playing, 'bg-bronze': !playing }"
      class="text-white h-24 w-24 relative float-left"
      href="#"
    >
      <span class="h-6 w-6 center-xy">
        <pause_icon v-if="playing" />
        <play_icon v-else />
      </span>
    </a>
    <div class="ml-12 mt-8 float-left">
      <div class="uppercase text-xs font-medium">1517 Blogcast</div>
      <span class="">
        {{ title }}
        <span class="btn__text" v-if="player">
          <template v-if="playing">
            {{ currentTime | secondsToTime }}
          </template>
          <template v-else>
            {{ player.duration | secondsToTime }}
          </template>
        </span>
      </span>
    </div>
    <div
      class="bg-bronze-lighter h-1 absolute pin-b ml-24"
      style="width: calc(100% - 6rem)"
    >
      <div
        id="progress-bar"
        class="bg-bronze-dark h-1"
        :style="`width: ${progress}%`"
      ></div>
    </div>
    <div class="clearfix"></div>
    <audio
      :src="`https://s3.us-east-2.amazonaws.com/1517-podcast-files/${filename}`"
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
      title: {
        type: String,
        required: true,
      },
      filename: {
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

    computed: {
      progress() {
        if (this.playing) {
          return this.currentTime / this.player.duration * 100
        } else {
          return 0
        }
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