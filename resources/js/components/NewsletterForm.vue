<template>
  <form @submit.prevent="handleSubmit">
    <h2 class="text-white text-lg font-normal mb-2" v-html="formTitle"></h2>
    <p v-if="formSent" v-html="confirmationdetail"></p>

    <div v-else class="relative">
      <div class="form-group">
        <div class="field-group | w-full">
          <input
            v-model="userEmail"
            type="email"
            id="email"
            class="email-input"
            name="Email"
            required
            placeholder
            @click="clearError"
          >
          <small v-if="error" v-html="errorMsg"></small>
        </div>
      </div>
      <button type="submit" class="submit">Submit</button>
    </div>
  </form>
</template>

<script>
import { Validation } from '../vendor/Validation'

export default {
    props: {
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
            formSent: false,
            userEmail: '',
            error: false,
            errorMsg: '',
        }
    },
    computed: {
        formTitle() {
            if (this.formSent) {
                return this.confirmationtitle
            } else {
                return this.signuptitle
            }
        },
    },
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
                    _this.mailchimpSignup()
                } else {
                    // section invalid, result is array of invalid inputs
                    Validation.focusInput(result[0])
                    submitBtn.disabled = true
                }
            })

            return false
        },
        mailchimpSignup() {
            const userEmailData = encodeURIComponent(_this.userEmail)
            const url =
                'https://' +
                _this.mcurl +
                '.list-manage.com/subscribe/post-json?u=' +
                _this.mcuser +
                '&id=' +
                _this.mcid +
                '&c=callback'
            const data =
                '&EMAIL=' + userEmailData + '&SIGNUP=' + _this.signuplocation

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
            // console.log(url+data)
        },
        clearError() {
            this.errorMsg = ''
            this.error = false
        },
    },
}
</script>


