<template>
  <form
    @submit.prevent="handleSubmit"
    :method="formmethod"
    accept-charset="UTF-8"
    class="form-base"
  >
    <slot name="fields"></slot>
  </form>
</template>
<script>
import { Validation } from '../vendor/Validation'

export default {
    props: {
        formmethod: {
            required: true,
            default: 'post',
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
        const _this = this
        _this.form = _this.$el

        this.validateForm()
    },
    methods: {
        validateForm() {
            const _this = this
            window.addEventListener('load', function() {
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
                    _this.subscribeUser()
                } else {
                    // Invalid
                    Validation.focusInput(result[0])
                    submitBtn.disabled = true
                }
            })

            return false
        },
        subscribeUser() {
            const _this = this
            const optIn = document.getElementById('subscribe-to-updates')

            // OK to subscribe user?
            if (optIn && optIn.checked == true) {
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
                    console.log(data.msg)

                    setTimeout(() => {
                        _this.form.submit()
                    }, 200)
                }
            } else {
                _this.form.submit()
            }
        },
        handleConfirmation(form) {
            const _this = this
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


