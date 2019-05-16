<template>
  <div>
    <transition name="fade" mode="out-in">
      <div v-if="formSent" key="success">
        <slot name="success"></slot>
      </div>
      <div v-else key="default">
        <slot name="default"></slot>
        <form @submit.prevent="handleSubmit" accept-charset="UTF-8" class="form-base">
          <slot name="fields"></slot>
        </form>
      </div>
    </transition>
  </div>
</template>
<script>
import { Validation } from '../vendor/Validation'
import anime from 'animejs'

export default {
    props: {
        formmethod: {
            required: true,
            default: 'post',
        },
        formaction: {
            required: true,
            default: '{formaction}',
        },
        mcid: {
            required: true,
            default: '{ID}',
        },
        mcuser: {
            required: true,
            default: '{USER}',
        },
        mcurl: {
            required: true,
            default: '{URL.region}',
        },
        signuplocation: {
            required: true,
            default: 'subscribe-form',
        },
    },
    data() {
        return {
            formSent: false,
            form: null,
        }
    },
    mounted() {
        this.validateForm()
    },
    methods: {
        validateForm() {
            const _this = this
            window.addEventListener('load', function() {
                _this.form = _this.$el.querySelector('form')
                Validation.init(_this.form, true)
            })
        },
        handleSubmit(event) {
            const _this = this
            const submitBtn = _this.form.querySelector('[type="submit"]')

            Validation.validateSection(_this.form).then(result => {
                submitBtn.disabled = false
                if (result === true) {
                    // Valid
                    _this.sendData(_this.form)
                    _this.subscribeUser()
                } else {
                    // Invalid
                    Validation.focusInput(result[0])
                    submitBtn.disabled = true
                }
            })

            return false
        },
        sendData(form) {
            console.log(form)
            const data = new FormData(form)
            const req = new XMLHttpRequest()

            req.open(this.formmethod, this.formaction)
            req.send(data)

            this.handleConfirmation(form)
        },
        subscribeUser() {
            const _this = this
            const optIn = _this.form.querySelector('#subscribe-to-updates')

            // OK to subscribe user?
            if (optIn.checked == true) {
                const userEmailVal = _this.form.querySelector('[type="email"]')
                    .value

                const userEmailData = encodeURIComponent(userEmailVal)
                const url =
                    'https://' +
                    _this.mcurl +
                    '.list-manage.com/subscribe/post-json?u=' +
                    _this.mcuser +
                    '&id=' +
                    _this.mcid +
                    '&c=callback'
                const data =
                    '&EMAIL=' +
                    userEmailData +
                    '&SIGNUP=' +
                    _this.signuplocation

                // Create & add post script to the DOM
                var script = document.createElement('script')
                script.src = url + data
                document.body.appendChild(script)

                // Callback function
                var callback = 'callback'
                window[callback] = function(data) {
                    // Remove post script from the DOM
                    delete window[callback]
                    document.body.removeChild(script)
                    // console.log(data.msg)
                }
            }
            // console.log(url+data)
        },
        handleConfirmation(form) {
            const _this = this
            // Scroll Up
            anime({
                targets: 'html, body',
                scrollTop: 0,
                duration: 300,
                easing: 'easeInOutQuad',
            })
            _this.formSent = true
        },
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
</style>


