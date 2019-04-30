<template>
  <span class="icon | " :class="classes">
    <svg viewBox="0 0 12.6 16" xmlns="http://www.w3.org/2000/svg" >
      <polygon fill="currentColor" points="0,0 0,16 12.6,8 " />
    </svg>
  </span>
</template>
<script>
export default {
  props: ["classes"]
};
</script>
