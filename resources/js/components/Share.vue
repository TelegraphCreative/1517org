<template>
    <button @click="share">
        <slot/>
    </button>
</template>

<script>

export default {
    props: {
        target: {
            type: String,
            required: false
        },
        subject: {
            type: String,
            required: false
        },
        message: {
            type: String,
            required: false
        },
    },    
    methods: {
        share: function() {
            if (this.target) {
                window.open (this.target, "mywindow","menubar=0,resizable=1,width=600,height=400");
            }
            else if (this.message) {
                document.location = "mailto:hello@email.com?subject="+this.subject+"&body="+this.message;
            }
        }
    },
}
</script>
