<script>
export default {
  name: 'Message',
  props: {
    message: String
  }
}
</script>

<template>
  <div class="message-container">
    <p> {{ message }}</p>
  </div>
</template>

<style scoped>
  .message-container {
    color: #004085;
    background: #cce5ff;
    border: 2px solid #b8daff;
    border-radius: 5px;
    padding: 10px;
    max-width: 400px;
    margin: 30px auto;
  }
</style>