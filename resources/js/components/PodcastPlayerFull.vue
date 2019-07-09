<template>
  <div class="flex w-full bg-ivory-light relative">
    <!-- class="btn -xs -media -has-icon" -->
    <a
      @click.prevent="togglePlayback"
      :class="{ 'bg-slate-dark': playing, 'bg-bronze': !playing }"
      class="text-white sm:h-24 w-24 relative float-left"
      href="#"
    >
      <span class="h-6 w-6 center-xy">
        <pause_icon v-if="playing"/>
        <play_icon v-else/>
      </span>
    </a>
    <div class="w-1/2 ml-5 mt-5 mb-5 | sm:ml-12 sm:mt-8 sm:pb-0 float-left">
      <div class="uppercase text-xs font-medium">{{ source }}</div>
      <span class>
        {{ title }}
        <span class="btn__text" v-if="player">
          <template v-if="playing">{{ currentTime | secondsToTime }}</template>
          <template v-else>{{ player.duration | secondsToTime }}</template>
        </span>
      </span>
    </div>
    <div class="bg-bronze-lighter h-1 absolute pin-b ml-24" style="width: calc(100% - 6rem)">
      <div id="progress-bar" class="bg-bronze-dark h-1" :style="`width: ${progress}%`"></div>
    </div>
    <div class="clearfix"></div>
    <audio :src="url" @timeupdate="updateCurrentTime" @ended="resetPlayer" class="hidden" controls>
      Your browser does not support the
      <code>audio</code> element.
    </audio>
  </div>
</template>
<script>
import play_icon from '../icons/icon-play-sharp'
import pause_icon from '../icons/icon-pause'

export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        source: {
            type: String,
            required: true,
            default: '1517 Blogcast',
        },
        url: {
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
            if (this.currentTime) {
                return (this.currentTime / this.player.duration) * 100
            } else {
                return 0
            }
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
            }
        },

        updateCurrentTime() {
            if (!this.player) return
            // performace/sustainability tweak so that we don't update ~4 times/sec
            let playerTime = Math.round(this.player.currentTime)
            if (playerTime > this.currentTime) {
                this.currentTime = playerTime
            }
        },

        resetPlayer() {
            this.togglePlayback()
            this.player.currentTime = 0
        },
    },

    mounted() {
        const _this = this
        const playerEl = _this.$el

        window.addEventListener('load', function() {
            _this.player = playerEl.querySelector('audio')
        })
    },

    components: {
        play_icon,
        pause_icon,
    },
}
</script>