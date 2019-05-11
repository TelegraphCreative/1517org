<template>
  <div class="image-slider">
    <ul class="slider-items list-reset">
      <li v-for="(item, index) in items" :key="index" class="slider-item">
        <figure>
          <img :src="item.imageUrl" :alt="item.caption">
        </figure>
        <figcaption v-if="item.caption">
          <p>{{ item.caption }}</p>
        </figcaption>
      </li>
    </ul>
  </div>
</template>
<script>
import { tns } from 'tiny-slider/src/tiny-slider'
export default {
    props: {
        items: {
            type: Array,
            required: true,
        },
    },
    mounted() {
        var slider = tns({
            container: this.$el.querySelector('.slider-items'),
            slideBy: 1,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
        })
    },
}
</script>
