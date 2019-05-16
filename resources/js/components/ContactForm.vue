<template>
  <form @submit.prevent="handleSubmit">
    <slot name="main"></slot>
  </form>
</template>
<script>
import { Validation } from '../vendor/Validation'
import anime from 'animejs'

export default {
    props: {
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
        signuptitle: {
            required: true,
            default: 'Signup!',
        },
        confirmationtitle: {
            required: true,
            default: 'Success!',
        },
        confirmationdetail: {
            required: true,
            default: 'It worked.',
        },
    },
    data() {
        return {
            // formSent: false,
            // userEmail: '',
            // error: false,
            // errorMsg: '',
        }
    },
    // computed: {
    //     formTitle() {
    //         if (this.formSent) {
    //             return this.confirmationtitle
    //         } else {
    //             return this.signuptitle
    //         }
    //     },
    // },

    mounted() {
        this.validateForm()
    },
    methods: {
        validateForm() {
            const _this = this
            window.addEventListener('load', function() {
                const form = _this.$el
                Validation.init(form, true)
            })
        },
        handleSubmit(event) {
            const _this = this
            const form = _this.$el
            const submitBtn = form.querySelector('[type="submit"]')

            Validation.validateSection(form).then(result => {
                submitBtn.disabled = false
                if (result === true) {
                    // Valid
                    console.log('Send form')
                    _this.subscribeUser()
                    _this.sendData(form)
                } else {
                    // Invalid
                    Validation.focusInput(result[0])
                    submitBtn.disabled = true
                }
            })

            return false
        },
        sendData(form) {
            const data = new FormData(form)
            const req = new XMLHttpRequest()

            req.open(form.method, this.formaction)
            req.send(data)

            this.handleConfirmation(form)
            console.log('Sent successfully')
        },
        subscribeUser() {
            const _this = this
            const form = _this.$el
            const optIn = form.querySelector('#subscribe-to-updates')

            // OK to subscribe user?
            if (optIn.checked == true) {
                const userEmailVal = form.querySelector('[type="email"]').value

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

                    // Display response message
                    console.log('Response: ' + data.msg)
                    if (data.result !== 'error') {
                        _this.formSent = true
                        _this.error = false
                    } else {
                        _this.errorMsg = data.msg
                        _this.error = true
                    }
                }
            }
            // console.log(url+data)
        },
        clearError() {
            this.errorMsg = ''
            this.error = false
        },
        handleConfirmation(form) {
            // Scroll Up
            anime({
                targets: 'html, body',
                scrollTop: 0,
                duration: 500,
                easing: 'easeInOutQuad',
                complete: function() {
                    // Hide Form
                    anime({
                        targets: form,
                        opacity: 0,
                        duration: 500,
                        easing: 'easeInOutQuad',
                        complete: function() {
                            form.style.display = 'none'
                        },
                    })

                    // // Confirmation Text
                    // anime({
                    //     targets: headerContent,
                    //     opacity: 0,
                    //     duration: 500,
                    //     easing: 'easeInOutQuad',
                    //     complete: function() {

                    //         // Trigger conf message here

                    //         anime({
                    //             targets: headerContent,
                    //             opacity: 1,
                    //             duration: 300,
                    //             easing: 'easeInOutQuad',
                    //         })
                    //     },
                    // })
                },
            })
        },
    },
}
</script>

