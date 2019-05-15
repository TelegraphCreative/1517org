// Vue
window.Vue = require('vue')

// Imports
import lazysizes from 'lazysizes'
import site_menu from './components/SiteMenu'
import search_menu from './components/SearchMenu'
import select_box from './components/SelectBox'
import date_picker from './components/DatePicker'
import video_player_full from './components/VideoPlayerFull'
import video_content_card from './components/VideoContentCard'
import podcast_player_compact from './components/PodcastPlayerCompact'
import podcast_player_full from './components/PodcastPlayerFull'
import image_slider from './components/ImageSlider'
import seconds_to_time_filter from './filters/SecondsToTime'
import print from './components/Print'
import share from './components/Share'
import dropcap from './components/DropCap'

// Vue App
const app = new Vue({
    el: '#app',

    components: {
        site_menu,
        search_menu,
        select_box,
        date_picker,
        video_player_full,
        video_content_card,
        podcast_player_compact,
        podcast_player_full,
        image_slider,
        print,
        share,
    },
})

// Other Initializations
dropcap()
