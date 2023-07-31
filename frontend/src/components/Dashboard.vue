<script>
import Message from "@/components/Message.vue";

export default {
  name: 'Dashboard',
  components: {Message},
  data() {
    return {
      response_burgers: null,
      status: [],
      msg: null,
      url: "http://localhost:8000/api/v1"
    }
  },
  methods: {
    async getOrders() {
      const req = await fetch(`${this.url}/burgers`)
      const data = await req.json()
        this.response_burgers = data.data
      await this.getStatus()
    },
    async getStatus() {
      const req = await fetch(`${this.url}/status`)
      const data = await req.json()
      this.status = data.data
    },
    async updateStatus(event, id) {
      const statusSelected = event.target.value
      const dataJson = JSON.stringify({ status_id: statusSelected })

      await fetch(`${this.url}/burgers/${id}`, {
        method: 'PATCH',
        headers: {"Content-Type": "application/json"},
        body: dataJson
      })

      this.msg = "Pedido alterado."
      setTimeout(() => this.msg = "", 3000)
    },

  },
  mounted() {
    this.getOrders()
  }
}
</script>

<template>

  <div id="burger-table">
    <Message :message="msg" v-show="msg" />
    <div>
      <div id="burger-table-heading">
        <div class="order-id">#:</div>
        <div>Cliente:</div>
        <div>Pão:</div>
        <div>Carne:</div>
        <div>Opcionais:</div>
        <div>Ações:</div>
      </div>
    </div>

    <div id="burger-table-rows">
      <div class="burger-table-row" v-for="burger in response_burgers" :key="burger.id">
        <div class="order-number"> {{ burger.id }}</div>
        <div> {{ burger.name }} </div>
        <div> {{ burger.bread }} </div>
        <div> {{ burger.meat }} </div>
        <div>
          <ul>
            <li v-for="item in burger.options" :key="item"> {{ item }} </li>
          </ul>
        </div>
        <div>
          <select name="status" class="status" @change="updateStatus($event, burger.id)">
            <option disabled>Selecione</option>
            <option v-for="state in status" :key="state.id" :value="state.id" :selected="burger.status_id === state.id">
              {{ state.type }}
            </option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  #burger-table {
    max-width: 1200px;
    margin: 0 auto;
  }

  #burger-table-heading,
  #burger-table-rows,
  .burger-table-row {
    display: flex;
    flex-wrap: wrap;
  }

  #burger-table-heading {
    font-weight: bold;
    padding: 12px;
    border-bottom: 3px solid #333;
  }

  #burger-table-heading div,
  .burger-table-row div {
    width: 19%;
  }

  .burger-table-row {
    width: 100%;
    padding: 12px;
    border-bottom: 1px solid #ccc;
  }

  #burger-table-heading .order-id,
  .burger-table-row .order-number {
    width: 5%;
  }

  select {
    padding: 12px 6px;
    margin-right: 12px;
  }

</style>
