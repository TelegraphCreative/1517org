<template>
  <span class="icon |" :class="classes">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="f" stroke="currentColor" x="5.25" y="3.75" width="4.5" height="16.5" rx="1.5" ry="1.5"/><rect class="f" stroke="currentColor" x="14.25" y="3.75" width="4.5" height="16.5" rx="1.5" ry="1.5"/></svg>
  </span>
</template>
<script>
export default {
  props: ["classes"]
};
</script>
