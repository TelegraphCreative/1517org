<template>
  <span class="icon | " :class="classes">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="s" stroke="currentColor" d="M5.25,17.249h-3a1.5,1.5,0,0,1-1.5-1.5v-7.5a1.5,1.5,0,0,1,1.5-1.5h19.5a1.5,1.5,0,0,1,1.5,1.5v7.5a1.5,1.5,0,0,1-1.5,1.5h-3"/><line class="s" stroke="currentColor" x1="3.75" y1="9.749" x2="5.25" y2="9.749"/><rect class="s" stroke="currentColor" x="5.25" y="12.749" width="13.5" height="10.5"/><path class="s" stroke="currentColor" d="M18.75,6.749H5.25v-4.5a1.5,1.5,0,0,1,1.5-1.5h10.5a1.5,1.5,0,0,1,1.5,1.5Z"/><line class="s" stroke="currentColor" x1="8.25" y1="15.749" x2="15.75" y2="15.749"/><line class="s" stroke="currentColor" x1="8.25" y1="18.749" x2="13.5" y2="18.749"/></svg>
  </span>
</template>
<script>
export default {
  props: ["classes"]
};
</script>

