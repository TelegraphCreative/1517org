<template>
    <button @click="print" class="js-print">
        <print_icon />
    </button>
</template>

<script>

import print_icon from '../icons/icon-print'

export default {
    
    methods: {
        print: function() {
            window.print();  
        }
    },

    components: {
        print_icon,
    },
}
</script>
