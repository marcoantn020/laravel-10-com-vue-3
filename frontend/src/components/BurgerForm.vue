<script>
import Message from "@/components/Message.vue";

export default {
  name: 'BurgerForm',
  components: {Message},
  data() {
    return {
      response_bread: null,
      response_meat: null,
      response_options: null,
      request_name: null,
      request_bread: null,
      request_meat: null,
      request_options: [],
      msg: "",
      url: "http://localhost:8000/api/v1"
    }
  },
  methods: {
    async getIngredients() {
      const req = await fetch(`${this.url}/ingredients`)
      const data = await req.json()
      this.response_bread = data.bread
      this.response_meat = data.meat
      this.response_options = data.optional
    },
    async createHamburger(e) {
      e.preventDefault()
      const data = {
        name: this.request_name,
        bread: this.request_bread,
        meat: this.request_meat,
        options: Array.from(this.request_options)
      }
      const dataJson = JSON.stringify(data)

      const req = await fetch(`${this.url}/burgers`, {
        method: 'POST',
        headers: {"Content-Type": "application/json"},
        body: dataJson
      })

      const res = await req.json()

      this.msg = `Pedido Nº ${res.data} realizado com sucesso.`

      setTimeout(() => this.msg = "", 3000)

      this.request_name = ""
      this.request_bread = ""
      this.request_meat = ""
      this.request_options = []

    }
  },
  mounted() {
    this.getIngredients()
  }
}
</script>

<template>
  <Message :message="msg" v-show="msg" />
  <div>
    <form id="burger-form" @submit="createHamburger($event)">
      <div class="input-container">
        <label for="name">Nome do cliente:</label>
        <input type="text" name="name" id="name" v-model="request_name" placeholder="Digite seu nome">
      </div>

      <div class="input-container">
        <label for="bread">Escolha o Pão:</label>
        <select name="bread" id="bread" v-model="request_bread">
          <option disabled>Selecione o pão</option>
          <option v-for="item in this.response_bread" :value="item.type" :key="item.id">
            {{ item.type }}
          </option>
        </select>
      </div>

      <div class="input-container">
        <label for="meat">Escolha a Carne:</label>
        <select name="meat" id="meat" v-model="request_meat">
          <option disabled>Selecione a carne</option>
          <option v-for="item in this.response_meat" :value="item.type" :key="item.id">
            {{ item.type }}
          </option>
        </select>
      </div>

      <div id="options-container" class="input-container">
        <label id="options-title" for="options">Opcionais:</label>
        <div v-for="item in this.response_options" :key="item.id" class="checkbox-container">
          <input type="checkbox" name="options" v-model="request_options" :value="item.type">
          <span>{{ item.type }}</span>
        </div>
      </div>

      <div class="input-container">
        <input type="submit" class="submit-btn" value="Criar meu Hamburger">
      </div>

    </form>
  </div>
</template>

<style scoped>
#burger-form {
  max-width: 400px;
  margin: 0 auto;
}

.input-container {
  display: flex;
  flex-direction: column;
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  margin-bottom: 15px;
  color: #222;;
  padding: 5px 10px;
  border-left: 4px solid #fcba03;
}

input, select {
  padding: 5px 10px;
  width: 300px;
}

#options-container {
  flex-direction: row;
  flex-wrap: wrap;
}

#options-title {
  width: 100%;
}

.checkbox-container {
  display: flex;
  align-items: flex-start;
  width: 50%;
  margin-bottom: 20px;
}

.checkbox-container span,
.checkbox-container input {
  width: auto;
}

.checkbox-container span {
  margin-left: 6px;
  font-weight: bold;
}

.submit-btn {
  background-color: #222;
  color:#fcba03;
  font-weight: bold;
  border: 2px solid #222;
  padding: 10px;
  font-size: 16px;
  margin: 0 auto;
  cursor: pointer;
  transition: .5s;
}

.submit-btn:hover {
  background-color: transparent;
  color: #222;
}

</style>
