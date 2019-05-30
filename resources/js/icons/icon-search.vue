<template>
  <span class="icon |" :class="classes">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <circle
        stroke="currentColor"
        class="s-2"
        cx="9.813"
        cy="9.812"
        r="9.063"
        transform="translate(-3.056 4.62) rotate(-23.025)"
      ></circle>
      <line class="s-2" stroke="currentColor" x1="16.221" y1="16.22" x2="23.25" y2="23.25"></line>
    </svg>
  </span>
</template>
<script>
export default {
    props: ['classes'],
}
</script>

