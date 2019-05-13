<template>
  <span class="icon | " :class="classes">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202 202">
      <polygon fill="currentColor" points="78,61 78,141 140.9,101 "/>
      <circle stroke="currentColor" class="s" cx="101" cy="101" r="100"/>
    </svg>
  </span>
</template>
<script>
export default {
  props: ["classes"]
};
</script>
