<template>
  <div class="cookie-toaster-wrap">
    <transition name="fadeDown">
      <section
        v-if="active"
        class="cookie-toaster w-full fixed pin-b pin-l p-6 bg-slate-dark z-20 text-white"
      >
        <div class="container--xs gutter--xl | md:flex-grid items-center">
          <header class="cookie-consent__header | paragraphs -xs">
            <h2 class="header-sm font-serif">{{ header }}</h2>
            <p>{{ description }}</p>
          </header>
          <div class="cookie-consent__action | button-group">
            <button @click="optIn" class="btn -sm -light" v-html="optin"></button>
            <button @click="optOut" class="btn -sm -outline" v-html="optout"></button>
          </div>
        </div>
      </section>
    </transition>
  </div>
</template>
<script>
export default {
    props: {
        header: {
            required: true,
            default: 'Do you like cookies?',
        },
        description: {
            required: true,
            default: 'We have good cookies and follow a strict be nice policy.',
        },
        optout: {
            required: true,
            default: "That's fine",
        },
        optin: {
            required: true,
            default: 'No thanks',
        },
    },
    data() {
        return {
            tracking: false,
            active: true,
        }
    },
    methods: {
        hideToaster() {
            this.active = false
        },

        optIn() {
            document.cookie =
                'tracking=true; expires=Fri, 31 Dec 2024 23:59:59 GMT'
            this.tracking = true
            this.hideToaster()
        },
        optOut() {
            this.tracking = false
            this.hideToaster()
        },
    },
    components: {
        // close_icon,
    },
}
</script>

<style>
.cookie-toaster {
    box-shadow: -2px 0 8px 0 rgba(0, 0, 0, 0.22);
}
.fadeDown-enter-active,
.fadeDown-leave-active {
    transition: opacity 0.5s;
}
.fadeDown-enter,
.fadeDown-leave-to {
    opacity: 0;
}
</style>
