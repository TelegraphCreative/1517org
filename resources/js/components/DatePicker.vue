<template>
  <div class="date-picker">
    <input type="text" :value="dateFormated" :id="opt.id" :name="opt.name" class="hidden">
    <datepicker v-model="date"></datepicker>
    <!--  -->
  </div>
</template>
<script>
import Datepicker from 'vuejs-datepicker'
import moment from 'moment'
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
            date: moment(this.date).format('ddd DD MMM YYYY'),
        }
    },
    computed: {
        dateFormated: function() {
            return moment(this.date).format('ddd DD MMM YYYY')
        },
    },
    components: {
        Datepicker,
    },
}
</script>

<style>
.vdp-datepicker__calendar {
    box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.11),
        0 5px 15px 0 rgba(0, 0, 0, 0.08);
}
.vdp-datepicker__calendar header .prev:not(.disabled):hover,
.vdp-datepicker__calendar header .next:not(.disabled):hover,
.vdp-datepicker__calendar header .up:not(.disabled):hover {
    background: var(--ivory-lightest);
}
.vdp-datepicker__calendar header .prev:after {
    border-right: 5px solid var(--slate-darkest);
}
.vdp-datepicker__calendar header .next:after {
    border-left: 5px solid var(--slate-darkest);
}

.vdp-datepicker__calendar .cell:not(.blank):not(.disabled).day:hover,
.vdp-datepicker__calendar .cell:not(.blank):not(.disabled).month:hover,
.vdp-datepicker__calendar .cell:not(.blank):not(.disabled).year:hover {
    border-color: var(--sage-dark);
}
.vdp-datepicker__calendar .cell.selected,
.vdp-datepicker__calendar .cell.selected:hover {
    background: var(--bronze);
    color: var(--ivory-lightest);
    border-color: var(--bronze) !important;
}
</style>
