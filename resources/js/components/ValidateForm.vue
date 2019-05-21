<template>
  <form @submit.prevent="handleSubmit" accept-charset="UTF-8" class="form-base">
    <slot></slot>
  </form>
</template>
<script>
import { Validation } from '../vendor/Validation'

export default {
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
                    _this.form.submit()
                } else {
                    // Invalid
                    Validation.focusInput(result[0])
                    submitBtn.disabled = true
                }
            })

            return false
        },
    },
}
</script>
