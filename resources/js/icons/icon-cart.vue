<template>
  <span class="icon |" :class="classes">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
      <path
        stroke="currentColor"
        class="s-2"
        d="M6,19.125h9.921A1.5,1.5,0,0,0,17.4,17.876l2.637-15.5a1.5,1.5,0,0,1,1.479-1.248H22.5"
      ></path>
      <path
        stroke="currentColor"
        class="s-2"
        d="M7.875,21.375a.375.375,0,1,1-.375.375.375.375,0,0,1,.375-.375"
      ></path>
      <path
        stroke="currentColor"
        class="s-2"
        d="M15.375,21.375A.375.375,0,1,1,15,21.75a.375.375,0,0,1,.375-.375"
      ></path>
      <path
        stroke="currentColor"
        class="s-2"
        d="M17.953,14.625H5.882a3,3,0,0,1-2.91-2.272l-1.45-5.8a.75.75,0,0,1,.728-.932H19.484"
      ></path>
    </svg>
  </span>
</template>
<script>
export default {
    props: ['classes'],
}
</script>

