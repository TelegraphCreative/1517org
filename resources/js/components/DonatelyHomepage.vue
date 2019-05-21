<template>
	<form class="billboard__action" action="/donate">
		<div class="meta-label | mb-4">Choose Amount:</div>

		<div class="option-group -equalize -start">
			<label
				class="option-group__item | control control--radio-box"
				:for="`option-${index}`"
				v-for="(amount, index) in amounts"
				:key="index"
				@click="submit()"
			>
				<input
					:id="`option-${index}`"
					name="donately"
					type="radio"
					:value="amount.number"
				>
				<span class="control__text | w-full">${{ amount.number }}</span>
			</label>
		</div>
	</form>
</template>
<script>
export default {
    props: {
        amounts: {
            type: Array,
            required: true,
        },
    },

    data() {
        return {
        }
    },

    methods: {
        submit() {
            console.log('submit');
			
        },
    },

}
</script>