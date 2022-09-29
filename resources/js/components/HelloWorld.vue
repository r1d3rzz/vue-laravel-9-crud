<template>
  <div>
    <h1>Hello {{ name }}</h1>
  </div>
</template>

<script>
import { ref } from "@vue/reactivity";
export default {
  setup() {
    let name = ref("Rider");

    return { name };
  },
};
</script>

<style>
</style>
