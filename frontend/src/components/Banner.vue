<script>
export default {
  name: 'Banner'
}
</script>

<template>
  <div id="main-banner">
    <h1>Monte seu Hamburger</h1>
  </div>
</template>

<style scoped>
  #main-banner {
    background-image: url("../../public/img/burger.jpg");
    background-repeat: no-repeat;
    background-position: 0 -250px;
    background-size: cover;
    height: 500px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
  }

  h1 {
    background: #222;
    text-align: center;
    font-size: 60px;
    color: #fff;
    padding: 20px 40px;
  }
</style>