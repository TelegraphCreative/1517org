<template>
  <div v-click-outside="hide">
    <nav aria-label="1517 Main Menu" class="site-menu" :class="{'-active' : isActive}">
      <div class="site-menu__container | container">
        <!-- Group -->
        <div class="site-menu__group -primary | flex-grid">
          <!-- Toggle -->
          <div
            @click="toggleMenu"
            class="site-menu__toggle | btn--toggle"
            :class="{'-active' : isActive}"
          >
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>

          <!-- Logo -->
          <a href="/" class="site-menu__logo | flex items-center">
            <slot name="logo"></slot>
          </a>
        </div>

        <!-- Group -->
        <div class="site-menu__group -secondary | flex items-center">
          <ul class="menu-bar">
            <li class="site-menu__cart">
              <a href="/shop/cart">
                <span class="badge" :data-item-count="cart.itemcount">{{ cart.itemcount }}</span>
                <cart_icon :classes=" 'icon -sm mr-2' "/>
              </a>
            </li>

            <li @click="toggleMenu" class="site-menu__search" :class="{'-active' : isActive}">
              <button class="text-slate hover:text-red">
                <search_icon :classes=" 'icon -sm mr-2' "/>
              </button>
            </li>

            <li>
              <a href="/donate" class="btn -sm">Donate</a>
            </li>
          </ul>
        </div>
      </div>

      <transition name="fade" v-on:enter="enter" v-on:leave="leave">
        <div v-if="isActive" class="site-menu__dropdown | space-b">
          <div class="site-menu__dropdown-search | bg-ivory-lightest | gutter">
            <search_menu :opt="{ 'query': query, 'classes': 'container md:w-4/5 mx-auto' }"></search_menu>
          </div>

          <div class="site-menu__dropdown-groups container gutter-md | md:flex-grid">
            <slot name="menu"></slot>
          </div>
        </div>
      </transition>
    </nav>
  </div>
</template>

<script type="text/babel">
import click_outside from '../directives/ClickOutslide'
import search_icon from '../icons/icon-search'
import cart_icon from '../icons/icon-cart'
import search_menu from './SearchMenu'
//import scrollLock from 'body-scroll-lock'
import {
    disableBodyScroll,
    enableBodyScroll,
    clearAllBodyScrollLocks,
} from 'body-scroll-lock'

export default {
    props: {
        cart: {
            type: Object,
            required: false,
            default() {
                return {}
            },
        },
        opt: {
            type: Object,
            required: false,
            default() {
                return {}
            }
        },
    },
    data() {
        return {
            isActive: false,
            query: this.opt.query,
        }
    },
    mounted() {
        // Handle Escape
        document.body.addEventListener('keyup', e => {
            if (e.keyCode === 27) {
                this.isActive = false
            }
        })
    },
    methods: {
        hide() {
            this.isActive = false
        },

        enter() {
            const scrollable = this.$el.querySelector('.site-menu__dropdown')
            console.log(scrollable)
            disableBodyScroll(scrollable)
        },

        leave() {
            const scrollable = this.$el.querySelector('.site-menu__dropdown')
            enableBodyScroll(scrollable)
        },

        toggleMenu() {
            // setTimeout(function(){
            //   const scrollable = this.$el.querySelector('.site-menu__dropdown');
            // }, 600)

            // Handle Toggle
            if (!this.isActive) {
                // Open
                this.isActive = true
            } else {
                // Close
                this.isActive = false
            }
        },
    },
    directives: {
        'click-outside': click_outside,
    },

    components: {
        search_menu,
        search_icon,
        cart_icon,
    },
}
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
/* .fade-right-enter-active, .fade-right-leave-active {
        transition: .3s cubic-bezier(0.71, -0.01, 0.25, 0.65) transform;
    }
    .fade-right-enter, .fade-right-leave-to {
        transform: translate(100%, 0);
    } */
</style>

