<template>
  <div class="search-form | form-base" :class="[query ? '-query' : '', classes]">
    <form action="/static/search-results">
      <div class="field-group">
        <input v-model="query" type="search" id="search" name="q" class="search-input">
        <label class="search-label | flex items-center" for="search">
          <search_icon :classes=" 'icon -sm | hover:bronze | mr-4' "/>Search 1517
        </label>

        <button class="submit" v-if="query">
          <search_icon :classes=" 'icon -sm | hover:bronze | mr-4' "/>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import search_icon from '../icons/icon-search'

export default {
    props: {
        opt: {
            type: Object,
            required: false,
            default() {
                return {}
            },
        },
    },
    data() {
        return {
            query: this.opt.query,
        }
    },
    computed: {
        classes: function() {
            return this.opt.classes
        },
    },
    components: {
        search_icon,
    },
}
</script>
